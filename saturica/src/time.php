<?php

function DateToPosTime($date)
{	// return the pos time number of seconds from 1970 for the date enterd
	$date_arr =explode("/", $date);
	$month = $date_arr[0];
	$day = $date_arr[1];
	$year = $date_arr[2];
	return mktime(0,0,0,$month,$day,$year);
}
//********************************************************************

?>