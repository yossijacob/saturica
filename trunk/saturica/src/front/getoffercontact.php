<?php 
include_once 'backoffice/html.php';
include_once 'backoffice/mysql.php';
include_once 'backoffice/db.php';
include_once 'backoffice/connect.php';

connect();   //connect to mysql DB

  $approval_contact = isset($_POST['approval_contact_box'])? $_POST['approval_contact_box']: "";
  
  if ($approval_contact == "on")
  {		// add the customer to our database
	  $client_name_box  = isset($_POST['client_name_box'])? $_POST['client_name_box']: "";
	  $client_name_box = CleanText($client_name_box);
	  /*$phone = isset($_POST['phone'])? $_POST['phone']: "";
	  $phone = CleanText($phone);*/
	  $_subject = isset($_POST['subject_contact_box'])? $_POST['subject_contact_box']: "";
	  $_subject= CleanText($_subject);
	  $e_mail_contact_box = isset($_POST['e_mail_contact_box'])? $_POST['e_mail_contact_box']: "";
	  $e_mail_contact_box = CleanText($e_mail_contact_box);
	  $company_name_box = isset($_POST['company_name_box'])? $_POST['company_name_box']: "";
	  $company_name_box = CleanText($company_name_box);
	  $msg_contact_box = isset($_POST['msg_contact_box'])? $_POST['msg_contact_box']: "";
	  $msg_contact_box = CleanText($msg_contact_box);
	  /*$comments = isset($_POST['comments'])? $_POST['comments']: "";
	  $comments = CleanText($comments);*/
	  
	  $data[0] = $client_name_box;
  	  $data[1] = $company_name_box;
  	  $data[2] = "";
  	  $data[3] = $e_mail_contact_box;
  	  $data[4] = "";
  	  $data[5] = time();  // join date
  	  $data[6] = "כן";   // active
  	  $data[7] = "לא";  // sent feedback
  			  			
  	  $customer_id = AddRecord("customers", $data);     			// add the customer
  }

 	// Send confirmation mail to client
 	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: satorika@satorika.com' . "\r\n" .'Reply-To: satorika@satorika.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		
  	$subject = "סאטוריקה";		
	$mailcontent  = "פנייתך התקבלה ותטופל בהקדם";
	mail($e_mail_contact_box, $subject, $mailcontent,$headers);
	
	// get manager email
	$preferences = GetRecord("preferences",1);  // get data
	$manager_email = $preferences[1];

	$subject = $_subject." - סאטוריקה";	
		
	$mailcontent  = "התקבלה פנייה:";
	$mailcontent  .= "<br/>";
	$mailcontent  .= "שם: ".$client_name_box;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "נושא: ".$_subject;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "חברה: ".$company_name_box;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "אימייל: ".$e_mail_contact_box ;
	$mailcontent  .= "<br/>";
	$mailcontent  .= "תוכן: ".$msg_contact_box ;
	mail($manager_email, $subject, $mailcontent,$headers);
  
	header('Location:thankyou.php');
?>