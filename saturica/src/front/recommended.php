<!DOCTYPE html>
<?php 
include_once 'functions.php';
include_once 'backoffice/connect.php';
include_once 'backoffice/mysql.php';		//change to the correct location ! 

connect();   //connect to mysql DB

$first_workshop_id = GetRecord('recommendeds',1);	//get id of the recommended workshop
$first_pic_workshop_recommended = $first_workshop_id[2];	//the picture from recommendeds table 
$first_workshop = GetRecord('workshops',$first_workshop_id[1]); //get the workshop

$second_workshop_id = GetRecord('recommendeds',2);
$second_pic_workshop_recommended = $second_workshop_id[2];	//the picture from recommendeds table 
$second_workshop = GetRecord('workshops',$second_workshop_id[1]); //get the workshop


$third_workshop_id = GetRecord('recommendeds',3);
$third_pic_workshop_recommended = $third_workshop_id[2];	//the picture from recommendeds table 
$third_workshop = GetRecord('workshops',$third_workshop_id[1]); //get the workshop
?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
SetupJqueryContactDialogCss();
if(CheckIfIE()) 
	{
		?>
		<link rel="stylesheet" href="IEstyle.css" type="text/css" />
		<?php 
	}
SetupJquery();
SetupJqueryContactDialog();
SetupSearchInputRest();
?>
<title>סאטוריקה - מומלצים</title>
<?php GoogleAnalytics();?>
</head>
<?php flush();?>
<body>

	<?php HeaderFunc("recommended");?>
	<div id="recommendeds_wizard">
	<div id="recommendeds_wizard_main">
		<div id="recommendeds_main_title"> 
			<div id="recommended_title">
                    המומלצים שלנו
        	</div>
        	<div id="recommended_title_B">
                     :אנחנו מקפידים על כך שכל הפעילויות באתר יהיו טובות ואיכותיות, אבל יש כמה שחשוב לנו במיוחד שתכירו
        	</div>
		</div>

		<div id="recommendeds">     
        
        <div id="recommended_A_image">
		<?php
		//echo "<img src='recommended_pic/$first_pic_workshop_recommended' border=0 width=240>";
		//echo "<img src='recommended_pic/$first_workshop[3]' border=0 width=240>";
		
		//for testing at home - different folders. the path is below : 
		echo "<img src='../backoffice/recommended_pic/$first_pic_workshop_recommended' border=0 height=220 width=240>";
		?>
		</div>

		<div id="recommended_B_image">
		<?php
		//echo "<img src='recommended_pic/$second_workshop[3]' border=0 width=240>";
		//below is path at home 
		echo "<img src='../backoffice/recommended_pic/$second_pic_workshop_recommended' border=0 height=220 width=240>";
		
		?>
		</div>
		
		<div id="recommended_C_image">
		<?php
		//echo "<img src='recommended_pic/$third_workshop[3]' border=0 width=240>";
		//below is path at home 
		echo "<img src='../backoffice/recommended_pic/$third_pic_workshop_recommended' border=0 height=220 width=240>";
		
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
	</div>		
	<?php
	FooterFunc();
	DialogBoxHtml();
	?>
</body>
</html>