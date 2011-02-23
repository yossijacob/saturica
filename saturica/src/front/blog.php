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
<?php flush();?>
<body>
	<?php  HeaderFunc("blog"); ?>
	<div id="blog_div">
		<div id = "blog_div_main">
		<iframe height="2000" width="960px" frameborder="0" src="../blog/"></iframe>
		</div>
	</div>
	<?php FooterFunc();?>
</body>
</html>

