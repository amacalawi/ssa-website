<?php
/*
| -----------------------------------------------
| # Sender
| -----------------------------------------------
*/

# if the submit button is clicked, send the email
$data = [];

if ( isset( $_POST['contact'] ) ) {

    $MailMan = new MailManController();
    $MailMailer = new MailManMailMailerController();

    $options = $MailMan->get_options();
    $Get_Options = $options->options;

    /**
     * extracted equals to
     * $smtp = []
     * $email= []
     * $shortcode = string
     * $page = string
     */
    extract($Get_Options);

    $form = $_POST['contact'];

    $Name    = sanitize_text_field( $form['name'] );
    $Email   = sanitize_email( $form['email'] );
    $Subject = "Message from ".$Name;
    $Phone   = (isset($form['phone']) && (strlen($form['phone']) > 5) ) ? $form['phone'] : '';
    $Note    = isset($form['note']) ? nl2br($form['note']) : '';
    $Course  = isset($form['course']) ? $form['course'] : '';
    $Message = isset($form['message']) ? nl2br($form['message']) : $Note . PHP_EOL;

    $Headers = "From: $Name <$Email>" . "\r\n" . PHP_EOL;
    $Headers.= "Reply-To: $Email" . "\r\n" . PHP_EOL;

    # To
    $To      = ('' !== $email['to']) ? $email['to'] : get_bloginfo('admin_email');
        if( isset($form['course']) )
        {
            include_once('pdf-generator.php');
            include_once('confirmation-email.php');
        }

    # CC
    $ccs = explode(',', $email['cc']);
    if( is_array($ccs) )
    {
        foreach ($ccs as $cc) {
            $Headers.= "CC: ". trim( sanitize_email( $cc ) ) .PHP_EOL;
        }
    } else {
        $Headers.= "CC: ". trim( sanitize_email($email['cc']) ) .PHP_EOL;
    }

    # BCC
    $bccs = explode(',', $email['bcc']);
    if( is_array($bccs) )
    {
        foreach ($bccs as $bcc) {
            $Headers.= "BCC: ". trim( sanitize_email( $bcc ) ) .PHP_EOL;
        }
    } else {
        $Headers.= "BCC: ". trim( sanitize_email($email['bcc']) ) .PHP_EOL;
    }


    # Validation Fallback
    # This will run if the
    # jQuery Validation doesn't.
    $errorsArray  = array();
    $hasError    = false;

    $fieldsArray = array(
        'name' => $Name,
        'email' => $Email,
        'message' => $Message,
    );

    # Check the $fieldsArray for errors
    foreach ($fieldsArray as $key => $value) {
        switch ($key) {
            case 'name':
                $len = strlen($value);
                if($len < 3) {
                    $hasError = true;
                    $errorsArray[$key] ="Name field cannot be empty or abbreviated. Please fill out accordingly.";
                }
            break;
            case 'email':
                if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    $hasError = true;
                    $errorsArray[$key] = "Invalid email syntax or email field is empty.";
                } else {
                    $Email = filter_var($Email, FILTER_SANITIZE_EMAIL);
                }
            break;
            case 'message':
                if(empty($value)) {
                    $hasError = true;
                    $errorsArray[$key] = "Message field cannot be empty. Please fill out accordingly.";
                }
            break;
        }
    }

    # If email has been process for sending, display a success message
    if( $hasError == true ):
        $data['message'] = 'failed';
        $data['errors'] = $errorsArray;
        $data['method'] = 'avc-bs';
    else:

        /**
         * If no Errors, then we are good to go.
         *
         * Now, we check if the Settings is using
         * SMTP Only
         */
        if( array_key_exists('usage', $smtp) && 'use_smtp_only' === $smtp['usage'] )
        {

            include MAIL_MAN_DIR_INCLUDES . "smtp.php";

        }
        elseif( array_key_exists('usage', $smtp) && 'use_smtp_fallback' === $smtp['usage'] )
        {
            /**
             * Else its SMTP as fallback
             * so start with WP_Mail()
             */
            if(isset($PDFoutput))
            {
                $attachments = array();
                $pdf_attachment = array(
                    'pdf_doc_attachment_id' => $PDFoutput
                );
                $attachments[] = wp_json_encode( $pdf_attachment );
            }
            if ( wp_mail( $To, $Subject, html_entity_decode(nl2br($Message)), $Headers, isset($attachments) ? $attachments : null ) )
            {
                $data['message'] = '1';
                $data['errors'] = null;
                $data['method'] = 'smtp fallback with php mail';
            } else {

                include MAIL_MAN_DIR_INCLUDES . "smtp.php";

            }
        }
        elseif( array_key_exists('usage', $smtp) && 'no_smtp' === $smtp['usage'] )
        {
            if ( wp_mail( $To, $Subject, nl2br($Message), $Headers ) )
            {
                $data['message'] = '1';
                $data['errors'] = null;
                $data['method'] = 'vanilla php mail';
            }
            else
            {
                $data['message'] = 'failed';
                $data['errors'] = array(
                    '0' => "Unable to send the email. Please enable the PHP Mail Function or contact the Host Server Administrator.",
                );
            }
        }

        /**
         * Check if we the Save to Database Option is enabled
         */
        if( '1' == $data['message'] && array_key_exists('enable_email_saving', $Get_Options) && 'yes' == $Get_Options['enable_email_saving'] )
        {
            $options->subject = $Subject;
            $options->name    = $Name;
            $options->email   = $Email;
            $options->message = $Message;
            /*
            | -------------------
            | # MailMailer Create
            | -------------------
            */
            $MailMailer->create($options);
        }

    endif;
}

// $data['options'] = $Get_Options;
echo json_encode($data);
die(); ?>