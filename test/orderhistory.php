<?php 
require("serverconfig.inc");

if (isset($_COOKIE["username"]))
{
		$username=mysql_real_escape_string($_COOKIE['username']);
	echo "<table border='1'> <tr> <th>Order No.</th> <th>Mobile No.</th> <th>Date</th><th>Time</th><th>Amount</th><th>Status</th></tr>";
		
	$sql=mysql_query("SELECT * FROM recharge WHERE email='$username'");
	
	if(mysql_num_rows($sql)>0){
		while($info=mysql_fetch_assoc($sql)){
			
			echo "<tr>"; 
				echo "<td>" . $info['order_no'] . " </td>"; 
				echo "<td>" . $info['mobile_no'] . "</td>"; 
				echo "<td>" . $info['trans_date'] . "</td>"; 
				echo "<td>" . $info['trans_time'] . "</td>"; 
				echo "<td>" . $info['amt'] . "</td>"; 
				echo "<td>" . $info['status'] . "</td>"; 
			echo "</tr>";
		}
	}else{echo "<tr><center>You haven't made a recharge yet!</center></tr>";}
	echo "</table>";

}else{echo "Please sign in to continue";header('Location: www.rechargers.co.in');}

 ?>