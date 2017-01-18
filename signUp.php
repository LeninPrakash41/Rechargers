<?php 
require("serverconfig.inc");
if($_POST){
	$username=mysql_real_escape_string($_POST['username']);
	$password=mysql_real_escape_string($_POST['password']);
	
	//if($sql){
	
	$randomstring ='';
   for ($i = 0; $i <8 ; $i++)
    {
	  $randomstring .=chr(mt_rand(65,90));
	}
	$verifyurl = "verifymail.php";
	$verifystring = urlencode($randomstring);
	$verifyemail = urlencode($username);
    $mail_body = 	'Hi,
	 
	 Please click on the following link to verify your mail:
     <a href="http://www.rechargers.co.in/'.urldecode($verifyurl).'?email='.urldecode($verifyemail).'&verify='.urldecode($verifystring).'">http://www.rechargers.co.in/'.urldecode($verifyurl).'?email='.urldecode($verifyemail).'&verify='.urldecode($verifystring).'</a>';
      require("class.phpmailer.php");
      require("class.smtp.php");
	 $mailer = new PHPMailer();
	 //$mailer->IsSMTP();
	 //$mailer->SMTPAuth =TRUE;
	 //$mailer->SMTPSecure = 'ssl';
	 //$mailer->Host = "smtp.gmail.com";  //localhost
     //$mailer->Port = 465;
	 //$mailer->SMTPDebug  = 1;
	 $mailer->SetFrom('care@rechargers.co.in', 'Rechargers ');
	 $mailer->Username ="care@rechargers.co.in";//sender email address
	 $mailer->Password ="iamchargedup";//sender password
	 //$mailer->From = "care@rechargers.co.in";//sender email address
	 //$mailer->FromName ="Rechargers";// From name in the email
     $mailer->IsHTML(true);
	 $mailer->Body =$mail_body;
	 $mailer->Subject = "Email Verification";
	 $mailer->AddAddress($_POST['username']); // email id of user
	 if(!$mailer->Send())
	  {
	    echo "error";
	  }
	 else
	  {   // $timezone = "Asia/Kolkata";
			//	if(function_exists('date_default_timezone_set')) 
				//	date_default_timezone_set($timezone);
				//	$time= date('Y-m-d H:i:s');
					
	    	//$sql=mysql_query("Update users set verified= 1 WHERE username='$username'");
	    //echo"  A link has been send to the address you entered below .Link is valid for 10 minutes only. Please follow the link in the email to reset the password for your account" ;
		$sql=mysql_query("INSERT INTO users (username, password,verified,verify_code)
						VALUES
						('$username','$password',0,'$randomstring')");
						
		//echo "verify";
		echo "A link has been send to the address you entered .Please follow the link in the email to verify your account";
	  }
		  
	       
	
		//echo "signedUp";
			
			//$expire=time()+86400;
			
			//setcookie("username",$username,$expire);
		
	//}
}
?> 