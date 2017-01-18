<?php 
require("serverconfig.inc");
if($_POST){
	$username=mysql_real_escape_string($_POST['username']);
	$sql=mysql_query("SELECT * FROM users WHERE username='$username'");
	if(mysql_num_rows($sql)>0){
		echo "checked";
	}
}
?>