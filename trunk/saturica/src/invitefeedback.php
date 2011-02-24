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
  	$mailcontent .="<br/><h2>";
  	$mailcontent  .= "אנו ב סאטוריקה מקפידים על איכות הפעילויות המוצעות ללקוחותינו.";
	$mailcontent .="<br/>";
	$mailcontent .=" נודה לך באם תקדיש/י מעט מזמנך לספר לנו עד כמה היית מרוצה מהפעילות שהזמנת דרכנו. מילוי המשוב יעזור לנו לשמור על איכות הפעילויות גם בעתיד.";
  	$mailcontent .="</h2><br/>";
	$mailcontent .="<h2><a href='www.satorika.co.il/survey.php'>השאלון<a><h2>";
	mail($email, $subject, $mailcontent,$headers);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ערוך מיקום</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br/><br/>
	<div id='centerdiv'>
	<h2>הזמנת משוב נשלחה בהצלחה</h2>
	<a href='customers.php'>חזור לעמוד הלקוחות</a>
	</div>
</body>	
