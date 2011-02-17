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
<title>סטוריקה</title>
</head>
<body>
	<?php  HeaderFunc("blog"); ?>
	<div id="blog_div">
		<iframe height="2000" width="960px"  src="../blog/"></iframe>
	</div>
	<?php FooterFunc();?>
</body>
</html>

