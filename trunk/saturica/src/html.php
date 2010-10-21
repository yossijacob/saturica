<?php


//--------------------------------------------------------------------------------------------------
function ShowStatesDropdown($name , $deafult,$wildcard_bool)
// creates a drop down of numbers by the $name and with range from low to high
{
echo  "<select id ='$name' name='$name'>";
if ($wildcard_bool == 'true')
	echo "<option value='Any' selected>Any</option>";

$result = mysql_query("SELECT * FROM states ");

while($row = mysql_fetch_row($result))
{
	if ($row[0] == $deafult)
	echo "<option value='$row[0]' selected>$row[0]</option>";
	else
	echo "<option value='$row[0]'>$row[0]</option>";
}
echo "</select>";
mysql_free_result($result);
}

//**********************************************************************
function isemail($email) {
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
}
//***********************************************************************


function isrank($rank) {
    if ( ( $rank < 1 ) || ( $rank > 5 ) ) return false;
    return true; 
}
//***********************************************************************
function UploadPicture($file,$tmp_name,$target) {
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
	echo "<p id='legal'>Copyright &copy; 2010 by Yossi Jacob & Roee Minster. All Rights Reserved.</p>";
	//echo "<p id='links'><a href='#'>Privacy Policy</a> | <a href='#'>Terms of Use</a></p>";
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
    echo   	"<li class=".$sel['reccomended']."><a href='reccomended.php' title='reccomended'>מומלצים</a></li>";    
    echo   	"<li class=".$sel['workshops']."><a href='workshops.php' title='workshops'>סדנאות</a></li>";    
    echo   	"<li class=".$sel['newsletter']."><a href='newsletter.php' title='newsletter'>ניוזלטר</a></li>";    
    echo   	"<li class=".$sel['preferences']."><a href='preferences.php' title='preferences'>הגדרות</a></li>";   
    echo   	"<li class=".$sel['blog']."><a href='blog.php' title='blog'>בלוג</a></li>";    
	echo 	"</ul>";	
	echo 	"</div>";	

}
//************************************************************************


?>