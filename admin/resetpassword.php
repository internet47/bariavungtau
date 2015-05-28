<?php
$user = isset($_POST['user'])?$_POST['user']:'';
if ($user =="")
	echo "Please, check your infomations again !!!!";
else
	{
	include('config.php');

		//////////////////////////////////////////////////////////////
		$data = get_data('users','*','username,=,'.$user.'');
		if (!$data)
		{
			echo 'This Username is not exist in system. Please, try again.'	;
		}
		else
		{
			foreach ($data as $value)
			{
				$username_ = $value['username'];
				$password_ = base64_decode($value['password']);	
			}
			
			require_once('PHPMailer/class.phpmailer.php');
			function smtpmailer($to, $from, $from_name, $subject, $body) 
			{ 
				global $error;
				$mail = new PHPMailer();  // create a new object
				$mail->IsSMTP(); // enable SMTP
				$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
				$mail->SMTPAuth = true;  // authentication enabled
				//$mail->SMTPSecure = 'ssl';
				$mail->Host = 'jp.baria-vungtau.gov.vn';
				$mail->Port = 25; 
				$mail->Username = 'no-reply@jp.baria-vungtau.gov.vn';  
				$mail->Password = 'Sct@Brvt-admin';           
				$mail->SetFrom($from, $from_name);
				$mail->Subject = $subject;
				$mail->Body = $body;
				$mail->AddAddress($to);
				if(!$mail->Send()) {
					echo $error = 'Mail error: '.$mail->ErrorInfo.'. Please, check your mail config !!!'; 
					return false;
				} else {
					echo $error = 'Message sent.';
					return true;
				}
			}
			//$to, $from, $from_name, $subject, $body
			$daychanged = date('d/m/Y h:i:s A', time());
			$ip = $_SERVER["REMOTE_ADDR"];
			$body = 'Your account login: '.$username_.'/'.$password_.' [IP restored password: '.$ip.' - Time restored: '.$daychanged.']';
			smtpmailer('hiepvd@soct.baria-vungtau.gov.vn', 'no-reply@jp.baria-vungtau.gov.vn', 'Ba Ria Vung Tau of Management System', 'Restore password', $body);
 
		}
	}
	
	//viettq@freesale-vietnam.com
	//hiepvd@soct.baria-vungtau.gov.vn
/*

$data = get_data('users','*','username,=,'.'admin'.'');
		foreach ($data as $value)
		{
			$username_ = $value['username'];
			$password_ = $value['password'];	
		}

		
require_once('bk/PHPMailer/class.phpmailer.php');
function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->Host = 'mail.freesale-vietnam.com';
	$mail->Port = 25; 
	$mail->Username = 'viettq@freesale-vietnam.com';  
	$mail->Password = 'jAwKuAMKn02';           
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
$body = 'Your account login: '.$username_.'/'.$password_;
smtpmailer('no-reply@jp.baria-vungtau.gov.vn', 'no-reply@jp.baria-vungtau.gov.vn', 'Ba Ria Vung Tau of Management System', 'Restore password', $body);
echo '<script>alert("Your account sent to no-reply@jp.baria-vungtau.gov.vn. Please, check it.")</script>';
*/
?>