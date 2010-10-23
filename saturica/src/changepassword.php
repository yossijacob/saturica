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
<title>שנה ססמא</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php 
		MenuBar('preferences'); 
	?>
    
	
<div id="content">
    <br/>
    <h1>שינוי ססמא</h1>
    <hr></hr>
    <div id="left_menu">
    	<a href="preferences.php" style="float:right;" class="icon_button"><span class="back">חזור להגדרות</span></a>
    	<br/>
    	
	</div>	
    
  <?php
  
  
  $old_pass = isset($_POST['old_pass']) ? $_POST['old_pass']: "";
  $old_pass = CleanText($old_pass);
  $new_pass_1  = isset($_POST['new_pass_1'])? $_POST['new_pass_1']: "";
  $new_pass_1 = CleanText($new_pass_1);
  $new_pass_2  = isset($_POST['new_pass_2'])? $_POST['new_pass_2']: "";
  $new_pass_2 = CleanText($new_pass_2);

  $preferences = GetRecord("preferences",1);  // get data
  $email = $preferences[1];  // mail remains the same
  $user =  $preferences[2];
  $cap =   $preferences[4];
  $old = $preferences[3];

  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";
  	$name_exist = "";
  	
  	
  	if (isset($_POST['submitted']))
  	{
  	
  	if ($old_pass == "") 
  		{
  			$miss = true;
  			$missing['old_pass'] = "חסרה ססמא נוכחית";
  		}
  	else
  		{
  		if ($old != $old_pass) 
  	
  		{
  			$miss = true;
  			$missing['old_pass'] = "ססמא נוכחית לא נכונה";			
  		}
  		else {
  			if ($new_pass_1 == "") 	{
  			$miss = true;
  			$missing['new_pass_1'] = "לא הוכנסה ססמא חדשה";
  			}
  			else {
  				if ($new_pass_2 == "") 
  				{
  					$miss = true;
  					$missing['new_pass_2'] = "הססמא החדשה לא הוקלדה באופן נכון";
  				}
  				else 
  				if (!($new_pass_1 == "") && !($new_pass_2 == "") && !($new_pass_1 == $new_pass_2))
  				{
  				$miss = true;
  				$missing['new_pass_1'] = "הססמא החדשה שנבחרה אינה זהה בשתי ההקלדות.";
  				}
  			}
  	  	}
  	}
  	
  	if ($miss == true)
  		{
  			$miss_msg = implode(",",$missing);
  			echo "<br/>";
  			echo "<b>:התרחשה שגיאה בפרטים הבאים</b>";
  			echo "<h4>".$miss_msg."</h4>";	
  		}	
  	
	if ($miss != true)
  		{		// the form was validated successfully now we process the form
  			
  			
  			$data[0] = $email;
  			$data[1] = $user;
  			$data[2] = $new_pass_1;
  			$data[3] = $cap;
  			
  			
  			EditRecord("preferences",1, $data);     			// 
 			header('Location:preferences.php');

  		}
  	
  	}  // close if submitted 

 // if not submitted then get data
  	
  	$email  = $preferences[1];
  	$user = $preferences[2];
  	$cap = $preferences[3];
  	$password = $preferences[4];
  	
  
?>
	<br/>
	<div id="add_password_div" dir="rtl">
	<form name="edit_password_form" id="edit_password_form" method="post" action="changepassword.php">
	<?php echo "<input type='hidden' name='id' value=1/>"; ?>
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>ססמא נוכחית</b></td>
	 <?php 	
	 echo "<td><input type='text' name='old_pass' value='$old_pass' title='old password'/></td>";
	 ?>
	 </tr>
	 <tr>
	 	<td><b>ססמא חדשה</b></td>
	 <?php echo "<td><input type='text' name='new_pass_1' value='$new_pass_1' title='new password1'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>הקש שוב ססמא חדשה</b></td>
	 <?php echo "<td><input type='text' name='new_pass_2' value='$new_pass_2' title='new password2'/></td>";?>
	 </tr>
	 
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.edit_password_form.submit();">שמור<span/></div>
		<!-- <a class="green_ovalbutton" href="javascript:document.add_broker_form.submit();"><span>Add broker</span></a> -->
  	</div>
	</form>
	</div>
 
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>