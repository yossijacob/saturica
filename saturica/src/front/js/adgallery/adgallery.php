<?php
/***
 * adgallery.php BY YOSSI JACOB (C) 2010
 * 
 * you need to have a js/adgallery folder
 * and an js/adgallery/images folder
 * also you need to call the InitGallery function inside your head tag 
 */

function ListFiles($folder,$mask)
{	// $extension is like '*.png'
	$images = glob("" . $folder . $mask);
	return  $images;
}

function InitGallery()
{
	?>
	<script type="text/javascript" src="js/adgallery/jquery.min.js"></script>
	<script type="text/javascript" src="js/adgallery/jquery.ad-gallery.js"></script>
	<link rel="stylesheet" type="text/css" href="js/adgallery/jquery.ad-gallery.css"/>
	<script type="text/javascript">
	  	$(function() 
	  	{
	    //$('img.image1').data('ad-desc', 'Whoa! This description is set through elm.data("ad-desc") instead of using the longdesc attribute.<br>And it contains <strong>H</strong>ow <strong>T</strong>o <strong>M</strong>eet <strong>L</strong>adies... <em>What?</em> That aint what HTML stands for? Man...');
	    //$('img.image1').data('ad-title', 'Title through $.data');
	    var galleries = $('.ad-gallery').adGallery();
	    $('#switch-effect').change(
	      function() 
	      {
	        galleries[0].settings.effect = $(this).val();
	        return false;
	      }
	    );
	    $('#toggle-slideshow').click(
	      function() 
	      {
	        galleries[0].slideshow.toggle();
	        return false;
	      }
	    );
	    $('#toggle-description').click(
	      function() 
	      {
	        if(!galleries[0].settings.description_wrapper) 
		    {
	          galleries[0].settings.description_wrapper = $('#descriptions');
	        } 
	        else 
		    {
	          galleries[0].settings.description_wrapper = false;
	        }
	        return false;
	      }
	    );
	  });
	</script>
	<?php 
}



/**
 * Enter description here ...
 * @param $folder
 * @param $mask
 * @param $thumbWidth
 * @param $thumbHeight
 */
function ShowGallery($folder, $mask,$thumbWidth,$thumbHeight)
{
	$images = ListFiles($folder, $mask);
	?>
	<div id="gallery" class="ad-gallery" >
		<div class="ad-image-wrapper">
		</div>
		<div class="ad-controls">
		</div>
		<div class="ad-nav">
			<div class="ad-thumbs">
				<ul class="ad-thumb-list">
				<?php 
				$counter = 0;  // for the imageX class (image0,image1,...)
				foreach ($images as $image)
				{
					$alt = basename($image,substr($mask,1));  // cut the folder and extension (mask as a "*" at begining so without it) 
					$alt = str_replace("_", " ", $alt);  // alt is name without underscore
					echo	"<li>";
					echo 		"<a href='$image'>";
					echo    	"<img src='$image' alt='$alt' class='image".$counter."' style='width:".$thumbWidth."px; height:".$thumbHeight."px;'/>";
					echo    	"</a>";
					echo 	"</li>";				
				}	// foreach close
				?>
				</ul>
			</div>
		</div>
	</div>
	<?php 
}


?>