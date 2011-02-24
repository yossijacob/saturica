<?php 
include_once 'html.php';
include_once 'mysql.php';
include_once 'db.php';
include_once 'connect.php';

connect();   //connect to mysql DB
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>משוב</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />


</head>
<body>

	
<div id="content">
    <br/>
    <h1>משוב ללקוח</h1>
    <hr></hr>
	
    
  <?php
  
  function return_grade($stringa)
	{
		if ( $stringa == "במידה רבה מאוד" ) return 5;
		if ( $stringa == "במידה רבה" ) return 4;
		if ( $stringa == "במידה בינונית" ) return 3;
		if ( $stringa == "במידה מעטה" ) return 2;
		if ( $stringa == "כלל לא" ) return 1;
		if ( $stringa == "לא רלוונטי" ) return 6;
		
		
		
	}
  
  
 
  $answer1 = isset($_POST['answer1']) ? $_POST['answer1']: "";
  $answer1 = CleanText($answer1);
  $answer1_text = isset($_POST['answer1_text']) ? $_POST['answer1_text']: "";
  $answer1_text = CleanText($answer1_text);
  
  $answer2  = isset($_POST['answer2'])? $_POST['answer2']: "";
  $answer2 = CleanText($answer2);
  $answer2_text  = isset($_POST['answer2_text'])? $_POST['answer2_text']: "";
  $answer2_text = CleanText($answer2_text);
  
  
  $answer3  = isset($_POST['answer3'])? $_POST['answer3']: "";
  $answer3 = CleanText($answer3);
  $answer3_text  = isset($_POST['answer3_text'])? $_POST['answer3_text']: "";
  $answer3_text = CleanText($answer3_text);
  
  
  $answer4  = isset($_POST['answer4'])? $_POST['answer4']: "";
  $answer4 = CleanText($answer4);
  $answer4_text  = isset($_POST['answer4_text'])? $_POST['answer4_text']: "";
  $answer4_text = CleanText($answer4_text);
  
  $answer5  = isset($_POST['answer5'])? $_POST['answer5']: "";
  $answer5 = CleanText($answer5);
  $answer5_text  = isset($_POST['answer5_text'])? $_POST['answer5_text']: "";
  $answer5_text = CleanText($answer5_text);
  
  $answer6 = isset($_POST['answer6']) ? $_POST['answer6']: "";	//name 
  $answer6 = CleanText($answer6);
  
  $answer7 = isset($_POST['answer7']) ? $_POST['answer7']: "";	//name 
  $answer7 = CleanText($answer7);
  
  
  
  
  

  //$rank  = isset($_POST['rank'])? $_POST['rank']: "";
  //$rank = CleanText($rank);
  

  	$sum=0;		// sum of answers, will be use for compute rank.
  	$answers = 0; 	//number of answers

  	$dont_show_form = false;
  	$miss = false;
  	$missing = "";
  	$name_exist = "";
  	
  	
  	//get all workshop's names
  	//$names = GetColumn("workshops",2); // maybe needs to be "2" 
  	//$size = count($names);
  	
  	//for ($i=0; $i<$size; $i++)
  		//$ans6[$i]=$names[$i];
  	
  	
  		

    $ans1[0] = "במידה רבה מאוד";		// for the dropdown boxes
	$ans1[1] = "במידה רבה";
	$ans1[2] = "במידה בינונית";
	$ans1[3] = "במידה מעטה";
	$ans1[4] = "כלל לא";
	$ans1[5] = "לא רלוונטי";		
	
	$ans2[0] = "במידה רבה מאוד";		// for the dropdown boxes
	$ans2[1] = "במידה רבה";
	$ans2[2] = "במידה בינונית";
	$ans2[3] = "במידה מעטה";
	$ans2[4] = "כלל לא";
	$ans2[5] = "לא רלוונטי";	
	
	$ans3[0] = "במידה רבה מאוד";		// for the dropdown boxes
	$ans3[1] = "במידה רבה";
	$ans3[2] = "במידה בינונית";
	$ans3[3] = "במידה מעטה";
	$ans3[4] = "כלל לא";
	$ans3[5] = "לא רלוונטי";

	$ans4[0] = "במידה רבה מאוד";		// for the dropdown boxes
	$ans4[1] = "במידה רבה";
	$ans4[2] = "במידה בינונית";
	$ans4[3] = "במידה מעטה";
	$ans4[4] = "כלל לא";
	$ans4[5] = "לא רלוונטי";	
	
	$ans5[0] = "במידה רבה מאוד";		// for the dropdown boxes
	$ans5[1] = "במידה רבה";
	$ans5[2] = "במידה בינונית";
	$ans5[3] = "במידה מעטה";
	$ans5[4] = "כלל לא";
	$ans5[5] = "לא רלוונטי";	
	
	
	
	
  	$grade1 = return_grade($answer1);
  	$grade2 = return_grade($answer2);
  	$grade3 = return_grade($answer3);
  	$grade4 = return_grade($answer4);
  	$grade5 = return_grade($answer5);
  	
  	
  	
  	if (isset($_POST['submitted']))
  	{
  	
  	if ( ($grade1 >= 1) && ($grade1 <= 5) ) 
  		{
  			$answers++;
  			$sum += $grade1;
  		}
  	if ( ($grade2 >= 1) && ($grade2 <= 5) )
  		{
  			$answers++;
  			$sum += $grade2;
  		}
  	if ( ($grade3 >= 1) && ($grade3 <= 5) ) 
  		{
  			$answers++;
  			$sum += $grade3;
  		}
  	if ( ($grade4 >= 1) && ($grade4 <= 5) )
  		{
  			$answers++;
  			$sum += $grade4;
  		}	
  	if ( ($grade5 >= 1) && ($grade5 <= 5) )
  		{
  			$answers++;
  			$sum += $grade5;
  		}	
  		
  	if ($answers != 0 )
  	{
  		$rank = $sum/$answers;
  		//get num of people answers and compute rank of workshop...
  		//....
  	}

  		
  			
  			$data[0] = $answer6;	// id
  			
  			$data[1] = $answer1;	//overall
  			$data[2] = $answer1_text;	//overall text 
  			
  			$data[3] = $answer2; 	//host
  			$data[4] = $answer2_text;	//host text
  			
  			$data[5] = $answer3;  //personal
  			$data[6] = $answer3_text;	//  personal text 
  			
  			$data[7] = $answer4;  //location
  			$data[8] = $answer4_text;	//  location text 
  			
  			$data[9] = $answer5;  //food
  			$data[10] = $answer5_text;	//  food text 
  			
  			$data[11] = $answer7;  //comments
  			$data[12] = $rank;  //rank (avarage)
  			$data[13] = time();	//time ,date
  			
			AddRecord("satorika_db", $data);     			// add the location
  			
			?>
		
			<script type="text/javascript" language="javascript">
   			window.location = 'thankyou.php';
   			</script>
   			<?php 
  		
  	
  	}  // close if submitted 


  if ($dont_show_form == false)
  {
 			
?>
	<br/>
	<div id="add_location_div" dir="rtl">
	<form enctype="multipart/form-data" name="fill_survey_form" id="fill_survey_form" method="post" action="survey.php">
	<input type="hidden" name="submitted" value="true"/>
	<table cellspacing="10">
	 <tr>
	 	<td><b>שם הסדנא  </b>
		<?php 
	 	//ShowDropDown("answer6",$ans6,$ans6,"","",$answer6);
	 	ShowColumnDropDown("workshops",0,2,$answer6,"","",-1);
	 	?>
	 	</td>
	</tr>
	
	<tr>
	 	<td><b>עד כמה היית שבע/ת רצון מהפעילות באופן כללי   </b>
	 	<div id="query_questions"></div>
	 	<?php 
	 	ShowDropDown("answer1",$ans1,$ans1,"","",$answer1);

	 	echo "<td><input type='text' name='answer1_text' value='$answer1_text' title='answer1_text'/></td>";
	 	?>
	 	</td>
	</tr>
	 
	<tr>
	 	<td><b>עד כמה היית שבע/ת רצון מהמנחה </b>
	 	<?php 
	 	ShowDropDown("answer2",$ans2,$ans2,"","",$answer2);

	 	echo "<td><input type='text' name='answer2_text' value='$answer2_text' title='answer2_text'/></td>";
	 	?>
	 	</td>
	</tr> 
	
	
	<tr>
	 	<td><b>עד כמה תכני הפעילות הוסיפו לך ברמה האישית </b>
	 	<?php 
	 	ShowDropDown("answer3",$ans3,$ans3,"","",$answer3);

	 	echo "<td><input type='text' name='answer3_text' value='$answer3_text' title='answer3_text'/></td>";
	 	?>
	 	</td>
	</tr>
	
	
	<tr>
	 	<td><b>עד כמה היית שבע/ת רצון מהמקום בו נערכה הפעילות, והתנאים הסביבתיים </b>
	 	<?php 
	 	ShowDropDown("answer4",$ans4,$ans4,"","",$answer4);

	 	echo "<td><input type='text' name='answer4_text' value='$answer4_text' title='answer4_text'/></td>";
	 	?>
	 	</td>
	</tr>
	
	
	<tr>
	 	<td><b>עד כמה היית שבע/ת רצון מרמת האוכל והכיבוד </b>
	 	<?php 
	 	ShowDropDown("answer5",$ans5,$ans5,"","",$answer5);

	 	echo "<td><input type='text' name='answer5_text' value='$answer5_text' title='answer5_text'/></td>";
	 	?>
	 	</td>
	</tr>
	  

	 <tr>
	 	<td><b>הערות</b></td>
	 <?php 	echo "<td><textarea type='text' name='answer7' value='$answer7' title='answer7' rows='8' cols='25' > </textarea> </td>"; ?>
	 </tr>
	  
	
	 <tr><td></td></tr>
	 <tr><td></td></tr>
	 </table>
	<br/>
	
  	<div class="centered_button_div"> 
		<div id="shiny-demo-green" class="demo-button" onclick="javascript:document.fill_survey_form.submit()";>שלח משוב<span/></div>
  	</div>
	</form>
	</div>
<?php } // closing the else ?>  
</div>   <!--  end of content -->
<?php 
footer();
?>
</body>
</html>
