<?php session_start(); ?>
<? ob_start(); ?>
<?php 

function tranfer()
{
	include('tranfer.htm');
}
if (isset($_GET['do']) == 'logout' && isset($_SESSION['username']))
{
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
			
			if ($username == $value['username'] && md5($password) ==$value['password'])
			{
				 $_SESSION['username']= $username;
				 $date = date('m/d/Y h:i:s a', time());
				 $_SESSION['logindate'] = $date;	
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



</head>
<body>

	<!-- Begin Page Content -->
	
	<div id="containerlogin">
			
			<form name="form-login" action="login.php" method="post" class="form-signin">
			
				<label for="username">Username:</label>
				
				<input type="text" id="username" name="username">
				
				<label for="password">Password:</label>
				
				<!--<p><a href="#">Forgot your password?</a></p> -->
				
				<input type="password" id="password" name="password">
				
				<div id="lower">
				
					<!--<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label> -->
					
					<input type="submit" value="Login" name="Login" id="Login">
				
				</div><!--/ lower-->
			
			</form>
			
		</div><!--/ container-->
	
	
	<!-- End Page Content -->


</body>
</html>