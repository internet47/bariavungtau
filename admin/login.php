<?php 
$lifetime=6000;
session_set_cookie_params($lifetime);
session_start(); ?>
<? ob_start(); ?>
<?php 

function tranfer()
{
	include('tranfer.htm');
}


function addLog()
{
	$ip = $_SESSION['ip'];
	$login = $_SESSION['logindate'];
	$logout = '-----------------';
	$user = $_SESSION['username'];
	$content = $_SESSION['content'];
	
		
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





if (isset($_GET['do']) == 'logout' && isset($_SESSION['username']))
{
	$ip = $_SESSION['ip'];
	//$login = $_SESSION['logindate'];
	$login = date('m/d/Y h:i:s a', time());
	$logout = date('m/d/Y h:i:s a', time());
	$user = $_SESSION['username'];
	$content = 'Logout success';
	
		
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

	$xdoc->save('data/syslog.xml');
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//  $admin = array(); 
//  $admin [] = array( 
//  'user' => $user, 
//  'login' => $login, 
//  'logout' => $logout,
//  'content' => $content,
//  'ip' => $ip
//  ); 
// 
//   
//  $doc = new DOMDocument(); 
//  $doc->formatOutput = true; 
//   
//  $r = $doc->createElement( "List" ); 
//  $doc->appendChild( $r ); 
//
//   
//  foreach( $admin as $admin ) 
//  { 
//		  $b = $doc->createElement( "admin" ); 
//		   
//		  $user_ = $doc->createElement( "user" ); 
//		  $user_->appendChild($doc->createTextNode( $admin['user'] )); 
//		  $b->appendChild( $user_ ); 
//			  
//		  $login_ = $doc->createElement( "login" ); 
//		  $login_->appendChild($doc->createTextNode( $admin['login'] )); 
//		  $b->appendChild( $login_ ); 
//			 
//		  $logout_ = $doc->createElement( "logout" ); 
//		  $logout_->appendChild($doc->createTextNode( $admin['logout'])); 
//		  $b->appendChild( $logout_ ); 
//		  
//		  $content_ = $doc->createElement("content");
//		  $content_->appendChild($doc->createTextNode($admin['content']));
//		  $b->appendChild($content_);
//		  
//		  $ip_ = $doc->createElement("ip");
//		  $ip_->appendChild($doc->createTextNode($admin['ip']));
//		  $b->appendChild($ip_);
//		  
//		  $r->appendChild( $b ); 
//  } 
//   
//  echo $doc->saveXML(); 
//  $doc->save("data/syslog.xml"); 
//	
//	
	
	session_destroy();
}
if (isset($_SESSION['username']))
	header("location:index.php");
include('config.php');
//create_table('users',array('id','name','username','password'));
//add_data('users',array('1','long','admin','admin'));

	if (isset($_POST['Login']))
	{
		//$data = get_data('users','*');
		$data = get_data('users','*','username,=,'.$_POST['username'].'');
		foreach ($data as $value)
		{
			$username = $_POST['username'];
			$username = addslashes($username);
			
			
			$password = $_POST['password'];
			$password = addslashes($password);
			$password = base64_encode($password);
			
			if ($username == $value['username'] && $password ==$value['password'])
			{
				 $_SESSION['username']= $username;
				 $date = date('m/d/Y h:i:s a', time());
				 $_SESSION['logindate'] = $date;	
				
				 if (!empty($_SERVER['HTTP_CLIENT_IP'])){
					  $ip=$_SERVER['HTTP_CLIENT_IP'];
					//Is it a proxy address
					}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
					  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
					}else{
					  $ip=$_SERVER['REMOTE_ADDR'];
					}

					$_SESSION['ip'] = $ip;
					$_SESSION['content'] = 'Login success';
					
					addLog();//ghi log vào hệ thống	
				 header("location: index.php");
			}
			else
			{
				/*echo '<script>$(function()
				{ 
				$("#falselogin").css("display","inline");
				$("#thongbao").css("display","none");
				$("#username").focus();
				});
				</script>';*/
				 
				header("location: login.php");
			}
		}
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
	<title>Login</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->

<link rel="stylesheet" type="text/css" href="styles/loginbase.css">
<link rel="stylesheet" type="text/css" href="styles/animate.css">
<link rel="stylesheet" type="text/css" href="styles/login.css">
	<!--[if gte IE 6]>
	<link rel="stylesheet" type="text/css" href="styles/ie.css">
	<![endif]-->

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon================================================== -->
	<!-- //<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png"> // -->


	<!-- jQuery================================================== -->
<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 

<script type="text/javascript" charset="utf-8">
		!window.jQuery && document.write('<script charset="utf-8" src="js\/jquery.min.js"><\/script>');
		!window.jQuery && document.write('<script charset="utf-8" src="js\/jquery-ui.min.js"><\/script>');
</script>
	<!-- jQuery================================================== -->

<style>
.erorr
	{
		font-size:12px;
		color: #F00;
		
	}

</style>

<script>
$(document).ready(function(e) {
    $("#Forgot").click(function(e) {
		var ans = confirm("Do you want restore password to email ?");
		if (ans)
		{
			var user = $("#username").val();
			if (user !="")
				{
					$.ajax({
						type:"POST",
						url:"resetpassword.php",
						data:"user="+user,
						cache:false
					}).done(function(data){
						//alert(data);
						$(".erorr").text(data).fadeIn(2000);
					});
				}
			else
				{
					$(".erorr").text('Please, type your Username that you want to send password.').fadeIn(2000);
					$("#username").focus();
				}
		}
		else
		{
			return false;
		}
    });//end forgot
});//end ready
</script>

</head>
<body>

	<!-- Begin Page Content -->
	
	<div id="containerlogin">
    
    
    
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



			
			<form name="form-login" action="login.php" method="post" class="form-signin">
			
				<label for="username">Username:</label>
				
				<input type="text" id="username" name="username">
				
				<label for="password">Password:</label>
				
				<!--<p><a href="#">Forgot your password?</a></p> -->
				
				<input type="password" id="password" autocomplete="off" name="password">
				
				<div id="lower">
                	<span class="erorr"></span>
					<input type="button" value="Forgot Password" name="Forgot" id="Forgot">
					<input type="submit" value="Login" name="Login" id="Login">
					<input type="hidden" name="csrf" value="<?php echo $key; ?>" />
				</div><!--/ lower-->
			
			</form>
			
		</div><!--/ container-->
	
	
	<!-- End Page Content -->


</body>
</html>