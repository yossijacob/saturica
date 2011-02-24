<?php

include_once 'connect.php';
include_once 'mysql.php';
include_once 'db.php';
connect();

$id  = isset($_POST['id'])? $_POST['id']: "";

if ($id != "")
	{	
		$id = CleanText($id);	
		DeleteRecord("workshops", $id); // make the deletion
		DropTable(GetWorkshopSurveyTableName($id));   // delete that workshop survey table
	}
header('Location:workshops.php');

?>