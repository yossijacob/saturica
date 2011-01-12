<!DOCTYPE html>
<?php 
include_once 'functions.php';
include_once 'js/adgallery/adgallery.php';
?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
InitGallery();	// loads js function and files for the adgallery plugin also loads the css for adgallery
?>
<title>סטוריקה</title>
</head>
<body>
	<?php  HeaderFunc("gallery"); ?>
<div id="gallery_page">	

	<div id="gallery_div">
		<?php ShowGallery("../blog/wp-content/gallery/satorika/", "*.jpg", "90", "60")  // folder,mask,thunb width , thumb height?>  
	</div>
	
	
	<div id="channel_div">
		<div id="channel">
			<object width="746" height="413">
				<param name="movie" value="http://www.youtube.com/cp/vjVQa1PpcFN1rfBq9dbk_nTWiCscyt1OqNNuV0rmsDo=">
				<embed src="http://www.youtube.com/cp/vjVQa1PpcFN1rfBq9dbk_nTWiCscyt1OqNNuV0rmsDo=" type="application/x-shockwave-flash" width="746" height="413"></embed>
			</object>
		</div>
	</div>
	
	
	
	
</div>
	<?php FooterFunc();?>
</body>
</html>
