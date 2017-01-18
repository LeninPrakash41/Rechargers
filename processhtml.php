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
            
            
            <div class="signinpay">
            		<div class="signed"><!--     -->
                        <center><div class="coupons">
            			<label for="payconf">Payment for Rs. </label><br><br>
                        <label for="payconf">Recharge delivery </label><br>
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