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
function CustomersTableRow($row)
{	/* this function print the row in the customers table
	   it gets the array $row as a paramater.
	*/
if ($row==null)  // if null then put header
	{
		echo "<thead>";
		echo "<tr>";
		echo "<th></th>";
		echo "<th>משוב</th>";
		echo "<th>פעיל</th>";
		echo "<th>תאריך הצטרפות</th>";
		echo "<th>הערות</th>";
		echo "<th>דואר אלקטרוני</th>";
		echo "<th>טלפון</th>";
		echo "<th>חברה</th>";
		echo "<th>שם</th>";
		echo "<th></th>";
		echo "</tr>";
		echo "</thead>";
	}
	else
	{
		$id = $row[0];  // get the id
		$joinDate = date("d/m/Y", $row[6]);
		echo "<tr>";
		echo "<td><a title='מחק רשומה' href='javascript:DeleteRecord(\"deletecustomer.php\",\"$id\",\"$row[1]\")'><img src='images/delete.gif' class='small_icon_button' /></a></td>";
		echo "<td>$row[8]</td>"; // sent feedback
		echo "<td>$row[7]</td>"; // active ?
		echo "<td>$joinDate</td>"; // join date
		echo "<td>$row[5]</td>"; // comments
		echo "<td>$row[4]</td>"; // eamil
		echo "<td>$row[3]</td>"; // phone
		echo "<td>$row[2]</td>"; // company
		echo "<td>$row[1]</td>"; // name
		echo "<td><a title='ערוך רשומה' href='javascript:OpenPageWithId(\"editcustomer.php\",\"$id\")'><img src='images/edit_small.png' class='small_icon_button'/></a></td>";
		echo "</tr>";
	}
}
//---------------------------------------------------------------------------------------------
function ShowCustomerTable()
{
	// usage ShowTable ( table, query, row_func, class, curr_page, table_id)
	ShowTable("customers","","CustomersTableRow","report_table","customers.php?","");  
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="default.css" rel="stylesheet" type="text/css" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="javascript/functions.js"></script>
<title>לקוחות</title>
</head>
<?php flush();?>
<body>
	<?php 

		MenuBar('customers'); 
	?>
    
	
<div id="content">
	    <br/>
	    <h1>לקוחות</h1>
	    <hr></hr>
	    <div id="right_menu">
    	<a href="addcustomer.php" class="icon_button"><span class="add">הוסף לקוח חדש</span></a>
    	</div>
	    <br/>
	    <br/>
	    <br/>
	    <br/>
		
		<?php
		ShowCustomerTable();
		?>
		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
