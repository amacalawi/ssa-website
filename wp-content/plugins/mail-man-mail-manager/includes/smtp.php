<?php
/**
 * Means we are using SMTP Now
 */
require_once MAIL_MAN_DIR_VENDOR . 'PHPMailer/PHPMailerAutoload.php';
$mail=null;
$mail = new PHPMailer();
// $mail->SMTPDebug = 2;

# Init
$mail->isSMTP();
$mail->Host = $smtp['host'];
$mail->Port = $smtp['port'];

# Auth
if( array_key_exists('use_auth', $smtp) )
{
    $mail->SMTPAuth = $auth = ( 'yes' === $smtp['use_auth'] ) ? true : false;
    if( $auth )
    {
        $mail->Username = $smtp['username'];
        $mail->Password = $smtp['password'];
    }
}

# Encryption / Security
if( array_key_exists('secure', $smtp) && !empty($smtp['secure']) )
{
    $mail->SMTPSecure = $smtp['secure'];
}

$mail->setFrom( $Email, $Name );

# Add To
$tos = explode(',', $To);
if( is_array($tos) )
{
    foreach ($tos as $to) {
        $mail->addAddress( trim( sanitize_email($to) ) );
    }
} else {
    $mail->addAddress( trim( sanitize_email($To) ) );
}

// $mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo($Email, $Name);

# Add CC
$ccs = explode(',', $email['cc']);
if( is_array($ccs) )
{
    foreach ($ccs as $cc) {
        $mail->addCC( trim( sanitize_email($cc) ) );
    }
} else {
    $mail->addCC( trim( sanitize_email($email['cc']) ) );
}

# Add BCC
$bccs= explode(',', $email['bcc']);
if( is_array($bccs) )
{
    foreach ($bccs as $bcc) {
        $mail->addBCC( trim( sanitize_email($bcc) ) );
    }
} else {
    $mail->addBCC( trim( sanitize_email($email['bcc']) ) );
}

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML( (array_key_exists('send_html', $smtp) && 'yes'==$smtp['send_html']) ? true : false );

# Message
$mail->Subject = $Subject;
$mail->Body    = $Message;
$mail->AltBody = $Message;

if(isset($PDFoutput)) $mail->AddStringAttachment($PDFoutput, $PDFName);

# Send
if(!$mail->send()) {
    $data['message'] = 'failed smtp.php';
    $data['errors'] = array(
        '0' => 'Error: '.$mail->ErrorInfo,
    );
} else {
    $data['message'] = '1';
    $data['errors'] = null;
    $data['method'] = 'smtp only || smtp with failed php mail';
}

?>