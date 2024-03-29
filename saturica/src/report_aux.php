<?php
include_once 'time.php';
include_once 'html.php';
/*
 * this file is for all of the functions used to create reports
 */

//---------------------------------------------------------------------------------
function ShowResultNavigatior($record_count,$start,$cap,$curr_page)
{
// record_count - amount of records
// cap - how many results per page
// curr_ page - which page of results we are now in including page PARAM GET
// start - first recrord to show
	
$end = $start + $cap;
if ($end > $record_count) $end = $record_count;
echo "<div class='result_navigatior'>";
echo "<form name='change_cap_form' id='change_cap_form' method='post' action='$curr_page&record_start=$start'>"; // define a form for the dropdown
echo "results $start -  $end out of $record_count &nbsp&nbsp&nbsp&nbsp&nbsp";
if ($start >= $cap)
	{
	$backjump = $start- $cap; 
    echo "<a href='$curr_page&record_start=$backjump'>< previous</a>&nbsp";
	//echo "<a href='javascript:NavigateResult(\"previous\",$start,$cap,\"$curr_page\")'>previous</a>&nbsp";
	}
if ($end < $record_count)
	{
	$forwardjump = $start + $cap;
	echo "&nbsp<a href='$curr_page&record_start=$forwardjump'>next ></a>";
	//echo "&nbsp<a href='javascript:NavigateResult(\"next\",$start,$cap,\"$curr_page\")'>next</a>";
	}
echo "&nbsp&nbsp&nbsp&nbsp ";
// now we do the cap dropdwon
echo "results per page &nbsp&nbsp";
echo "<select name='num_results_dropdown' id='num_results_dropdown' onchange='javascript:submit()'>"; // define the dropdown box
for ($i =0 ; $i < 5 ; $i++) 
	{
		$sel[$i] = null;
	}
	
if ($cap == 10) $sel[0] = "selected";
else if ($cap == 20) $sel[1] = "selected";
else if ($cap == 50) $sel[2] = "selected";
else if ($cap == 100) $sel[3] = "selected";
else if ($cap == 200) $sel[4] = "selected";
else $sel[5] = "selected";
echo "<option value='10' $sel[0]>10</option>";
echo "<option value='20' $sel[1]>20</option>";
echo "<option value='50' $sel[2]>50</option>";
echo "<option value='100' $sel[3]>100</option>";
echo "<option value='200' $sel[4]>200</option>";
echo "<option value='500' $sel[5]>500</option>";
echo "</select>";

echo "</form>";
//echo "&nbsp&nbsp<a href='#' onclick='window.print()'>print</a> ";
//echo '&nbsp&nbsp&nbsp&nbsp <a href="javascript:JumpToPage($curr_page)">jump to page</a><input type="text" size="1" name="jump" value="1"/>';
echo "</div>";
}

//---------------------------------------------------------------------------------
function ShowTable($table,$query,$row_func,$class,$curr_page,$table_id)
{	// shows a table 
	// table to show from
	// query is the required query	
	// row_func - function to hande row printing the function will get null to put header
	// table class
	// curr_page - current page
	// table_id make an id for the table - for example if u want to use jExpand to expand rows
	
	$preferences = GetPreferences();  // get prefereces
	if (isset($_POST['num_results_dropdown']))
	{
		$cap = $_POST['num_results_dropdown'];
		$preferences['cap'] = $cap;
		SetPreferences($preferences);
	}
	else
	{
	$cap = $preferences['cap'];	  // get the result cap
	}
	
	$start = (isset($_GET['record_start'])) ? $_GET['record_start'] : 0;   // where to start from
	$result = mysql_query("SELECT * FROM $table $query") // get total number of records
	or die(mysql_error());
	$record_count = mysql_num_rows($result);  
	mysql_free_result($result);  // free memory
	
	$result = mysql_query("SELECT * FROM $table $query LIMIT $start,$cap") // do query
	or die(mysql_error()); 
	
	ShowResultNavigatior($record_count,$start,$cap,$curr_page); // show table page navigator
	
	print "<table id='$table_id' class='$class' cellspacing='0'>";  
	
	$row_func(null); 	// using a function passed as a parameter to print header
	// print table headers
	

	// print table data
	while($row = mysql_fetch_row($result)) 
	{
		$row_func($row);   // using a function passed as a parameter
	}
	echo '</table>';
	
	ShowResultNavigatior($record_count,$start,$cap,$curr_page);
	
	mysql_free_result($result);
}

//---------------------------------------------------------------------------------------------



?>
