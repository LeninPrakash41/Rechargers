<?php 
require("../serverconfig.inc");
if($_POST){
	$orderId=mysql_real_escape_string($_POST['orderId']);
	$sql=mysql_query("SELECT * FROM recharge WHERE order_no='$orderId'");
	if(mysql_num_rows($sql)>0){
		$info=mysql_fetch_assoc($sql);
		echo $info['status'];
	}
}
?>