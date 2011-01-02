<?php
session_start();
if (!is_authenticated()) 
			header("Location:login.php"); 
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB	 

ForgotPassword();
header("Location:login.php");

?>

