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
	   <select name="select_workshop">
		<?php 
    	// default is 0, no entry will be selected.
    		db_createlist($linkID,0,
            "SELECT * FROM workshops","Please select recommended workshop");
		
    		?>
</select>
	    <br/>
	    <br/>
	    <br/>
	    <br/>
		

		
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
