<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
include_once 'report_aux.php';
		
connect();   //connect to mysql DB	 
//---------------------------------------------------------------------------------------------
function LocationsTableRow($row)
{	/* this function print the row in the locations table
	   it gets the array $row as a paramater.
	*/
if ($row==null)  // if null then put header
	{
		echo "<thead>";
		echo "<tr>";
		echo "<th>Location number</th>";
		echo "<th>Fake location name</th>";
		echo "<th>Real location name</th>";
		echo "<th>Description</th>";
		echo "<th>Picture</th>";
		echo "<th>Rank</th>";
		echo "</tr>";
		echo "</thead>";
	}
	else
	{
		echo "<tr>";
		echo "<td>$row[1]</td>"; // Location number
		echo "<td>$row[2]</td>"; // Fake location name
		echo "<td>$row[3]</td>"; // Real location name
		echo "<td>$row[4]</td>"; // Fake location name
		echo "<td>$row[5]</td>"; // Description
		echo "<td>$row[6]</td>"; // Picture
		echo "<td>$row[7]</td>"; // Rank
		echo "</tr>";
	}
}
//---------------------------------------------------------------------------------------------
function ShowLocationTable()
{
	// usage ShowTable ( table, query, row_func, class, curr_page, table_id)
	ShowTable("locations","","LocationsTableRow","report_table","locations.php","");  
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>לוקיישנים</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php 
		MenuBar('locations'); 
	?>
    
	
<div id="content">
	    <br/>
	    <h1>לוקיישנים</h1>
	    <hr></hr>
	    <div id="right_menu">
    	<a href="addlocation.php" class="icon_button"><span class="add">הוסף לוקיישן חדש</span></a>
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
