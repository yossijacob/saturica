<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

session_start();	
connect();   //connect to mysql DB

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>חפש סדנא לפי שם</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php
		if (!is_authenticated()) 
			header("Location:login.php"); 
		MenuBar(''); 
		//MenuBarSearch('price');
	?>
    
	
<div id="content">
    <br/>
    <h1>חיפוש</h1>
    <hr></hr>
    
  <?php
  
  
  $price = isset($_POST['price']) ? $_POST['price']: "";
  $price = CleanText($price);

  
  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";

  	echo "(בחר את התקציב למשתתף (לא כולל אוכל";
  	echo "<br/><br/>";
  	echo '.המחירים אינם כוללים מע"מ';
  	echo "<br/><br/>";
  	$prices[0] = "פחות מ50";		// for the places dropdown boxes
	$prices[1] = "50-150";
  	$prices[2] = "150-250";
	$prices[3] = "250-350";
	$prices[4] = "350-500";
	$prices[5] = "מעל 500";

  	
  	if (isset($_POST['submitted']))
  	{
  	
  	if ($price == "") 
  		{
  			$miss = true;
  			$missing['search'] = "לא הוכנסו מילות חיפוש";
  		}
  	if ($miss == true)
  		{
  			$miss_msg = implode(",",$missing);
  			echo "<br/>";
  			echo "<b>:התרחשה שגיאה בפרטים הבאים</b>";
  			echo "<h4>".$miss_msg."</h4>";	
  		}	
  	
	if ($miss != true)
  		{		// the form was validated successfully now we process the form
  			$col="personal_price";
  			if ($price == $prices[0])
  			{
  				$result = SearchWorkshopPrice($col,0,50);
  			}
  			
  			if ($price == $prices[1])
  			{
  				$result = SearchWorkshopPrice($col,50,150);
  			}
  			
  		  	if ($price == $prices[2])
  			{
  				$result = SearchWorkshopPrice($col,150,250);
  			}
  		  	
  			if ($price == $prices[3])
  			{
  				$result = SearchWorkshopPrice($col,250,350);
  			}
  			
  		  	if ($price == $prices[4])
  			{
  				$result = SearchWorkshopPrice($col,350,500);
  			}
  			
  		  	if ($price == $prices[5])
  			{
  				$result = SearchWorkshopPrice($col,500,5000000000000000);
  			}
  					
 			if ($result !="")
 			{
 				foreach ($result as $value)
 				{
 					echo "<br/>";
 					echo "  שם הסדנא: $value[2]  "; 
 					echo "<br/>";
 					echo "  נושא הסדנא: $value[4]  "; 
 					echo "<br/>";
 					echo "  סגנון הסדנא: $value[5]  "; 
 					echo "<br/>";
 					echo "  מחיר קבוע: $value[6]  "; 	
 					echo "<br/>";
 					echo "  מחיר למשתתף: $value[7]  "; 
 					echo "<br/>";
 					echo "  תאור הסדנא: $value[8]  "; 	
 					echo "<br/>";
 					
 					if ($value[3] !="")
 						echo "<img src='workshop_pic/$value[3]' border=0 >";
 					echo "<br/>";
 						
 					echo "<hr></hr>";
 				}

 			}
 			 else{
 					echo "לא נמצאו סדנאות מתאימות";
 				 }
  			
  			//header('Location:preferences.php');

  		}
  	
  	}  // close if submitted 

  
?>
	<br/>
	<div id="search_name_form" dir="rtl">
	<form name="search_name_form" id="search_name_form" method="post" action="price.php">
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	
	 	<?php 
	 	ShowDropDown("price",$prices,$prices,"","",$price);
	 	?>
	 </tr>
	 
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.search_name_form.submit();">חפש<span/></div>
		<!-- <a class="green_ovalbutton" href="javascript:document.add_broker_form.submit();"><span>Add broker</span></a> -->
  	</div>
	</form>
	</div>
 
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>