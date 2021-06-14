<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/jereakzp/public_html/php/PHPMailer/src/Exception.php';
require '/home/jereakzp/public_html/php/PHPMailer/src/PHPMailer.php';
require '/home/jereakzp/public_html/php/PHPMailer/src/SMTP.php';

//die spam bots
if (empty(end($_POST['items']))) die();

//making table to add as body
$body = "<html><body>\r\n";
$body.= "<table style='border: 1px solid #ccc;border-collapse: collapse;width:100%;' cellpadding='10' cellspacing='0'>\r\n";
foreach ($_POST['items'] as $key => $value) {
	$body .= "<tr><td style='border: 1px solid #ccc;text-transform: capitalize;vertical-align: top;width:100px'><b>" . $key . "</b></td><td style='border: 1px solid #ccc;'>" . $value . "</td></tr>\r\n";
}
$body .= "</table>\r\n";
$body .= "</html></body>";

//PHPMailer setup
$mail = new PHPMailer(true); 
$mail->isSMTP();                                            
$mail->Host       = 'jeremyhummel.me';                    
$mail->SMTPAuth   = true;                                   
$mail->Username   = 'phpmailer@jeremyhummel.me';                      
$mail->Password   = '#tOFWj!z+}Y~v';  
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
$mail->Port       = 465;                                    

//From email address and name
$mail->From     = "phpmailer@jeremyhummel.me";
$mail->FromName = $_POST['name'];

//To address and name
$mail->addAddress("jeremyhummel@jeremyhummel.me");

//Address to which recipient will reply
$mail->addReplyTo($_POST['email'], $_POST['name']);

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = 'New Message from JeremyHummel.me';
$mail->Body = $body;

try {
    $mail->send();
	echo '<p>Your message has been sent! I will get back to you shortly :) </p>';
} catch (Exception $e) {
	echo "ERROR: There was a problem sending your message, try again later.";
}

?>
