<!DOCTYPE html>
<?php include_once 'functions.php';?>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
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
<body>
	<?php  HeaderFunc("home"); ?>
	<!-- 
	<div id="header">
	    <ul>
            <li >
                <div id="header_left">
                </div>
            </li>
            <li >
                <div id="header_content">
                    <div id="header_content_search">
                        <form method="get" action="index.html">
                        <input type="image" src="images/search_icon.jpg" alt="Search button" id="search_icon"/>
                        &nbsp;
                        <input type="text" name="searchString" class="textInput" dir="rtl"/>
                        </form>
                    </div>
                    <div id="navigation">
                        <ul>
                            <li id="menu_contact" onclick="location.href='contact.php'"></li>
			                <li id="menu_blog" onclick="location.href='/blog'"></li>
                            <li id="menu_gallery" onclick="location.href='gallery.php'"></li>
                            <li id="menu_locations" onclick="location.href='locations.php'"></li>
                            <li id="menu_customized" onclick="location.href='customized.php'"></li>
			                <li id="menu_recommended" onclick="location.href='recommendeds.php'"></li>
			                <li id="menu_whatwedo" onclick="location.href='whatwedo.php'"></li>
                            <li id="menu_home_pushed" onclick="location.href='index.php'"></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li >
                <div id="header_right">
                </div>
            </li>
        </ul>  
	</div>
	 -->
	<div id="search_wizard">
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
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','מפגשים חברתיים');">
		                                מפגשים חברתיים</a></div>
	                                </div>
                                </div>
                            </div>

                        <span class="questions" id="howmany_Question">
                            ? כמה משתתפים
                        </span>
			            <div id="howmany">
                            <input class="howmany_text" name="howmany_text" type="text" value=""  size="10"/>
                        </div>                                 
                         
                        <span class="questions" id="where_Question">
                            ? היכן רוצים את הפעילות
                        </span>
			               <div id="where" class="dropdown"  onclick="show_dropdown('where_ddlist')" >
                                <input id="where_ddtext" class="dd_text" name="where_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="where_ddlist" class="dd_list" onmousemove="show_dropdown('where_ddlist')" onmouseout="hide_list('where_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','במבנה ממוזג\מחומם');">
		                                 במבנה ממוזג\מחומם</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','אצלכם בארגון');">
		                                אצלכם בארגון</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','בחוץ במקום מיוחד');">
		                                בחוץ במקום מיוחד</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','על שפת הבריכה');">
		                                על שפת הבריכה</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','על חוף הים');">
		                                על חוף הים</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','רוצים לנוע ממקום למקום');">
		                                רוצים לנוע ממקום למקום</a></div>
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
		                                קצר, מקסימום 3 שעות</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','חצי יום');">
		                                חצי יום</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','יום מלא');">
		                                יום מלא</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','ערב');">
		                                ערב</a></div>
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
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','מעל 300');">
		                                מעל 300 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','200 - 300');">
		                                200 - 300 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','100 - 200');">
		                                100 - 200 ש"ח</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','50 -100');">
		                                50 -100 ש"ח</a></div>
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
	
	<!-- <div id="black_strip">
	</div> -->
	
	
	<div id="workshop_buttons">
	    <ul id="buttons_strip">
            <li id="contact_button" onclick="location.href='contact.html'" style="width: 163px;"></li>
            <li id="enrichment_button" onclick="location.href='customized.html'"></li>
            <li id="lectures_button" onclick="location.href='locations.html'"></li>
            <li id="workers_button" onclick="location.href='gallery.html'"></li>
            <li id="managers_button" onclick="location.href='blog.html'" ></li>
            <li id="team_button" onclick="location.href='contact.html'" style="width: 160px;"></li>
        </ul>
    </div>
	
	<div id="main_text">
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
	
	<div id="bottom">
	    <ul id="bottom_content">
            <li>
                <div id="blog">
                </div>
            </li>
            <li>
                <div id="recomended">
                </div>
                <div id="dictionery">
                </div>
            </li>
            <li>
                <div id="video">   
                <!--<object width="315" height="377"><param name="movie" value="http://www.youtube.com/v/4A-EllJptgg?fs=1&amp;hl=en_US"/><param name="allowFullScreen" value="true"/><param name="allowscriptaccess" value="always"/><param name="border" value="1"/><param name="color2" value="#E0D1B0"/><embed src="http://www.youtube.com/v/4A-EllJptgg?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="315" height="377" color2=0xE0D1B0></embed></object>-->
                <!-- 
                <object width="325" height="375">
                    <param name="movie" value="http://www.youtube.com/v/4A-EllJptgg?rel=1&color1=0xAF674E&color2=0xAF674E&border=1&fs=1"/>
                    <param name="allowFullScreen" value="true"/>
                    <param name="allowScriptAccess" value="always"/>
                    <embed src="http://www.youtube.com/v/4A-EllJptgg?rel=1&color1=0xAF674E&color2=0xAF674E&border=1&fs=1"
                        type="application/x-shockwave-flash"
                        allowscriptaccess="always"
                        width="325" height="375" 
                        allowfullscreen="false">
                    </embed>
                </object>
                 -->
                <object width="325" height="375">
                    <param name="movie" value="http://www.youtube.com/v/gkvpuOebd88?rel=1&color1=0xAF674E&color2=0xAF674E&border=1&fs=1"></param>
                    <param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
                    <embed src="http://www.youtube.com/v/gkvpuOebd88?rel=1&color1=0xAF674E&color2=0xAF674E&border=1&fs=1" 
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
	<?php FooterFunc();?>
	<!-- 
	<div id="footer">
        <ul id="footer_content">
            
             
            <li id="midigital_logo">
            site by <a href="http://www.midigital.co.il/"><b>MIDigital</b></a>
            </li>
            <li id="small_logo">
            </li>
            <li id="links">
                <a href="index.html">דף הבית</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">מה אנחנו עושים?</a>
                &nbsp;|&nbsp;&nbsp;<a href="recommendeds.php">המומלצים שלנו</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות בהתאמה אישית</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">לוקיישנים</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">גלריה</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">בלוג</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">צור קשר</a>
                <br />
                <a href="index.html">גיבוש ועבודת צוות</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות מנהלים</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות עובדים</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">הרצאות</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">מפגשי העשרה</a>
                &nbsp;|&nbsp;&nbsp;<a href="index.html">ספקים</a>
                
            </li>
           
        </ul>
	</div>
	 -->
</body>
</html>