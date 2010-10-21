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
<title>הוסף לקוח</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php 
		MenuBar('customers'); 
	?>
    
	
<div id="content">
    <br/>
    <h1>הוספת לקוח חדש</h1>
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
  			echo "<b>חסרים הפרטים הבאים:</b>";
  			echo "<h4>".$miss_msg."</h4>";	
  		}	
  	
	if ($miss != true)
  		{		// the form was validated successfully now we process the form
  			$data[0] = $name;
  			$data[1] = $company;
  			$data[2] = $phone;
  			$data[3] = $email;
  			$data[4] = $comments;
  			$data[5] = time();  // join date
  			$data[6] = "yes";   // active
  			$data[7] = "no";  // sent feedback
  			  			
  			$customer_id = AddRecord("customers", $data);     			// add the customer

  			//$dont_show_form = true;
	  		//echo "<h3>Broker Have Been Added</h3>";
  			//echo "<br/>";
  			header('Location:customers.php');
  		}
  	
  	}  // close if submitted 

  if ($dont_show_form == false)
  {
 			
?>
	<br/>
	<div id="add_customer_div" dir="rtl">
	<form name="add_customer_form" id="add_customer_form" method="post" action="addcustomer.php">
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
	
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.add_customer_form.submit();">הוסף לקוח<span/></div>
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
