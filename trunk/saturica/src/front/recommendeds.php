﻿<!DOCTYPE html>
<?php 

include_once '../mysql.php';
include_once '../connect.php';
include_once 'functions.php';

connect();   //connect to mysql DB


$first_workshop_id = GetRecord('recommendeds',1);	//get id of the recommended workshop
$first_workshop = GetRecord('workshops',$first_workshop_id[1]); //get the workshop
$second_workshop_id = GetRecord('recommendeds',2);
$second_workshop = GetRecord('workshops',$second_workshop_id[1]); //get the workshop
$third_workshop_id = GetRecord('recommendeds',3);
$third_workshop = GetRecord('workshops',$third_workshop_id[1]); //get the workshop
?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="recommendeds_style.css" />
<script type="text/javascript" language="javascript">
    var hide = false;
    function show_dropdown(id) 
    {
        if (!hide) document.getElementById(id).style.visibility = "visible";  // dd_list
        hide = false;
        //document.getElementById("dd_text").value=121;
    }
    function downkey()
    {

    }

    function setText(text_id,list_id, val) 
    {
        hide = true;
        hide_list(list_id);
        document.getElementById(text_id).value = val;    // dd_text

    }
    function hide_list(id) 
    {
        document.getElementById(id).style.visibility = "hidden";  // dd_list
    }
</script>
<title>סטוריקה</title>
</head>
<body>
	<?php
	HeaderFunc();
	?>
	<div id="recommendeds_wizard">
		<div id="recommendeds">
		
		<div id="recommended_title">
                    המומלצים שלנו
        </div>
        
        
        <div id="recommended_A_image">
		<?php
		echo "<img src='../recommended_pic/$first_workshop[3]' border=0 width=240>";
		?>
		</div>

		<div id="recommended_B_image">
		<?php
		echo "<img src='../recommended_pic/$second_workshop[3]' border=0 width=240>";
		?>
		</div>
		
		<div id="recommended_C_image">
		<?php
		echo "<img src='../recommended_pic/$third_workshop[3]' border=0 width=240>";
		?>
		</div>
        
        
        
        <div id="recommended_A">
			<?php
			PrintDetails($first_workshop);
			?>
		</div>
		
		<div id="recommended_B">
			<?php
			PrintDetails($second_workshop);
			?>
		</div>
		
		
		<div id="recommended_C">
			<?php
			PrintDetails($third_workshop);
			?>
        
		</div>
		

		</div>
	</div>
	
	
	

	<div id="bottom">
	</div>
	
	<?php
	FooterFunc();
	?>
</body>
</html>