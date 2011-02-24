<?php
include_once 'backoffice/html.php';
include_once 'backoffice/mysql.php';
include_once 'backoffice/db.php';
include_once 'backoffice/connect.php';

connect();   //connect to mysql DB

$id  = isset($_POST['id'])? $_POST['id']: "";
$id = CleanText($id);
// get customer email
	$customer = GetRecord("customers",$id);  // get data
	$email = $customer[4];  // get email

// Send confirmation mail to client
 	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: satorika@satorika.co.il' . "\r\n" .'Reply-To: satorika@satorika.co.il' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		
  	$subject = "סאטוריקה";		
	$mailcontent  = "אנו ב satorika מקפידים על איכות הפעילויות המוצעות ללקוחותינו. נודה לך באם תקדיש/י מעט מזמנך לספר לנו עד כמה היית מרוצה מהפעילות שהזמנת דרכנו. מילוי המשוב יעזור לנו לשמור על איכות הפעילויות גם בעתיד.";
	$mailcontent .="<br/>";
	$mailcontent .="<a href='www.satorika.co.il/survey.php'>השאלון<a>";
	mail($email, $subject, $mailcontent,$headers);
	
?>