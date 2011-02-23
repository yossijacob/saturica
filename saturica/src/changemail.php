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
<title>שנה מייל</title>
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
    <h1>שינוי מייל</h1>
    <hr></hr>
    <div id="left_menu">
    	<a href="preferences.php" style="float:right;" class="icon_button"><span class="back">חזור להגדרות</span></a>
    	<br/>
    	
	</div>	
    
  <?php
  
  
  $new_mail = isset($_POST['new_mail']) ? $_POST['new_mail']: "";
  $new_mail = CleanText($new_mail);
  

  $preferences = GetRecord("preferences",1);  // get data
  
  $user =  $preferences[2];
  $password = $preferences[3];
  $cap =   $preferences[4];
  
  $old_email = $preferences[1];  // for displying the old mail

  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";
  	$name_exist = "";
  	
  	echo "<br/>";
  	echo "<FONT COLOR='RED'>$old_email</FONT> המייל הנוכחי שלך הוא";
  	echo "<br/>";
  	echo "<br/>";
  	echo  "אם ברצונך לשנותו, אנא הכנס מייל חדש ולחץ על שמור";
  	echo "<br/>";
  	
  	
  	if (isset($_POST['submitted']))
  	{
  	
  	if ($new_mail == "") 
  		{
  			$miss = true;
  			$missing['old_pass'] = "לא הוכנסה כתובת מייל";
  		}
  	else if (!isemail($new_mail))
  		{
  			$miss = true;
  			$missing['new_mail'] = "דואר אלקטרוני לא תקין";
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
  			
  			
  			$data[0] = $new_mail;
  			$data[1] = $user;
  			$data[2] = $password;
  			$data[3] = $cap;
  			
  			
  			EditRecord("preferences",1, $data);     			// edit the email
  			?>
  			<script type="text/javascript" language="javascript">
   			window.location = 'changemail.php';
   			</script>
 			<?php 	//header('Location:preferences.php');
	
  		}
  	
  	}  // close if submitted 

 // if not submitted then get data
  	
  	$email  = $preferences[1];
  	$user = $preferences[2];
  	$cap = $preferences[3];
  	$password = $preferences[4];
  	
  
?>
	<br/>
	<div id="add_email_div" dir="rtl">
	<form name="edit_email_form" id="edit_email_form" method="post" action="changemail.php">
	<?php echo "<input type='hidden' name='id' value=1/>"; ?>
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>כתובת מייל חדשה</b></td>
	 <?php 	
	 echo "<td><input type='text' size='50' name='new_mail' value='$new_mail' title='new email'/></td>";
	 ?>
	 </tr>
	 
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.edit_email_form.submit();">שמור<span/></div>
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