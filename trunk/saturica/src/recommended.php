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
		if (!is_authenticated()) 
			header("Location:login.php");  
		MenuBar('recommended'); 
	?>
    
    
<div id="content">
	    <br/>
	    <h1>מומלצים</h1>
	    <hr></hr>
	    <br/>
	    <br/>
	    <b>.המומלצים הנוכחיים הם המומלצים המופיעים בתיבות הבאות </b>
	    
  	  <?php

	  $select_workshop1  = isset($_POST['select_workshop1'])? $_POST['select_workshop1']: "";
	  $select_workshop1 = CleanText($select_workshop1);
	  $select_workshop2 = isset($_POST['select_workshop2'])? $_POST['select_workshop2']: "";
	  $select_workshop2 = CleanText($select_workshop2);
	  $select_workshop3 = isset($_POST['select_workshop3'])? $_POST['select_workshop3']: "";
	  $select_workshop3 = CleanText($select_workshop3);
	  
	  $workshop1_id = GetRecord("recommendeds","1"); // get the 'workshop table id' of the record
	  $workshop1_id = $workshop1_id[1]; //the id at the workshop table
	  $workshop1_name = GetRecord("workshops",$workshop1_id); // get the name of the record
	  $workshop1_name = $workshop1_name[2];
	  
	  $workshop2_id = GetRecord("recommendeds","2"); // get the 'workshop table id' of the record
	  $workshop2_id = $workshop2_id[1]; //the id at the workshop table
	  $workshop2_name = GetRecord("workshops",$workshop2_id); // get the name of the record
	  $workshop2_name = $workshop2_name[2];
	  
	  $workshop3_id = GetRecord("recommendeds","3"); // get the 'workshop table id' of the record
	  $workshop3_id = $workshop3_id[1]; //the id at the workshop table
	  $workshop3_name = GetRecord("workshops",$workshop3_id); // get the name of the record
	  $workshop3_name = $workshop3_name[2];
	  

	    if (isset($_POST['submitted']))  // if form was submitted - process it
  		{
  		 if (check_not_same($select_workshop1,$select_workshop2,$select_workshop3))
  		 {
  			
  			if (!($select_workshop1 == -1)) // if we change the first recommended workshop
  			{
	  			$select_workshop1 = GetRecord("workshops",$select_workshop1);
	  			$data[0] = $select_workshop1[0]; //the id of the record at the original "workshops" table
	  			$data[1] = $select_workshop1[3];    // workshop picture
	  			EditRecord("recommendeds","1",$data);	
  			}
  			
  			if (!($select_workshop2 == -1))	// if we change the second recommended workshop
  			{
	  			$select_workshop2 = GetRecord("workshops",$select_workshop2);
	  			$data[0] = $select_workshop2[0]; 
	  			$data[1] = $select_workshop2[3];    // workshop picture
	  			EditRecord("recommendeds","2",$data);	
  			}
  			
  			if (!($select_workshop3 == -1))	// if we change the third recommended workshop
  			{
	  			$select_workshop3 = GetRecord("workshops",$select_workshop3);
	  			$data[0] = $select_workshop3[0]; 
	  			$data[1] = $select_workshop3[3];    // workshop picture
	  			EditRecord("recommendeds","3",$data);	
  			}	
  			header('Location:recommended.php');	
  		 }
  		 else
  		 	{
	  			?>	
	  			<script type="text/javascript">
	  			alert('עליך לבחור מומלצים שונים') 
	  			</script>
	  			<?php 	
  		 	}
	
  		}
		

		?>
	
	   <br/><br/> 
	   <b> "אם ברצונך לשנות את הסדנאות המומלצות,אנא בחר סדנאות חדשות ולחץ על "בחר כמומלצים</b>
	   <br/>
	   <br/>
	   <form name="choose_recommended_form" id="choose_recommended_form" method="post" action="recommended.php">
		<input type="hidden" name="submitted" value="true"/>	
	   <table dir="rtl" cellspacing='15' class='recommend_pick_table'>
	   <tr>
			<td>
			<?php ShowColumnDropDown("workshops",0,2,"select_workshop1",-1,$workshop1_name,-1);?>
			</td>
	   </tr>
	   <tr>	
		    <td>
			<?php ShowColumnDropDown("workshops",0,2,"select_workshop2",-1,$workshop2_name,-1);?>
			</td>
	   </tr>
	   <tr>
		    <td>
		    <?php ShowColumnDropDown("workshops",0,2,"select_workshop3",-1,$workshop3_name,-1);?>
		    </td>
	   </tr> 
	   </table>
	    <br/>
	    <br/>
	    <br/>
	     <br/> <br/> <br/> <br/> <br/> <br/> <br/>
	    <div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.choose_recommended_form.submit();">בחר כמומלצים<span/></div>
  		</div>
		

		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
