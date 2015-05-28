<?php

session_start();
ob_start();
include('config.php');




if(($_POST['Submit'])){
	
	
	
	$data = get_data('users','*','username,=,"admin"');
		foreach ($data as $value)
		{
			$username_ = $value['username'];
			$password_ = $value['password'];
			
			
			
		}
		
		echo $username_;
		echo $password_;
		
		
		
		
require_once('PHPMailer/class.phpmailer.php');
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
	$mail->Password = '!!!';           
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
$body = $username_.'/'.$password_;
smtpmailer('no-reply@jp.baria-vungtau.gov.vn', 'email@gmail.com', 'Ba Ria Vung Tau of Management System', 'Restore password', $body);

		
		
		
		
//		 require_once "PEAR/Mail.php";
// 
//		 $from = "Sandra Sender <sender@example.com>";
//		 $to = "Ramona Recipient <recipient@example.com>";
//		 $subject = "Hi!";
//		 $body = "Hi,\n\nHow are you?";
//		 
//		 $host = "smtp.gmail.com";
//		 $username = "fvn.lochkt@gmail.com";
//		 $password = "gmail!!!";
//		
//		 $headers = array ('From' => $from,
//		   'To' => $to,
//		   'Subject' => $subject);
//		 $smtp = Mail::factory('smtp',
//		   array ('host' => $host,
//			 'auth' => true,
//			 'username' => $username,
//			 'password' => $password));
//		 
//		 $mail = $smtp->send($to, $headers, $body);
//		 
//		 if (PEAR::isError($mail)) {
//		   echo("<p>" . $mail->getMessage() . "</p>");
//		  } else {
//		   echo("<p>Message successfully sent!</p>");
//		  }		
		
		
		
		
		
		
		
		
		//$to      = 'hoang.lkt@gmail.com';
//			$subject = 'the subject';
//			$message = 'hello';
//			$headers = 'From: webmaster@example.com' . "\r\n" .
//				'Reply-To: webmaster@example.com' . "\r\n" .
//				'X-Mailer: PHP/' . phpversion();
//			
//			if(mail($to, $subject, $message, $headers)){
//				
//				echo '<script>alert("fffffffffffffff")<\/script>';
//				
//			}
//			else{
//				
//				echo '<script>alert("ffrrrrrrrrrrrrrrfffff")<\/script>';
//			}
	
	
}



?>


















<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>FVN Map</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->

	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<!--[if gte IE 6]>
	<link rel="stylesheet" type="text/css" href="styles/ie.css">
	<![endif]-->

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">


    

<!--//ADDONS//-->    
<link rel="stylesheet" type="text/css" href="styles/file-upload.css">


<link rel="stylesheet" type="text/css" href="libs/tiptip/tipTip.css">

<!--//ADDONS//-->
      




<!-- // valudator // -->

	
	
    	
      <!-- // calendar jquery //-->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" /> 
  
  
 
 <style>
 table#syslog{
	 border: 1px solid #333;
	 
 }
 
 table#syslog th{
	 border:1px solid #999;
	 background-color:#09F;
	 font-weight:bold;
	 text-align:center;
 }
 </style>
    
</head>
<body>

<div class="container">

<aside>
	<div class="navbar">
    	<ul>
            <li><a href="#">Home</a></li>
            <li><a href="#"><span>System</span></a></li>
            <li><a href="#"><span>Forget Password</span></a></li>
        </ul>
    </div>
</aside>

    

  <div class="sixteen columns">
	<h1 class="remove-bottom">Forget Password </h1>
<hr />
	<!--//Content//-->
	<div id="contentfrm">
    
    
    
    
    
    
    

<form action="forgetpass.php" method="post">
<label>The password will be sent to the default email</label><br />
<label>The default email</label>&nbsp;&nbsp;<input type="text" value="email@host.com" disabled="disabled" readonly />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="Submit" id="Submit" name="Submit" />

</form>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	<!--//Content//-->    

	</div>


</div>



</body>
</html>













