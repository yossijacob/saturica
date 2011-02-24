<?php 
include_once 'backoffice/html.php';
include_once 'backoffice/mysql.php';
include_once 'backoffice/db.php';
include_once 'backoffice/connect.php';

connect();   //connect to mysql DB

  $approval_contact = isset($_POST['approval_contact_box'])? $_POST['approval_contact_box']: "";
  
  if ($approval_contact == "on")
  {		// add the customer to our database
	  $name  = isset($_POST['name'])? $_POST['name']: "";
	  $name = CleanText($name);
	  /*$phone = isset($_POST['phone'])? $_POST['phone']: "";
	  $phone = CleanText($phone);*/
	  $_subject = isset($_POST['subject'])? $_POST['subject']: "";
	  $_subject= CleanText($_subject);
	  $email = isset($_POST['email'])? $_POST['email']: "";
	  $email = CleanText($email);
	  $company = isset($_POST['company'])? $_POST['company']: "";
	  $company = CleanText($company);
	  $content = isset($_POST['content'])? $_POST['content']: "";
	  $content = CleanText($content);
	  /*$comments = isset($_POST['comments'])? $_POST['comments']: "";
	  $comments = CleanText($comments);*/
	  
	  $data[0] = $name;
  	  $data[1] = $company;
  	  $data[2] = "";
  	  $data[3] = $email;
  	  $data[4] = "";
  	  $data[5] = time();  // join date
  	  $data[6] = "כן";   // active
  	  $data[7] = "לא";  // sent feedback
  			  			
  	  $customer_id = AddRecord("customers", $data);     			// add the customer
  }

 	// Send confirmation mail to client
 	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: satorika@satorika.co.il' . "\r\n" .'Reply-To: satorika@satorika.co.il' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		
  	$subject = "סאטוריקה";		
	$mailcontent  = "פנייתך התקבלה ותטופל בהקדם";
	mail($email, $subject, $mailcontent,$headers);
	
	// get manager email
	$preferences = GetRecord("preferences",1);  // get data
	$manager_email = $preferences[1];

	$subject = $_subject." - סאטוריקה";	
		
	$mailcontent  = "התקבלה פנייה:";
	$mailcontent  .= "<br/>";
	$mailcontent  .= "שם: ".$name;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "נושא: ".$_subject;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "חברה: ".$company;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "אימייל: ".$email ;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "תוכן: ".$content ;
	mail($manager_email, $subject, $mailcontent,$headers);
  
	header('Location:thankyou.php');
?>