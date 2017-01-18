<?php
require("serverconfig.inc");

$timezone = "Asia/Kolkata";
			if(function_exists('date_default_timezone_set')) 
			date_default_timezone_set($timezone);
			$date= date('Y-m-d');
			$time=date('H:i:s');

$record=mysql_query("INSERT INTO recharge (email,mobile_no,trans_date,trans_time,amt,status)
							VALUES
							('hello','999999999','$date','$time','88','processing')");
				if($record)			
				{echo "successfull";}else{echo "unsucessfull";}
?>
