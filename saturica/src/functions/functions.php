		<?php	function HeaderFunc()	{	?>	<div id="header">	    <ul>            <li >                <div id="header_left">                </div>            </li>            <li >                <div id="header_content">                    <div id="header_content_search">                        <form method="get" action="index.html">                        <input type="image" src="images/search_icon.jpg" alt="Search button"/>                        &nbsp;                        <input type="text" name="searchString" class="textInput" dir="rtl"/>                        </form>                    </div>                    <div id="navigation">                        <ul>                            <li id="menu_contact" onclick="location.href='contact.html'"></li>			                <li id="menu_blog" onclick="location.href='blog.html'"></li>                            <li id="menu_gallery" onclick="location.href='gallery.html'"></li>                            <li id="menu_locations" onclick="location.href='locations.html'"></li>                            <li id="menu_customized" onclick="location.href='customized.html'"></li>			                <li id="menu_recommended_pushed" onclick="location.href='recommended.html'"></li>			                <li id="menu_whatwedo" onclick="location.href='whatwedo.html'"></li>                            <li id="menu_home_pushed" onclick="location.href='index.html'"></li>                        </ul>                    </div>                </div>            </li>            <li >                <div id="header_right">                </div>            </li>        </ul>  	</div>	<?php	}	?>		<!-- -----------------------------------------------------------------------------	 -->		<?php	function FooterFunc()	{	?>		<div id="footer">        <ul id="footer_content">                                     <li id="midigital_logo">            site by <a href="index.html"><b>MIDigital</b></a>            </li>            <li id="small_logo">            </li>            <li id="links">                <a href="index.html">דף הבית</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">מה אנחנו עושים?</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">המומלצים שלנו</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות בהתאמה אישית</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">לוקיישנים</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">גלריה</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">בלוג</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">צור קשר</a>                <br />                <a href="index.html">גיבוש ועבודת צוות</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות מנהלים</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות עובדים</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">הרצאות</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">מפגשי העשרה</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">ספקים</a>                            </li>                   </ul>	</div>	<?php	}	?>				<!-- -----------------------------------------------------------------------------	 -->		<?php	function PrintDetails($recommended_workshop)	{	?>	<br/>        	<div id="recommended_name_title">        	<?php echo $recommended_workshop[2];?>        	</div>                 	      			<span id="recommended_small_text">נושא:</span>			<span id="recommended_small_text_content">			<?php 			echo $recommended_workshop[4];			?></span>						<br/>						<span id="recommended_small_text">סגנון:</span>			<span id="recommended_small_text_content">			<?php 			echo $recommended_workshop[5];			?></span>						<br/>						<span id="recommended_small_text">מסגרת זמן:</span>			<span id="recommended_small_text_content">			<?php 			echo $recommended_workshop[18];			?></span>						<br/><br/>						<span id="recommended_content_descriptoin">			<?php 			echo $recommended_workshop[8];			?>			</span>						<div id="get_details_button_recommended" onclick="location.href='index.php'"></div>	<?php	}	?>