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
<title>הוסף סדנא</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php 

		MenuBar('workshops'); 
	?>
    
	
<div id="content">
    <br/>
    <h1>הוספת סדנא חדשה</h1>
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
  
  $workshoppic  = isset($_FILES['workshoppic']['name'])? $_FILES['workshoppic']['name']: "";
  $workshoppic = CleanText($workshoppic);
  
  $type_team_work  = isset($_POST['type_team_work'])? $_POST['type_team_work']: 0;
  $type_team_work = CleanText($type_team_work);
  
  $type_managers  = isset($_POST['type_managers'])? $_POST['type_managers']: "";
  $type_managers = CleanText($type_managers);
  
  $type_workers  = isset($_POST['type_workers'])? $_POST['type_workers']: "";
  $type_workers = CleanText($type_workers);
  
  $type_lectures  = isset($_POST['type_lectures'])? $_POST['type_lectures']: "";
  $type_lectures = CleanText($type_lectures);
  
  $type_teachers  = isset($_POST['type_teachers'])? $_POST['type_teachers']: "";
  $type_teachers = CleanText($type_teachers);
  
  $type_fun  = isset($_POST['type_fun'])? $_POST['type_fun']: "";
  $type_fun = CleanText($type_fun);
  
  
  //$workshopsubject  = isset($_POST['workshopsubject'])? $_POST['workshopsubject']: "";
  //$workshopsubject = CleanText($workshopsubject);
  
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
  
  //$workshoplocation  = isset($_POST['workshoplocation'])? $_POST['workshoplocation']: "";
  //$workshoplocation = CleanText($workshoplocation);
  
  $loc_building  = isset($_POST['loc_building'])? $_POST['loc_building']: "";
  $loc_building = CleanText($loc_building);
  
  $loc_our_place  = isset($_POST['loc_our_place'])? $_POST['loc_our_place']: "";
  $loc_our_place = CleanText($loc_our_place);
  
  $loc_outside  = isset($_POST['loc_outside'])? $_POST['loc_outside']: "";
  $loc_outside = CleanText($loc_outside);
  
  $loc_pool  = isset($_POST['loc_pool'])? $_POST['loc_pool']: "";
  $loc_pool = CleanText($loc_pool);
  
  $loc_beatch  = isset($_POST['loc_beatch'])? $_POST['loc_beatch']: "";
  $loc_beatchs = CleanText($loc_beatch);
  
  $loc_place_to_place  = isset($_POST['loc_place_to_place'])? $_POST['loc_place_to_place']: "";
  $loc_place_to_place = CleanText($loc_place_to_place);
  

  $workshoptimeframe  = isset($_POST['workshoptimeframe'])? $_POST['workshoptimeframe']: "";
  $workshoptimeframe = CleanText($workshoptimeframe);
  
  $workshopactive  = isset($_POST['workshopactive'])? $_POST['workshopactive']: "";
  $workshopactive = CleanText($workshopactive);


  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";
  	$name_exist = "";
  	
  	
  	/*
  	$workshopsubjects[0] = "גיבוש ועבודת צוות";		// for the places dropdown boxes
	$workshopsubjects[1] = "פיתוח מנהלים";
	$workshopsubjects[2] = "פיתוח עובדים";
	$workshopsubjects[3] = "הרצאות";
	$workshopsubjects[4] = "פעילות מיוחדת למורים";
	$workshopsubjects[5] = "מפגש העשרה חוויתי";	
	
	$workshoplocations[0] = "במבנה ממוזג\מחומם";		// for the places dropdown boxes
	$workshoplocations[1] = "אצלנו בארגון";
	$workshoplocations[2] = "בחוץ במקום מיוחד";
	$workshoplocations[3] = "ליד הבריכה";
	$workshoplocations[4] = "על חוף הים";
	$workshoplocations[5] = "נעבור ממקום למקום";
	
	*/
	
	$workshoptimeframes[0] = "פעילות קצרה, מקסימום 3 שעות";		// for the places dropdown boxes
	$workshoptimeframes[1] = "חצי יום";
	$workshoptimeframes[2] = "יום מלא";
	//$workshoptimeframes[3] = "ערב";
	$workshoptimeframes[3] = "יותר מיום אחד";
	
	$yesno[0] = "כן";		// for the active dropdown box
	$yesno[1] = "לא";
	
	
  	
  	if (isset($_POST['submitted']))
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
  	if ( ($type_team_work==0)&&($type_managers==0)&&($type_workers==0)&&($type_lectures==0)&&($type_teachers==0)&&($type_fun==0) ) 
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
  			$data[3] = "";		// not use this. subject at the end of the table. just for the indexes of the columns
  			$data[4] = $workshopstyle;		
  			$data[5] = $workshopfixprice;  
  			$data[6] = $workshoppersonprice;  
  			$data[7] = $workshopdesc;
  			$data[8] = $workshopcomments;
  			$data[9] = $workshopdetails;
  			$data[10] = $workshopsupllier;
  			$data[11] =	$workshopactive;   
  			$data[12] = $workshopminsize;  
  			$data[13] = $workshopmaxsize; 
  			$data[14] = $workshoprank; 
  			$data[15] = $workshoptype; 
			$data[16] = ""; 		// not use this. location at the end of the table. just for the indexes of the columns
			$data[17] = $workshoptimeframe;
			$data[18] = 0;   // votes in feedback 
			$data[19] = $type_team_work;
			$data[20] = $type_managers;
			$data[21] = $type_workers;
			$data[22] = $type_lectures;
			$data[23] = $type_teachers;
			$data[24] = $type_fun;
			$data[25] = $loc_building;     
			$data[26] = $loc_our_place;
			$data[28] = $loc_outside;
			$data[29] = $loc_pool;
			$data[30] = $loc_beatch;
			$data[31] = $loc_place_to_place;
			
  			
  			$target_path = "workshop_pic/";	//upload the picture to 'workshop_pic' folder
			$target_path = $target_path . basename( $_FILES['workshoppic']['name']); 
			UploadFile( $_FILES['workshoppic']['name'],$_FILES['workshoppic']['tmp_name'],$target_path);
			
		/*	$_FILES['picture']['name'] - name contains the original path of the user uploaded file.
		 *  $_FILES['picture']['tmp_name'] - tmp_name contains the path to the temporary file that is on the server.  */
			
	
  			$workshop_id = AddRecord("workshops", $data);     			// add the workshop
  			CreateWorkshopSurveyTable($workshop_id);					// create a table for this workshop survey

  			//$dont_show_form = true;
	  		//echo "<h3>Broker Have Been Added</h3>";
  			//echo "<br/>";
  			
  			?>
		
			<script type="text/javascript" language="javascript">
   			window.location = 'workshops.php';
   			</script>
   			<?php 
  			//header('Location:workshops.php');
  		}
  	
  	}  // close if submitted 

  if ($dont_show_form == false)
  {
 			
?>
	<br/>
	<div id="add_workshop_div" dir="rtl">
	<form enctype="multipart/form-data" name="add_workshop_form" id="add_workshop_form" method="post" action="addworkshop.php">
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
	 	<td><b>סוג הפעילות </b></td>
	 	<td>
	 	<?php 
	 	if ($type_team_work == 1)
	 		echo '<input class="approval_contact_box" name="type_team_work" type="checkbox" value="1"  size="20" checked/> גיבוש ועבודת צוות <br />';
	 	else echo '<input class="approval_contact_box" name="type_team_work" type="checkbox" value="1" size="20"/> גיבוש ועבודת צוות <br />';
	 	
	 	if ($type_managers == 1 )
	 		echo '<input class="approval_contact_box" name="type_managers" type="checkbox" value="1" size="20" checked/> פיתוח מנהלים <br />';
	 	else echo '<input class="approval_contact_box" name="type_managers" type="checkbox" value="1" size="20"/> פיתוח מנהלים <br />';
	 	
	 	if ($type_workers == 1 ) 
	 		echo '<input class="approval_contact_box" name="type_workers" type="checkbox" value="1" size="20" checked/> פיתוח עובדים <br />';
	 	else echo '<input class="approval_contact_box" name="type_workers" type="checkbox" value="1" size="20"/> פיתוח עובדים <br />';
	 	
	 	if ($type_lectures == 1 )
	 		echo '<input class="approval_contact_box" name="type_lectures" type="checkbox" value="1" size="20" checked/> הרצאות <br />';
	 	else echo '<input class="approval_contact_box" name="type_lectures" type="checkbox" value="1" size="20"/> הרצאות <br />';
	 	 
	 	if ($type_teachers == 1 )
	 		echo '<input class="approval_contact_box" name="type_teachers" type="checkbox" value="1" size="20" checked/> פעילות מיוחדת למורים <br />';
	 	else echo '<input class="approval_contact_box" name="type_teachers" type="checkbox" value="1" size="20"/> פעילות מיוחדת למורים <br />';	
	 	
	 	if ($type_fun == 1 )
	 		echo '<input class="approval_contact_box" name="type_fun" type="checkbox" value="1" size="20" checked/> מפגש העשרה חוויתי <br />';
	 	else echo '<input class="approval_contact_box" name="type_fun" type="checkbox" value="1" size="20"/> מפגש העשרה חוויתי <br />';
	 	
	 	?>
	 	
		<?php 
	 	//ShowDropDown("workshopsubject",$workshopsubjects,$workshopsubjects,"","",$workshopsubject);
	 	?>
	 	</td>
	 </tr>
	 
	 <tr>
	 	<td><b>סגנון פעילות</b></td>
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
	 <?php // echo "<td><textarea  name='workshopdesc' value='$workshopdesc' title='workshopdesc' rows='8' cols='25' > </textarea> </td>";?> 
	<?php echo "<td><input type='text' size='302' maxlength='300'  name='workshopdesc' value='$workshopdesc' title='workshopdesc' rows='8' cols='25' > </textarea> </td>";?>
	 </tr>
	 
	 <tr>
	 	<td><b>הערות סדנא</b></td>
	 <?php echo "<td><textarea  name='workshopcomments' value='$workshopcomments' title='workshopcomments' rows='8' cols='25' > </textarea> </td>";?>	 	
	 </tr>
	 <tr>
	 	<td><b>פרטים חשובים בסדנא</b></td>
	 	<?php echo "<td><textarea  name='workshopdetails' value='$workshopdetails' title='workshopdetails' rows='8' cols='25' > </textarea> </td>";?>
	 </tr>
	 <tr>
	 	<td><b>שם הספק</b></td>
	 <?php echo "<td><input type='text' name='workshopsupllier' value='$workshopsupllier' title='$workshopsupllier'/></td>";?>
	 </tr>
<!--  <tr> -->	
<!--	 	<td><b>סדנא פעילה</b></td>	-->	
<!--	 <?php echo "<td><input type='text' name='workshopactive' value='$workshopactive' title='workshopactive'/></td>";?>	-->	
<!--	 </tr>	-->	
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
	 	<td><b>נושא סדנא</b></td>
	 <?php echo "<td><input type='text' size='52' name='workshoptype' value='$workshoptype' title='workshoptype'/></td>";?>
	 </tr>
	 	 <tr>
	 	<td><b>מיקום סדנא</b></td>
		 	<td>
		<?php 
		if ($loc_building == 1)
			echo '<input class="approval_contact_box" name="loc_building" type="checkbox" value="1" size="20" checked/> במבנה ממוזג\מחומם <br />';
		else echo '<input class="approval_contact_box" name="loc_building" type="checkbox" value="1" size="20"/> במבנה ממוזג\מחומם <br />';
		
		if ($loc_our_place == 1)	
			echo '<input class="approval_contact_box" name="loc_our_place" type="checkbox" value="1" size="20" checked/> אצלנו בארגון <br />';
		else echo '<input class="approval_contact_box" name="loc_our_place" type="checkbox" value="1" size="20"/> אצלנו בארגון <br />';
		
		if ($loc_outside == 1)	
			echo '<input class="approval_contact_box" name="loc_outside" type="checkbox" value="1" size="20" checked/> בחוץ במקום מיוחד <br />';
		else echo '<input class="approval_contact_box" name="loc_outside" type="checkbox" value="1" size="20"/> בחוץ במקום מיוחד <br />';
		
		if ($loc_pool == 1)	
			echo '<input class="approval_contact_box" name="loc_pool" type="checkbox" value="1" size="20" checked/> ליד הבריכה <br />';
		else echo '<input class="approval_contact_box" name="loc_pool" type="checkbox" value="1" size="20"/> ליד הבריכה <br />';
			
		if ($loc_beatch == 1)
			echo '<input class="approval_contact_box" name="loc_beatch" type="checkbox" value="1" size="20" checked/> על חוף הים <br />';
		else echo '<input class="approval_contact_box" name="loc_beatch" type="checkbox" value="1" size="20"/> על חוף הים <br />';
		
		if ($loc_place_to_place == 1)
			echo '<input class="approval_contact_box" name="loc_place_to_place" type="checkbox" value="1" size="20" checked/> נעבור ממקום למקום <br />';
		else echo '<input class="approval_contact_box" name="loc_place_to_place" type="checkbox" value="1" size="20"/> נעבור ממקום למקום <br />';
	 			
	 ?>	
	 
	 <?php 
	 	//ShowDropDown("workshoplocation",$workshoplocations,$workshoplocations,"","",$workshoplocation);
	 	?>
	 	</td>
	 </tr>
	 
	 	 <tr>
	 	<td><b>זמן סדנא</b></td>
	 		 	<td>
	 	<?php 
	 	ShowDropDown("workshoptimeframe",$workshoptimeframes,$workshoptimeframes,"","",$workshoptimeframe);
	 	?>
	 	</td>
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

	 
	 
	
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.add_workshop_form.submit();">הוסף סדנא<span/></div>
		<!-- <a class="green_ovalbutton" href="javascript:document.add_broker_form.submit();"><span>Add broker</span></a> -->
  	</div>
	</form>
	</div>
<?php } // closing the else ?>  
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
