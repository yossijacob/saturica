<!DOCTYPE html>
<?php 
include_once 'functions.php';

?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
if(CheckIfIE()) 
	{
		?>
		<link rel="stylesheet" href="IEstyle.css" type="text/css" />
		<?php 
	} 
SetupJqueryContactDialogCss();
SetupJquery();
SetupJqueryContactDialog();
SetupSearchInputRest();
?>

<title>סאטוריקה - צור קשר</title>
<?php GoogleAnalytics();?>
</head>
<?php flush();?>
<body>

	<?php HeaderFunc("contact");?>
	
	
	<?php 
	$flag = 0;
	
		$name  = isset($_POST['name'])? $_POST['name']: "";
	//  $name = CleanText($name);
	  $phone = isset($_POST['phone'])? $_POST['phone']: "";
	 // $phone = CleanText($phone);
	  $email = isset($_POST['email'])? $_POST['email']: "";
	//  $email = CleanText($email);
	  $company = isset($_POST['company'])? $_POST['company']: "";
	 // $company = CleanText($company);
	 $subject = isset($_POST['subject'])? $_POST['subject']: "";
	  
	  $content = isset($_POST['content'])? $_POST['content']: "";
	 // $comments = CleanText($comments);
	 $approval_contact = isset($_POST['approval_contact_box'])? $_POST['approval_contact_box']: "";
	
	
	if ( ($name != "") && ($email != "") && ($content != "") )
		{  
		?>
		<script type="text/javascript" language="javascript">
   			window.location = "getoffer.php?name=<?php echo $name?>&phone=<?php echo $phone?>&email=<?php echo $email?>&company=<?php echo $company ?>&subject=<?php echo $subject ?>&content=<?php echo $content?>&approval_contact=<?php echo $approval_contact ?>";
   			</script>
	
	<?php 
		}
		if ( ($name != "") || ($email != "") || ($content != "") ) //some details missing
		$flag = 1;   // print line details missing
	?>
	
	
	
	<div id="contact_us_main">
	<div id = "contact_us_main_main" dir="rtl">
		<div id="contact_us_main_title"> 
			<div id="contact_us_title">
                    צור קשר
                    <?php  if ($flag == 1) echo "<span style='color:red;'>- נא למלא את כל הפרטים המסומנים כחובה לפני השליחה ! </span>"; ?>
        	</div>
        	<div id="contact_us_title_B">
                     אנחנו עומדים לשירותך בכל דרך: במייל, בטלפון או בפגישה אישית,
                     <br/>
                      כדי לעזור לכם למצוא את הפעילות המתאימה ביותר עבורכם.                    
                      
        	</div>
		</div>
		
		<div id="contact_us_details">
		
		<div id="contact_us_text">
					
		   <form action="contact.php" method="post" id="contact_form">
			<div id="client_name_A">
			<input class="client_name_box" name="name" type="text" value='<?php echo $name?>' size="10" />
			</div>
			<span id="client_name">
            שם הפונה
            </span>
             
             <span id="text_must_insert">
	              
	            <br/>(
	                    חובה
	                    ) 
             </span>
                                              
            <div id="company_name_A">
			<input class="company_name_box" name="company" type="text" value='<?php echo $company?>' size="10"/>
			</div>
			<span id="company_name">
            שם החברה
            </span>           

		    <div id="e_mail_contact_A">
			<input class="e_mail_contact_box" name="email" type="text" value='<?php echo $email?>' size="10"/>
			</div>
			<span id="e_mail_contact">
            כתובת דוא"ל
            </span>    

		   <span id="text_must_insert_email"> 
	        <br/>(
	         חובה
	         ) 
           </span>
      
           
            <div id="subject_contact_A">
			<input class="subject_contact_box" name="subject" type="text" value='<?php echo $subject?>' size="10"/>
			</div>
			<span id="subject_contact">
            נושא הפנייה
            </span> 
           

			<div id="msg_contact_A">
			<textarea class="msg_contact_box" name="content" rows="5" cols="5"> <?php echo $content ?>
			 </textarea>
			</div>
			
			<span id="msg_contact">
            תוכן הפנייה
            </span> 

		   <span id="text_must_insert_msg"> 
	        <br/>(
	         חובה
	         ) 
           </span>
		
			<input class="approval_contact_box" name="approval_contact_box" type="checkbox" value="on" size="20" checked/>
			
			<span id="approval_contact">
            מאשר את הצטרפותי למועדון הלקוחות של סאטוריקה וקבלת
             עידכונים תקופתיים
            </span>
            
            <div id="approval_contact_button" onclick="document.forms['contact_form'].submit();"></div>
            </form>
			</div>	
		</div>		
	</div>
	</div>
	<?php
	//DialogBoxHtml();
	FooterFunc();
	?>
</body>
</html>