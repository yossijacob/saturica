<?php


//---------------------------------------------------------------------
function GetRecord($table,$id)
{
	$query = "SELECT * FROM $table WHERE id=$id";
	$result = mysql_query($query)
	or die(mysql_error());
	$row = mysql_fetch_row($result);
	return $row;
}

//********************************************************************
function AddRecord($table,$data)
{
	// gets an array of data and insert it as a record into the table
//	Debug("Function: AddRecord to table: $table <br/>");
	$data_msg = implode("','", $data);
	$query = "INSERT INTO $table VALUES (NULL,'".$data_msg."')";
	$result = mysql_query($query) 
	or die(mysql_error());
	$auto_id = mysql_insert_id();
	return $auto_id;				// return the auto id generated
}
//********************************************************************
function GetTableSize($table)
{
	$result = mysql_query("SELECT * FROM $table") or die(mysql_error());
	$res = mysql_num_rows($result);
	return $res;
}
//********************************************************************
function GetTableActiveSize($table)
{
	$result = mysql_query("SELECT * FROM $table Where active='כן'") or die(mysql_error());
	$res = mysql_num_rows($result);
	return $res;
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
//Debug("FUNCTION:DeleteRecordByIntField($table,$field,$val)<br/>");
//Debug("FUNCTION:DeleteRecordByIntField: query=DELETE FROM $table WHERE $field='$val'<br/>");
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
	echo $query;
	$result = mysql_query($query) or die(mysql_error());
}

//*********************************************************************
function CheckIfRecordExist($table,$col_name,$val)
{		// check if a record for field= $col_name and value = val exist
		$result = mysql_query("SELECT name FROM $table WHERE $col_name='$val'");
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

//*********************************************************************
function GetColumn($table,$col_number)
{	// return an entire column as an array
	// first col_number is 0
	$col = null;
	$index = 0;
	$query = "SELECT * FROM $table";
	$result = mysql_query($query)
	or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$col[$index++] = $row[$col_number]; // get the current field
	}
	return $col;
}

//*********************************************************************
function SearchWorkshop($column,$val)
{
	$index = 0;
	$res="";
	$query = "SELECT * FROM workshops WHERE $column = '$val'";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$res[$index++] = $row; // get the current field
	}
	return $res;

}
//*********************************************************************
function SearchFreeText($column1,$column2,$column3,$val)
{
	$index = 0;
	$res="";
	$words = explode(" ", $val);
	
	foreach ($words as $singleword)
	{	
		$query = "SELECT * FROM workshops WHERE $column1 LIKE '%$singleword%' OR $column2 LIKE '%$singleword%' OR $column3 LIKE '%$singleword%' ";
		$result = mysql_query($query) or die(mysql_error());
		while ($row = mysql_fetch_row($result))
		{
			$res[$index++] = $row; // get the current field
		}
	}
	
	$unique_res = $res;
	if ( $unique_res != "") 
		DeleteDupplicate($unique_res);	//function to remove duplicate values at the array
				//need it cause array_unique doesnt work on array of arrays
				//NOT WORKING PERFECTLY YET !
	return $unique_res;

}


//*********************************************************************
function DeleteDupplicate($arrayOfArrays)
{
	// this function removes duplicated values from array (even array of array)
	//downloaded it from http://php.net/manual/en/function.array-unique.php
	foreach ($arrayOfArrays as $key=>$value) { 
	  $arrayOfArrays[$key] = "'" . serialize($value) . "'"; 
	} 
	$arrayOfArrays = array_unique($arrayOfArrays); 
	foreach ($arrayOfArrays as $key=>$value) { 
	  $arrayOfArrays[$key] = unserialize(trim($value, "'")); 
	} 

}


//*********************************************************************
function SearchWorkshopPrice($column,$lowval,$highval)
{
	$index = 0;
	$res="";
	$query = "SELECT * FROM workshops WHERE  $column BETWEEN $lowval AND $highval ";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$res[$index++] = $row; // get the current field
	}
	return $res;

}

//*********************************************************************
/*
function db_createlist($linkID,$default,$query,$blank)
{
    if($blank)
    {
        print("<option select value=\"0\">$blank</option>");
    }
    
    $resultID = mysql_query($query);
    $num = mysql_num_rows($resultID); 
 
    for ($i=0;$i<$num;$i++)
    {	
    	$row = mysql_fetch_row($resultID);
        
        if($row[0]==$default)$dtext = "selected";
        else $dtext = "";
    
        print("<option $dtext value=\"$row[0]\">$row[1]</option>");
    }
}*/

?>
