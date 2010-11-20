<?php
		include_once 'connect.php';
		include_once 'html.php';
		include_once 'mysql.php';
		include_once 'db.php';
		
		session_start();

		$fileName = "letter.html";
		$emails = "";
		$emailmsg = "";

		// exporting newsletter file
		if ((isset($_GET['pending'])) && ($_GET['pending'] =="export" ))
		{					// exporiting the newsletter file
			header("Location:saveas.php?filename=$fileName");
		}
		else if ((isset($_GET['pending'])) && ($_GET['pending'] =="savenewsletter" ))
		{   // save changes to current newletter
			$filedata = $_POST['editor1']; // get data from editor
			$fileHandle = fopen($fileName, 'w+') or die("can't open file"); // open file
			fwrite($fileHandle,$_POST['editor1']); // write
			echo "הקובץ נשמר בהצלחה";
		}
		else if ((isset($_GET['pending'])) && ($_GET['pending'] =="import" ))
		{   // import newsletter file
			$target_path = $fileName;
			UploadFile( $_FILES['picture']['name'],$_FILES['picture']['tmp_name'],$target_path);
		}
		else 
		{	//send newsletter to all customers
			$fileHandle = fopen($fileName, 'r+') or die("can't open file");
			$filesize = filesize($fileName);
			if ($filesize)
				{
				$filedata = fread($fileHandle, $filesize);
				}
			else
				{
				$filedata = "";
				}
		}
		fclose($fileHandle);
		
		// send mails
		if ((isset($_POST['send'])) && ($_POST['send'] =="true" ))
		{
			connect();
			$subject  = isset($_POST['subject'])? $_POST['subject']: "";  /// get the subject
  			$subject = CleanText($subject);
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Dispatch@ufaservices.com' . "\r\n" .'Reply-To: Dispatch@ufaservices.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
			
			$emails = GetColumn("customers",4);
			$names = GetColumn("customers",1);
			$index=0;
			$count=0;
			foreach ($emails as $email)
			{
				$mailcontent  = str_replace  ( "[name]"  ,  $names[$index]  ,  $filedata ); // get personal mail
				if (mail($email, $subject, $mailcontent,$headers)) 
				{
					$count++;
				}	 
				$index++;
			}
			$emailmsg ="לקוחות ".$count ."הניוזלטר נשלח בהצלחה ל";
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">	    
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ניוזלטר</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/ckeditor/ckeditor.js"></script>

</head>
<body>
	
	<?php
		if (!is_authenticated()) 
			header("Location:login.php"); 
		MenuBar('newsletter'); 
	?>
    
<div id="content" dir="rtl">
	    <br/>
	    <h1>ניוזלטר</h1>
	    <hr></hr>
	    <br/>
	    כאן ניתן לערוך לשמור ולשלוח עמוד לכל הלקוחות
	    <br/>
	    <br/>
	    <?php 
	    	echo $emailmsg;
	    ?>
	    <br/>
	   
	    <h2>ערוך מכתב</h2>
		<hr></hr>
		<br/>
		ניתן להחדיר את שם הלקוח לתוך הטקסט על ידי שימוש בתווית מיוחדת
	   
	    [name] - יוחלף על ידי שם הלקוח
	    <br/>
	    <form name="save_newsletter_form" id="save_newsletter_form" method="post" action="newsletter.php?pending=savenewsletter">
	    <label for="editor1"></label><br />
		<?php echo "<textarea cols='80' id='editor1' name='editor1' rows='10'>$filedata</textarea>";?>
		<script type="text/javascript">
		/*<![CDATA[*/
		CKEDITOR.replace( 'editor1',{fullPage : true});
		/*]]>*/
		</script>
		<br/>
		<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.save_newsletter_form.submit();">שמור שינויים<span/></div>
		</div>
		</form>
		<br/>
		<br/>
		
		<form name="send_newsletter_form" id="send_newsletter_form" method="post" action="newsletter.php">
		<input type="hidden" name="send" value="true"/>
		<h2>שליחת דואר</h2>
		<hr></hr>	   
	    <br/>
	    <table cellspacing='10'>
	    <tr>
	    <td>נושא הדואר</td>
	    <td><input type="text" size='120' name="subject" value=""/></td>
	    </tr>
	    </table>
	    <div class="centered_button_div"> 
	    <div id="shiny-demo-blue" class="demo-button" onclick="javascript:document.send_newsletter_form.submit();">שלח דואר לכל הלקוחות<span/></div>
		</div>
		</form>
		<br/>
		
		<form name="export_newsletter_form" id="export_newsletter_form" method="post" action="newsletter.php?pending=export">
		<h2>יצוא הניוזלטר</h2>
		<hr></hr>
		<div class="centered_button_div">
	    <div id="shiny-demo-blue" class="demo-button" onclick="javascript:document.export_newsletter_form.submit();">שמור ניוזלטר למחשבך<span/></div>
	    </form>
	    <br/>
	    ייצא את הקובץ למחשבך
	    </div>
	    <br/>
	    <br/>
	    
	    <form name="import_newsletter_form" id="import_newsletter_form" method="post" action="newsletter.php?pending=import">
	    <h2>יבוא ניוזלטר</h2>
	    <hr></hr>
	    לחץ על 
	    choose file לבחירת קובץ
	    ואז לחץ על "טען ניוזלטר ממחשבך" על מנת לבצע 
	    <div class="framed_centered_button_div"> 
	  	<div id="shiny-demo-red" class="demo-button" onclick="javascript:document.import_newsletter_form.submit();">טען ניוזלטר ממחשבך<span/></div>
	  	&nbsp &nbsp &nbsp &nbsp
	  	<input type="file"  name="loadnewsletter"/>
	    </div>
	    
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
