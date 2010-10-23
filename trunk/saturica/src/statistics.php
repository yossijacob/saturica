<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB

?>

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
    	<a href="user.php" class="icon_button"><span class="add">Add</span></a>
    	<a href="user.php" class="icon_button"><span class="delete">Delete</span></a>
    	<a href="user.php" class="icon_button"><span class="edit">Edit</span></a>
    	<a href="create_dispatch_table.php?next=home.php" class="big_icon_button"><span class="refresh">Bigger button</span></a>
    	and there are more pics ,and more can be added ofcourse.
	    <br/>
	    <br/>
	    <div id="shiny-demo-green" class="demo-button" onclick="javascript:alert('batlan ya batlan');">Green Button<span/></div>
	    <div id="shiny-demo-red" class="demo-button" onclick="javascript:alert('batlanit ya batlanit');">Red Button<span/></div>
	    <div id="shiny-demo-blue" class="demo-button" onclick="javascript:alert('batlan ya batlan');">Blue Button<span/></div>
	    <br/>
		
  
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
