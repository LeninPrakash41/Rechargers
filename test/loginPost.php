<?php 
require("serverconfig.inc");
if($_POST){
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);
	$sql=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
	if(mysql_num_rows($sql)>0){
		echo "login";
		while($info=mysql_fetch_assoc($sql)){
			
			$username=$info['username'];
			$expire=time()+86400;
			
			setcookie("username",$username,$expire);
		}
	}
}
?>