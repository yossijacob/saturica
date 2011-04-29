<!DOCTYPE html>
<?php 
include_once 'functions.php';
?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
if(CheckIfIE()) 
	{
		?>
		<link rel="stylesheet" href="IEstyle.css" type="text/css" />
		<?php 
	}
SetupSearchInputRest();
?>
<title>סאטוריקה - תודה על פנייתך</title>
<?php GoogleAnalytics();?>
</head>
<?php flush();?>
<body>
	<?php HeaderFunc("contact");?>
	<div id="about_wizard">
	<div id="about_wizard_main">
		<div id="about_main_title" dir="rtl"> 
        	<div id="about_title">
        	<br/>
                     <h1>תודה על פנייתך</h1>
                     <h2>אנו ניצור איתך קשר בהקדם</h2>
        	</div>
		</div>
		<div id="about_second_title">
			<div id="about_title_second_text">
		  
			</div>
		</div>
	</div>
	</div>
	
	<?php
	FooterFunc();
	?>
</body>
</html>