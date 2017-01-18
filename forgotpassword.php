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
	<div class="rcBox">
	<!--<div class="content">-->
   <form>
   
   <div class="email">
   <label for="Email">Email</label><br>
   <input type="text" name="email" id="emailIn"> <br/>
   </div>
   
   <center><input type="button" class="button" value="Send Recovery Link" onclick="validateEmail();"></center>
   <br/><br/> <br/>   
   
	<div id="test" class="test" > 
     
	 
    </div>  
   
   </form>
   <!--</div>-->
    </div>
   	 <!-- End rcBox-->
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
   <script type="text/javascript">
  
  function validateEmail()
 { var username= document.getElementById("emailIn").value;
   if(username.length != 0)
   {
   $.ajax({
				type: "POST",
				url: "forgotprocess.php",
				data: "username="+username,
				success: function(result){
								$("#test").html(result);
								  document.getElementById("emailIn").value="";
								 } , 
		        error: function(xhr){
      					alert("An error occured: " + xhr.status + " " + xhr.statusText);
					}
		   });
	   
  }
  else
   {document.getElementById("test").innerHTML="Enter email. It cannot be blank";
    }
	}
  
 </script>
</body> 
   </html>