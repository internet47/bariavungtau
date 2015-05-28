<?php include('checklogin.php');
ob_start(); 
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


	<!-- jQuery================================================== -->
<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 


  
  

<script type="text/javascript" charset="utf-8">
		!window.jQuery && document.write('<script charset="utf-8" src="js\/jquery.min.js"><\/script>');
		!window.jQuery && document.write('<script charset="utf-8" src="js\/jquery-ui.min.js"><\/script>');
</script>
	<!-- jQuery================================================== -->
    

<!--//ADDONS//-->    
<link rel="stylesheet" type="text/css" href="styles/file-upload.css">
<script src="js/form-min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/file-upload.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="libs/tiptip/tipTip.css">
<script src="libs/tiptip/jquery.tipTip.js" type="text/javascript"></script>
<!--//ADDONS//-->
      

<script src="js/script.js" type="text/javascript" charset="utf-8" ></script>


<!-- // valudator // -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/messages_vi.js"></script>
    	<script type="text/javascript">
		$(document).ready(function(){
			$("#contact").validate({
				errorElement: "span" //Thành phần HTML hiện thông báo lỗi
				//Sử dụng tùy chọn rules cho những validate không hỗ trợ bởi class name
				/*rules: {
					cpassword: {
						equalTo: "#password" //So sánh với trường cpassword với thành trường có id là password
					},
					min_field: { min: 5 }, //Giá trị tối thiểu
					max_field: { max : 10 }, //Giá trị tối đa
					range_field: { range: [4,10] }, //Giá trị trong khoảng từ 4 - 10
					rangelength_field: { rangelength: [4,10] } //Chiều dài chuỗi trong khoảng từ 4 - 10 ký tự
				}*/
			});
		});
	</script>
      <!-- // calendar jquery //-->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" /> 
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datapicker" ).datepicker();
  });
  </script>
 
 <script type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
if (limitField.value.length > limitNum) {
limitField.value = limitField.value.substring(0, limitNum);
} else {
limitCount.value = limitNum - limitField.value.length;
}
}
</script>
    
</head>
<body>

<div class="container">

<aside>
	<div class="navbar">
    	<ul>
            <li><a href="#">Home</a></li>
            <li><a href="#"><span>Gallery</span></a></li>
            <li><a href="#"><span>Upload Video</span></a></li>
        </ul>
    </div>
</aside>

<?php 

function addLog()
{
	$ip = $_SESSION['ip'];
	//$login = $_SESSION['logindate'];
	$login = date('m/d/Y h:i:s a', time());
	$logout = '-------------------';
	$user = $_SESSION['username'];
	$content = 'Changed password success ['.date('m/d/Y h:i:s a', time()).']';
	
		
	$xdoc = new DomDocument;
	$xdoc->Load('data/syslog.xml');
	
	$root = $xdoc->firstChild; // Xac dinh root, de tu root them vo node.
	
	$newAdmin = $xdoc->createElement('admin'); // Tao them node moi 1
	$root->appendChild($newAdmin); // Them node moi 1
	
	
	$newUser = $xdoc->createElement('user'); //Tao node moi 2
	$newAdmin->appendChild($newUser); // Dung node 1 de them node 2
	$userText = $xdoc->createTextNode($user); //Tao text cho node 2
	$newUser->appendChild($userText); // Dung node 2 them text cho chinh no
	
	$newLogin = $xdoc->createElement('login');
	$newAdmin->appendChild($newLogin);
	$loginText = $xdoc->createTextNode($login);
	$newLogin->appendChild($loginText);
	
	$newLogout = $xdoc->createElement('logout');
	$newAdmin->appendChild($newLogout);
	$logoutText = $xdoc->createTextNode($logout);
	$newLogout->appendChild($logoutText);
	
	$newContent = $xdoc->createElement('content');
	$newAdmin->appendChild($newContent);
	$contentText = $xdoc->createTextNode($content);
	$newContent->appendChild($contentText);
	
	$newIp = $xdoc->createElement('ip');
	$newAdmin->appendChild($newIp);
	$ipText = $xdoc->createTextNode($ip);
	$newIp->appendChild($ipText);

	$xdoc->save('data/syslog.xml') or die("Error save log file");
	
}//end addlog





$checkpassold ='';
$checkpassnew='';
$success ='';
if(isset($_POST['submit']))
{
	include('config.php');
	$passold = trim($_POST['passsold']);
	$passoldmd5 = base64_encode($passold);
	
	$passnew = $_POST['passsnew'];
	$passrenew = $_POST['repasss'];
	
	$change = get_data('users','*','username,=,'.$_SESSION['username'].'');
	$username = $_SESSION['username'];
	foreach($change as $val)
	{
		if($val['password']==$passoldmd5)
		{
			if($passnew==$passrenew)
			{
				$passnewmd5 = base64_encode($passnew);
				//$passnewmd5 = $passnew;
				//add_data('users',array($id,$fullname,$username,$password));
				update_data('users',array('username',$_SESSION['username']),array($val['id'],$val['name'],$_SESSION['username'],$passnewmd5));
				$success ='Change password successful';				
				addLog();
				
				////////////////SEND MAIL AFTER CHANGE ///////
				require_once('PHPMailer/class.phpmailer.php');
				//$to, $from, $from_name, $subject, $body
				$daychanged = date('d/m/Y h:i:s A', time());
				$ip = $_SERVER["REMOTE_ADDR"];
				$body = 'Your account login: '.$username.'/'.$passrenew. ' [IP changed password: '.$ip.' - Time changed: '.$daychanged.']';//
				smtpmailer('hiepvd@soct.baria-vungtau.gov.vn', 'no-reply@jp.baria-vungtau.gov.vn', 'Ba Ria Vung Tau of Management System', 'You have changed password', $body);
				echo '<script>alert("Your new password sent to hiepvd@soct.baria-vungtau.gov.vn.")</script>';
				//////////////////////////////////////////////
				//hiepvd@soct.baria-vungtau.gov.vn
				
				session_destroy();
			}
			else
			{
				$checkpassnew='Enter re-password new is not correct';
			}
		}
		else
		{
			$checkpassold ='Enter password old is not correct';
		}
	}
}






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




?>
    

		<div class="sixteen columns">
			<h1 class="remove-bottom">Form Change Password </h1>
			
			
			<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Here we parse the form
    if(!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $_POST['csrf'])
        throw new RuntimeException('CSRF attack');
 
    //Do the rest of the processing here
}
 
//Generate a key, print a form:
$key = sha1(microtime());
$_SESSION['csrf'] = $key;
?>

	<!--//Content//-->
	<div id="contentfrm">
    
    
    <form action="#" id="contact" method="post" name="form" enctype="multipart/form-data" class="contact-form">
    	<div class="incon"> <hr /> </div>
        
        <div class="texttitle"></div>
        <div class="frmname"><span id="charLeft"><?php echo $success; ?></span></div>
        
        <div class="texttitle">Passsword old</div>
        <div class="frmname"><input type="password" autocomplete="off" class="required" name="passsold" maxlength="15"><span id="charLeft"><?php echo $checkpassold; ?></span></div>
        
        <div class="texttitle">Password new</div>
        <div class="frmname"><input type="password" autocomplete="off" class="required" name="passsnew" maxlength="15"><span id="charLeft">
        <span id="charLeft"></span></div>
        
        <div class="texttitle">Re-Password new</div>
        <div class="frmname"><input type="password" autocomplete="off" class="required" name="repasss" maxlength="15"><span id="charLeft">
        <span id="charLeft"><?php echo $checkpassnew; ?></span></div>
        

         <div class="texttitle">&nbsp;</div>
        <div class="frmname subres">
        	<input type="submit" name="submit" value="Change">
        </div>  

            
        
    </div>
    <input type="hidden" name="csrf" value="<?php echo $key; ?>" />
    </form>
	<!--//Content//-->    

		</div>


</div>



</body>
</html>