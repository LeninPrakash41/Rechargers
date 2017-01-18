<?php
require("serverconfig.inc");
$verify = mysql_real_escape_string(urldecode($_POST['verify']));
$verifymail = urldecode($_POST['email']);
$newpwd=urldecode($_POST['newpwd']);
$confirmpwd=urldecode($_POST['confirmpwd']);
$code=preg_replace('/(^[\"\']|[\"\']$)/', '', urldecode($_POST['verify']));

if ($_POST)
 {
   
		$r = strcmp($newpwd,$confirmpwd);
	   if($r == 0)  //passwords match
	   { 
         $resetpwd = "Update users set password = '".$newpwd."' where username = '".$verifymail."'";
         if(mysql_query($resetpwd))
        {
	   $removeverifystring = "Update users set forgotpwd = '',linktime=null where username = '" .$verifymail."'";
	   mysql_query($removeverifystring);
       echo "<b> Your password has been reset successfully. Login with your new password. </b>" ;	  
	  }
	 
	 }
	 else 
	 {
	 echo "<b> Passwords do not match. </b>" ;
  }
  
   }
   else
    {
	  echo "Error";
	 } 
  ?>
    