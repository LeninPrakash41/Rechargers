<?php

//if($_POST)
//{  
 	
	
	$username='riddhi@rechargers.co.in';
	
$mail_body = 	'Hi,
	 Test mail';
require("class.phpmailer.php");
require("class.smtp.php");
	//-- $mailer = new PHPMailer();
	 //--$mailer->IsMail(); // telling the class to use SendMail transport

	 //$mailer->IsSMTP();
	 //$mailer->SMTPAuth =TRUE;
	 //$mailer->SMTPSecure = 'ssl';
	 //$mailer->Host = "smtp.gmail.com";  //localhost
     //$mailer->Port = 465;
	 //$mailer->SMTPDebug  = 1;
	 //--$mailer->SetFrom('riddhi1@rechargers.co.in', 'Rechargers ');
	 //$mailer->Username ="rechargerstest@gmail.com";//sender email address
	 //$mailer->Password ="testing@123";//sender password
	 //$mailer->From = "care@rechargers.co.in";//sender email address
	 //$mailer->FromName ="Rechargers";// From name in the email
     //--$mailer->IsHTML(true);
	 //--$mailer->Body =$mail_body;
	 //$mailer->MsgHTML($mail_body);
	 //--$mailer->Subject = "Test";
	 //--$mailer->AddAddress($username); // email id of user
	 $subject="Test using mail";
	  $headers= "MIME-Version: 1.0"."\r\n";
	  $headers.="Contents-type:text/html;
	  charset=iso-8859-1"."\r\n";
	  $headers.="From: care@rechargers.co.in"."\r\n";
	  $headers.="Reply-To: care@rechargers.co.in"."\r\n";
	  $headers.="X-Mailer:PHP/".phpversion();
	  $headers.="X-Priority: 1"."\r\n";
	  mail('riddhi@rechargers.co.in',$subject,$mail_body,$headers);
	 /*if(!$mailer->Send())
	  {
	   echo "Message was not send . Mailer Error: ".$mailer->ErrorInfo;
	  }
	 else
	  {    echo "Successful sent to ".$username;
	  }*/
	 if(!(mail('riddhi@rechargers.co.in',$subject,$mail_body,$headers)))
	  {
	   echo "Message was not send . Mailer Error: ".$mailer->ErrorInfo;
	  }
	   else
	  {    echo "Successful sent to ".$username;
	  } 
	//}	
		
   	
	
   ?>
		
		

