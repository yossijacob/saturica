<!DOCTYPE html>
<?php 
include_once 'functions.php';
include_once '../connect.php';
include_once '../mysql.php';		//change to the correct location ! 

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
	$whatodo = $_GET['whatodo_ddtext'];
  	$whatodo = CleanText($whatodo);
  	
  	$howmany = $_GET['howmany_text'];
  	$howmany = CleanText($howmany);
  	
  	$where = $_GET['where_ddtext'];
  	$where = CleanText($where);
  	
  	$howlong = $_GET['howlong_ddtext'];
  	$howlong = CleanText($howlong);
  	
    $whatbudget = $_GET['whatbudget_ddtext'];
  	$whatbudget = CleanText($whatbudget);	
  
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
			
			                 <li>
			                         <div id="results_box_A">
				           			 
				           			 <div id="get_details_button" onclick="location.href='index.php'"></div>
				            		</div>
				           	 </li>
				           	 
				             <li>
			                         <div id="results_box_B">
				           			  
				           			 <div id="get_details_button" onclick="location.href='index.php'"></div>
				           			 
				            		</div>
			                   	  </li>
			                   <li>
			                         <div id="results_box_A">
				           			 
				           			 <div id="get_details_button" onclick="location.href='index.php'"></div>
				            		</div>
				            	</li>
				            	<li>
			                         <div id="results_box_B">
				           			 
				           			 <div id="get_details_button" onclick="location.href='index.php'"></div>
				            		</div>
			                   	  </li>
			                   	  
			                   	  
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