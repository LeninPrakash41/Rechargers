<?php 
require("../serverconfig.inc");
require_once '../lib/Unirest/Unirest.php';
$response = Unirest::get(
  "https://site2sms.p.mashape.com/index.php?uid=9038559515&pwd=abhishekant2&phone=9038559515&msg=The%20recharge%20for%20the%20mob%20number%20is%20successful.%20Reach%20us%20at%20help%40rechargers.co.in%20for%20any%20queries.",
  array(
    "X-Mashape-Authorization" => "94q1EvdrNRzW8JaWXZQhj5ZQBnPTIFpo"
  ),
  null
);

 ?>