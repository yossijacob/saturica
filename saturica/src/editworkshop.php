<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ערוך סדנא</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>

</head>
<body>
	<?php 
		MenuBar('workshops'); 
	?>
    
	
<div id="content">
    <br/>
    <h1>עריכת פרטי סדנא</h1>
    <hr></hr>
    <div id="left_menu">
    	<a href="workshops.php" style="float:right;" class="icon_button"><span class="back">חזור לרשימת סדנאות</span></a>
    	<br/>
    	
	</div>	
    
  <?php
  
  
  $workshopnum = isset($_POST['workshopnum']) ? $_POST['workshopnum']: "";
  $workshopnum = CleanText($workshopnum);
  
  $workshopname  = isset($_POST['workshopname'])? $_POST['workshopname']: "";
  $workshopname = CleanText($workshopname);
  
  $workshoppic  = isset($_POST['workshoppic'])? $_POST['workshoppic']: "";
  $workshoppic = CleanText($workshoppic);
  
  $workshopsubject  = isset($_POST['workshopsubject'])? $_POST['workshopsubject']: "";
  $workshopsubject = CleanText($workshopsubject);
  
  $workshopstyle  = isset($_POST['workshopstyle'])? $_POST['workshopstyle']: "";
  $workshopstyle = CleanText($workshopstyle);
  
  $workshopfixprice  = isset($_POST['workshopfixprice'])? $_POST['workshopfixprice']: "";
  $workshopfixprice = CleanText($workshopfixprice);
  
  $workshoppersonprice  = isset($_POST['workshoppersonprice'])? $_POST['workshoppersonprice']: "";
  $workshoppersonprice = CleanText($workshoppersonprice);
  
  $workshopdesc = isset($_POST['workshopdesc'])? $_POST['workshopdesc']: "";
  $workshopdesc = CleanText($workshopdesc);

  $workshopcomments  = isset($_POST['workshopcomments'])? $_POST['workshopcomments']: "";
  $workshopcomments = CleanText($workshopcomments);
  
  $workshopdetails = isset($_POST['workshopdetails']) ? $_POST['workshopdetails']: "";
  $workshopdetails = CleanText($workshopdetails);
  
  $workshopsupllier  = isset($_POST['workshopsupllier'])? $_POST['workshopsupllier']: "";
  $workshopsupllier = CleanText($workshopsupllier);
  
  $workshopactive  = isset($_POST['workshopactive'])? $_POST['workshopactive']: "";
  $workshopactive = CleanText($workshopactive);
  
  $workshopminsize = isset($_POST['workshopminsize']) ? $_POST['workshopminsize']: "";
  $workshopminsize = CleanText($workshopminsize);
  $workshopmaxsize  = isset($_POST['workshopmaxsize'])? $_POST['workshopmaxsize']: "";
  $workshopmaxsize = CleanText($workshopmaxsize);
  $workshoprank  = isset($_POST['workshoprank'])? $_POST['workshoprank']: "";
  $workshoprank = CleanText($workshoprank);
  
  //more questions (expert / wiz questions )

  $workshoptype  = isset($_POST['workshoptype'])? $_POST['workshoptype']: "";
  $workshoptype = CleanText($workshoptype);
  
  $workshoplocation  = isset($_POST['workshoplocation'])? $_POST['workshoplocation']: "";
  $workshoplocation = CleanText($workshoplocation);
  
  $workshoptimeframe  = isset($_POST['workshoptimeframe'])? $_POST['workshoptimeframe']: "";
  $workshoptimeframe = CleanText($workshoptimeframe);
  
  
  $id  = isset($_POST['id'])? $_POST['id']: "";
  $id = CleanText($id);
  if ($id == "") header('Location:workshops.php'); // if no id then go back
  
  $workshop = GetRecord("workshops",$id);  // get data

  
  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";
  	$name_exist = "";
  	
  	if (isset($_POST['submitted']))	// if form was submitted then check and process it
  	{
  	
  	if ($workshopnum == "") 
  		{
  			$miss = true;
  			$missing['workshopnum'] = "מספר סדנא";
  		}
  	if ($workshopname == "") 
  		{
  			$miss = true;
  			$missing['workshopname'] = "שם סדנא";
  		}
  	if ($workshopsubject == "") 
  		{
  			$miss = true;
  			$missing['workshopsubject'] = "נושא סדנא";
  		}
  	if ($workshopfixprice == "") 
  		{
  			$miss = true;
  			$missing['workshopfixprice'] = "מחיר קבוע";
  		}
  	if ($workshoppersonprice == "") 
  		{
  			$miss = true;
  			$missing['workshoppersonprice'] = "מחיר למשתתף";
  		}
  	if ($workshoprank == "") 
  		{
  			$miss = true;
  			$missing['workshoprank'] = "דירוג סדנא";
  		}
  	else if (!isrank($workshoprank))
  		{
  			$miss = true;
  			$missing['workshoprank'] = "על הדירוג להיות מספר בין 1 ל 5";
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
  			$data[0] = $workshopnum;
  			$data[1] = $workshopname;
  			$data[2] = $workshoppic;
  			$data[3] = $workshopsubject;
  			$data[4] = $workshopstyle;
  			$data[5] = $workshopfixprice;  
  			$data[6] = $workshoppersonprice;  
  			$data[7] = $workshopdesc;
  			$data[8] = $workshopcomments;
  			$data[9] = $workshopdetails;
  			$data[10] = $workshopsupllier;
  			$data[11] = $workshopactive;
  			$data[12] = $workshopminsize;  
  			$data[13] = $workshopmaxsize; 
  			$data[14] = $workshoprank; 
  			$data[15] = $workshoptype; 
			$data[16] = $workshoplocation; 
			$data[17] = $workshoptimeframe; 
  			
  			$target_path = "workshop_pic/";	//upload the picture to 'workshop_pic' folder
			$target_path = $target_path . basename( $_FILES['workshoppic']['name']); 
			UploadFile( $_FILES['workshoppic']['name'],$_FILES['workshoppic']['tmp_name'],$target_path);
  			
		/*	$_FILES['picture']['name'] - name contains the original path of the user uploaded file.
		 *  $_FILES['picture']['tmp_name'] - tmp_name contains the path to the temporary file that is on the server.  */
			
	
			$data[2] = $target_path.$workshoppic;
  			
  			EditRecord("workshops",$id, $data);     			// add the workshop		

  			header('Location:workshops.php');
  		}
  	
  	}  // close if submitted 
// if not submitted then get data
  		$workshopnum = $workshop[1];
  		$workshopname = $workshop[2];
  		$workshoppic = $workshop[3];
  		$workshopsubject = $workshop[4];
  		$workshopstyle = $workshop[5];
  		$workshopfixprice = $workshop[6];  
  		$workshoppersonprice = $workshop[7];  
  		$workshopdesc = $workshop[8];
  		$workshopcomments = $workshop[9];
  		$workshopdetails = $workshop[10];
  		$workshopsupllier = $workshop[11];
  		$workshopactive = $workshop[12];
  		$workshopminsize = $workshop[13];  
  		$workshopmaxsize = $workshop[14]; 
  		$workshoprank = $workshop[15]; 
  		$workshoptype = $workshop[16]; 
		$workshoplocation = $workshop[17]; 
		$workshoptimeframe = $workshop[18];
 		
		$yesno[0] = "כן";		// for the active dropdown box
		$yesno[1] = "לא";
 			
?>
	<br/>
	<div id="add_workshop_div" dir="rtl">
	<form enctype="multipart/form-data" name="edit_workshop_form" id="edit_workshop_form" method="post" action="editworkshop.php">
	<?php echo "<input type='hidden' name='id' value='$id'/>"; ?>
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>מספר סדנא</b></td>
	 <?php 	
	 echo "<td><input type='text' name='workshopnum' value='$workshopnum' title='workshopnumber'/></td>";
	 
	 ?>
	 </tr>
	 <tr>
	 	<td><b>שם סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshopname' value='$workshopname' title='workshopname'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>תמונה</b></td>
	 <?php 	echo "<td><input type='file' name='workshoppic' value='$workshoppic' title='workshoppic'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>נושא סדנא </b></td>
	 <?php echo "<td><input type='text' name='workshopsubject' value='$workshopsubject' title='workshopsubject'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>סגנון סדנא</b></td>
	 <?php 	echo "<td><input type='text' name='workshopstyle' value='$workshopstyle' title='workshopstyle'/></td>"; ?>
	 </tr>
	 <tr>
	 	<td><b>מחיר קבוע</b></td>
	 <?php echo "<td><input type='text' name='workshopfixprice' value='$workshopfixprice' /></td>";?>
	 </tr>
	 <tr>
	 <td><b>מחיר למשתתף</b></td>
	 <?php 	echo "<td><input type='text' name='workshoppersonprice' value='$workshoppersonprice' title='workshoppersonprice'/></td>"; ?>
	 </tr>
	 <tr>
	 	<td><b>תאור סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshopdesc' value='$workshopdesc' title='workshopdesc'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>הערות סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshopcomments' value='$workshopcomments' title='workshopcomments'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>פרטים חשובים בסדנא</b></td>
	 <?php echo "<td><input type='text' name='workshopdetails' value='$workshopdetails' title='workshopdetails'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>שם הספק</b></td>
	 <?php echo "<td><input type='text' name='workshopsupllier' value='$workshopsupllier' title='$workshopsupllier'/></td>";?>
	 </tr>
	 <tr>
	 	<td>האם סדנא פעילה</td>
	 	<td>
	 	<?php 
	 	ShowDropDown("workshopactive",$yesno,$yesno,"","",$workshopactive);
	 	?>
	 	</td>
	<!--  <?php echo "<td><input type='text' name='workshopactive' value='$workshopactive' title='workshopactive'/></td>";?>	-->
	 </tr>
	 <tr>
	 	<td><b>גודל סדנא מינימלי</b></td>
	 <?php echo "<td><input type='text' name='workshopminsize' value='$workshopminsize' title='workshopminsize'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>גודל סדנא מקסימלי</b></td>
	 <?php echo "<td><input type='text' name='workshopmaxsize' value='$workshopmaxsize' title='workshopmaxsize'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>דירוג סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshoprank' value='$workshoprank' title='workshoprank'/></td>";?>
	 </tr>
	 	 <tr>
	 	<td><b>סוג סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshoptype' value='$workshoptype' title='workshoptype'/></td>";?>
	 </tr>
	 	 <tr>
	 	<td><b>מיקום סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshoplocation' value='$workshoplocation' title='workshoplocation'/></td>";?>
	 </tr>
	 	 <tr>
	 	<td><b>זמן סדנא</b></td>
	 <?php echo "<td><input type='text' name='workshoptimeframe' value='$workshoptimeframe' title='$workshoptimeframe'/></td>";?>
	 </tr>

	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.edit_workshop_form.submit();">שמור<span/></div>
  	</div>
	</form>
	</div>

</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>