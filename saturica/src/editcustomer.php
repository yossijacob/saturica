<?php 
session_start();
if (!is_authenticated()) 
	header("Location:login.php");
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ערוך לקוח</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>

</head>
<body>
	<?php 
		MenuBar('customers'); 
	?>
    
<div id="content">
    <br/>
    <h1>עריכת פרטי לקוח </h1>
    <hr></hr>
    <div id="left_menu">
    	<a href="customers.php" style="float:right;" class="icon_button"><span class="back">חזור לרשימת לקוחות</span></a>
    	<br/>
    	
	</div>	
    
  <?php
  
  $name  = isset($_POST['name'])? $_POST['name']: "";
  $name = CleanText($name);
  $phone = isset($_POST['phone'])? $_POST['phone']: "";
  $phone = CleanText($phone);
  $email = isset($_POST['email'])? $_POST['email']: "";
  $email = CleanText($email);
  $company = isset($_POST['company'])? $_POST['company']: "";
  $company = CleanText($company);
  $comments = isset($_POST['comments'])? $_POST['comments']: "";
  $comments = CleanText($comments);
  $active = isset($_POST['active'])? $_POST['active']: "";
  $active = CleanText($active);
  $sent_feedback = isset($_POST['sent_feedback'])? $_POST['sent_feedback']: "";
  $sent_feedback = CleanText($sent_feedback);
  
  $id  = isset($_POST['id'])? $_POST['id']: "";
  $id = CleanText($id);
  if ($id == "") header('Location:customers.php'); // if no id then go back
  
  $customer = GetRecord("customers",$id);  // get data
  $time_joined = $customer[6];  // time cant be altered

  $dont_show_form = false;
  $miss = false;
  $missing = "";
  
  	
  	if (isset($_POST['submitted']))  // if form was submitted then check and process it
  	{
  	
  	if ($phone == "") 
  		{
  			$miss = true;
  			$missing['phone'] = "טלפון";
  		}
  	if ($name == "") 
  		{
  			$miss = true;
  			$missing['name'] = "שם";
  		}
  	if ($email == "") 
  		{
  			$miss = true;
  			$missing['email'] = "דואר אלקטרוני";
  		}
  	else if (!isemail($email))
  		{
  			$miss = true;
  			$missing['email'] = "דואר אלקטרוני לא תקין";
  		}
  	
  	if ($miss== true)
  		{
  			$miss_msg = implode(",",$missing);
  			echo "<br/>";
  			echo "<b>:חסרים הפרטים הבאים</b>";
  			echo "<h4>".$miss_msg."</h4>";	
  		}	
  
  	
	if ($miss != true)
  		{		// the form was validated successfully now we process the form
  			$data[0] = $name;
  			$data[1] = $company;
  			$data[2] = $phone;
  			$data[3] = $email;
  			$data[4] = $comments;
  			$data[5] = $time_joined;  // join date
  			$data[6] = $active;   // active
  			$data[7] = $sent_feedback;  // sent feedback
  			
  			EditRecord("customers",$id, $data);     			// add the customer

  			header('Location:customers.php');
  		}
  	
  	}  // close if submitted 
// if not submitted then get data
  	
  	$name  = $customer[1];
  	$company = $customer[2];
  	$phone = $customer[3];
  	$email = $customer[4];
  	$comments = $customer[5];
  	$active = $customer[7];
  	$sent_feedback = $customer[8];
  	
  	$yesno[0] = "כן";		// for the active and send_feedback dropdown boxes
	$yesno[1] = "לא";
 		
?>
	<br/>
	<div id="add_customer_div" dir="rtl">
	<form name="edit_customer_form" id="edit_customer_form" method="post" action="editcustomer.php">
	<?php echo "<input type='hidden' name='id' value='$id'/>"; ?>
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>שם</b></td>
	 <?php 	
	 echo "<td><input type='text' name='name' value='$name' title='name of customer'/></td>";
	 ?>
	 </tr>
	 <tr>
	 	<td><b>טלפון</b></td>
	 <?php echo "<td><input type='text' name='phone' value='$phone' title='phone'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>דואר אלקטרוני</b></td>
	 <?php echo "<td><input type='text' name='email' value='$email' title='email for contacting customer'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>חברה</b></td>
	 <?php 	echo "<td><input type='text' name='company' value='$company' title='company'/></td>"; ?>
	 	
	 </tr>
	 <tr>
	 	<td><b>הערות</b></td>
	 <?php echo "<td><input type='text' name='comments' value='$comments' /></td>";?>
	 </tr>
	 <tr>
	 	<td>האם פעיל</td>
	 	<td>
	 	<?php 
	 	ShowDropDown("active",$yesno,$yesno,"","",$active);
	 	?>
	 	</td>
	 </tr>
	 <tr>
	 	<td>האם שלח משוב</td>
	 	<td>
	 	<?php 
	 	ShowDropDown("sent_feedback",$yesno,$yesno,"","",$sent_feedback);
	 	?>
	 	</td>
	 </tr>
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.edit_customer_form.submit();">שמור<span/></div>
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
