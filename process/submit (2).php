<?
//sample php code

//this will collect data from form
$operator = $_POST['operator']; 
$servicenumber = $_POST['servicenumber'];
$amount = $_POST['amount'];
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
$myjoloappkey = ""; //your jolo appkey
$mode = "1"; //set 1 for live recharge, set 0 for demo recharge

//doing recharge now by hitting jolo api
$ch = curl_init();
$timeout = 60; // set to zero for no timeout
$myurl = "http://www.jolo.in/api/recharge.php?mode=$mode&key=$myjoloappkey&operator=$operator&service=$servicenumber&amount=$amount";
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

//display the result to customer
echo"Transaction ID: $transactionid (This is jolo orderid)";
echo"<br/>";
echo"Recharge Status: $status";
echo"<br/>";
echo"Operator: $operator";
echo"<br/>";
echo"Service Number: $service";
echo"<br/>";
echo"Amount: $amount";
echo"<br/>";

?>