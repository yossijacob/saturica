<!DOCTYPE html>
<?php 
include_once 'backoffice/mysql.php';	
include_once 'backoffice/connect.php';
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
SetupSearchInputRest();
?>
<title>סאטוריקה - אודות</title>

<?php GoogleAnalytics();?>
</head>
<?php flush();?>
<body>
	<?php HeaderFunc("whatwedo");?>
	<div id="about_wizard">
	<div id="about_wizard_main">
		<div id="about_main_title" dir="rtl">
			<div id="about_sat">
			אודות סאטוריקה
			</div> 
		
        	<div id="about_title">
        	<br/>
                     סאטוריקה גאה להציג את הדור הבא בעולם הסדנאות - שירות ייחודי המאפשר לכם לבחור סדנא, הרצאה או פעילות תוכן
                      <br/>
                      המתאימה לכם ביותר, במינימום זמן ומאמץ.
                     <br/> <br/>
                     במקום להתקשר בעצמכם למספר רב של חברות או יחידים, להסביר שוב ושוב את הדרישות והצרכים שלכם ולצלוח בשלום את מאמצי
                      <br/>                     
                      המכירה - סאטוריקה מציעה לכם גישה מהירה, נוחה וממוקדת לפעילויות שעונות בדיוק למאפיינים שהגדרתם.
                     <br/> <br/>
                     לרשותכם מאגר גדול ובלעדי של סדנאות, הרצאות ופעילויות העשרה איכותיות. כל פעילות נבדקה על ידינו באופן אישי , אומתה ביחס 
                     <br/>
                     לתוכנה המוצהר ונמצאה ראויה להיכנס למאגר המומלצים שלנו.
                      <br/> <br/>
                      מאחר שמטרתינו היא לחסוך לכם זמן ומשאבים בתהליך איתור הפעילות המתאימה לכם, אנו גובים את שכרנו אך ורק מספק הפעילות.
                      <br/>
                      המשמעות עבורכם היא שהזמנת פעילות באמצעות האתר אינה מייקרת את עלותה.
                      <br/> <br/>
                      עדיין לא מצאתם את הפעילות שחיפשתם ? יועץ ארגוני יסייע לכם באיתור הצרכים, הגדרת המטרות והתאמת הפעילות, בטלפון או  
                      <br/>
                       אצלכם במשרד. לחלופין, נשמח לבצע התאמות לדרישות ספציפיות לפעילות קיימת או ליצור עבורכם פעילות חדשה לחלוטין.   
        	</div>
		</div>
		
		<div id="about_second_title">
			<div id="about_title_second_text">
		  סאטוריקה הוקמה על-ידי לימור בר שלמה, בעלת תואר ראשון בכלכלה ומנהל
		    <br/>
            עסקים מאוניברסיטת חיפה.
             <br/> <br/>
            בוגרת המסלול הארבע שנתי של מכון אדלר ומנחת קבוצות הורים מוסמכת.
             <br/> <br/>
            מאמנת מוסמכת מטעם בית הספר למאמנים "שדות ישראל" - המרכז הישראלי לאימון.
             <br/> <br/>
            בעלת ניסיון רב בשיווק סדנאות ממוקדות ופיתוח סדנאות בהתאמה אישית 
            <br/>
            בדגש מיוחד על אימון חוויתי ושימוש בערוצי הקליטה השונים.
			<br/> <br/> <br/> . 
			 בזן-בודהיזם הוא הבזק של תובנה <span STYLE="font-weight: bold;">  - (Satori) "סאטורי"</span>
			<br/> <br/> <br/>
			אנחנו מזמינים אתכם להשתמש באתר כדי לאתר סדנאות והרצאות שכל אחת ואחת
			<br/>
			מהן תוכננה ועוצבה בדיוק למטרה זו - להעניק למשתתפים הבזק של תובנה, לעשות
			<br/> 
			עבורם הבדל ולהעניק משמעות חדשה שלא הייתה קיימת קודם.
			</div>
		</div>

	</div>	
	</div>

	<!-- <div id="bottom">
	</div> 
	-->
	
	<?php
	FooterFunc();
	?>
	
	<div id="preload" style="display:none;">
	   <img src="images/main_menu_homepage_hover.jpg" width="1" height="1" alt="Image01"/>
	   <img src="images/main_menu_whatwedo_hover.jpg" width="1" height="1" alt="Image02"/>
	   <img src="images/main_menu_recommended_hover.jpg" width="1" height="1" alt="Image03"/>
	   <img src="images/main_menu_customized_hover.jpg" width="1" height="1" alt="Image04"/>
	   <img src="images/main_menu_locations_hover.jpg" width="1" height="1" alt="Image05"/>
	   <img src="images/main_menu_gallery_hover.jpg" width="1" height="1" alt="Image06"/>
	   <img src="images/main_menu_blog_hover.jpg" width="1" height="1" alt="Image07"/>
	   <img src="images/main_menu_contact_hover.jpg" width="1" height="1" alt="Image08"/>
	</div>
</body>
</html>