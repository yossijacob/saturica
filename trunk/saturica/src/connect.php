<?php


function connect()
{
$db_host = 'localhost';
	$db_user = 'root';
	$db_pwd = '';
	$database = 'saturica';
	
	
	if (!mysql_connect($db_host, $db_user, $db_pwd))
				die("Sorry for the inconvienence,we are having temporary technical difficulties, please try again later");
	
	if (!mysql_select_db($database))
				die("Can't select database");
	
}
?>

