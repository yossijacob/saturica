<!DOCTYPE html>
<?php
include_once 'functions.php';
include_once 'backoffice/connect.php';
include_once 'backoffice/db.php';
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
<title>סטוריקה</title>
<?php GoogleAnalytics();?>
</head>
<?php flush();?>
<body>
<?php
	HeaderFunc('locations');
	
	$where  = isset($_GET['whatodo_ddtext'])? $_GET['whatodo_ddtext']: "";
	$where = CleanText($where);
  	
    
    $Per_Page = 5;  // number of results per page.
    
    $Result_Set = isset($_GET['Result_Set'])? $_GET['Result_Set']: "0";
	$Result_Set = CleanText($Result_Set); // start display input from the 'result_set' location.
    
  	$Total = 0;
  	$i = 0; //for the foreach , and the boxA or boxB
  	
     

 	//just for counting the number of results	
 		$result = SearchWorkshopPlace($where,0,500);
 	
 	if ($result != null)
 	foreach ($result as $print_workshop)
 		$Total++;
 	  
     	$result = SearchWorkshopPlace($where,$Result_Set,$Per_Page);
	?>
	
	<div id="locations_wizard">
	<div id="locations_wizard_main">
	 <div id="locations_wizard_content"> 
		<div id="locations">
			<div id="search_locations_content">
            	<form action="locations.php" method="get" id="location_search_subject_form">
			            <span class="questions" id="locations_filter_Subjects">
                            : בחר איזור בארץ
                        </span>
			            <div id="locations_filter" class="location_wizard_dropdown"  onclick="show_dropdown('whattodo_ddlist')" >
                        	<?php 
                        	if(CheckIfIE()) 
                        	echo '<input id="whattodo_ddtext" class="dd_text_search" name="whatodo_ddtext" type="text" value=""  size="10"  readonly="readonly" style="margin-right:0.5cm;" />';
                        	else echo '<input id="whattodo_ddtext" class="dd_text_search" name="whatodo_ddtext" type="text" value=""  size="10"  readonly="readonly" style="margin-right:0.5cm; margin-top:-0.1cm;" />';
                        	?>
                        	<div id="whattodo_ddlist" class="dd_list" >

	                                <div class="my_ul">
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','צפון');">צפון</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','חיפה והסביבה');">חיפה והסביבה</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','אזור השרון');">אזור השרון</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','מרכז');">מרכז</a></div>
		                                <div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','ירושליים');">ירושליים</a></div>
	                               		<div class="my_li"><a onclick="setText('whattodo_ddtext','whattodo_ddlist','דרום');">דרום</a></div>
	                                </div>
                            </div>
                       </div>                           
                            <!-- sending the right parameters with the new location , to search page  -->
                         
                            <input class="Result_Set" name="Result_Set" type="hidden" value="0" />  
                             
                            <div id="location_harder_button" onclick="document.forms['location_search_subject_form'].submit();">  </div>            
                 </form>
           </div>			          
				             
		                <div id="locations_title">
		                    <div id="locations_title_text_A">
	                        :לוקיישנים
	                        </div>
	                        <div id="locations_title_small">
	                        	<div id="locations_title_text_B" dir="rtl">
	                        		<br/> <br/> 
	                        		יש לכם פעילות פנים ארגונית ואתם רק צריכים מקום בשבילה ?
	                        		<br/>
	                        		  הנה מגוון אתרים המותאמים לקיום סדנאות, הרצאות ופעילויות תוכן :
	                        	</div> 
	                        </div> 
	                     </div>
	                     
			                <ul id="locations_boxes">
			                <?php
			                $j=0; //for printing empty boxes
			                if ($result != null)
			                     foreach ($result as $print_workshop)
							     {
							     	echo "<li>";
							     	if ( ($i % 2) == 0)
							     		echo "<div id='locations_box_A'>";
							     	else echo "<div id='locations_box_B'>";
							     	echo "<div id='locations_workshop_img_box'>";
							     	 		if ($print_workshop[6] !="")
							     	 		{
							     	 			echo "<br/>";

							     	 			echo "<img src='backoffice/$print_workshop[6]' border=0 height=115px width=210px;>";
							     	 			//for home the path is 
 												//echo "<img src='../location_pic/$print_workshop[6]' border=0 height=115px width=210px;>";
							     	 		}
							     	echo "</div>";
							     	
									echo "<div id='locations_workshop_text_box'>";
							     	Print_Single_Location($print_workshop);
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
							     		echo "<div id='locations_box_A'>";
							     	else echo "<div id='locations_box_B'>";
							     	
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
					       
					      	echo "<a HREF=\"locations.php?Result_Set=$Res1&where=$where\"> קודם >> </a>"; 
					
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

					         echo "<a HREF=\"locations.php?Result_Set=$Res1&where=$where\"> <<  הבא </a>"; 

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
			<div id="buttom_contact_location_button" onclick="location.href='contact.php'"></div>
		</div>
	</div>
	</div>
	<?php
	FooterFunc();
	DialogBoxHtml();
	?>
</body>
</html>