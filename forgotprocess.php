<?php
require("serverconfig.inc");
if($_POST)
{  
 	$username=mysql_real_escape_string($_POST['username']);
	$sql=mysql_query("SELECT * FROM users WHERE username='$username'");
	if(mysql_num_rows($sql)>0)
    {
   $row = mysql_fetch_assoc($sql);
   $validusername = $sql['username'];
   $randomstring ='';
   for ($i = 0; $i <8 ; $i++)
    {
	  $randomstring .=chr(mt_rand(65,90));
	}
	$verifyurl = "resetpassword.php";
	$verifystring = urlencode($randomstring);
	$verifyemail = urlencode($_POST['username']);
$mail_body = 	'Hi,
	 A request has been made to reset the password for your account.
	 Please click on the following link to password reset page:
     <a href="http://www.rechargers.co.in/'.urldecode($verifyurl).'?email='.urldecode($verifyemail).'&verify='.urldecode($verifystring).'">http://www.rechargers.co.in/'.urldecode($verifyurl).'?email='.urldecode($verifyemail).'&verify='.urldecode($verifystring).'</a>';
require("class.phpmailer.php");
require("class.smtp.php");
	 $mailer = new PHPMailer();
	 //$mailer->IsSendmail(); // telling the class to use SendMail transport

	// $mailer->IsSMTP();
	// $mailer->SMTPAuth =TRUE;
	// $mailer->SMTPSecure = 'ssl';
	// $mailer->Host = "smtp.gmail.com";  //localhost
    // $mailer->Port = 465;
	// $mailer->SMTPDebug  = 1;
	 $mailer->SetFrom('care@rechargers.co.in', 'Rechargers ');
	 $mailer->Username ="care@rechargers.co.in";//sender email address
	 $mailer->Password ="iamchargedup";//sender password
	 //$mailer->From = "care@rechargers.co.in";//sender email address
	 //$mailer->FromName ="Rechargers";// From name in the email
     $mailer->IsHTML(true);
	 $mailer->Body =$mail_body;
	 //$mailer->MsgHTML($mail_body);
	 $mailer->Subject = "User Verification";
	 $mailer->AddAddress($_POST['username']); // email id of user
	/* $headers="MIME-Version: 1.0"."\r\n";
	 $header.="Content-type:text/html;charset=UTF-8"."\r\n";
	 $header.='From:care@rechargers.co.in';
	 
	 mail($_POST['username'],"User Verification",$mail_body,$header);*/
	 if(!$mailer->Send())
	  {
	   echo "Message was not send . Mailer Error: ".$mailer->ErrorInfo;
	  }
	 else
	  {    $timezone = "Asia/Kolkata";
				if(function_exists('date_default_timezone_set')) 
					date_default_timezone_set($timezone);
					$time= date('Y-m-d H:i:s');
					
	    	$sql=mysql_query("Update users set forgotpwd='$randomstring',linktime='$time' WHERE username='$username'");
	    echo"  A link has been send to the address you entered below .Link is valid for 10 minutes only. Please follow the link in the email to reset the password for your account" ;
	  }
	 
	    }
		
		else
		 {  echo "We could not find any registered email with email id as " .$username. 
	                     "Please enter a valid email id and try again.";
		 }
   }	
	
   ?>
		
		
