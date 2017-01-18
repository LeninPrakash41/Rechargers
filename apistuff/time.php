<?php
$timezone = "Asia/Kolkata";
if(function_exists('date_default_timezone_set')) 
date_default_timezone_set($timezone);
$date= date('d-m-Y');
$time=date('H:i:s');
echo $date;
echo $time;

/*
$timezone = new DateTimeZone("Asia/Kolkata" );
$date = new DateTime();
$date->setTimezone($timezone );
echo  $date->format( 'H:i:s A  /  D, M jS, Y' );
?> 


$date=$datetime->format( 'H:i:s A  /  D, M jS, Y' );
$time=$datetime->format( 'H:i:s A  /  D, M jS, Y' );
*/
?>
