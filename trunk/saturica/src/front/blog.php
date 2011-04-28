<!DOCTYPE html>
<?php 
include_once 'functions.php';
$blog_path = isset($_GET['path']) ? $_GET['path'] : "../blog/";
//$blog_path = "../blog/".$blog_path; 
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
<title>בלוג</title>
<?php GoogleAnalytics();?>
</head>
<?php flush();?>
<body>
	<?php  HeaderFunc("blog"); ?>
	<div id="blog_div">
		<div id = "blog_div_main">
			<iframe height="1800" width="960px" frameborder="0" src="<?php echo $blog_path?>" seamless></iframe>
		</div>
	</div>
	<?php FooterFunc();?>
	
	<div id="preload">
	   <img src="images/main_menu_homepage_hover.jpg" width="1" height="1" alt="Image 01" />
	   <img src="images/main_menu_whatwedo_hover.jpg" width="1" height="1" alt="Image 02" />
	   <img src="images/main_menu_recommended_hover.jpg" width="1" height="1" alt="Image 03" />
	   <img src="images/main_menu_customized_hover.jpg" width="1" height="1" alt="Image 04" />
	   <img src="images/main_menu_locations_hover.jpg" width="1" height="1" alt="Image 05" />
	   <img src="images/main_menu_gallery_hover.jpg" width="1" height="1" alt="Image 06" />
	   <img src="images/main_menu_blog_hover.jpg" width="1" height="1" alt="Image 07" />
	   <img src="images/main_menu_contact_hover.jpg" width="1" height="1" alt="Image 08" />
	</div>
</body>
</html>

