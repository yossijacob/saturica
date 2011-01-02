<?php
if (!is_authenticated()) 
	header("Location:login.php");

include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
include_once 'report_aux.php';
			
connect();   //connect to mysql DB	 
//---------------------------------------------------------------------------------------------

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>הגדרות</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>
</head>
<body>
	<?php  
		MenuBar('preferences'); 
	?>
    
	
<div id="content">
	    <br/>
	    <h1>הגדרות</h1>
	    <hr></hr>
	    <br/> <br/>
	    <br/> <br/>
	    
	 	<div id="shiny-demo-green" class="demo-button" onclick="location.href='changepassword.php'">שינוי ססמא<span/></div>
	    <div id="shiny-demo-red" class="demo-button" onclick="location.href='changemail.php'">שינוי מייל<span/></div>
	   <!--  <div id="shiny-demo-blue" class="demo-button" onclick="javascript:alert('batlan ya batlan');">Blue Button<span/></div>	-->

		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
