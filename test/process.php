<?php 
require("serverconfig.inc");

if (isset($_COOKIE["username"]))
{
	if(isset($_POST["mobNo"])){
			$mobNo=mysql_real_escape_string($_POST["mobNo"]);
			$operator=mysql_real_escape_string($_POST["sel_op"]);
			$amount=mysql_real_escape_string($_POST["amount"]);
			
			$username=mysql_real_escape_string($_COOKIE['username']);
			$rcCash=0;
			$sql=mysql_query("SELECT * FROM users WHERE username='$username'");
			
			if(mysql_num_rows($sql)>0){
				while($info=mysql_fetch_assoc($sql)){
					$rcCash=$info['rc_cash'];
				}
			
				if($rcCash>=$amount){
					$rcCash=$rcCash-$amount;
					
					$timezone = "Asia/Kolkata";
					if(function_exists('date_default_timezone_set')) 
					date_default_timezone_set($timezone);
					$date= date('Y-m-d');
					$time=date('H:i:s');
					
					$sql=mysql_query("UPDATE users SET rc_cash='$rcCash' WHERE username='$username'");
					if($sql){
						$payment="success";
						$record=mysql_query("INSERT INTO recharge (email,mobile_no,trans_date,trans_time,amt,status)
									VALUES
									('$username','$mobNo','$date','$time','$amount','amt-paid / rc-pending')");
									
					$oid=mysql_query("SELECT MAX(order_no) AS lastorder FROM recharge WHERE email='$username'");
					$o_id=mysql_fetch_assoc($oid);
					$order_id=$o_id['lastorder'];
						
						if($record)
						{
							
							//sample php code

							//this will collect data from form
							//$operator = $_POST['operator']; 
							$servicenumber = $mobNo;
							//$amount = $_POST['amount'];
							//end of data collection from form
							
							
							//check whether user enter some data or not
							if(empty($operator)){
							echo"select operator";
							exit;
							}
							if(empty($servicenumber)){
							echo"enter mobile number";
							exit;
							}
							if(empty($amount)){
							echo"enter amount";
							exit;
							}
							//end of data input checking
							
							
							//common settings
							$myjoloappkey = "cpurnendu220"; //your jolo appkey
							$mode = "1"; //set 1 for live recharge, set 0 for demo recharge
							
							//doing recharge now by hitting jolo api
							$ch = curl_init();
							$timeout = 60; // set to zero for no timeout
							$myurl = "http://www.jolo.in/api/recharge.php?mode=$mode&key=$myjoloappkey&operator=$operator&service=$servicenumber&amount=$amount&orderid=$order_id";
							curl_setopt ($ch, CURLOPT_URL, $myurl);
							curl_setopt ($ch, CURLOPT_HEADER, 0);
							curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
							$file_contents = curl_exec($ch);
							curl_close($ch);
							//echo"$file_contents";
							
							//capture the response from jolo api
							//splitting each data as single
							$maindata = explode(",", $file_contents);
							
							$transactionid = $maindata[0];
							$status = $maindata[1]; 
							$operator= $maindata[2]; 
							$service= $maindata[3]; 
							$amount= $maindata[4];
							//$order_id = $maindata[5];
							
							$apiId=$transactionid;
							
							$record=mysql_query("INSERT INTO api_id (order_no,api_pid)
									VALUES
									('$order_id','$apiId')");
									
							if($status=="SUCCESS"){
								$sql=mysql_query("UPDATE recharge SET status='amt-paid / rc-success' WHERE order_no='$order_id'");
								
								
										//Sending the success SMS
											$phoneNo = $mobNo; 
											$msg2Send = "Recharge for your mobile number ".$mobNo." for Rs. ".$amount." was successful. Order No. is ".$order_id.". Visit www.rechargers.co.in or contact care@rechargers.co.in";
											
											$timeout = 5; // set to zero for no timeout
											
									
											$url = 'http://rechargers.orgfree.com/smsAPI.php';
											$fields = array(
																	'phone' => urlencode($phoneNo),
																	'msg' => urlencode($msg2Send),
															);
											
											//url-ify the data for the POST
											foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
											rtrim($fields_string, '&');
											
											//open connection
											$ch = curl_init();
											
											//set the url, number of POST vars, POST data
											curl_setopt($ch,CURLOPT_URL, $url);
											curl_setopt($ch,CURLOPT_POST, count($fields));
											curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
											curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
											
											//execute post
											$result = curl_exec($ch);
											
											//close connection
											curl_close($ch);
								
								
							}
							if($status=="FAILED"){
									$sqlRc=mysql_query("SELECT * FROM recharge WHERE order_no='$order_id'");
								if(mysql_num_rows($sqlRc)>0){
									$info=mysql_fetch_assoc($sqlRc);
										if($info['status']=="amt-paid / rc-pending"){
											$username=$info['email'];
											$sql=mysql_query("SELECT * FROM users WHERE username='$username'");
											$record=mysql_fetch_assoc($sql);
											$rcCash=$record['rc_cash']+$amount;
											$refund=mysql_query("UPDATE users SET rc_cash='$rcCash' WHERE username='$username'");
											if($refund){
												$sql=mysql_query("UPDATE recharge SET status='rc-failed / amt-refunded' WHERE order_no='$order_id'");
													//Sending the success SMS
													$phoneNo = $mobNo; 
													$msg2Send = "Recharge for your mobile number ".$mobNo." for Rs.".$amount." failed. Order No.-".$order_id.". Your recharge amount has been refunded as RC Cash. -rechargers.co.in.";
													
													$timeout = 5; // set to zero for no timeout
													
											
													$url = 'http://rechargers.orgfree.com/smsAPI.php';
													$fields = array(
																			'phone' => urlencode($phoneNo),
																			'msg' => urlencode($msg2Send),
																	);
													
													//url-ify the data for the POST
													foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
													rtrim($fields_string, '&');
													
													//open connection
													$ch = curl_init();
													
													//set the url, number of POST vars, POST data
													curl_setopt($ch,CURLOPT_URL, $url);
													curl_setopt($ch,CURLOPT_POST, count($fields));
													curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
													curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
													curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
													
													//execute post
													$result = curl_exec($ch);
													
													//close connection
													curl_close($ch);
											}
										}
								}
							}
									
									
						}else{echo "unsucessfull";}
					}
				}else{$payment="NO";}
			}else{echo "User doesn't exist!";}
	}else{echo "Enter mobile no!";header('Location: www.rechargers.co.in');}
}else{echo "Please sign in to continue";header('Location: www.rechargers.co.in');}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rechargers</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script src="jquery.cookie.js"></script>
<script type="text/javascript" src="home.js"></script>
<script type="text/javascript">

	function refStatus(){ 
	
			$.ajax({
				type: "POST",
				url: "process/refStatus.php",
				data: "orderId="+<?=$order_id?>,
				success: function(result){
								if(result=="refunded"){
									$("#rcRefund").html("Refunded to RC Cash");
								}else{
									refStatus();
								}
							},
				error: function(xhr){
							alert("An error occured: " + xhr.status + " " + xhr.statusText);
						}
			}); 
		 }

	function getStatus(){ 
	
			$.ajax({
				type: "POST",
				url: "apistuff/getStatus.php",
				data: "orderId="+<?= $rc['ORDERID']?>+"&merOId="+<?=$order_id?>,
				success: function(result){
								if(result=="SUCCESS"){
									$("#rcDeliv").html("SUCCESS");
								}else if(result=="FAILED"){
									$("#rcDeliv").html("FAILED");
									$("#refund").show("fast");
									refStatus();
								}else{
									getStatus();
								}
							},
				error: function(xhr){
							alert("An error occured: " + xhr.status + " " + xhr.statusText);
						}
			}); 
		 }
		 
	function showRefund(){
			 $("#refund").show("fast");
			 $("#rcRefund").html("Refunded to RC Cash");
	}
	
	$(document).ready(function () {
		
		<?php if($status=="FAILED"){ ?>
		          setTimeout('showRefund()', 1000);
		<?php } ?>
		
		//setTimeout('getStatus()', 12000);
	});
</script>

</head>

<body onload="checkUser()">
<div class="wrapOverall">
    
        <div class="header">
       	  <a href="index.php"><img class="logo" src="images/header_logo.png" width="274" height="64" alt="rechargers" /></a>
        	
       	  <div class="navMain">
          		<div class="navOpt" style="display:none">
            		<a href="#" id="logout">Logout</a>
                </div>
            	<a href="#" id="username"></a>
            	
            </div> <!-- End navMain-->
        
        </div> 
    <!-- End header-->
        <form method="post" action="process.php" onsubmit="return validateForm()">
        
     <div class="rcBoxB">	<!---->	
       <!-- The recharge box -->
            <center>
            <label for="header" id="rcBox_header">Recharge for your prepaid mobile</label><br>
        
        	<div id="rcInfo">
            </div><br/>
            <img src="images/divider1.png">
        	</center>
            
            
            <div class="order">
            		<div class="signed"><!--     -->
                        <center><div class="coupons">
            			<label for="payConf">Payment for <span class="WebRupee">Rs</span> <?=$amount?>: </label><label id="payConf"><?php if($payment=="success"){?>Successful<?php }else{echo "Not enough RC Cash";}?></label><br><br>
                        <label for="rcDeliv">Recharge delivery : </label><label id="rcDeliv"><?php if($status=="PENDING"){?><img src="images/processing.gif" width="28" height="28" alt="processing" /> Pending</label><?php }else{echo $status;}?><br>
                        
                        <div id="refund" <?php if($status!="FAILED"){ ?>style="display:none"<?php } ?>><br><label for="rcDeliv">Refund : </label><label id="rcRefund"><?php if($status!="FAILED"){ ?><img src="images/processing.gif" width="28" height="28" alt="processing" />Processing<?php }else {echo "Amount refunded to RC Cash.";} ?> </label></div>
                        
                        </div> <img src="images/divider1.png">
                        </center>
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