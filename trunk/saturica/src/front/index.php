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

$whatodo_ddtext = isset($_GET['whatodo_ddtext']) ? $_GET['whatodo_ddtext']: "" ;
$whatodo_ddtext = CleanText($whatodo_ddtext);

$howmany_text = isset($_GET['howmany_text']) ? $_GET['howmany_text']: "" ;
$howmany_text = CleanText($howmany_text);

$where_ddtext = isset($_GET['where_ddtext']) ? $_GET['where_ddtext']: "" ;
$where_ddtext = CleanText($where_ddtext);

$howlong_ddtext = isset($_GET['howlong_ddtext']) ? $_GET['howlong_ddtext']: "" ;
$howlong_ddtext = CleanText($howlong_ddtext);

$whatbudget_ddtext = isset($_GET['whatbudget_ddtext']) ? $_GET['whatbudget_ddtext']: "" ;
$whatbudget_ddtext = CleanText($whatbudget_ddtext);


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
<script type="text/javascript">
var hide = false;

    function HideAll(id)
    {
    	if (id != "whattodo_ddlist") hide_list('whattodo_ddlist');
    	if (id != "where_ddlist") hide_list('where_ddlist');
    	if (id != "howlong_ddlist") hide_list('howlong_ddlist');
    	if (id != "whatbudget_ddlist") hide_list('whatbudget_ddlist');
    }
	
    function show_dropdown(id) 
    {
    	HideAll(id);
    	elem = document.getElementById(id);
		if ((elem.style.visibility != "visible") && (hide == false))
		{
			elem.style.visibility = "visible";  // dd_list
		}
		else
		{
			elem.style.visibility = "hidden";  // dd_list
		}
		hide = false;
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
<title>סאטוריקה</title>
<?php GoogleAnalytics();?>
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
                    <div id="wizard" >
                        
                       <form action="search.php" method="get" id="wizard_form">
			            
			           
				            <span class="questions" id="whattodo_Question">
	                            ? מה רוצים לעשות
	                        </span>
				               <div id="whattodo" class="dropdown"  onclick="show_dropdown('whattodo_ddlist')" >
				               			               
	                                <input id="whattodo_ddtext" class="dd_text" name="whatodo_ddtext" type="text" value="<?php echo $whatodo_ddtext;?>"  size="10"  readonly="readonly"  />
	                                <div id="whattodo_ddlist" class="dd_list"   >
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
                            <input class="howmany_text" name="howmany_text" type="text" value="<?php echo $howmany_text;?>" size="10"/>
                        </div>    
                   
			            <div id="resset">
                            <input class="Result_Set" name="Result_Set" type="text" value="0" style="display:none;"/>
                        </div>  

                        	<input class="Free_search" name="Free_search" type="hidden" value="0" />
                        
                        <span class="questions" id="where_Question">
                            ? היכן רוצים את הפעילות
                        </span>
			               <div id="where" class="dropdown"  onclick="show_dropdown('where_ddlist')" >
                                <input id="where_ddtext" class="dd_text" name="where_ddtext" type="text" value="<?php echo $where_ddtext;?>"  size="10"  readonly="readonly"  />
                                <div id="where_ddlist" class="dd_list"   >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','במבנה ממוזג/מחומם');">
		                                 במבנה ממוזג/מחומם</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','אצלכם בארגון');">
		                                אצלכם בארגון</a></div>
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
                                <input id="howlong_ddtext" class="dd_text" name="howlong_ddtext" type="text" value="<?php echo $howlong_ddtext;?>"  size="10"  readonly="readonly"  />
                                <div id="howlong_ddlist" class="dd_list"  >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','פעילות קצרה, מקסימום 3 שעות');">
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
                                <input id="whatbudget_ddtext" class="dd_text" name="whatbudget_ddtext" type="text" value="<?php echo $whatbudget_ddtext;?>"  size="10"  readonly="readonly"   />
                                <div id="whatbudget_ddlist" class="dd_list"   >
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
                            <a href="blog.php?path=http://www.satorika.co.il/blog/?p=37">? צריכים עזרה</a>
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
	            <li id="enrichment_button" onclick="location.href='search.php?whatodo_ddtext=מפגש+העשרה+חוויתי&amp;howmany_text=&amp;Result_Set=0&amp;Free_search=0&amp;where_ddtext=&amp;howlong_ddtext=&amp;whatbudget_ddtext='"></li>
	            <li id="lectures_button" onclick="location.href='search.php?whatodo_ddtext=הרצאות&amp;howmany_text=&amp;Result_Set=0&amp;Free_search=0&amp;where_ddtext=&amp;howlong_ddtext=&amp;whatbudget_ddtext='"></li>
	            <li id="workers_button" onclick="location.href='search.php?whatodo_ddtext=פיתוח+עובדים&amp;howmany_text=&amp;Result_Set=0&amp;Free_search=0&amp;where_ddtext=&amp;howlong_ddtext=&amp;whatbudget_ddtext='"></li>
	            <li id="managers_button" onclick="location.href='search.php?whatodo_ddtext=פיתוח+מנהלים&amp;howmany_text=&amp;Result_Set=0&amp;Free_search=0&amp;where_ddtext=&amp;howlong_ddtext=&amp;whatbudget_ddtext='" ></li>
	            <li id="team_button" onclick="location.href='search.php?whatodo_ddtext=גיבוש+ועבודת+צוות&amp;howmany_text=&amp;Result_Set=0&amp;Free_search=0&amp;where_ddtext=&amp;howlong_ddtext=&amp;whatbudget_ddtext='" style="width: 160px;"></li>
	   </ul>
	   </div> 
    </div>
	
	<div id="main_text">
        <div id="main_text_main">
        <div id="main_text_content" dir="rtl">
			<br/>
        	<div id="main_text_head">
        	מחפשים סדנה או הרצאה שמתאימה לכם  ?
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
                <div id="recomended" dir="rtl">
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
                <object width="325" height="375" type="application/x-shockwave-flash">
                    <param name="movie" value="http://www.youtube.com/v/2QcTmqB4tCo?hl=en&fs=1&rel=1&amp;color1=0xAF674E&amp;color2=0xAF674E&amp;border=1&amp;fs=1"/>
                    <param name="allowFullScreen" value="true"/><param name="allowscriptaccess" value="always"/>
                    <embed src="http://www.youtube.com/v/2QcTmqB4tCo?rel=1&amp;color1=0xAF674E&amp;color2=0xAF674E&amp;border=1&amp;fs=1" 
                    type="application/x-shockwave-flash" 
                    allowscriptaccess="always" 
                    allowfullscreen="true" 
                    width="325" 
                    height="375"/>
                </object>
                </div>
            </li>
        </ul>
    </div>
    </div>
    
	
    <?php FooterFunc();?>
	
	<div id="preload" style="display:none;">
	   <img src="images/main_menu_homepage_hover.jpg" width="1" height="1" alt="Image 01" />
	   <img src="images/main_menu_whatwedo_hover.jpg" width="1" height="1" alt="Image 02" />
	   <img src="images/main_menu_recommended_hover.jpg" width="1" height="1" alt="Image 03" />
	   <img src="images/main_menu_customized_hover.jpg" width="1" height="1" alt="Image 04" />
	   <img src="images/main_menu_locations_hover.jpg" width="1" height="1" alt="Image 05" />
	   <img src="images/main_menu_gallery_hover.jpg" width="1" height="1" alt="Image 06" />
	   <img src="images/main_menu_blog_hover.jpg" width="1" height="1" alt="Image 07" />
	   <img src="images/main_menu_contact_hover.jpg" width="1" height="1" alt="Image 08" />
	  
	   <img src="images/wizard_find_button_hover.jpg" width="1" height="1" alt="Image 09" />
	   <img src="images/main_icon_contact_hover.jpg" width="1" height="1" alt="Image 11" />
	   <img src="images/main_icon_enrichment_hover.jpg" width="1" height="1" alt="Image 12" />
	   <img src="images/main_icon_lectures_hover.jpg" width="1" height="1" alt="Image 13" />
	   <img src="images/main_icon_workers_hover.jpg" width="1" height="1" alt="Image 14" />
	   <img src="images/main_icon_managers_hover.jpg" width="1" height="1" alt="Image 15" />
	   <img src="images/main_icon_team_hover.jpg" width="1" height="1" alt="Image 16" />
	</div>
</body>
</html>