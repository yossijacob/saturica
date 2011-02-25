<!DOCTYPE html>
<?php 
include_once 'functions.php';
include_once 'getposts.php';
include_once 'backoffice/connect.php';
include_once 'backoffice/mysql.php';

connect();   //connect to mysql DB

$first_workshop_id = GetRecord('recommendeds',1);	//get id of the recommended workshop 
$first_workshop = GetRecord('workshops',$first_workshop_id[1]); //get the workshop

$second_workshop_id = GetRecord('recommendeds',2); 
$second_workshop = GetRecord('workshops',$second_workshop_id[1]); //get the workshop

$third_workshop_id = GetRecord('recommendeds',3); 
$third_workshop = GetRecord('workshops',$third_workshop_id[1]); //get the workshop

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
<script type="text/javascript" language="javascript">
    var hide = false;
    function show_dropdown(id) 
    {
        if (!hide) document.getElementById(id).style.visibility = "visible";  // dd_list
        hide = false;
        //document.getElementById("dd_text").value=121;
    }
    function downkey()
    {

    }

    function setText(text_id,list_id, val) 
    {
        hide = true;
        hide_list(list_id);
        document.getElementById(text_id).value = val;    // dd_text

    }
    function hide_list(id) 
    {
        document.getElementById(id).style.visibility = "hidden";  // dd_list
    }
</script>
<title>סטוריקה</title>
</head>
<?php flush();?>
<body>
	<?php  HeaderFunc("home"); ?>
	
	
	<div id="search_wizard">
        <div id="search_wizard_main">
        
        <div id="search_wizard_content">
            <ul>
                <li>
                    <div id="wizard_slogen">
                    </div>
                </li>
                <li>
                    <div id="wizard">
                        
                       <form action="search.php" method="get" id="wizard_form">
			            <span class="questions" id="whattodo_Question">
                            ? מה רוצים לעשות
                        </span>
			               <div id="whattodo" class="dropdown"  onclick="show_dropdown('whattodo_ddlist')" >
                                <input id="whattodo_ddtext" class="dd_text" name="whatodo_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="whattodo_ddlist" class="dd_list" onmousemove="show_dropdown('whattodo_ddlist')" onmouseout="hide_list('whattodo_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','גיבוש ועבודת צוות');">
		                                גיבוש ועבודת צוות</a>
		                                </div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','פיתוח מנהלים');">
		                                פיתוח מנהלים</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','פיתוח עובדים');">
		                                פיתוח עובדים</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','הרצאות');">
		                                הרצאות</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','פעילות מיוחדת למורים');">
		                                פעילות מיוחדת למורים</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','מפגש העשרה חוויתי');">
		                                מפגש העשרה חוויתי</a></div>
	                                </div>
                                </div>
                            </div>

                        <span class="questions" id="howmany_Question">
                            ? כמה משתתפים
                        </span>
			            <div id="howmany">
                            <input class="howmany_text" name="howmany_text" type="text" value="" size="10"/>
                        </div>    
                   
			            <div id="resset">
                            <input class="Result_Set" name="Result_Set" type="text" value="0" style="display:none;"/>
                        </div>  

                        	<input class="Free_search" name="Free_search" type="hidden" value="0" />
                        
                        <span class="questions" id="where_Question">
                            ? היכן רוצים את הפעילות
                        </span>
			               <div id="where" class="dropdown"  onclick="show_dropdown('where_ddlist')" >
                                <input id="where_ddtext" class="dd_text" name="where_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="where_ddlist" class="dd_list" onmousemove="show_dropdown('where_ddlist')" onmouseout="hide_list('where_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','במבנה ממוזג\\מחומם');">
		                                 במבנה ממוזג\מחומם</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','אצלנו בארגון');">
		                                אצלנו בארגון</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','מחוץ לעבודה, במקום מיוחד');">
		                                מחוץ לעבודה, במקום מיוחד</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','ליד הבריכה');">
		                                ליד הבריכה</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','על חוף הים');">
		                                על חוף הים</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','נעבור ממקום למקום');">
		                                נעבור ממקום למקום</a></div>
	                                </div>
                                </div>
                            </div>

                        <span class="questions" id="howlong_Question">
                            ? כמה זמן
                        </span>
			               <div id="howlong" class="dropdown"  onclick="show_dropdown('howlong_ddlist')" >
                                <input id="howlong_ddtext" class="dd_text" name="howlong_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="howlong_ddlist" class="dd_list" onmousemove="show_dropdown('howlong_ddlist')" onmouseout="hide_list('howlong_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','קצר, מקסימום 3 שעות');">
		                                פעילות קצרה, מקסימום 3 שעות</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','חצי יום');">
		                                חצי יום</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','יום מלא');">
		                                יום מלא</a></div>
		                                <!-- <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','ערב');">
		                                ערב</a></div> -->
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','יותר מיום אחד');">
		                                יותר מיום אחד</a></div>
	                                </div>
                                </div>
                            </div>
                          
                        <span class="questions" id="whatbudget_Question">
                            ? מה התקציב למשתתף
                        </span> 
			               <div id="whatbudget" class="dropdown"  onclick="show_dropdown('whatbudget_ddlist')" >
                                <input id="whatbudget_ddtext" class="dd_text" name="whatbudget_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="whatbudget_ddlist" class="dd_list" onmousemove="show_dropdown('whatbudget_ddlist')" onmouseout="hide_list('whatbudget_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','מעל 500');">
		                                מעל 500 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','350 - 500');">
		                                350 - 500 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','250 - 350');">
		                                250 - 350 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','150 - 250');">
		                                150 - 250 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','50 -150');">
		                                50 -150 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','פחות מ 50');">
		                                פחות מ 50 ש"ח</a></div>
	                                </div>
                                </div>
                            </div>
                        
                        
                        <span id="not_including_food" dir="rtl">
                        *לא כולל אוכל
                        </span>

                        <div id="wizard_title">
                        :מצאו את הסדנא המתאימה לכם
                        </div>
                        <!-- <div id="wizard_find_button" onclick="location.href='index.html'"> -->
                        <div id="wizard_find_button" onclick="document.forms['wizard_form'].submit();">
                        </div>
                        <div id="need_help_button">
                            <a href="index.html">? צריכים עזרה</a>
                        </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        </div>
	</div>
		
	<div id="workshop_buttons">
		<div id="workshop_buttons_main">
		<ul id="buttons_strip">
	            <li id="contact_button" onclick="location.href='contact.php'" style="width: 163px;"></li>
	            <li id="enrichment_button" onclick="location.href='search.php?whatodo_ddtext=מפגש+העשרה+חוויתי&howmany_text=&Result_Set=0&Free_search=0&where_ddtext=&howlong_ddtext=&whatbudget_ddtext='"></li>
	            <li id="lectures_button" onclick="location.href='search.php?whatodo_ddtext=הרצאות&howmany_text=&Result_Set=0&Free_search=0&where_ddtext=&howlong_ddtext=&whatbudget_ddtext='"></li>
	            <li id="workers_button" onclick="location.href='search.php?whatodo_ddtext=פיתוח+עובדים&howmany_text=&Result_Set=0&Free_search=0&where_ddtext=&howlong_ddtext=&whatbudget_ddtext='"></li>
	            <li id="managers_button" onclick="location.href='search.php?whatodo_ddtext=פיתוח+מנהלים&howmany_text=&Result_Set=0&Free_search=0&where_ddtext=&howlong_ddtext=&whatbudget_ddtext='" ></li>
	            <li id="team_button" onclick="location.href='search.php?whatodo_ddtext=גיבוש+ועבודת+צוות&howmany_text=&Result_Set=0&Free_search=0&where_ddtext=&howlong_ddtext=&whatbudget_ddtext='" style="width: 160px;"></li>
	   </ul>
	   </div> 
    </div>
	
	<div id="main_text">
        <div id="main_text_main">
        <div id="main_text_content" dir="rtl">
			<br/>
        	<div id="main_text_head">
        	מתעקשים על סדנא או הרצאה שמתאימה לכם בול ?
        	<br/>
        	<span id="saturica_name">סאטוריקה</span>
        	תתאים לכם בדיוק...        	
        	</div>
        	<br/>
        	<div id="main_text_mid">
        	זה פשוט וקל כמו שזה נשמע. לכם יש מטרות ואילוצים שונים. לנו יש מאגר עצום של מיטב הסדנאות, ההרצאות ופעילויות העשרה של המרצים,
        	<br/>
        	המנחים והחברות המובילים בתחומם, שנבדקו ואושרו על ידינו ביסודיות רבה. עכשיו נשאר רק לבחור, להזמין ולהנות מהפעילות המתאימה לכם ביותר.
        	<br/>
        	<span class="white_text">קחו את מה שמתאים לכם.</span>
        	<br/>
        	<br/>
        	<span class="white_text">חיפוש עצמי באתר - </span> ענו על 5 השאלות במגדיר הצרכים ותקבלו את הפעילויות העונות לדרישות שהגדרתם.
        	<br/>
        	<span class="white_text">ליווי אישי של יועץ ארגוני - </span> בטלפון או אצלכם במשרד, שיסייע לכם באיתור הצרכים, הגדרת המארות והתאמת הפעילות. 
        	<br/>
        	<span class="white_text">פעילות בהתאמה אישית - </span> בניית פעילות מקורית עם קונספט ייחודי לכם או התאמת פעילות קיימת לערכי החברה, למטרות האירוע ולאופי המשתתפים.  
        	</div>
        </div>
        </div>
	</div>
	
	<div id="bottom">
	<div id="bottom_main">
	    <ul id="bottom_content">
            <li>
                <div id="blog">
                <?php echo GetPosts("http://www.satorika.co.il/blog/?feed=rss2")?>
                </div>
            </li>
            <li>
                <div id="recomended">
                	<ul>
                	<li class="recomended_li"><a href ="recommended.php"><?php echo $first_workshop[2] ?></a></li>
                	<li class="recomended_li"><a href ="recommended.php"><?php echo $second_workshop[2] ?></a></li>
                	<li><a href ="recommended.php"><?php echo $third_workshop[2] ?></a></li>
                	</ul>
                </div>
                <div id="dictionery">
                </div>
            </li>
            <li>
                <div id="video">       
                <object width="325" height="375">
                    <param name="movie" value="http://www.youtube.com/v/axCT1a_M0lc?rel=1&color1=0xAF674E&color2=0xAF674E&border=1&fs=1"></param>
                    <param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
                    <embed src="http://www.youtube.com/v/axCT1a_M0lc?rel=1&color1=0xAF674E&color2=0xAF674E&border=1&fs=1" 
                    type="application/x-shockwave-flash" 
                    allowscriptaccess="always" 
                    allowfullscreen="true" 
                    width="325" 
                    height="375">
                    </embed>
                    </object>
                </div>
            </li>
        </ul>
    </div>
    </div>
    
   
	<?php FooterFunc();?>
	
	<div id="preload">
	   <img src="images/main_menu_homepage_hover.jpg" width="1" height="1" alt="Image 01" />
	   <img src="images/main_menu_whatwedo_hover.jpg" width="1" height="1" alt="Image 02" />
	   <img src="images/main_menu_recommended_hover.jpg" width="1" height="1" alt="Image 03" />
	   <img src="images/main_menu_customized_hover.jpg" width="1" height="1" alt="Image 04" />
	   <img src="images/main_menu_locations_hover.jpg" width="1" height="1" alt="Image 05" />
	   <img src="images/main_menu_gallery_hover.jpg" width="1" height="1" alt="Image 06" />
	   <img src="images/images/main_menu_blog_hover.jpg" width="1" height="1" alt="Image 07" />
	   <img src="images/main_menu_contact_hover.jpg" width="1" height="1" alt="Image 08" />
	</div>
</body>
</html>