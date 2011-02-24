<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

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
	$mailcontent .="<h1>שלום</h1>";
  	$mailcontent .="<br/>";
  	$mailcontent  .= "אנו ב satorika מקפידים על איכות הפעילויות המוצעות ללקוחותינו. נודה לך באם תקדיש/י מעט מזמנך לספר לנו עד כמה היית מרוצה מהפעילות שהזמנת דרכנו. מילוי המשוב יעזור לנו לשמור על איכות הפעילויות גם בעתיד.";
	$mailcontent .="<br/>";
	$mailcontent .="<h2><a href='www.satorika.co.il/survey.php'>השאלון<a><h2>";
	mail($email, $subject, $mailcontent,$headers);
	
	echo "<br/><br/>";
	echo "<h2>הזמנת משוב נשלחה בהצלחה</h2>";
	echo "<a href='customers.php'>חזור לעמוד הלקוחות</a>";
	
?>