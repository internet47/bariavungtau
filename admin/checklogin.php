<?php
$lifetime=6000;
session_set_cookie_params($lifetime);
session_start(); 
if (!isset($_SESSION['username']) || isset($_SESSION['username'])=="")
{
	header("location: login.php");
}
?>