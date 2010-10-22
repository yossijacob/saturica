<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';
include_once 'report_aux.php';
		
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
		MenuBar('recommended'); 
	?>
    
	
<div id="content">
	    <br/>
	    <h1>מומלצים</h1>
	    <hr></hr>
	    בחר 3 סדנאות שיופיעו בעמוד המומלצים
	   <br/>
	   <br/>
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
		

		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
