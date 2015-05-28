<?php include('checklogin.php');
ob_start(); 
session_start();
include('config.php');


//$xmlDoc = new DOMDocument();
//$xmlDoc->load("data/syslog.xml");
//
//$x = $xmlDoc->documentElement;
//foreach ($x->childNodes AS $item)
//  {
//  print $item->nodeValue . "<br />";
//  }

if(isset($_GET['clear']) || ($_GET['clear']==1)){
	
	$xml = simplexml_load_file('data/syslog.xml');
	foreach($xml->List as $list){
		
		unset($list->admin);	
		
	}
	$xml->asXML();
//	$dom = new DOMDocument();
//	$dom->Load('data/syslog.xml');
//	$admin = $dom->getElementsByTagName('admin');
//	
//	//$count =  count($admin);
//	
//	
//		foreach ($admin as $node) {
//			$node->parentNode->removeChild($node);
//			
//			
//		}
//		
//	
//		$dom->save('data/syslog.xml');
		$_SESSION['content'] .= 'Admin cleaned the logs <br />';
}


$file = 'data/syslog.xml';
if (file_exists($file)) {
    $xml = simplexml_load_file($file);
	//echo $_SESSION['ip'];
    //print_r($xml);
} else {
    exit('Failed to open '.$file);
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
            <li><a href="#"><span>Logs</span></a></li>
        </ul>
    </div>
</aside>

    

  <div class="sixteen columns">
	<h1 class="remove-bottom">System Logs </h1>

	<!--//Content//-->
	<div id="contentfrm">
    
    
    
    
    
    
    

<table width="100%" border="1" cellpadding="0" cellspacing="3" id="syslog">
  <tr>
    <th width="20%" align="center" valign="top">User</th>
    <th width="20%" align="center" valign="top">Login</th>
    <!--th width="20%" align="center" valign="top">Logout</th-->
    <th width="40%" align="center" valign="top">Content</th>
    <th width="20%" align="center" valign="top">IP</th>
  </tr>

  
  <?php
  
  
  foreach($xml->admin as $admin) {
	  
	  ?>
        <tr style="border-bottom:1px solid #999">
       <td width="20%" align="center" valign="top"><?=(string)$admin->user?></td>
       <td width="20%" align="center" valign="top"><?=(string)$admin->login?></td>
     <!--  <td width="20%" align="center" valign="top"><?(string)$admin->logout?></td> -->
       <td width="40%" align="left" valign="top"><?=(string)$admin->content?></td>
       <td width="20%" align="center" valign="top"><?=(string)$admin->ip?></td>

      </tr>
       
      <?php	  
 
}

	?>
  
<!--   <tr style="border-bottom:1px solid #999">
          <td align="left" valign="top"><a href="syslog.php?clear=1">Clear logs</a></td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
      </tr>
-->  
</table>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	<!--//Content//-->    

	</div>


</div>



</body>
</html>