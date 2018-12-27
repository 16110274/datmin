<?php
//place this before any script you want to calculate time
$time_start = microtime(true); 

//sample script
for($i=0; $i<1000; $i++){
 //do anything
}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
// if you get weird results, use number_format((float) $execution_time, 10) 	
?>