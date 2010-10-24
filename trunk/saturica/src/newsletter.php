<?php
		include_once 'html.php';

		$fileName = "letter.html";
	
		if ((isset($_GET['pending'])) && ($_GET['pending'] =="export" ))
		{					// exporiting the newsletter file
			header("Location:saveas.php?filename=$fileName");
		}
		else if ((isset($_GET['pending'])) && ($_GET['pending'] =="savenewsletter" ))
		{
			$filedata = $_POST['editor1']; // get data from editor
			$fileHandle = fopen($fileName, 'w+') or die("can't open file"); // open file
			fwrite($fileHandle,$_POST['editor1']); // write
			echo "הקובץ נשמר בהצלחה";
		}
		else if ((isset($_GET['pending'])) && ($_GET['pending'] =="import" ))
		{
			$target_path = $fileName;
			UploadFile( $_FILES['picture']['name'],$_FILES['picture']['tmp_name'],$target_path);
		}
		else
		{	//get data from file
			$fileHandle = fopen($fileName, 'r+') or die("can't open file");
			$filesize = filesize($fileName);
			if ($filesize)
				{
				$filedata = fread($fileHandle, $filesize);
				}
			else
				{
				$filedata = "";
				}
		}
		fclose($fileHandle);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">	    
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ניוזלטר</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/ckeditor/ckeditor.js"></script>

</head>
<body>
	
	<?php 
		MenuBar('newsletter'); 
	?>
    
<div id="content">
	    <br/>
	    <h1>ניוזלטר</h1>
	    <hr></hr>
	    <br/>
	    <br/>
	    <p>כאן ניתן לערוך לשמור ולשלוח עמוד לכל הלקוחות
	    <br/>
	    ניתן להחדיר את שם הלקוח לתוך הטקסט על ידי שימוש בתווית מיוחדת
	    </p>
	    [name] - יוחךף על ידי שם הלקוח 
	    <br/>
	    
	   
	    <br/>
	   
	   
	    
	    <br/>
	    <form name="save_newsletter_form" id="save_newsletter_form" method="post" action="newsletter.php?pending=savenewsletter">
	    <label for="editor1"></label><br />
		<?php echo "<textarea cols='80' id='editor1' name='editor1' rows='10'>$filedata</textarea>";?>
		<script type="text/javascript">
		/*<![CDATA[*/
		CKEDITOR.replace( 'editor1',{fullPage : true});
		/*]]>*/
		</script>
		<br/>
		<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.save_newsletter_form.submit();">שמור שינויים<span/></div>
		</div>
		</form>
		<br/>
		<br/>
		<br/>
		<br/>
		<form name="export_newsletter_form" id="export_newsletter_form" method="post" action="newsletter.php?pending=export">
		<h2>יצוא הניוזלטר</h2>
		<hr></hr>
		<div class="centered_button_div">
	    <div id="shiny-demo-blue" class="demo-button" onclick="javascript:document.export_newsletter_form.submit();">שמור ניוזלטר למחשבך<span/></div>
	    </form>
	    <br/>
	    ייצא את הקובץ למחשבך
	    </div>
	    <br/>
	    <br/>
	    <br/>
	    <form name="import_newsletter_form" id="import_newsletter_form" method="post" action="newsletter.php?pending=import">
	    <h2>יבוא ניוזלטר</h2>
	    <hr></hr>
	      לשימוש בתור ניוזלטר html בחר קובץ 
	    <div class="framed_centered_button_div"> 
	  	<div id="shiny-demo-red" class="demo-button" onclick="javascript:document.import_newsletter_form.submit();">טען ניוזלטר ממחשבך<span/></div>
	  	&nbsp &nbsp &nbsp &nbsp
	  	<input type="file"  name="loadnewsletter"/>
	    </div>
	    
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
