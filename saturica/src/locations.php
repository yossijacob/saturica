<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
include_once 'report_aux.php';
	
connect();   //connect to mysql DB

session_start();
if (!is_authenticated()) 
			header("Location:login.php");	
//---------------------------------------------------------------------------------------------
function LocationsTableRow($row)
{	/* this function print the row in the locations table
	   it gets the array $row as a paramater.
	*/
if ($row==null)  // if null then put header
	{
		echo "<thead>";
		echo "<tr>";
		echo "<th></th>";
		echo "<th>דירוג פנימי</th>";
		echo "<th>מיקום גאוגרפי</th>";
		echo "<th>טקסט תיאור</th>";
		echo "<th>שם מיקום אמיתי</th>";
		echo "<th>שם מיקום בדוי</th>";
		echo "<th>מספר מיקום</th>";
		echo "<th></th>";
		echo "</tr>";
		echo "</thead>";
	}
	else
	{
		$id = $row[0];  // get the id
		echo "<tr>";
		echo "<td><a title='מחק רשומה' href='javascript:DeleteRecord(\"deletelocation.php\",\"$id\",\"$row[3]\")'><img src='images/delete.gif' class='small_icon_button' /></a></td>";
		echo "<td>$row[7]</td>"; // דירוג פנימי 	
		echo "<td>$row[5]</td>"; // מיקום גאוגרפי
		echo "<td>$row[4]</td>"; // טקסט תיאור
		echo "<td>$row[3]</td>"; // שם מיקום אמיתי
		echo "<td>$row[2]</td>"; // שם מיקום בדוי
		echo "<td>$row[1]</td>"; // מספר מיקום
		echo "<td><a title='ערוך רשומה' href='javascript:OpenPageWithId(\"editlocation.php\",\"$id\")'><img src='images/edit_small.png' class='small_icon_button'/></a></td>";
		
		echo "</tr>";
	}
}
//---------------------------------------------------------------------------------------------
function ShowLocationTable()
{
	// usage ShowTable ( table, query, row_func, class, curr_page, table_id)
	ShowTable("locations","","LocationsTableRow","report_table","locations.php?","");  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>מיקומים</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>
</head>
<body>
	<?php
		if (!is_authenticated()) 
			header("Location:login.php"); 
		MenuBar('locations'); 
	?>
    
	
<div id="content">
	    <br/>
	    <h1>מיקומים</h1>
	    <hr></hr>
	    <div id="right_menu">
    	<a href="addlocation.php" class="icon_button"><span class="add">הוסף מיקום חדש</span></a>
    	</div>
	    <br/>
	    <br/>
	    <br/>
	    <br/>
		
		<?php
		ShowLocationTable();

		?>
		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
