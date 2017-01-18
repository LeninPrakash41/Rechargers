<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rechargers</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
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
        <form method="post" action="process.php" onsubmit="return validateForm()">
   	 <div class="rcBox">		
       <!-- The recharge box -->
       	<center>
        <label id="rcBox_header">Recharge your prepaid mobile</label><br>							
        </center>
        	<div class="mobNo">
            	<label for="Mobile Number">Mobile Number</label><br>
                <input type="text" name="mobNo" id="mobNoin" maxlength="10" autocomplete='off' onkeypress='numeric_val(event)' onkeyup="mobOpsuggest(this.value)" /> 
                <div id="errMob" style="display:none">
                	<label for="Mobile Number error" class="error" >Please enter a valid mobile number.</label>
                </div>          
            </div>
            <div class="mobOp">
            	<label for="Mobile Operator">Mobile Operator</label><br>
                
                <select name="sel_op" id="selOp" onchange="OpRcsuggest(this.value)"> <!-- class="sel_op_drop" -->
                		<option value="Select operator" selected="yes">Select Operator</option>
                        <option value="AT">Airtel</option>
                       <option value="AL">Aircel</option>
                       <option value="BS">BSNL</option>
                       <option value="BSS">BSNL Special/Validity</option>
                       <option value="ID">Idea</option>
                       <option value="VF">Vodafone</option>
                       <option value="TD">Docomo GSM</option>
                       <option value="TDS">Docomo Special GSM</option>
                       <option value="TI">Docomo CDMA</option>
                        <option value="RG">Reliance GSM</option>
                       <option value="RL">Reliance CDMA</option>
                  		<option value="MS">MTS</option>
                      <option value="UN">Uninor</option>
                       <option value="UNS">Uninor Special</option>
                       <option value="LM">Loop Mobile</option>
                      <option value="VD">Videocon</option>
                       <option value="VDS">Videocon Special</option>
                       <option value="MTD">MTNL Delhi</option>
                       <option value="MTDS">MTNL Delhi Special</option>
                       <option value="MTM">MTNL Mumbai</option>
                        <option value="MTMS">MTNL Mumbai Special</option>
                       <option value="TW">Tata Walky</option>
				</select> 
            
            	<div id="errOp" style="display:none">
                	<label for="Operator select error" class="error">Please select an operator</label>
                </div>
                
            </div>   
            <div class="amount">
            	<label for="Amount">Amount</label><br>
                <input type="text" maxlength="4" onkeypress='numeric_val(event)' name="amount" id="amt"/>           		<div id="errAmt" style="display:none">
                	<label for="Amount error" class="error">Please enter a valid amount</label>
                </div>
            </div>
            
            <center><input class="button" type="button" onclick="rcBoxA()" value="Recharge now"><!--<img src="images/rcbox_button_rechargenow.png" width="351" height="39" alt="Proceed with the recharge" />--></center>
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
                        <center><input class="button" type="button" id="signIn" value="Sign In / Up and continue" /></center>
                    </div>
            </div>
       </div>
   	 <!-- End rcBox-->
     </form>
     <div class="footer"></div>
    <!-- End footer-->
   </div>
<!-- End wrapOverall-->
</body>
</html>