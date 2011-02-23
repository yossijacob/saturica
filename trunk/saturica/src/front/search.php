<!DOCTYPE html>
<?php
 
include_once 'functions.php';
include_once 'backoffice/connect.php';
include_once 'backoffice/mysql.php';		//change to the correct location ! 
include_once 'backoffice/html.php';			//for the printworkshop function. maybe would be better to place the func at functions.php

connect();   //connect to mysql DB
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
SetupJqueryContactDialogCss();
SetupJquery();
SetupJqueryContactDialog();
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
<?php
	HeaderFunc('empty');
	
	$Free_search = $_GET['Free_search'];  // start display input from the 'result_set' workshop.
  	$Free_search = CleanText($Free_search);
  	
  	if ($Free_search == 1)	// we here through free search so get the right var from the url
  	{
  		$searchString = $_GET['searchString'];
  		$searchString = CleanText($searchString);	
  	}		
  	else
  	{
	//get the input to search at the DB 
	$whattodo = $_GET['whatodo_ddtext'];
  	$whattodo = CleanText($whattodo);
  	
  	$howmany = $_GET['howmany_text'];
  	$howmany = CleanText($howmany);
  	
  	$where = $_GET['where_ddtext'];
  	$where_for_resend = $_GET['where_ddtext'];
  	$where = CleanText($where);
  	
  	$howlong = $_GET['howlong_ddtext'];
  	$howlong = CleanText($howlong);
  	
    $whatbudget = $_GET['whatbudget_ddtext'];
  	$whatbudget = CleanText($whatbudget);

    $lowval = null;
    $highval = null;   
  	}
    
    $Per_Page = 5;  // number of results per page.
  	$Result_Set = $_GET['Result_Set'];  // start display input from the 'result_set' workshop.
  	$Result_Set = CleanText($Result_Set);
 
  	$Total = 0;
  	$i = 0; //for the foreach , and the boxA or boxB
  	
     if ( ($Free_search == 0) && ($whatbudget != null) )
     {
          $prices[0] = "פחות מ 50";		// for the places dropdown boxes
		  $prices[1] = "50 -150";
		  $prices[2] = "150 - 250";
		  $prices[3] = "250 - 350";
		  $prices[4] = '350-500';
		  $prices[5] = "מעל 500";
					
		  $col="personal_price";
		  $result='';

           	if ($whatbudget == $prices[0])
  			{
  				$lowval = 0;
  				$highval = 50;				
  			}
  			
  			if ($whatbudget == $prices[1])
  			{
  				$lowval = 50;
  				$highval = 150;
  			}
  			
  		  	if ($whatbudget == $prices[2])
  			{
  				$lowval= 150;
  				$highval = 250;
  			}
  		  	
  			if ($whatbudget == $prices[3])
  			{
  				$lowval = 250;
  				$highval = 350;		
  			}
  			
  		  	if ($whatbudget == $prices[4])
  			{
  				$lowval = 350;
  				$highval = 500;
  			}
       		if ($whatbudget == $prices[5])
  			{
  				$lowval = 500;
  				$highval = 5000000;
  			}
 	}

 	//just for counting the number of results
 	if ($Free_search == 0)	// regular search 	
 		$result = SearchAllParams_Workshop($whattodo,$where,$howlong,$lowval,$highval,$howmany,0,500);
 	else // free search function 
 		$result = SearchFreeText("description_text","name","subject",$searchString,0,500);
 		
 	if ($result != null)
 	foreach ($result as $print_workshop)
 		$Total++;
 	
     if ($Free_search == 0)	// regular search      
     	$result = SearchAllParams_Workshop($whattodo,$where,$howlong,$lowval,$highval,$howmany,$Result_Set,$Per_Page);
	 else // free search function 
 		$result = SearchFreeText("description_text","name","subject",$searchString,$Result_Set,$Per_Page);      
	?>
	
	<div id="results_wizard">
	<div id="results_wizard_main">
	 <div id="results_wizard_content"> 
		<div id="results">
			<div id="search_results_content">
            	<form action="search.php" method="get" id="search_subject_form">
			            <span class="questions" id="filter_Subjects">
                            : סנן נושאי פעילות
                        </span>
			            <div id="filter" class="search_wizard_dropdown"  onclick="show_dropdown('whattodo_ddlist')" >
                        	<input id="whattodo_ddtext" class="dd_text_search" name="whatodo_ddtext" type="text" value=""  size="10"  readonly="readonly" style="margin-right:0.5cm;" />
                        	<div id="whattodo_ddlist" class="dd_list" onmousemove="show_dropdown('whattodo_ddlist')" onmouseout="hide_list('whattodo_ddlist')" >

	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','גיבוש ועבודת צוות');">גיבוש ועבודת צוות</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','פיתוח מנהלים');">פיתוח מנהלים</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','פיתוח עובדים');">פיתוח עובדים</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','הרצאות');">הרצאות</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','פעילות מיוחדת למורים');">פעילות מיוחדת למורים</a></div>
	                               		<div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','מפגש העשרה חוויתי');">מפגש העשרה חוויתי</a></div>
	                                </div>
                            </div>
                       </div>                           
                            <!-- sending the right parameters with the new subject , to search page  --> 
                            <input class="howmany_text" name="howmany_text" type="hidden" value="<?php echo $howmany ?>" >  
                            <input id="where_ddtext" class="dd_text" name="where_ddtext" type="hidden" value="<?php echo $where_for_resend ?>"   >
                            <input id="howlong_ddtext" class="dd_text" name="howlong_ddtext" type="hidden" value="<?php echo $howlong?>"   >
                        	<input id="whatbudget_ddtext" class="dd_text" name="whatbudget_ddtext" type="hidden" value="<?php echo $whatbudget ?>"    >
                            <input class="Result_Set" name="Result_Set" type="hidden" value="0" />
                            <input class="Free_search" name="Free_search" type="hidden" value="0" />
                             
                            <div id="search_harder_button" onclick="document.forms['search_subject_form'].submit();">  </div>            
                 </form>
           </div>			          
				             
		                <div id="results_title">
		                    <div id="results_title_text_A">
	                        :אלה הפעילויות המתאימות לבחירה שלך
	                        </div>
	                        <div id="results_title_small">
	                        <div id="results_title_text_B">
	                        <br/> <br/> ?רוצה למקד את החיפוש עוד יותר
	                        </div> 
	                        </div> 
	                     </div>
	                     
			                <ul id="results_boxes">
			                <?php
			                $j=0; //for printing empty boxes
			                if ($result != null)
			                     foreach ($result as $print_workshop)
							     {
							     	echo "<li>";
							     	if ( ($i % 2) == 0)
							     		echo "<div id='results_box_A'>";
							     	else echo "<div id='results_box_B'>";
							     	echo "<div id='results_workshop_img_box'>";
							     	 		if ($print_workshop[3] !="")
							     	 		{
							     	 			echo "<br/>";
 												echo "<img src='../workshop_pic/$print_workshop[3]' border=0 height=115px width=210px;>";
							     	 		}
							     	echo "</div>";
							     	
									echo "<div id='results_workshop_text_box'>";
							     	Print_Single_Workshop($print_workshop);
							     	echo "</div>";
							     	?>
							     	<div id='get_details_button' class='get_offer' alt="<?php echo $print_workshop[2];?>"> </div>
			                        <?php 
			                        echo "</div>";
			                         $i++;
			                         if ($j == 5) $j=0;
			                         $j++;	//for printing empty boxes  
									echo "</li>";       
							      }	
			                

							      while ($j <5)
							      {
							      	echo "<li>";
							      	if ( ($i % 2) == 0)
							     		echo "<div id='results_box_A'>";
							     	else echo "<div id='results_box_B'>";
							     	
							     	echo "</div>";
							      	$i++;
							      	$j++;
							      	echo "</li>";
							      }
					   ?>	 
			               </ul>      
              </div>           	
          </div>
          </div>
      </div>
			
		<?php 
				//	echo "<div id='NextPrevious' >vsdvdvd   </div>";
		
				  //maybe need  to be under the li div div......
							 // Create Next / Prev Links and $Result_Set Value 
					if ($Total>0) 
					   { 
					   if ($Result_Set<$Total && $Result_Set>0) 
					      { 
					      echo "<div id='Prev_next_Style'>";
					       echo "<div id='Prev_next_Style_main'>";		
					      echo "<div id='PrevStyle'>";
					      $Res1=$Result_Set-$Per_Page;
					      if ($Free_search == 0)  

					      	echo "<a HREF=\"search.php?Result_Set=$Res1&whatodo_ddtext=$whattodo&howmany_text=$howmany&where_ddtext=$where&howlong_ddtext=$howlong&Free_search=$Free_search&whatbudget_ddtext=$whatbudget\"> קודם >> </a>"; 

					      else 
					      	echo "<a HREF=\"search.php?Result_Set=$Res1&Free_search=$Free_search&searchString=$searchString\"> קודם >> </a>";
					      	echo"</div>";
					      echo"</div>";
					      echo"</div>";
					      } 
					   if ($Result_Set>=0 && $Result_Set<$Total) 
					      { 
					      $Res1=$Result_Set+$Per_Page; 
					      if ($Res1<$Total) 
					         { 
					         echo "<div id='Prev_next_Style_main'>";	
					         echo "<div id='NextStyle'>";
					         if ($Free_search == 0)  	

					         	echo "<a HREF=\"search.php?Result_Set=$Res1&whatodo_ddtext=$whattodo&howmany_text=$howmany&where_ddtext=$where&howlong_ddtext=$howlong&Free_search=$Free_search&whatbudget_ddtext=$whatbudget\"> <<  הבא </a>"; 

					         else 
					         	echo "<a HREF=\"search.php?Result_Set=$Res1&Free_search=$Free_search&searchString=$searchString\"> <<  הבא </a>";
					         	echo"</div>";
					         	echo"</div>";
					         } 
					      } 
					   }   	
		?>

	<div id="buttom_search">
	<div id="buttom_search_main">
		<div id="buttom_search_content">
			<br/>
			?לא מצאת את מה שחיפשת
			<div id="buttom_search_button" onclick="location.href='index.php'"></div>
			<div id="buttom_contact_button" onclick="location.href='contact.php'"></div>
		</div>
	</div>
	</div>
	<?php
	FooterFunc();
	DialogBoxHtml();
	?>
</body>
</html>