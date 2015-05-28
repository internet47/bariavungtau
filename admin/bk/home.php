<?php 
include('checklogin.php');
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
<link rel="stylesheet" type="text/css" href="styles/plane-layout.css">
<link rel="stylesheet" type="text/css" href="libs/menu_ie8/css/styles.css">
<link rel="stylesheet" type="text/css" href="styles/metro.css">
<script type="text/javascript" charset="utf-8" src="js/jquery.layout-latest.js"></script>
<script type="text/javascript" charset="utf-8" src="js/layout.config.js"></script>
<!--//ADDONS//-->

</head>
<body>


<iframe id="mainFrame" name="mainFrame" class="ui-layout-center" width="100%" height="600" frameborder="0" scrolling="auto" src="main.php"></iframe>


<!--//TOP//-->
<div class="ui-layout-north">
<header>
<!--//HEADER//-->
	<div id="header">
    	<div class="navlogo">
        <hgroup>
            <h1>Ba Ria Vung Tau of Management System</h1>
            <p>Welcome <a href="demo.html" target="mainFrame">
            <?php 
				include('config.php');
				$datas = get_data('users','*','username,=,'.$_SESSION['username'].'');
				foreach($datas as $val)
				{
					echo $val['name'];	
				}
			 ?>
            </a></p>
        </hgroup>
        </div>
        
        
<!--		
        <ul class="navlogin">
          <li class="active"><a href="main.html" target="mainFrame">Home</a></li>
          <li><a href="login.html" \>Logout</a></li>
        </ul>    
-->     
			<div id="metrologin">
            
							<!-- //<a class="shortcutmini" href="main.html" target="mainFrame">
                                <span class="icon">
                                    <i class="icon-link"></i>
                                </span>
                                <span class="label">
                                <img src="images/metro/24352-48-tools-icon.png">
                                    <span>Links</span>
                                </span>

                            </a> //-->

							<a class="shortcutmini" href="login.php?do=logout">
                                <span class="icon">
                                    <i class="icon-link"></i>
                                </span>
                                <span class="label">
                                <img src="images/metro/icon-man.png">
                                    <span>Logout</span>
                                </span>

                                <!--<span class="badge"></span> -->
                            </a>
             </div>
        
        
	</div>
<!--//HEADER//-->
</header>
</div>
<!--//TOP//-->

<!--//MENU//-->
<div class="ui-layout-west">

<nav>
	<ul class="menu">
		<li class="item1 active" id="one"><a href="#one"><img src="images/menu.png"> Google Map </a>
			<ul>
				<li class="subitem2"><a href="getmap.php" target="mainFrame">List location </a></li>
				<li class="subitem1"><a href="getLocation.php" target="mainFrame">Add location </a></li>
			</ul>
		</li>
		<li class="item2" id="two"><a href="#two"><img src="images/menu.png"> Gallery </a>
			<ul>
				<li class="subitem1"><a href="listvideo.php" target="mainFrame">Video Gallery</a></li>
				<li class="subitem2"><a href="videoupload.php" target="mainFrame">Upload Videos</a></li>
				<li class="subitem3"><a href="listimage.php" target="mainFrame">Picture Gallery</a></li>
				<li class="subitem2"><a href="imageupload.php" target="mainFrame">Upload Pictures </a></li>
			</ul>
		</li>
		
		<!-- //<li class="item2" id="two"><a href="#two"><img src="images/menu.png"> Manager user</a>
			<ul>
				<li class="subitem1"><a href="adduser.php" target="mainFrame">Add user</a></li>
			</ul>
		</li> //-->
		
	</ul>
</nav>

<script type="text/javascript" charset="utf-8">
    $('ul.menu li').mouseover(function(){
        $('ul.menu li.active').removeClass('active');
        $(this).addClass('active');
    });
	
</script>

<footer>
	<div id="copyright">
    	CMS Admin<br>
        Copyright by FVN 2012
    </div>
</footer>    

</div> 
<!--//MENU//-->
 

</body>
</html>