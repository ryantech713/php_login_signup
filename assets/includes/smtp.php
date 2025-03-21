<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

$mail = new PHPMailer(true);

try {
	// SMTP Configuration
	$mail->isSMTP();
	$mail->Host = 'smtp.hostinger.com'; // Replace with your SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = 'admin@713techsupport.com'; // Your SMTP username
	$mail->Password = '#H!town$rdcRYAN410'; // Your SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS or PHPMailer::ENCRYPTION_SMTPS for SSL
	$mail->Port = 587; // Usually 587 for TLS, 465 for SSL

	// Sender & Recipient
	$mail->setFrom('noreply@713techsupport.com', '713TechSupport.com Admin');
	$mail->addAddress($email, $fullname);

	// Email Content
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body    = $email_body;
	$mail->AltBody = $alt_email_body;

	// Send Email
	$mail->send();
	echo 'Email has been sent successfully!';
} catch (Exception $e) {
	echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
