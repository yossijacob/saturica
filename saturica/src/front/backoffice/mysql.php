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
	//return workshops that their value at the column "$column"   =   $val
	$index = 0;
	$res="";
	$query = "SELECT id FROM workshops WHERE $column = '$val'";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$temp = $row[0];
		$res[$index++] = $temp; // get the current field
	}
	return $res;

}

//*********************************************************************
function SearchFreeText($column1,$column2,$column3,$val,$Result_Set,$Per_Page)
{
	//search each word that appears at $val in the columns 1,2,3 
	$index = 0;
	$res="";
	$unique_res="";
	$new_arr="";
	$words = explode(" ", $val);
	
	// get the id of the workshops that needs to be return
	foreach ($words as $singleword)
	{	
		//ignore all of the following common words  (search only  uncommon words)
		if ( ($singleword !="ו") && ($singleword !="סדנא") && ($singleword !="סדנאות") && ($singleword !="או") && ($singleword !="על") && ($singleword !="בסדנא")
			&& ($singleword !="בסדנאות") && ($singleword !="וגם") && ($singleword !="עם") && ($singleword !="ה") && ($singleword !="הסדנא") && ($singleword !="הסדנאות")
			 && ($singleword !="")) 
		{
		
			$query = "SELECT id FROM workshops WHERE $column1 LIKE '%$singleword%' OR $column2 LIKE '%$singleword%' OR $column3 LIKE '%$singleword%' ";
			//OR CONTAINS($column1, '$singleword') OR CONTAINS($column2, '$singleword') OR CONTAINS($column3, '$singleword')
			//OR CONTAINS('$singleword',$column1) OR CONTAINS('$singleword',$column2) OR CONTAINS('$singleword',$column3)";
			$result = mysql_query($query) or die(mysql_error());
			while ($row = mysql_fetch_row($result))
			{
				$res[$index++] = $row[0]; // get the workshop id 
			}
		}
	}

	if ($res != "")	//we found requested workshops
	{
		$res = array_unique($res); 	//remove duplicate workshops (so we wont show the same workshop more then one time) 
		$index = 0;
		$col = "id";
		
		//get the workshope by their id that we found.
		foreach ($res as $selectedworkshop)
		{	
			$query = "SELECT * FROM workshops WHERE $col=$selectedworkshop ";	
			$result = mysql_query($query) or die(mysql_error());
			while ($row = mysql_fetch_row($result))
			{
				$unique_res[$index++] = $row; // get the current field
			}
		}
	}
	
	
	if (!$Result_Set) $Result_Set=0;
	for ($k=0; $k<$Per_Page ; $k++)
	{
		if ($index > $Result_Set+$k)
		{
			$new_arr[$k] = $unique_res[$Result_Set+$k];
		}
	}
		


	return $new_arr;

}

//*********************************************************************
function SearchWorkshopPrice($column,$lowval,$highval)
{
	//return the workshops that their value at $column is between $lowval and $highval
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
// search at 'workshop' table all the workshops at location=where (or all locations if empty string) and order by rank and place 
function SearchWorkshopPlace($where,$Result_Set,$Per_Page)
{
	$index = 0;
	$res="";
	$unique_res="";
	
	
	$query = "SELECT id FROM locations WHERE ";
	if ($where != "") $query .= "location = '$where' "; 
	else $query .= "location LIKE '%' "; 
	$query .= "	ORDER BY rank DESC ";
	
	if (!$Result_Set) 
	   { 
	   $Result_Set=0; 
	   $query.=" LIMIT $Result_Set, $Per_Page"; 
	   }
	else
		 { $query.=" LIMIT $Result_Set, $Per_Page"; } 
	
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$temp = $row[0];
		$res[$index++] = $temp; // get the current field
	}
	
	if ($res != "")	//we found requested workshops
	{
		$res = array_unique($res); 	//remove duplicate workshops (so we wont show the same workshop more then one time) 
		$index = 0;
		$col = "id";
		
		//get the workshope by their id that we found.
		foreach ($res as $selectedworkshop)
		{	
			$query = "SELECT * FROM locations WHERE $col=$selectedworkshop ";
			$result = mysql_query($query) or die(mysql_error());
			while ($row = mysql_fetch_row($result))
			{
				$unique_res[$index++] = $row; // get the current field
			}
		}
	}

	return $unique_res;
	
	
	
}




//*********************************************************************
// search at 'workshop' table all the rows that has the given values 
function SearchAllParams_Workshop($whattodo,$where,$howlong,$lowval,$highval,$howmany,$Result_Set,$Per_Page)
{
	$index = 0;
	$res="";
	$unique_res="";
	
	//$table = array("במבנה ממוזג\מחומם" => array( '  פחות מ 50 ש"ח'     =>20  ,   '50 -100 ש"ח' =>35 ));
	//echo $table['במבנה ממוזג\מחומם'][ '50 -100 ש"ח'];
	
	$query = "SELECT id FROM workshops WHERE ";

	$query .= "active = 'כן' AND ";
	
	if ($whattodo != null) $query .= "subject = '$whattodo' AND "; 
	else $query .= "subject LIKE '%' AND "; 
	
	if ($where != null) $query .= "location = '$where' AND "; 
	else $query .= "location LIKE '%' AND "; 
	
	if ($howlong != null) $query .= "time_frame = '$howlong' AND "; 
	else $query .= "time_frame LIKE '%' AND "; 
	
	//the customer filled price range and how many people are participating
	if ( ($lowval != null) && ($howmany != null) )
	{
		//get the place price
		if ($where == null ) $place_price = 0 ;
		else 
			{
				if ($where = "במבנה ממוזג\מחומם")
					{
						if ($lowval == 0) $place_price = 20;
						if ($lowval == 50) $place_price = 35;
						if ($lowval == 150) $place_price = 50;
						if ($lowval == 250) $place_price = 75;
						if ($lowval == 350) $place_price = 100;
						if ($lowval == 500) $place_price = 150;
					}
					
				if ($where = "אצלנו בארגון") $place_price = 0;
				if ($where = "מחוץ לעבודה, במקום מיוחד")
					{
						if ($lowval == 0) $place_price = 10;
						if ($lowval == 50) $place_price = 20;
						if ($lowval == 150) $place_price = 40;
						if ($lowval == 250) $place_price = 70;
						if ($lowval == 350) $place_price = 90;
						if ($lowval == 500) $place_price = 100;
					}
				if ($where = "ליד הבריכה")
					{
						if ($lowval == 0) $place_price = 20;
						if ($lowval == 50) $place_price = 35;
						if ($lowval == 150) $place_price = 50;
						if ($lowval == 250) $place_price = 70;
						if ($lowval == 350) $place_price = 90;
						if ($lowval == 500) $place_price = 100;
					}
				if ($where = "על חוף הים")	
					{
						if ($lowval == 0) $place_price = 10;
						if ($lowval == 50) $place_price = 25;
						if ($lowval == 150) $place_price = 35;
						if ($lowval == 250) $place_price = 55;
						if ($lowval == 350) $place_price = 85;
						if ($lowval == 500) $place_price = 120;
					}
				if ($where = "נעבור ממקום למקום") $place_price = 0;	
				
			}

		
		$query .= "( ((personal_price + $place_price)*$howmany) + fixed_price) BETWEEN ($lowval*$howmany )AND ($highval*$howmany) AND ";
		 
	}
	
	
	
	if ($howmany != null) $query .= "minimum_size <= $howmany AND maximum_size >= $howmany  ";
	else $query .= "minimum_size LIKE '%' "; 
	$query .= "	ORDER BY rank DESC ";

		
	if (!$Result_Set) 
	   { 
	   $Result_Set=0; 
	   $query.=" LIMIT $Result_Set, $Per_Page"; 
	   }else 
	   { 
	   $query.=" LIMIT $Result_Set, $Per_Page"; 
	   } 
	
	
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$temp = $row[0];
		$res[$index++] = $temp; // get the current field
	}
	
	
	if ($res != "")	//we found requested workshops
	{
		$res = array_unique($res); 	//remove duplicate workshops (so we wont show the same workshop more then one time) 
		$index = 0;
		$col = "id";
		
		//get the workshope by their id that we found.
		foreach ($res as $selectedworkshop)
		{	
			$query = "SELECT * FROM workshops WHERE $col=$selectedworkshop ";
			$result = mysql_query($query) or die(mysql_error());
			while ($row = mysql_fetch_row($result))
			{
				$unique_res[$index++] = $row; // get the current field
			}
		}
	}

	return $unique_res;

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
