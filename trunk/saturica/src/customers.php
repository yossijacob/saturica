<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
		
connect();   //connect to mysql DB	 
//---------------------------------------------------------------------------------------------
function CunstomersTableRow($row)
{	/* this function print the row in the customers table
	   it gets the array $row as a paramater.
	*/
if ($row==null)  // if null then put header
	{
		echo "<thead>";
		echo "<tr>";
		echo "<th>From City</th>";
		echo "<th>From State</th>";
		echo "</tr>";
		echo "</thead>";
	}
	else
	{
		echo "<tr>";
		echo "<td>$row[1]</td>"; // from city
		echo "<td>$row[2]</td>"; // from state
		echo "</tr>";
	}
}
//---------------------------------------------------------------------------------------------
function ShowCustomerTable()
{
	// usage ShowTable ( table, query, row_func, class, curr_page, table_id)
	ShowTable("customers","","CustomersTableRow","report_table","customers.php","");  
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>לקוחות</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
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
		
		<!-- <div class='table_bl'>
			<div class='table_br'>
				<div class='table_tl'>
					<div class='table_tr'> -->
		<?php
		ShowCustomerTable();
		?>
					<!-- </div>
				</div>
  			</div>
  		</div> -->
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
