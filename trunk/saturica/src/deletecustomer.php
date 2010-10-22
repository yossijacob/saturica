<?php

include_once 'connect.php';
include_once 'mysql.php';
connect();

$id  = isset($_POST['id'])? $_POST['id']: "";

if ($id != "")
	{	
		$id = CleanText($id);	
		DeleteRecord("customers", $id); // make the deletion
	}
header('Location:customers.php');

?>