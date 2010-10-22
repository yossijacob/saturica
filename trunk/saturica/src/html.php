<?php



//--------------------------------------------------------------------------------------------------
function ShowDropDown($name,$data,$data_text,$deafult_val,$deafult_text,$selected)
{
	/*
	 * show data as a drop down box
	 * name - name of select
	 * data - array of values
	 * data_text - array of text values
	 * deafult added data value that is not in the array
	 * val- values 
	 * selected the value which is selected by deafult
	 */
echo  "<select id ='$name' name='$name'>";
if ($deafult_text != '')
	{	
	echo "<option value='$deafult_val' selected>$deafult_text</option>";
	}
	$index = 0;
foreach($data as $element)
	{
	if ($element == $selected)
	echo "<option value='$element' selected>$data_text[$index]</option>";
	else
	echo "<option value='$element'>$data_text[$index]</option>";
	$index++;
	}
echo "</select>";
}



//**********************************************************************
function isemail($email) {
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
}

//***********************************************************************
function isrank($rank) 
{
    if ( ( $rank < 1 ) || ( $rank > 5 ) ) return false;
    return true; 
}

//***********************************************************************
function UploadPicture($file,$tmp_name,$target) 
{
	//	upload a picture to $target. the target needs to be an existing folder.
	if (move_uploaded_file($tmp_name, $target) ) 
		{ echo "The file ".$file." has been uploaded"; } 
	else{
   		 echo "There was an error uploading the file, please try again!";
		}
}
//***********************************************************************
  
function footer()
{
	echo "<div id='footer'>";
	echo "<div class='footer_pics'>";
	echo "<a href='http://validator.w3.org/check/referer' target='_blank'>
		  <img src='http://www.w3.org/Icons/valid-xhtml10'
          alt='Valid XHTML 1.0!' height='31'' width='88'' /></a>";
	echo "</div>";
	echo "<p>best viewed using <a href='http://www.google.com/chrome/' target='_blank'>google chrome</a></p>";
	echo "<br/>";
	echo "<p id='legal'>Copyright &copy; 2010 by Yossi Jacob & Roee Minster. All Rights Reserved.</p>";
	echo "</div>";
}
//************************************************************************
function RoundedBox($content,$width,$forecolor,$backcolor,$bordercolor)
{
	/*create a round painted box , and put the content html inside it*/
	$style = 'style="width:'.$width.';color:'.$forecolor.';background-color:'.$backcolor.';border-color:'.$bordercolor.';"';
	echo "<div class='round_box' $style>";
	echo $content;
	echo "</div>";
	/*echo "<div class='bl' style='width:".$width."px'>";
	echo "	<div class='br'>";
	echo "		<div class='tl'>";
	echo "			<div class='tr'>";
	echo "				$content";
	echo "			</div>";
	echo "		</div>";
	echo "	</div>";
	echo "</div>";
	echo "<div class='clear'>&nbsp;</div>";*/
}
//************************************************************************
function BrokerSubMenu($selected,$broker_id)
{
	/*Shows the sub menu , highlighting the current menu item*/
	$sel[1] = "not";
	$sel[2] = "not";
	$sel[3] = "not";
	$sel[$selected]= "current";
	//echo "<div class='bl2' style='width:300px'>";
	//echo "	<div class='br2'>";
	echo  "<div class='menu_bar'>";
	echo   "<ul class='blue'>";
	echo	"<li><a href='brokerinfo.php?id=$broker_id' title='Information' class='".$sel[1]."'><span>Information</span></a></li>";
	echo	"<li><a href='editbroker.php?id=$broker_id' title='Edit Information' class='".$sel[2]."'><span>Edit</span></a></li>";
	echo	"<li><a href='brokercredit.php?id=$broker_id' title='Load Credits' class='".$sel[3]."'><span>Load Credits</span></a></li>";
	echo	"</ul>";
  	//echo   "</div>";
	//echo "</div>";
	echo "</div>";
}
//************************************************************************
function Logo()
{
echo <<<TT
<div class="logo">
    SATURICA
</div>
TT;
}
//************************************************************************
function MenuBar($selected)
{
	$sel['statistics'] = "not";
	$sel['customers'] = "not";
	$sel['locations'] = "not";
	$sel['reccomended'] = "not";
	$sel['workshops'] = "not";
	$sel['newsletter'] = "not";
	$sel['preferences'] = "not";
	$sel['blog'] = "not";
	$sel[$selected]= "active";
echo '<div id="menu">';
	Logo();
	
	echo	"<ul>";	
    echo   	"<li class=".$sel["statistics"]."><a href='statistics.php'  title='statistics'>סטטיסטיקה</a></li>";    
    echo    "<li class=".$sel['customers']."><a href='customers.php' title=''>לקוחות</a></li>";  
    echo    "<li class=".$sel['locations']."><a href='locations.php' title='locations'>מיקומים</a></li>";   
    echo   	"<li class=".$sel['reccomended']."><a href='recommended.php' title='reccomended'>מומלצים</a></li>";    
    echo   	"<li class=".$sel['workshops']."><a href='workshops.php' title='workshops'>סדנאות</a></li>";    
    echo   	"<li class=".$sel['newsletter']."><a href='newsletter.php' title='newsletter'>ניוזלטר</a></li>";    
    echo   	"<li class=".$sel['preferences']."><a href='preferences.php' title='preferences'>הגדרות</a></li>";   
    echo   	"<li class=".$sel['blog']."><a href='blog.php' title='blog'>בלוג</a></li>";    
	echo 	"</ul>";	
	echo 	"</div>";	

}
//************************************************************************


?>