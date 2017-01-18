<?php 
require("serverconfig.inc");
if($_POST){
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);
	$sql=mysql_query("INSERT INTO users (username, password)
						VALUES
						('$username','$password')");
	if($sql){
		echo "signedUp";
			
			$expire=time()+86400;
			
			setcookie("username",$username,$expire);
		
	}
}
?>