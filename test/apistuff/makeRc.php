<?php 
$xml = file_get_contents("http://ww3.allianceapi.com/reseller/FlexiRechargeAPI.php?reseller_id=7&reseller_pass=54321&denomination=222&mobilenumber=9674143981&operatorid=9&meroid=103test&circleid=*&voucher=");
	echo $xml;
?>