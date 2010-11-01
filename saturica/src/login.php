<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

session_start();	// start session
connect();   //connect to mysql DB	 



?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>התחברות לאתר</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/functions.js"></script>

</head>
<body>




<div id="content">
    <br/>
    <h1>:אנא הזדהה</h1>
    <hr></hr>
    <br/>	
	</div>	
	
	
	
<?php
	
	$username  = isset($_POST['username'])? $_POST['username']: "";
  	$username = CleanText($username);
  
 	$entered_pass  = isset($_POST['entered_pass'])? $_POST['entered_pass']: "";
  	$entered_pass = CleanText($entered_pass); 	//the password the user entered

  	$_SESSION['authenticated'] = "no";	

	if (isset($_POST['submitted']))  
	  	{
	  		$userdetails = GetRecord("preferences",1);  // get user data
	  		$user_password = $userdetails[3];			//get the password of the user
	  		
	  	if ( ( $username == "yy") && (hash('sha256',$entered_pass) == $user_password) )
	  		{
	  			$_SESSION['authenticated'] = "yes";
	  			header("Location:statistics.php");
	  		}
	  		
	  	else
	  		{
	  			header("Location:login.php");		
	  		}
	  	}
	  	

?>

	<br/>
	<div id="login_div" dir="rtl">
	<form name="login_form" id="login_form" method="post" action="login.php">
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>שם משתמש</b></td>
	 <?php echo "<td><input type='text' name='username' value='$username' title='username'/></td>";?>
	 </tr>
	 <tr>
	 	<td><b>ססמא</b></td>
	 <?php
	 echo "<td><input type='text' name='entered_pass' value='$entered_pass' title='entered_pass'/></td>";
	 ?>
	 </tr>
	 
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.login_form.submit();">התחבר<span/></div>
  	</div>
	</form>
	</div>

</div>   <!--  end of content -->


</body>
</html>
