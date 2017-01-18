<?php 
require("../serverconfig.inc");
if($_POST){
	$apiOrderId=mysql_real_escape_string($_POST['orderId']);
	$rcOrderId=mysql_real_escape_string($_POST['merOId']);
	
	$rcUrl="http://ww3.allianceapi.com/reseller/RechargeStatusAPI.php?reseller_id=7&reseller_pass=54321&orderid=".$apiOrderId."&meroid=".$rcOrderId;
					
					$element='';
					$rc=array();
										
										
						$parser=xml_parser_create();
						
						
						
						//Function to use at the start of an element
						function start($parser,$element_name,$element_attrs)
						  {
							 if($element_name!="DATA"){
							  global $element;$element=$element_name;}
							 
						  }
						
						//Function to use at the end of an element
						function stop($parser,$element_name)
						  {
						  }
						
						//Function to use when finding character data
						function char($parser,$data)
						  {
							  global $element; global $rc;
							  if($data!="" & $element!=''){
								  $rc[$element]=$data;
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
						
						echo $rc['STATUS'];
						if($rc['STATUS']=="FAILED"){
							
							$sql=mysql_query("SELECT * FROM recharge WHERE order_no='$rcOrderId'");
							if(mysql_num_rows($sql)>0){
								$info=mysql_fetch_assoc($sql);
									if($info['status']=="processing"){
										$username=$info['email'];
										$sql=mysql_query("SELECT * FROM users WHERE username='$username'");
										$record=mysql_fetch_assoc($sql);
										$rcCash=$record['rc_cash']+$rc['DENOMINATION'];
										$refund=mysql_query("UPDATE users SET rc_cash='$rcCash' WHERE username='$username'");
										if($refund){
											$sql=mysql_query("UPDATE recharge SET status='refunded' WHERE order_no='$rcOrderId'");
										}
									}
							}
							
						}
}
?>