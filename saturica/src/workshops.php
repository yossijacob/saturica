<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
include_once 'report_aux.php';
		
session_start();	
connect();   //connect to mysql DB	 
//---------------------------------------------------------------------------------------------
function WorkshopsTableRow($row)
{	/* this function print the row in the workshops table
	   it gets the array $row as a paramater.
	*/
if ($row==null)  // if null then put header
	{
		echo "<thead>";
		echo "<tr>";
		echo "<th></th>";
		echo "<th>מיקום</th>";
		echo "<th>פעיל</th>";
		echo "<th>שם ספק</th>";
		echo "<th>מחיר למשתתף</th>";
		echo "<th>מחיר קבוע</th>";
		echo "<th>נושא</th>";
		echo "<th>שם</th>";
		echo "<th></th>";
		echo "</tr>";
		echo "</thead>";
	}
	else
	{
		$id = $row[0];  // get the id
		echo "<tr>";
		echo "<td><a title='מחק רשומה' href='javascript:DeleteRecord(\"deleteworkshop.php\",\"$id\",\"$row[2]\")'><img src='images/delete.gif' class='small_icon_button' /></a></td>";
		echo "<td>$row[17]</td>"; // מיקום	
		echo "<td>$row[12]</td>"; // פעיל 
		echo "<td>$row[11]</td>"; // שם ספק
		echo "<td>$row[7]</td>"; // מחיר למשתתף
		echo "<td>$row[6]</td>"; // מחיר קבוע
		echo "<td>$row[4]</td>"; // נושא
		echo "<td>$row[2]</td>"; // שם
		echo "<td><a title='ערוך רשומה' href='javascript:OpenPageWithId(\"editworkshop.php\",\"$id\")'><img src='images/edit_small.png' class='small_icon_button'/></a></td>";
		echo "</tr>";
	}
}
//---------------------------------------------------------------------------------------------
function ShowWorkshopTable()
{
	// usage ShowTable ( table, query, row_func, class, curr_page, table_id)
	ShowTable("workshops","","WorkshopsTableRow","report_table","workshops.php?","");  
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>סדנאות</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>
</head>
<body>
	<?php
		if (!is_authenticated()) 
			header("Location:login.php");  
		MenuBar('workshops'); 
	?>
    
	
<div id="content">
	    <br/>
	    <h1>סדנאות</h1>
	    <hr></hr>
	    <div id="right_menu">
    	<a href="addworkshop.php" class="icon_button"><span class="add">הוסף סדנא חדשה</span></a>
    	</div>
	    <br/>
	    <br/>
	    <br/>
	    <br/>
		
		<?php
		ShowWorkshopTable();
		?>
		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
