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
	  $email = isset($_POST['email'])? $_POST['email']: "";
	  $email = CleanText($email);
	  $company = isset($_POST['company'])? $_POST['company']: "";
	  $company = CleanText($company);
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


?>