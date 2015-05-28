<?
include('checklogin.php');
 ob_start(); ?>
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
				errorElement: "span", //Thành phần HTML hiện thông báo lỗi
				//Sử dụng tùy chọn rules cho những validate không hỗ trợ bởi class name
				rules: {
					cpassword: {
						equalTo: "#password" //So sánh với trường cpassword với thành trường có id là password
					},
					min_field: { min: 5 }, //Giá trị tối thiểu
					max_field: { max : 10 }, //Giá trị tối đa
					range_field: { range: [4,10] }, //Giá trị trong khoảng từ 4 - 10
					rangelength_field: { rangelength: [4,10] } //Chiều dài chuỗi trong khoảng từ 4 - 10 ký tự
				}
			});
		});
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
		<div class="sixteen columns">
			<h1 class="remove-bottom">Form add user </h1>

	<!--//Content//-->
	<div id="contentfrm">
    <form action="#" id="contact" method="post" name="form" enctype="multipart/form-data" class="contact-form">
    <?php include('config.php');
		//create_table('videos',array('id','title','description','link','video','date','status'));
	?>   
    	<div class="incon_1">
            <?php
		//include('upload_image.php');
		if(isset($_POST['submit']))
		{
			$id = uniqid();
			$fullname = $_POST['fullname'];
			$username = $_POST['username'];	
			$password = md5($_POST['password']);
			add_data('users',array($id,$fullname,$username,$password));
			
			//header('Location: user.php');	
			echo 'Add user complete';
		}
	?>
        </div>
        
        <div class="texttitle"> Full name</div>
        <div class="frmname"><input type="text" class="required" name="fullname"></div>
        
        <div class="texttitle"> Username</div>
        <div class="frmname"><input type="text" class="required" name="username"></div>
        
        <div class="texttitle"> Password</div>
        <div class="frmname"><input class="required" minlength="6" id="password" name="password" type="text" class="text" tabindex="2" /></div>
        
    	<div class="texttitle"> Repassword</div>
        <div class="frmname"><input class="required" name="cpassword" type="text" class="text" tabindex="3" /></div>
        
        <div class="texttitle">&nbsp;</div>
        <div class="frmname subres">
        <input type="reset" name="reset" value="Reset">
        <input type="submit" name="submit" value="Submit">
        </div>

            
        
    </div>
    </form>
	<!--//Content//-->    

		</div>


</div>



</body>
</html>