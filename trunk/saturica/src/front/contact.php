<!DOCTYPE html>
<?php 

include_once 'functions.php';
include_once 'backoffice/connect.php';
include_once 'backoffice/mysql.php';		//change to the correct location ! 


connect();   //connect to mysql DB


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
SetupSearchInputRest();
SetupJqueryContactDialog();
?>
<title>סטוריקה - צור קשר</title>
</head>
<?php flush();?>
<body>

	<?php HeaderFunc("contact");?>
	
	<div id="contact_us_main">
	<div id = "contact_us_main_main">
		<div id="contact_us_main_title"> 
			<div id="contact_us_title">
                    צור קשר
        	</div>
        	<div id="contact_us_title_B">
                     ,אנחנו עומדים לשירותך בכל דרך: במייל, בטלפון או בפגישה אישית
                     <br/>.
                     כדי לעזור לכם למצוא את הפעילות המתאימה ביותר עבורכם&nbsp;
        	</div>
		</div>
		
		<div id="contact_us_details">
		
		<div id="contact_us_text">
					
		   <form action="search.php" method="get" id="contact_form">
			<div id="client_name_A">
			<input class="client_name_box" name="client_name_box" type="text" value="  " size="10" />
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
			<input class="company_name_box" name="company_name_box" type="text" value="  " size="10"/>
			</div>
			<span id="company_name">
            שם החברה
            </span>           

		    <div id="e_mail_contact_A">
			<input class="e_mail_contact_box" name="e_mail_contact_box" type="text" value="  " size="10"/>
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
			<input class="subject_contact_box" name="subject_contact_box" type="text" value="  " size="10"/>
			</div>
			<span id="subject_contact">
            נושא הפנייה
            </span> 
           

			<div id="msg_contact_A">
			<textarea class="msg_contact_box" name="msg_contact_box" rows="5" cols="5"> 
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
		
			<input class="approval_contact_box" name="approval_contact_box" type="checkbox" value="" size="20"/>
			
			<span id="approval_contact">
            מאשר את הצטרפותי למועדון הלקוחות של סאטוריקה וקבלת
             עידכונים תקופתיים
            </span>
            
            <div id="approval_contact_button" onclick="document.forms['wizard_form'].submit();">
            
            
            
            </form>
			</div>	
		</div>		
		<?php 
		// button with send , do requrired functions
		//<div id="wizard_find_button" onclick="document.forms['contact_form'].submit();">
		?>	
	</div>
	</div>

	
	<?php
	FooterFunc();
	DialogBoxHtml();
	?>
	 
</body>
</html>