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



//***********************************************************************
function GetWorkshopSurveyTableName($workshop_id)
{
	return $workshop_id.'_survey';
}
//***********************************************************************
function CreateWorkshopSurveyTable($workshop_id)
{
	$table_name = GetWorkshopSurveyTableName($workshop_id);
	$result = mysql_query("CREATE TABLE `satorika_db`.`$table_name` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`overall` TEXT NOT NULL ,
	`overall_text` TEXT NOT NULL ,
	`host` TEXT NOT NULL ,
	`host_text` TEXT NOT NULL ,
	`personal` TEXT NOT NULL ,
	`presonal_text` TEXT NOT NULL ,
	`location` TEXT NOT NULL ,
	`location_text` TEXT NOT NULL ,
	`food` TEXT NOT NULL ,
	`food_text` TEXT NOT NULL ,
	`comments` TEXT NOT NULL ,
	`average` DOUBLE NOT NULL ,
	`date_entered` INT UNSIGNED NOT NULL) ENGINE = MYISAM;")
	or die(mysql_error());
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
function GetTableActiveSize($table)
{
	$result = mysql_query("SELECT * FROM $table Where active='כן'") or die(mysql_error());
	$res = mysql_num_rows($result);
	return $res;
}

//********************************************************************
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
					$name = $row[2];
					if ($uniq_names[$name] != 1)
					{
					$unique_res[$index++] = $row; // get the current field
					$uniq_names[$name] = 1;
					}
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
function SearchAllParams_Workshop($whattodo,$where,$howlong,$lowval,$highval,$howmany,$Result_Set,$Per_Page,$filter_text)
{
	$index = 0;
	$res="";
	$unique_res="";
	
	//$table = array("במבנה ממוזג\מחומם" => array( '  פחות מ 50 ש"ח'     =>20  ,   '50 -100 ש"ח' =>35 ));
	//echo $table['במבנה ממוזג\מחומם'][ '50 -100 ש"ח'];
	
	$query = "SELECT id FROM workshops WHERE ";

	$query .= "active = 'כן' AND ";
	
	if ($whattodo != null) $query .= "$whattodo = 1 AND "; 
	else $query .= "subject LIKE '%' AND "; // meaningless, ignore the subject at this search
	
	
	
	//if ($filter_text != null) $query .= "CONTAINS(type, '@$filter_text') AND "; 
	if ($filter_text != null) $query .= "type = '$filter_text' AND "; 
	
	
	if ($where != null) $query .= "$where = 1 AND "; 
	else $query .= "location LIKE '%' AND "; // meaningless, ignore the location at this search
	
	if ($howlong != null) $query .= "time_frame = '$howlong' AND "; 
	else $query .= "time_frame LIKE '%' AND "; 
	
	//the customer filled price range and how many people are participating
	if ( ($highval != null) && ($howmany != null) )
	{
		
		//get the place price
		$place_price = 0;		
		/*
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
			*/
		$lowerbound = $lowval*$howmany;
		$upperbound = $highval*$howmany;

		
		$query .= "( (personal_price * '$howmany') + ('$place_price' * '$howmany') + fixed_price) <= '$upperbound' AND ";	 
	}
	
	if ($howmany != null) $query .= "minimum_size <= $howmany AND maximum_size >= $howmany  ";
	else $query .= "minimum_size LIKE '%' "; 
	$query .= "	GROUP BY name ";
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
		$uniq_names = "";	//array for uniq names
		
		//get the workshope by their id that we found.
		foreach ($res as $selectedworkshop)
		{	
			$query = "SELECT * FROM workshops WHERE $col=$selectedworkshop ";
			$result = mysql_query($query) or die(mysql_error());
			while ($row = mysql_fetch_row($result))
			{
				$name = $row[2];
				if ($uniq_names[$name] != 1)
				{
				$unique_res[$index++] = $row; // get the current field
				$uniq_names[$name] = 1;
				}
			}
		}
	}
	
	/*
	if ($unique_res != null)
	foreach ($unique_res as $selectedworkshop)
		{	
			$query = "SELECT * FROM workshops WHERE $col=$selectedworkshop[1] ";
			$result = mysql_query($query) or die(mysql_error());
			if (!$Result_Set) 
		   { 
		   $Result_Set=0; 
		   $query.=" LIMIT $Result_Set, $Per_Page"; 
		   }else 
		   { 
		   $query.=" LIMIT $Result_Set, $Per_Page"; 
		   }
			$result = mysql_query($query) or die(mysql_error());
		}
	
		*/
		
	
	
	
	
	
	

	return $unique_res;

}






//*********************************************************************
// get the subjects of all workshops that we got at the serach results
function GetSubjects($whattodo,$where,$howlong,$lowval,$highval,$howmany)
{
	$index = 0;
	$res="";
	$unique_res="";
	
	$query = "SELECT DISTINCT type FROM workshops WHERE ";

	$query .= "active = 'כן' AND ";
	
	if ($whattodo != null) $query .= "$whattodo = 1 AND "; 
	else $query .= "subject LIKE '%' AND "; // meaningless, ignore the subject at this search
	
	if ($where != null) $query .= "$where = 1 AND "; 
	else $query .= "location LIKE '%' AND "; // meaningless, ignore the location at this search
	
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
	//$query .= "	ORDER BY type ";
		
	
	
	
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_row($result))
	{
		$temp = $row[0];
		$res[$index++] = $temp; // get the current field
	}
	
	return $res;
	
	/*
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


	*/
	
	
}


//*********************************************************************
//get the subjects of all workshops that we got at the serach results
function GetSubjectsFreeText($column1,$column2,$column3,$val)
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
		
			$query = "SELECT DISTINCT type FROM workshops WHERE $column1 LIKE '%$singleword%' OR $column2 LIKE '%$singleword%' OR $column3 LIKE '%$singleword%' ";
			//OR CONTAINS($column1, '$singleword') OR CONTAINS($column2, '$singleword') OR CONTAINS($column3, '$singleword')
			//OR CONTAINS('$singleword',$column1) OR CONTAINS('$singleword',$column2) OR CONTAINS('$singleword',$column3)";
			$result = mysql_query($query) or die(mysql_error());
			while ($row = mysql_fetch_row($result))
			{
				$res[$index++] = $row[0]; // get the workshop id 
			}
		}
	}
	
	return $res;
	
	/*

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
	
	*/

}

//*********************************************************************


?>