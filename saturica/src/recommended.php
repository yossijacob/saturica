<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
include_once 'report_aux.php';
		
connect();   //connect to mysql DB	 
//---------------------------------------------------------------------------------------------
function RecommendedsTableRow($row)
{	/* this function print the row in the customers table
	   it gets the array $row as a paramater.
	*/
if ($row==null)  // if null then put header
	{
		echo "<thead>";

		echo "<th>שם סדנא מומלצת</th>";
		echo "<th>מומלץ מספר</th>";
		echo "</tr>";
		echo "</thead>";
	}
	else
	{
		$id = $row[0];  // get the id
		echo "<tr>";
		echo "<td>$row[2]</td>"; // name
		echo "<td>$row[0]</td>"; 
		echo "</tr>";
	}
}
//---------------------------------------------------------------------------------------------
function ShowRecommendedTable()
{
	// usage ShowTable ( table, query, row_func, class, curr_page, table_id)
	ShowTable("recommendeds","","RecommendedsTableRow","report_table","recommended.php?","");  
}
//---------------------------------------------------------------------------------------------

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>מומלצים</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php 
		MenuBar('recommended'); 
	?>
    
    
<div id="content">
	    <br/>
	    <h1>מומלצים</h1>
	    <hr></hr>
	    <br/>
	    <br/>
	    :המומלצים הנוכחיים הם 
	    
  	  <?php

		ShowRecommendedTable();
	
  
	  $select_workshop1  = isset($_POST['select_workshop1'])? $_POST['select_workshop1']: "";
	  $select_workshop1 = CleanText($select_workshop1);
	  $select_workshop2 = isset($_POST['select_workshop2'])? $_POST['select_workshop2']: "";
	  $select_workshop2 = CleanText($select_workshop2);
	  $select_workshop3 = isset($_POST['select_workshop3'])? $_POST['select_workshop3']: "";
	  $select_workshop3 = CleanText($select_workshop3);
	  

	    if (isset($_POST['submitted']))  // if form was submitted - process it
  		{
  			
  			if (!($select_workshop1==-1))
  			{
  			$select_workshop1 = GetRecord("workshops",$select_workshop1);
  			$prev_id = $select_workshop1[0]; //the id at the original workshops table
  			$name = $select_workshop1[2];
  			$data[0] = $prev_id;
  			$data[1] = $name;
  			EditRecord("recommendeds","1",$data);	
  			}
  			
  		if (!($select_workshop2==-1))
  			{
  			$select_workshop2 = GetRecord("workshops",$select_workshop2);
  			$prev_id = $select_workshop2[0]; //the id at the original workshops table
  			$name = $select_workshop2[2];
  			$data[0] = $prev_id;
  			$data[1] = $name;
  			EditRecord("recommendeds","2",$data);	
  			}
  			
  		if (!($select_workshop3==-1))
  			{
  			$select_workshop3 = GetRecord("workshops",$select_workshop3);
  			$prev_id = $select_workshop3[0]; //the id at the original workshops table
  			$name = $select_workshop3[2];
  			$data[0] = $prev_id;
  			$data[1] = $name;
  			EditRecord("recommendeds","3",$data);	
  			}	
  			
  			header('Location:recommended.php');	
  		}
		

		?>
	
	    <br/><br/><br/><br/>   
	    <hr></hr>
	    <br/><br/> 
	  <b> "אם ברצונך לשנות את הסדנאות המומלצות,אנא בחר סדנאות חדשות ולחץ על "בחר כמומלצים</b>
	   <br/>
	   <br/>
	   <form name="choose_recommended_form" id="choose_recommended_form" method="post" action="recommended.php">
		<input type="hidden" name="submitted" value="true"/>	
	   <table dir="rtl" cellspacing='15' class='recommend_pick_table'>
	   <tr>
			<td>
			<?php ShowColumnDropDown("workshops",0,2,"select_workshop1",-1,"Please select recommended workshop",-1);?>
			</td>
	   </tr>
	   <tr>	
		    <td>
			<?php ShowColumnDropDown("workshops",0,2,"select_workshop2",-1,"Please select recommended workshop",-1);?>
			</td>
	   </tr>
	   <tr>
		    <td>
		    <?php ShowColumnDropDown("workshops",0,2,"select_workshop3",-1,"Please select recommended workshop",-1);?>
		    </td>
	   </tr> 
	   </table>
	    <br/>
	    <br/>
	    <br/>
	    
	    <div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.choose_recommended_form.submit();">בחר כמומלצים<span/></div>
  		</div>
		

		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
