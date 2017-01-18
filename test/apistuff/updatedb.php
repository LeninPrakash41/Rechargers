<?php 
require("../serverconfig.inc");


										$success=mysql_query("UPDATE recharge SET status='Successful' WHERE status='processing'");
										if($success)
										{echo "done";}

 ?>