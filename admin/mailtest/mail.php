<?php
require_once('PHPMailer/class.phpmailer.php');
//define('GUSER', 'fvn.lochkt@gmail.com'); // GMail username
//define('GPWD', 'gmail!!!'); // GMail password

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = 'fvn.lochkt@gmail.com';  
	$mail->Password = 'gmail!!!';           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
//$to, $from, $from_name, $subject, $body
smtpmailer('hoang.lkt@gmail.com', 'hoanglkt@gmail.com', 'yourName', 'test mail message', 'Hello World!');

?>