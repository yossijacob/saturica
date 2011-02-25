<!DOCTYPE html>
<?php 
include_once 'js/adgallery/adgallery.php';
include_once 'functions.php';
?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
InitGallery();	// loads js function and files for the adgallery plugin also loads the css for adgallery
?>
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
	<?php  HeaderFunc("gallery"); ?>
<div id="gallery_page">	
	<div id = "gallery_page_main">
	<div id="gallery_head" dir="rtl">
		<div id = "gallery_head_content">
			גלריה:
		</div>
		
		<div id = "gallery_head_content2">
			תמונה שווה אלף מילים
		</div>
	</div>
	
	<div id="gallery_main">	
		<div id="gallery_div">
			<?php ShowGallery("../blog/wp-content/gallery/satorika/", "*.jpg", "90", "60")  // folder,mask,thunb width , thumb height?>  
		</div>
		
		
		<div id="channel_div">
			<div id="channel">
				<script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/youtube.xml&amp;up_channel=idfnadesk&amp;synd=open&amp;w=695&amp;h=413&amp;title=&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
									
				<!-- <object width="746" height="413">
					<param name="movie" value="http://www.youtube.com/cp/vjVQa1PpcFN1rfBq9dbk_nTWiCscyt1OqNNuV0rmsDo=">
					<embed src="http://www.youtube.com/cp/vjVQa1PpcFN1rfBq9dbk_nTWiCscyt1OqNNuV0rmsDo=" type="application/x-shockwave-flash" width="746" height="413"/> 
				</object>
				 -->
			</div>
		</div>
	</div>
	
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
	   <img src="images/images/main_menu_blog_hover.jpg" width="1" height="1" alt="Image 07" />
	   <img src="images/main_menu_contact_hover.jpg" width="1" height="1" alt="Image 08" />
	</div>
</body>
</html>
