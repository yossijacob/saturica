<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

session_start();	
connect();   //connect to mysql DB

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>חפש סדנא לפי נושא</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php
		if (!is_authenticated()) 
			header("Location:login.php"); 
		MenuBar(''); 
		MenuBarSearch('subject');
	?>
    
	
<div id="content">
    <br/>
    <h1>חיפוש</h1>
    <hr></hr>
    
  <?php
  
  
  $search = isset($_POST['search']) ? $_POST['search']: "";
  $search = CleanText($search);

  
  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";

  	
  	if (isset($_POST['submitted']))
  	{
  	
  	if ($search == "") 
  		{
  			$miss = true;
  			$missing['search'] = "לא הוכנסו מילות חיפוש";
  		}
  	if ($miss == true)
  		{
  			$miss_msg = implode(",",$missing);
  			echo "<br/>";
  			echo "<b>:התרחשה שגיאה בפרטים הבאים</b>";
  			echo "<h4>".$miss_msg."</h4>";	
  		}	
  	
	if ($miss != true)
  		{		// the form was validated successfully now we process the form
  			
			$col="subject";
  			$result = SearchWorkshop($col,$search);
 			PrintWorkshops($result);
  			
  			//header('Location:preferences.php');

  		}
  	
  	}  // close if submitted 

  
?>
	<br/>
	<div id="search_name_form" dir="rtl">
	<form name="search_name_form" id="search_name_form" method="post" action="subject.php">
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>חיפוש לפי נושא</b></td>
	 <?php 	
	 echo "<td><input type='text' size='50' name='search' value='$search' title='search'/></td>";
	 ?>
	 </tr>
	 
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.search_name_form.submit();">חפש<span/></div>
		<!-- <a class="green_ovalbutton" href="javascript:document.add_broker_form.submit();"><span>Add broker</span></a> -->
  	</div>
	</form>
	</div>
 
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>