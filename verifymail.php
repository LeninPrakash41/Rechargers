<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rechargers</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="styleforgot.css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script src="jquery.cookie.js"></script>
<script type="text/javascript" src="home.js"></script>

</head>

<body onload="checkUser()">
<div class="wrapOverall">
    
        <div class="header">
       	  <a href="index.php"><img class="logo" src="images/header_logo.png" width="274" height="64" alt="rechargers" /></a>
        	
       	  <div class="navMain">
          		<div class="navOpt" style="display:none">
                	<a href="orderhistory.php">Order History</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            		<a href="#" id="logout">Logout</a>
                </div>
            	<a href="#" id="username"></a>
            	
            </div> <!-- End navMain-->
        
        </div> 
    <!-- End header-->
<?php
require("serverconfig.inc");
$code=preg_replace('/(^[\"\']|[\"\']$)/', '', urldecode($_GET['verify']));
$verifymail = preg_replace('/(^[\"\']|[\"\']$)/', '', urldecode($_GET['email']));
$sql = "select * from users where username = '".$verifymail."' and verify_code='".$code."'";	  
$sql = "select * from users where username = '".$verifymail."' and verify_code='".$code."'";	  
$result = mysql_query($sql);
$numrows = mysql_num_rows($result);
/*$sql = "SELECT date_format(linktime,'%Y') as y,date_format(linktime,'%m') as mon,date_format(linktime,'%d') as d,date_format(linktime,'%H') as                h,date_format(linktime,'%i') as min FROM `users`  where forgotpwd = '".$code."' and username = '".$verifymail."'";	  
$timezone = "Asia/Kolkata";
				if(function_exists('date_default_timezone_set')) 
					date_default_timezone_set($timezone);
$y1= date('Y');
$m1= date('n');
$d1= date('d');
$h1= date('H');
$min1=date('i');		
$info = mysql_query($sql);
$result = mysql_fetch_assoc($info);
$y=$result['y'];
$m=$result['mon'];
$d=$result['d'];
$h=$result['h'];
$min2=$result['min'];
 echo $y.$m.$d.$h.$min2;
 //echo $y1.$m1.$d1.$h1.$min1;*/
		if ($numrows == 1)// and $y == $y1 and $m==$m1 and $d==$d1 and $h==$h1 )  //link is valid and ($min1-$min2) <= 10
          
		  {
		   $result=mysql_query("Update users set verified= 1  WHERE username='$verifymail' and verify_code='$code'");
		   
		   $result=mysql_query("Update users set verify_code='' WHERE username='".$verifymail."'");
		   ?>
		   
            <div class="rcBox"> 
			<center><font size='5' color=#339900>Your account has been verified. <a href='index.php'>Click here to login </a></font></center>
			</div>
			<!-- End rcBox-->
			<?php
		}
  else
    { 
	  echo "Link is invalid".$code.$verifymail;
	 }
?>	 
<div class="rcBoxB" style="display:none">	<!---->	
       <!-- The recharge box -->
            <center>
	 <div id="rcBoxHeader">
                <label for="header" id="rcBox_header">Recharge for your prepaid mobile</label><br>
            
                <div id="rcInfo">
                </div><br/>
                <img src="images/divider1.png">
            </div>
        	</center>
            
            
            <div class="signinpay">
            		<div class="signed" style="display:none"><!--     -->
                        <center><div class="coupons">
                        <input type="checkbox" id="coupons" name="coupons" />
            			<label for="coupons"><span></span>Select Coupons</label>
                        </div> <img src="images/divider1.png">
                        </center>
                        <div class="payment">
                            <label for="Amount">Select a payment option:</label><br />
                           <br/><center><div id="cashBal" style="display:none"><br/><br/></div>
                            <input type="radio" id="rcCash" name="payOpt" value="rcCash"/>
                          <label for="rcCash"><span></span>RC Cash</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <input type="radio" id="dCard" name="payOpt" value="dCard"/>
                            <label for="dCard"><span></span>Debit / ATM Card</label>
                            <div id="errPay" style="display:none">
                            	<label for="Payment option error" class="error" >Please select a payment option.</label>
                        	</div> </center>
                        </div>
                            <center><input class="button" type="submit" value="Proceed to pay"></center>
                   	</div>
        			<div class="unsigned">
                    	<div id="unsignHead">
                        <br/>
                        <center>Sign In or sign up to continue</center>
                        </div>
                        <div id="fbconnect">
                        <input type="button" class="fbconnect" value="Login with facebook">
                        </div>
                        <center><img src="images/or.png"></center>
                        <div class="email">
                            <label for="Email">Email</label><br>
                    		<input type="text" name="email" id="emailIn"/> 
                            <div id="errEmail" style="display:none">
                                <label for="Email error" class="error" >Please enter a valid email id.</label>
                            </div>
                        </div>
                        <div class="pass">
                            <label for="password">Password</label><br>
                    		<input type="password" name="password" id="passIn"/>
                             
                            <div id="errPass" style="display:none">
                        		<label for="Password error" class="error" >Minimun 4 characters</label>
                            </div>
                        </div>
                        <center><input class="button" type="button" id="signIn" value="Sign In / Up and continue" /><br/><br/>
                         
						 <a href="forgotpassword.php">Forgot Password</a>&nbsp;&nbsp;  <!-- Forgot password --> </center>
					</div>
            </div>
       </div>
   	 <!-- End rcBox B-->
</body>
</html> 