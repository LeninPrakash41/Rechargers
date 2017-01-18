<?php 
require("serverconfig.inc");
if($_POST){
	$username=mysql_real_escape_string($_POST['username']); $rcCash=0;
	$sql=mysql_query("SELECT * FROM users WHERE username='$username'");
	if(mysql_num_rows($sql)>0){
		while($info=mysql_fetch_assoc($sql)){
			$rcCash=$info['rc_cash'];
		}
	echo $rcCash;
	}
}
?>