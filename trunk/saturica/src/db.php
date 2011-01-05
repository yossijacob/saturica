<?php
include_once 'time.php';

//********************************************************************
function GetPreferences()
{
	$result = mysql_query("SELECT * FROM preferences");
	$row = mysql_fetch_row($result);
	$preferences['email'] = $row[1];
	$preferences['cap'] = $row[4];
	return $preferences;
}
//********************************************************************
function SetPreferences($preferences)
{
	$query  = "UPDATE preferences SET cap ='".$preferences['cap']."',email ='".$preferences['email']."'";
	$result = mysql_query($query)
	or die(mysql_error());
}

//------------------------------------------------------------------------------------*/
function ShowColumnDropDown($table,$val_col_num,$text_col_num,$name,$deafult,$deafult_text,$selected)
/**
 * Enter description here ...
 *  $table - the table from which to take data
 * $val_col_num - the number of column to get values from
 * $text_col_num - the number of columns to get text from
 * $name - the name of the select box
 * $deafult - deafult value
 * $deafult_text - deafult text
 * $selected - selected value
 */
{
	$data_val = GetColumn($table, $val_col_num);
	$data_text = GetColumn($table, $text_col_num);
	ShowDropDown($name, $data_val,$data_text, $deafult,$deafult_text,$selected);
}

//***********************************************************************
function SetDailyCap($table_id,$cap)
{
	Debug("FUNCTION: SetDailyCap : table_id=$table_id<br/>");
	$result = mysql_query("UPDATE brokers_queue SET cap='$cap' WHERE id=$table_id");
}
//***********************************************************************
function CreateBrokerLeadTable($broker_id)
{
	$table_name = GetBrokerTableName($broker_id);
	Debug("Creating Table for broker : $broker_id , table name= $table_name <br/>");
	$result = mysql_query("CREATE TABLE `brokerdb`.`$table_name` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`from_city` TEXT NOT NULL ,
	`from_state` TEXT NOT NULL ,
	`from_zip` TEXT NOT NULL ,
	`to_city` TEXT NOT NULL ,
	`to_state` TEXT NOT NULL ,
	`to_zip` TEXT NOT NULL ,
	`shipingdate` INT UNSIGNED NOT NULL ,
	`carriertype` TEXT NOT NULL ,
	`year` TEXT NOT NULL ,
	`make` TEXT NOT NULL ,
	`model` TEXT NOT NULL ,
	`condition` TEXT NOT NULL ,
	`name` TEXT NOT NULL ,
	`phone` TEXT NOT NULL ,
	`email` TEXT NOT NULL ,
	`ip` TEXT NOT NULL ,
	`date_entered` INT UNSIGNED NOT NULL) ENGINE = MYISAM;")
	or die(mysql_error());
}
//*************************************************************************
function GetBroker($broker_id,$as_name_index)
{	// get broker information from borker table
	$result = mysql_query("SELECT * FROM brokers WHERE id=$broker_id")
	or die(mysql_error());
	$row = mysql_fetch_row($result);
	if ($as_name_index == true)
	{
		$broker['name'] = $row[1];
		$broker['phone'] = $row[2];
		$broker['contact'] = $row[3];
		$broker['email'] = $row[4];
		$broker['mc_number'] = $row[5];
		$broker['description'] = $row[6];
		$broker['lead_email'] = $row[7];
		$broker['lead_format'] = $row[8];
		$broker['daily_cap'] = $row[9];
		$broker['credit'] = $row[10];
		$broker['security_question'] = $row[11];
		$broker['security_answer'] = $row[12];
	}
	else
	{
		$broker[0] = $row[1];
		$broker[1] = $row[2];
		$broker[2] = $row[3];
		$broker[3] = $row[4];
		$broker[4] = $row[5];
		$broker[5] = $row[6];
		$broker[6] = $row[7];
		$broker[7] = $row[8];
		$broker[8] = $row[9];
		$broker[9] = $row[10];
		$broker[10] = $row[11];
		$broker[11] = $row[12];
	}
	
	return $broker;	
}

//**************************************************************************
function ShowBrokerTable()
{
	$result = mysql_query("SELECT * FROM brokers")
	or die(mysql_error());
	echo "<table class='broker_table' cellspacing='0'>";
	
	echo "<thead>";
	echo "<tr>";
	echo "<th>Name</th>";
	echo "<th>Phone</th>";
	echo "<th>Contact</th>";
	echo "<th>Email</th>";
	echo "<th>Credits</th>";
	echo "</tr>";
	echo "</thead>";
	
	while ($row = mysql_fetch_row($result))
	{
	
	echo "<tr onclick='document.location.href=\"brokerinfo.php?id=$row[0]\"' onmouseover='this.style.cursor=\"pointer\"'>";
	echo "<td>$row[1]</td>"; // name
	echo "<td>$row[2]</td>"; // phone
	echo "<td>$row[3]</td>"; // contact
	echo "<td>$row[4]</td>"; // email
	echo "<td>$row[10]</td>"; // credits
	echo "</tr>";
	}
	echo "</table>";
} 
//**************************************************************************

function is_authenticated() 
{
return ( isset($_SESSION['authenticated']) && ($_SESSION['authenticated'] == "yes"));
}

function CreatePassword()
{
	
	$challenge = "";
 	for ($i = 0; $i < 8; $i++) {
  		$challenge .= dechex(rand(0, 15));
 	}
 	return $challenge;
}
//**************************************************************************
function SendPassword ($pass)
{
	$user = GetRecord("preferences",1);
	$mail = $user[1];
	$name = $user[2];
	$subject = "Satorika site";
	$message = "Hello $name,
	your new password to Satorika is: $pass";
	mail($mail,$subject,$message);
	
}

//**************************************************************************
function InsertPassword ($pass)
{
	$safe_pass = hash('sha256',$pass);
	$user = GetRecord("preferences",1);
	$data[0] = $user[1];	//email
	$data[1] = $user[2];	//user
	$data[2] = $safe_pass;	//new password
	$data[3] = $user[4];	//cap
	
	EditRecord("preferences",1, $data);

}
//**************************************************************************
function ForgotPassword()
{
	header("Location:statistics.php");
	$pass = CreatePassword();
	SendPassword($pass);
	InsertPassword($pass);
	
}
//**************************************************************************



?>