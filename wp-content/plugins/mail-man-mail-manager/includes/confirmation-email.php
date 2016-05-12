<?php
/*
| -------------------------------------------
| # Send Confirmation Email to User
| -------------------------------------------
*/
require_once MAIL_MAN_DIR_VENDOR . 'PHPMailer/PHPMailerAutoload.php';

$Site_name = get_bloginfo('name');
# Init
$mail = new PHPMailer();
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

$mail->setFrom( $To, get_bloginfo('name') );

# Add To - (user)
$mail->addAddress( trim( sanitize_email($Email) ) );

# Add no-reply
$mail->addReplyTo($To, get_bloginfo('name'));

# is HTML
$mail->isHTML( (array_key_exists('send_html', $smtp) && 'yes'==$smtp['send_html']) ? true : false );

# Message
/*
 *
Dear Trainee,

Your registration is now confirmed. We thank you for registering in our e-Learning Course. Your schedule is attached in the document below.

Best Regards,
SSA Manila Team

 */
$mail->Subject = '['.$Site_name .'] - Thank you for your E-Learning Registration';
    $Message_to_user = '<p>Dear Trainee,</p><br>';
    $Message_to_user.= '<p>Your registration is now confirmed. We thank you for registering in our e-Learning Course. Your schedule is attached in the document below.</p><br>';
    $Message_to_user.= '<p>Best Regards,</p>';
    $Message_to_user.= $Site_name . ' Team';
$mail->Body    = $Message_to_user;
$mail->AltBody = $Message_to_user;

if(isset($PDFoutput)) $mail->AddStringAttachment($PDFoutput, $PDFName);
if(isset($PDFoutput)) $mail->addAttachment(dirname( __FILE__ ).'/attachments/HiCPTA-schedule.zip');

# Send
if(!$mail->send()) {
    $data['message'] = 'failed';
    $data['errors'] = array(
        '0' => 'Error: '.$mail->ErrorInfo,
    );
} else {
    $data['message'] = '1';
    $data['errors'] = null;
    $data['method'] = 'smtp only || smtp with failed php mail';
}
 ?>