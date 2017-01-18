<?php 

$rcUrl="http://ww3.allianceapi.com/reseller/RechargeStatusAPI.php?reseller_id=7&reseller_pass=54321&orderid=1696411&meroid=103test";

//"http://ww3.allianceapi.com/reseller/FlexiRechargeAPI.php?reseller_id=7&reseller_pass=54321&denomination=10&mobilenumber=9038559515&operatorid=9&meroid=t3st666&circleid=*&voucher=";
$element='';
$rc=array();


//$xml = file_get_contents("http://ww3.allianceapi.com/reseller/RechargeStatusAPI.php?reseller_id=7&reseller_pass=12345&orderid=1653083&meroid=101test");
	//echo $xml;
//Initialize the XML parser
	$parser=xml_parser_create();
	
	
	
	//Function to use at the start of an element
	function start($parser,$element_name,$element_attrs)
	  {
			if($element_name!="DATA"){
		  global $element;$element=$element_name;}/*
	 	switch($element_name)
		{
		case "STATUS":
		$element='Status';
		break;
		case "TALKTIME":
		$element='TalkTime';
		break;
		case "OPERATORTXNID":
		$element='operatorTxnId';
		break;
		case "DESCRIPTION":
		$element='description';
		break;
		case "MEROID":
		$element='merOId';
		break;
		case "ORDERID":
		$element='orderId';
		break;
		case "MOBILE":
		$element='mobile';
		break;
		case "DENOMINATION":
		$element='denomination';
		break;
		case "MERNOTES":
		$element='merNotes';
		break;
		case "CREDITUSED":
		$element='creditUsed';
		break;
		case "BALANCE":
		$element='balance';
		break;
		
		
		/*
		<Status>SUCCESS</Status>
		<TalkTime>0</TalkTime>
		<OperatorTxnId>GU0012337209</OperatorTxnId>
		<Description>Transaction Successful</Description>
		<MerOid>1234600</MerOid>
		<OrderId>4133</OrderId>
		<Mobile>967123456</Mobile>
		<Denomination>10</Denomination>
		<MerNotes/>
		<CreditUsed>9.808</CreditUsed>
		<Balance>9999999726.88</Balance>
				
		} 
		*/
	  }
	
	//Function to use at the end of an element
	function stop($parser,$element_name)
	  {
	  echo "<br />";
	  }
	
	//Function to use when finding character data
	function char($parser,$data)
	  {
		  global $element; global $rc;
		  if($data!="" & $element!=''){
			  $rc[$element]=$data;
			  echo $element." -> ".$rc[$element];
		  }
	  }
	
	//Specify element handler
	xml_set_element_handler($parser,"start","stop");
	
	//Specify data handler
	xml_set_character_data_handler($parser,"char");
	
	//Open XML file
	$fp=fopen("$rcUrl","r");
	
	//Read data
	while ($data=fread($fp,4096))
	  {
	  xml_parse($parser,$data,feof($fp)) or 
	  die (sprintf("XML Error: %s at line %d", 
	  xml_error_string(xml_get_error_code($parser)),
	  xml_get_current_line_number($parser)));
	  }
	
	//Free the XML parser
	xml_parser_free($parser);
	
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
            			<label for="payConf">Payment for Rs. </label><label class="status" id="payConf">Successful</label><br><br>
                        <label for="rcDel">Recharge delivery </label><label class="status" id="rcDel"><img class="processing" src="images/processing.gif" alt="processing" />Processing</label><br>
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