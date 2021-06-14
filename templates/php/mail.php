<?php

$mailto = "where_to_send_email@example.com";
if( isset($_POST['mailto']) ){
	$mailto = $_POST['mailto'];
}

$subject = 'Default Subject Line';
if( isset($_POST['subject']) ){
	$subject = $_POST['subject'];
}

$from_str   = '';
$from_email = '';
if( isset($_POST['email']) ){
	$from_email = $_POST['email'];
	$from_str = $from_email;
	if( isset($_POST['name']) ){
		$from_str = $_POST['name'] . " <" . $from_email . ">";
	}
}

$body = "<html><body>\r\n";
$body .= "<table style='border: 1px solid #ccc;border-collapse: collapse;width:100%;' cellpadding='10' cellspacing='0'>\r\n";
foreach ($_POST['items'] as $key => $value) {
	$body .= "<tr><td style='border: 1px solid #ccc;text-transform: capitalize;vertical-align: top;width:100px'><b>" . $key . "</b></td><td style='border: 1px solid #ccc;'>" . $value . "</td></tr>\r\n";
}
$body .= "</table>\r\n";
$body .= "</html></body>";


$headers = "From: " . $from_str . "\r\n";
$headers .= "Reply-To: " . $from_email . "\r\n";
// $headers .= "CC: \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=iso-8859-1\n";

if (mail ($mailto, $subject, $body, $headers)) {
	echo '<p>Your message has been sent!</p>';
} else {
	echo '<p class="error">Something went wrong, try again!</p>';
}

?>
