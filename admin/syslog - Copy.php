<?php
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

$file = 'data/syslog.xml';
if (file_exists($file)) {
    $xml = simplexml_load_file($file);
	//echo $_SESSION['ip'];
    //print_r($xml);
} else {
    exit('Failed to open '.$file);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1">
  <tr>
    <td width="20%" align="center" valign="top">User</td>
    <td width="20%" align="center" valign="top">Login</td>
    <td width="20%" align="center" valign="top">Logout</td>
    <td width="20%" align="center" valign="top">Content</td>
    <td width="20%" align="center" valign="top">IP</td>
  </tr>

  
  <?php
  
  
  foreach($xml->admin as $admin) {
	  
	  ?>
        <tr>
       <td width="20%" align="center" valign="top"><?=(string)$admin->user?></td>
       <td width="20%" align="center" valign="top"><?=(string)$admin->login?></td>
       <td width="20%" align="center" valign="top"><?=(string)$admin->logout?></td>
       <td width="20%" align="center" valign="top"><?=(string)$admin->content?></td>
       <td width="20%" align="center" valign="top"><?=(string)$admin->ip?></td>
      </tr>
      <?php
	  
 
}



	?>
  
  
  
</table>

</body>
</html>