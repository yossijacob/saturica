<?php
include_once 'debug.php';

//********************************************************************
function AddRecord($table,$data)
{
	// gets an array of data and insert it as a record into the table
	Debug("Function: AddRecord to table: $table <br/>");
	$data_msg = implode("','", $data);
	$query = "INSERT INTO $table VALUES (NULL,'".$data_msg."')";
	$result = mysql_query($query) 
	or die(mysql_error());
	$auto_id = mysql_insert_id();
	return $auto_id;				// return the auto id generated
}
//********************************************************************

function DeleteRecord($table,$id)
{
$result = mysql_query("DELETE FROM $table WHERE id=$id") 
or die(mysql_error());
}
//********************************************************************
function DeleteRecordByIntField($table,$field,$val)
{ // delete a record by a field and its value
Debug("FUNCTION:DeleteRecordByIntField($table,$field,$val)<br/>");
Debug("FUNCTION:DeleteRecordByIntField: query=DELETE FROM $table WHERE $field='$val'<br/>");
$result = mysql_query("DELETE FROM $table WHERE $field='$val'")
or die(mysql_error());	
}

//*********************************************************************
function EditRecord($table,$id,$data)
{
	// get field names and put them in an array
	$i = 0;
	$data_msg="SET";
	$result = mysql_query("SELECT * FROM $table") or die(mysql_error());
	$count = count(mysql_fetch_row($result)) - 1 ; // get columns count
	
	while ($i < $count)   // get filed names without the id (0)
	{
		$field_name[$i] = mysql_field_name($result, $i+1);
		$data_msg .= " ".$field_name[$i]." = '".$data[$i]."'";
		$i++;
		if ($i < $count) $data_msg.= " , ";
	}
	
	$query = "UPDATE $table $data_msg WHERE id='$id'";
	//echo $query;
	$result = mysql_query($query) or die(mysql_error());
}

//*********************************************************************
function CheckIfRecordExist($table,$col_name,$val)
{		// check if a record for field= $col_name and value = val exist
		$result = mysql_query("SELECT * FROM $table WHERE $col_name='$val'");
		$res = mysql_num_rows($result);
		//Debug("function: CheckIfRecordExist($table,$col_name,$val) --> $res<br/>");
		return  $res;
}

//*********************************************************************
function CleanText($text)
{	// this function clean a text from any characters that can be used for an attack
	// and from any html tags.
	return strip_tags(mysql_real_escape_string($text)); 
}



?>
