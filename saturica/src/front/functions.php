<?php//*********************************************************************function CheckIfIE(){	$u_agent = $_SERVER['HTTP_USER_AGENT'];      return (preg_match('/MSIE/i',$u_agent));}//---------------------------------------------------------------------------------------------------------function SetupJquery(){	?>	<link rel="stylesheet" type="text/css" href="js/css/jquery-ui-1.8.7.custom.css"/>	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>	<script type="text/javascript" src="js/jquery-ui-1.8.7.custom.min.js"></script>	<?php}//---------------------------------------------------------------------------------------------------------function SetupSearchInputRest(){	?>	<script type="text/javascript" language="javascript"> 		function SearchInputRest()		{			document.getElementById('textInput').value = "";		}	</script>	<?php }//---------------------------------------------------------------------------------------------------------function SetupJqueryContactDialog(){	?>	<style> 		body { font-size: 62.5%; }		#dialog-form label { display:block; } 		#dialog-form input { display:block; }		#dialog-form input.text { margin-bottom:12px; width:95%; padding: .4em; }		#dialog-form textarea {resize: none;}		fieldset { padding:0; border:0; margin-top:25px; }		h1 { font-size: 1.2em; margin: .6em 0; }		div#users-contain { width: 350px; margin: 20px 0; }		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }		.ui-dialog .ui-state-error { padding: .3em; }		.validateTips { border: 1px solid transparent; padding: 0.3em; }	</style> 	<script type="text/javascript" language="javascript"> 	$(function() {		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!		$( "#dialog:ui-dialog" ).dialog( "destroy" );				var name = $( "#name" ),			email = $( "#email" ),			password = $( "#password" ),			allFields = $( [] ).add( name ).add( email ).add( password ),			tips = $( ".validateTips" ); 		function updateTips( t ) {			tips				.text( t )				.addClass( "ui-state-highlight" );			setTimeout(function() {				tips.removeClass( "ui-state-highlight", 1500 );			}, 500 );		} 		function checkLength( o, n, min, max ) {			if ( o.val().length > max || o.val().length < min ) {				o.addClass( "ui-state-error" );				updateTips( "Length of " + n + " must be between " +					min + " and " + max + "." );				return false;			} else {				return true;			}		} 		function checkRegexp( o, regexp, n ) {			if ( !( regexp.test( o.val() ) ) ) {				o.addClass( "ui-state-error" );				updateTips( n );				return false;			} else {				return true;			}		}				$( "#dialog-form" ).dialog({			position: 'center',			autoOpen: false,			height: 390,			width: 360,			resizable: false,			show: 'drop',			hide: "drop",			modal: true,						buttons: 			{				"קבל הצעה": function() 				{					document.get_offer.submit();										/*var bValid = true;					allFields.removeClass( "ui-state-error" ); 					bValid = bValid && checkLength( name, "username", 3, 16 );					bValid = bValid && checkLength( email, "email", 6, 80 );					bValid = bValid && checkLength( password, "password", 5, 16 ); 					bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/					bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );					bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" ); 					if ( bValid ) {						$( "#users tbody" ).append( "<tr>" +							"<td>" + name.val() + "</td>" + 							"<td>" + email.val() + "</td>" + 							"<td>" + password.val() + "</td>" +						"</tr>" ); 						$( this ).dialog( "close" );					}*/				},				בטל: function() 				{					$( this ).dialog( "close" );				}			},			close: function() 			{				allFields.val( "" ).removeClass( "ui-state-error" );			}		}); 		$( ".get_offer" ).click(function() {				$( "#dialog-form" ).dialog( "open" );			});	});	</script> 	<?php}//---------------------------------------------------------------------------------------------------------	//if we want to use this function - its need to be corrected - better if the function recive parameter which will be "pushed" at the icons	//and all other icons will be idles	function HeaderFunc($page_name)	{		$id['contact'] = "menu_contact";		$id['blog'] = "menu_blog";		$id['gallery'] = "menu_gallery";		$id['locations'] = "menu_locations";		$id['customized'] = "menu_customized";		$id['recommended'] = "menu_recommended";		$id['whatwedo'] = "menu_whatwedo";		$id['home'] = "menu_home";		$id['empty'] = "empty";				$id["$page_name"] .= "_pushed";	?>	<div id="header">	    <ul>            <li >                <div id="header_left">                </div>            </li>            <li >                <div id="header_content">                    <div id="header_content_search">                        <form method="get" action="index.html" id="search_form">                        <input type="image" src="images/search_icon.jpg" alt="Search button" id="search_icon"/>                        &nbsp;                        <div id="textInput_div">                        	<input id="textInput" type="text" name="searchString" class="textInput" dir="rtl" value="חיפוש חופשי באתר" onclick="SearchInputRest()"/>                        </div>                        </form>                    </div>                    <div id="navigation">                        <ul>                           <li id="<?php echo $id['contact']?>" onclick="location.href='contact.php'"></li>			                <li id="<?php echo $id['blog']?>" onclick="location.href='blog.php'"></li>                            <li id="<?php echo $id['gallery']?>" onclick="location.href='gallery.php'"></li>                            <li id="<?php echo $id['locations']?>" onclick="location.href='locations.php'"></li>                            <li id="<?php echo $id['customized']?>" onclick="location.href='customized.php'"></li>			                <li id="<?php echo $id['recommended']?>" onclick="location.href='recommended.php'"></li>			                <li id="<?php echo $id['whatwedo']?>" onclick="location.href='about.php'"></li>                            <li id="<?php echo $id['home']?>" onclick="location.href='index.php'"></li>                        </ul>                    </div>                </div>            </li>            <li >                <div id="header_right">                </div>            </li>        </ul>  	</div>	<?php	}		///------------------------------------------------------------------------------		function FooterFunc()	{	?>		<div id="footer">        <ul id="footer_content">                                     <li id="midigital_logo">            site by <a href="http://www.midigital.co.il/"><b>MIDigital</b></a>            </li>            <li id="small_logo">            </li>            <li id="links">                <a href="index.html">דף הבית</a>                &nbsp;|&nbsp;&nbsp;<a href="about.php">מה אנחנו עושים?</a>                &nbsp;|&nbsp;&nbsp;<a href="recommended.php">המומלצים שלנו</a>                &nbsp;|&nbsp;&nbsp;<a href="customized.php">סדנאות בהתאמה אישית</a>                &nbsp;|&nbsp;&nbsp;<a href="location.href">לוקיישנים</a>                &nbsp;|&nbsp;&nbsp;<a href="gallery.php">גלריה</a>                &nbsp;|&nbsp;&nbsp;<a href="blog.php">בלוג</a>                &nbsp;|&nbsp;&nbsp;<a href="contact.php">צור קשר</a>                <br />                <a href="index.html">גיבוש ועבודת צוות</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות מנהלים</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">סדנאות עובדים</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">הרצאות</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">מפגשי העשרה</a>                &nbsp;|&nbsp;&nbsp;<a href="index.html">ספקים</a>                            </li>                   </ul>	</div>	<?php	}		///------------------------------------------------------------------------------		//prints the wanted values of 'recommended workshop' at the correct order	function PrintDetails($recommended_workshop)	{	?>	<br/>        	<div id="recommended_name_title">        	<?php echo $recommended_workshop[2];?>        	</div>                 	      			<span id="recommended_small_text">נושא:</span>			<span id="recommended_small_text_content">			<?php 			echo $recommended_workshop[4];			?></span>						<br/>						<span id="recommended_small_text">סגנון:</span>			<span id="recommended_small_text_content">			<?php 			echo $recommended_workshop[5];			?></span>						<br/>						<span id="recommended_small_text">מסגרת זמן:</span>			<span id="recommended_small_text_content">			<?php 			echo $recommended_workshop[18];			?></span>						<br/><br/>						<span id="recommended_content_descriptoin">			<?php 			echo $recommended_workshop[8];			?>			</span>								<div id="get_details_button_recommended" class="get_offer"></div>	<?php	}	?>		