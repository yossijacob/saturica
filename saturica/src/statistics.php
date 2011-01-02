<?php 
if (!is_authenticated()) 
			header("Location:login.php");
session_start();
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Statistics</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
	
	<?php
		  
		MenuBar('statistics'); 
	?>
    
<div id="content">
	    <br/>
	    <h1>סטטיסטיקה</h1>
	    <hr></hr>
	    <br/>
	    <br/>
	    <br/>
	    <b>מספר המיקומים הכולל במערכת :</b>
	   <?php echo GetTableSize("locations"); ?>
	    <br/>
	    <br/>
	    <b>מספר הלקוחות הכולל במערכת :</b>
	    <?php echo GetTableSize("customers"); ?>
	    <br/>
	    <b>מספר הלקוחות הפעילים במערכת :</b>
	    <?php echo GetTableActiveSize("customers"); ?>
	    <br/>
	    <br/>
	    <b>מספר הסדנאות הכולל במערכת :</b>
	    <?php echo GetTableSize("workshops"); ?>
	    <br/>
	    <b>מספר הסדנאות הפעילות במערכת :</b>
	    <?php echo GetTableActiveSize("workshops"); ?>
	   
    	
	    <br/>
		
  
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
