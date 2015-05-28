<?php

session_start();
ob_start();
include('config.php');

if(($_POST['Submit']))
{
	
	$data = get_data('users','*','username,=,'.$_SESSION['username'].'');
		foreach ($data as $value)
		{
			$username_ = $value['username'];
			$password_ = base64_decode($value['password']);	
		}

		
require_once('PHPMailer/class.phpmailer.php');
function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
				$mail->Host = 'jp.baria-vungtau.gov.vn';
				$mail->Port = 25; 
				$mail->Username = 'no-reply@jp.baria-vungtau.gov.vn';  
				$mail->Password = 'Sct@Brvt-admin';         
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
$daychanged = date('d/m/Y h:i:s A', time());
$ip = $_SERVER["REMOTE_ADDR"];
$body = 'Your account login: '.$username_.'/'.$password_.' [IP restored password: '.$ip.' - Time restored: '.$daychanged.']';
smtpmailer('hiepvd@soct.baria-vungtau.gov.vn', 'no-reply@jp.baria-vungtau.gov.vn', 'Ba Ria Vung Tau of Management System', 'Restore password', $body);
echo '<script>alert("Your account sent to hiepvd@soct.baria-vungtau.gov.vn. Please, check it.")</script>';
}

//viettq@freesale-vietnam.com
//hiepvd@soct.baria-vungtau.gov.vn
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
<label>The default email</label>&nbsp;&nbsp;<input type="text" value="hiepvd@soct.baria-vungtau.gov.vn" disabled="disabled" readonly />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="Submit" id="Submit" name="Submit" />

</form>
	<!--//Content//-->    

	</div>


</div>



</body>
</html>













