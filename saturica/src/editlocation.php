<?php 

include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB

session_start();
if (!is_authenticated()) 
			header("Location:login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ערוך מיקום</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>

</head>
<body>
	<?php		 
		MenuBar('locations'); 
	?>
    
	
<div id="content">
    <br/>
    <h1>עריכת פרטי מיקום</h1>
    <hr></hr>
    <div id="left_menu">
    	<a href="locations.php" style="float:right;" class="icon_button"><span class="back">חזור לרשימת מיקומים</span></a>
    	<br/>
    	
	</div>	
    
  <?php
  
  
  $number = isset($_POST['number']) ? $_POST['number']: "";
  $number = CleanText($number);
  $fake_name  = isset($_POST['fake_name'])? $_POST['fake_name']: "";
  $fake_name = CleanText($fake_name);
  $real_name  = isset($_POST['real_name'])? $_POST['real_name']: "";
  $real_name = CleanText($real_name);
  $description  = isset($_POST['description'])? $_POST['description']: "";
  $description = CleanText($description);
  $place  = isset($_POST['place'])? $_POST['place']: "";
  $place = CleanText($place);
  $picture  = isset($_POST['picture'])? $_POST['picture']: "";
  $picture = CleanText($picture);
  $rank  = isset($_POST['rank'])? $_POST['rank']: "";
  $rank = CleanText($rank);
  
  $id  = isset($_POST['id'])? $_POST['id']: "";
  $id = CleanText($id);
  if ($id == "") header('Location:locations.php'); // if no id then go back

  $location = GetRecord("locations",$id);  // get data
  
  
  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";
  	$name_exist = "";
  	
  	
  	$places[0] = "צפון";		// for the places dropdown boxes
	$places[1] = "חיפה והסביבה";
	$places[2] = "אזור השרון";
	$places[3] = "מרכז";
	$places[4] = "ירושליים";
	$places[5] = "דרום";		
  	
  	if (isset($_POST['submitted']))
  	{
  	
  	if ($number == "") 
  		{
  			$miss = true;
  			$missing['number'] = "מספר מיקום";
  		}
  	if ($fake_name == "") 
  		{
  			$miss = true;
  			$missing['fake_name'] = "שם בדוי";
  		}
  	if ($real_name == "") 
  		{
  			$miss = true;
  			$missing['real_name'] = "שם אמיתי";
  		}
  	if ($place == "") 
  		{
  			$miss = true;
  			$missing['place'] = "מיקום";
  		}
  	if ($rank == "") 
  		{
  			$miss = true;
  			$missing['rank'] = "דירוג פנימי";
  		}
  	else if (!isrank($rank))
  		{
  			$miss = true;
  			$missing['rank'] = "על הדירוג להיות מספר בין 1 ל 5";
  		}
  	
  	if ($miss == true)
  		{
  			$miss_msg = implode(",",$missing);
  			echo "<br/>";
  			echo "<b>:חסרים הפרטים הבאים</b>";
  			echo "<h4>".$miss_msg."</h4>";	
  		}	
  	
	if ($miss != true)
  		{		// the form was validated successfully now we process the form
  			$data[0] = $number;
  			$data[1] = $fake_name;
  			$data[2] = $real_name;
  			$data[3] = $description;
  			$data[4] = $place;
  			$data[5] = $picture;  
  			$data[6] = $rank;   
  			 
  			
  			$target_path = "location_pic/";	//upload the picture to 'location_pic' folder
			$target_path = $target_path . basename( $_FILES['picture']['name']); 
			UploadFile( $_FILES['picture']['name'],$_FILES['picture']['tmp_name'],$target_path);
  			
		/*	$_FILES['picture']['name'] - name contains the original path of the user uploaded file.
		 *  $_FILES['picture']['tmp_name'] - tmp_name contains the path to the temporary file that is on the server.  */	
			$data[5] = $target_path.$picture;			
			EditRecord("locations",$id, $data);     			// edit the location
	
			?>
		
			<script type="text/javascript" language="javascript">
   			//window.location = 'locations.php';
   			</script>
   			<?php 
  			//header('Location:locations.php');
  		}
  	
  	}  // close if submitted 
// if not submitted then get data

  	$number  = $location[1];
  	$fake_name = $location[2];
  	$real_name = $location[3];
  	$description = $location[4];
  	$place = $location[5];
  	$picture = $location[6];
  	$rank = $location[7];
  	
 			
?>
	<br/>
	<div id="add_location_div" dir="rtl">
	<form enctype="multipart/form-data" name="edit_location_form" id="edit_location_form" method="post" action="editlocation.php">
	<?php echo "<input type='hidden' name='id' value='$id'/>"; ?>
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>מספר מיקום</b></td>
	 <?php 	
	 echo "<td><input type='text' name='number' value='$number' title='number'/></td>";
	 //echo "<td>$name_exist</td>"; 
	 ?>
	 </tr>
	 <tr>
	 	<td><b>שם בדוי</b></td>
	 <?php echo "<td><input type='text' name='fake_name' value='$fake_name' title='fake name'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>שם אמיתי</b></td>
	 <?php echo "<td><input type='text' name='real_name' value='$real_name' title='real_name'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>תיאור</b></td>
	 <?php 	echo "<td><input type='text' name='description' value='$description' title='description'/></td>"; ?>
	 </tr>
	 <tr>
	 	<td><b>מקום</b></td>
	 	<td>
	 	<?php 
	 	ShowDropDown("place",$places,$places,"","",$place);
	 	?>
	 	</td>
	 </tr>
	 <tr>
	 	<td><b>תמונה</b></td>
	 <?php 	echo "<td>$picture <input type='file' name='picture' value='$picture' title='picture'/> </td>";?>
	 </tr>
	 <tr>
	 <td><b>דירוג פנימי</b></td>
	 <?php 	echo "<td><input type='text' name='rank' value='$rank' title='rank'/></td>"; ?>
	 </tr>
	
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.edit_location_form.submit()";>שמור<span/></div>
  	</div>
	</form>
	</div>

</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
