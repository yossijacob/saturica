﻿<!DOCTYPE html>
<?php 
include_once '../functions/functions.php';
?>
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
	<?php
	HeaderFunc();
	?>
	<div id="search_wizard">
        <div id="search_wizard_content">
            <ul>
                <li>
                    <div id="wizard_slogen">
                    </div>
                </li>
                <li>
                    <div id="wizard">
                        
                       <form action="index.html" method="post">
			            <span class="questions" id="whattodo_Question">
                            ? מה רוצים לעשות
                        </span>
			               <div id="whattodo" class="dropdown"  onclick="show_dropdown('whattodo_ddlist')" >
                                <input id="whattodo_ddtext" class="dd_text" name="whatodo_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="whattodo_ddlist" class="dd_list" onmousemove="show_dropdown('whattodo_ddlist')" onmouseout="hide_list('whattodo_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','sekar 1');">Sekar 1</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','sekar 2');">Sekar 2</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','sekar 3');">Sekar 3</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','sekar 4');">Sekar 4</a></div>
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
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','sekar 1');">Sekar 1</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','sekar 2');">Sekar 2</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','sekar 3');">Sekar 3</a></div>
		                                <div class="my_li"><a onclick="setText('where_ddtext','where_ddlist','sekar 4');">Sekar 4</a></div>
	                                </div>
                                </div>
                            </div>

                        <span class="questions" id="howlong_Question">
                            מה רוצים לעשות
                        </span>
			               <div id="howlong" class="dropdown"  onclick="show_dropdown('howlong_ddlist')" >
                                <input id="howlong_ddtext" class="dd_text" name="howlong_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="howlong_ddlist" class="dd_list" onmousemove="show_dropdown('howlong_ddlist')" onmouseout="hide_list('howlong_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','sekar 1');">Sekar 1</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','sekar 2');">Sekar 2</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','sekar 3');">Sekar 3</a></div>
		                                <div class="my_li"><a onclick="setText('howlong_ddtext','howlong_ddlist','sekar 4');">Sekar 4</a></div>
	                                </div>
                                </div>
                            </div>
                          
                        <span class="questions" id="whatbudget_Question">
                            מה רוצים לעשות
                        </span>
			               <div id="whatbudget" class="dropdown"  onclick="show_dropdown('whatbudget_ddlist')" >
                                <input id="whatbudget_ddtext" class="dd_text" name="whatbudget_ddtext" type="text" value=""  size="10"  readonly="readonly"  />
                                <div id="whatbudget_ddlist" class="dd_list" onmousemove="show_dropdown('whatbudget_ddlist')" onmouseout="hide_list('whatbudget_ddlist')" >
	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','sekar 1');">Sekar 1</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','sekar 2');">Sekar 2</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','sekar 3');">Sekar 3</a></div>
		                                <div class="my_li"><a onclick="setText('whatbudget_ddtext','whatbudget_ddlist','sekar 4');">Sekar 4</a></div>
	                                </div>
                                </div>
                            </div>
                        </form>

                        <div id="wizard_title">
                        :מצאו את הסדנא המתאימה לכם
                        </div>
                        <div id="wizard_find_button" onclick="location.href='index.html'">
                        </div>
                        <div id="need_help_button">
                            <a href="index.html">? צריכים עזרה</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
	</div>
	
	<div id="workshop_buttons">
	    <ul id="buttons_strip">
            <li id="contact_button" onclick="location.href='recommended.html'"></li>
            <li id="enrichment_button" onclick="location.href='customized.html'"></li>
            <li id="lectures_button" onclick="location.href='locations.html'"></li>
            <li id="workers_button" onclick="location.href='gallery.html'"></li>
            <li id="managers_button" onclick="location.href='blog.html'"></li>
            <li id="team_button" onclick="location.href='contact.html'"></li>
        </ul>
    </div>
	
	<div id="main_text">
        <div id="main_text_content">
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
                </div>
            </li>
        </ul>
    </div>
    
	<?php
	FooterFunc();
	?>
	
</body>
</html>