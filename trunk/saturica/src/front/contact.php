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
SetupJquery();
SetupJqueryContactDialog();
?>
<title>סטוריקה - צור קשר</title>
</head>
<body>

<div id="dialog-form" title="קבל הצעה" dir="rtl"> 
	<p class="validateTips">כל השדות הם חובה</p> 
 
	<form id="get_offer" name="get_offer" method="post" action="getoffer.php"> 
	<fieldset> 
		<label for="name">שם</label> 
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" /> 
		<label for="email">דוא"ל</label> 
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" /> 
		<label for="password">טלפון</label> 
		<input type="text" name="phone" id="phone" value="" class="text ui-widget-content ui-corner-all" />
		<label for="password">תוכן</label> 
		<textarea rows="4" cols="48" name="content" id="content" value="" class="text ui-widget-content ui-corner-all"></textarea>
	</fieldset> 
	<!--  <input type='submit' style=display:none>-->
	<!-- <input type="submit" value="קבל הצעה"/> -->
	</form> 
</div> 

	
	<?php HeaderFunc("contact");?>
	<div id="contact_us_main">
	
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
			<input class="client_name_box" name="client_name_box" type="text" value="" size="10"/>
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
			<input class="company_name_box" name="company_name_box" type="text" value="" size="10"/>
			</div>
			<span id="company_name">
            שם החברה
            </span>           
			


		    <div id="e_mail_contact_A">
			<input class="e_mail_contact_box" name="e_mail_contact_box" type="text" value="" size="10"/>
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
			<input class="subject_contact_box" name="subject_contact_box" type="text" value="" size="10"/>
			</div>
			<span id="subject_contact">
            נושא הפנייה
            </span> 
           

			<div id="msg_contact_A">
			<input class="msg_contact_box" name="msg_contact_box" type="text" value="" size="30"/>
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




			</div>
			
			
			
			

		</div>
		
		
		
		
		
		
	</div>
	
	
	

	<div id="bottom">
	</div>
	
	<?php
	FooterFunc();
	?>
</body>
</html>