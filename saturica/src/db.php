<?php
include_once 'time.php';

//********************************************************************
function GetPreferences()
{
	$result = mysql_query("SELECT * FROM preferences");
	$row = mysql_fetch_row($result);
	$preferences['email'] = $row[0];
	$preferences['recomend1'] = $row[3];
	$preferences['recomend2'] = $row[4];
	$preferences['recomend3'] = $row[5];
	$preferences['cap'] = $row[6];
	return $preferences;
}
//********************************************************************
function SetPreferences($preferences)
{
	$query  = "UPDATE preferences SET recomend1 ='".$preferences['recomend1']."',cap ='".$preferences['cap']."',recomend2 ='".$preferences['recomend2']."',email ='".$preferences['email']."',recomend3 = '".$preferences['recomend3']."'";
	$result = mysql_query($query)
	or die(mysql_error());
}
//------------------------------------------------------------------------------------*/
function GetBrokerList()
{
	$list[] = null;
	$query = "SELECT name FROM brokers";
	$result = mysql_query($query)
	or die(mysql_error());
	$i = 0;
	while($row = mysql_fetch_array($result))
	{
		$list[$i++] = $row['name'];
	}
	return  $list;
}
//------------------------------------------------------------------------------------*/
function ShowBrokersDropDown($name,$deafult,$selected)
{
	$list = GetBrokerList();
	ShowDropDown($name, $list, $deafult, $selected);
}


//************************************************************************************
function GetBrokerCredit($broker_id)
{
	$result = mysql_query("SELECT * FROM brokers WHERE id=$broker_id");
	$row = mysql_fetch_row($result);
	return $row[10];
}
//************************************************************************************
function SetBrokerCredit($broker_id,$credit)
{
	$result = mysql_query("UPDATE brokers SET credit='$credit' WHERE id=$broker_id")
	or die(mysql_error());
}
//************************************************************************************
function GetLead($lead_id,$as_name_index)
{	// get the lead data from the lead queue
	$result = mysql_query("SELECT * FROM queue WHERE id=$lead_id")
	or die(mysql_error());
	$row = mysql_fetch_row($result);
	if ($as_name_index == true)
	{
		$lead['fromcity'] = $row[1];
		$lead['fromstate'] = $row[2];
		$lead['from_zip'] = $row[3];
		$lead['tocity'] = $row[4];
		$lead['tostate'] = $row[5];
		$lead['to_zip'] = $row[6];
		$lead['shipingdate'] = $row[7];
		$lead['carriertype'] = $row[8];
		$lead['year'] = $row[9];
		$lead['make'] = $row[10];
		$lead['model'] = $row[11];
		$lead['condition'] = $row[12];
		$lead['name'] = $row[13];
		$lead['phone'] = $row[14];
		$lead['email'] = $row[15];
		$lead['ip'] = $row[16];
		$lead['date_enterd'] = $row[17];
		return $lead;
	}
	else
	{
		$lead[0] = $row[1];
		$lead[1] = $row[2];
		$lead[2] = $row[3];
		$lead[3] = $row[4];
		$lead[4] = $row[5];
		$lead[5] = $row[6];
		$lead[6] = $row[7];
		$lead[7] = $row[8];
		$lead[8] = $row[9];
		$lead[9] = $row[10];
		$lead[10] = $row[11];
		$lead[11] = $row[12];
		$lead[12] = $row[13];
		$lead[13] = $row[14];
		$lead[14] = $row[15];
		$lead[15] = $row[16];
		$lead[16] = $row[17];
		return $lead;	
	}
}
//************************************************************************************
function AddLeadToArchive($lead_id,$reception_list)
{
	$lead = GetLead($lead_id,false);
	$lead[17] = $reception_list;
	AddRecord("leads",$lead);
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
//*************************************************************************
function GetBrokerName($borker_id)
{
	$result = mysql_query("SELECT * FROM brokers WHERE id=$borker_id")
	or die(mysql_error());
	$row = mysql_fetch_row($result);
	return  $row[1];
}
//*************************************************************************
function GetBrokerTableName($broker_id)
{
	return  "zleads_".$broker_id;
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
function DeleteBroker($broker_id)
{
	DeleteRecord("brokers", $broker_id);  // delete from borkers table
	$broker_lead_table_name = GetBrokerTableName($broker_id); // get name of borker's table
	mysql_query("drop table if exists $broker_lead_table_name");
	DeleteRecordByIntField("brokers_queue", "broker_id", $broker_id);
	$preferences = GetPreferences();
  	$preferences['broker_count']--;
  	SetPreferences($preferences);
}

?>
