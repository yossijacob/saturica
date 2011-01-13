<!DOCTYPE html>
<?php 
include_once 'functions.php';
include_once '../connect.php';
include_once '../mysql.php';		//change to the correct location ! 
include_once '../html.php';			//for the printworkshop function. maybe would be better to place the func at functions.php

connect();   //connect to mysql DB
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
	HeaderFunc('empty');
	
	//get the input to search at the DB 
	$whattodo = $_GET['whatodo_ddtext'];
  	$whattodo = CleanText($whattodo);
  	
  	$howmany = $_GET['howmany_text'];
  	$howmany = CleanText($howmany);
  	
  	$where = $_GET['where_ddtext'];
  	$where = CleanText($where);
  	
  	$howlong = $_GET['howlong_ddtext'];
  	$howlong = CleanText($howlong);
  	
    $whatbudget = $_GET['whatbudget_ddtext'];
  	$whatbudget = CleanText($whatbudget);

    $lowval = null;
    $highval = null;
  
  	
 
  	
	 
  	$i = 0; //for the foreach , and the boxA or boxB
  	
     if ($whatbudget != null)
     {
          $prices[0] = "פחות מ 50";		// for the places dropdown boxes
		  $prices[1] = "50 -100";
		  $prices[2] = "100 - 200";
		  $prices[3] = "200 - 300";
		  //$prices[4] = "350-500";
		  $prices[4] = "מעל 300";
					
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
  				$highval = 100;
  				
  				
  			}
  			
  		  	if ($whatbudget == $prices[2])
  			{
  				$lowval= 100;
  				$highval = 200;
  			}
  		  	
  			if ($whatbudget == $prices[3])
  			{
  				$lowval = 200;
  				$highval = 300;		
  			}
  			
  		  	if ($whatbudget == $prices[4])
  			{
  				$lowval = 300;
  				$highval = 5000000;
  			}

 	}
                    
          
     $result = SearchAllParams_Workshop($whattodo,$where,$howlong,$lowval,$highval,$howmany);

     


	?>
	<div id="results_wizard">
	 <div id="results_wizard_content">
	 
	 
		<div id="results">
				       <div id="search_results_content">
                       <form action="index.html" method="set">
			            <span class="questions" id="filter_Subjects">
                            : סנן נושאי פעילות
                        </span>
			                <div id="filter" class="dropdown"  onclick="show_dropdown('whattodo_ddlist')" >
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
                       </div>
		
		
		
		
				       <div>  
				           <ul id="results_boxes">
				        	<div id="search_harder_button" onclick="location.href='index.php'"></div>
				           
				             <li> 
					                <div id="results_title">
				                        :אלה הפעילויות המתאימות לבחירה שלך
				                        <div id="results_title_small">
				                        </br> </br> ?רוצה למקד את החיפוש עוד יותר
				                        </div> 
				                     </div>
			                 </li> 
			
			                
			                
			                <?php
			                if ($result != null)
			                     foreach ($result as $print_workshop)
							     {
							     	echo "<li>";
							     	if ( ($i % 2) == 0)
							     		echo "<div id='results_box_A'>";
							     	else echo "<div id='results_box_B'>";
									
							     	Print_Single_Workshop($print_workshop);
							     	echo "<div id='get_details_button' onclick='location.href='index.php''></div>";
			                        echo "</div>";
			                         $i++; 
									echo "</li>";       
							      }
							  ?>		                
			                
  
			                   	  
			               </ul> 
               		   </div>  
		
		
		
		</div>
		
		
	
	</div>
		

	</div>
	
	

	<div id="bottom">
	</div>
	<div id="buttom_search">
	<div id="buttom_search_content">
	</br>
	?לא מצאת את מה שחיפשת
	<div id="buttom_search_button" onclick="location.href='index.php'"></div>
	<div id="buttom_contact_button" onclick="location.href='contact.php'"></div>
	</div>
	</div>
	<?php
	FooterFunc();
	?>
</body>
</html>