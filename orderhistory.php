<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rechargers</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="table_design.css"/>
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
            		<a href="index.php" id="logout">Logout</a>
                </div>
            	<a href="#" id="username"></a>
            	
            </div> <!-- End navMain-->
        
        </div> 
    <!-- End header-->
<?php

require("serverconfig.inc");

if (isset($_COOKIE["username"]))
{
$username=mysql_real_escape_string($_COOKIE['username']);
// rows per page

$rowsPerPage = 10;

// if $_GET

if(isset($_GET['page']))

{

$pageNum= $_GET['page'];

}

else

$pageNum = 1;

// preceding rows

$previousRows =($pageNum - 1) * $rowsPerPage;

// the first, optional value of LIMIT is the start position

//the next required value is the number of rows to retrieve

$query = "SELECT * FROM recharge WHERE email='$username' order by order_no desc LIMIT $previousRows, $rowsPerPage";

$result = mysql_query($query) or die('Error couldn\'t get the data').mysql_error();

echo "<center><p style='margin-left:0px';><font size='5' color=#339900 face='Arial, Helvetica, sans-serif'> <bold> Your Order History : </bold><br></font></p></center>";
echo "<div class='CSSTableGenerator' >";

echo "<table border=0  align='center'>\n";

echo "<tr><td>Order #</td><td>Mobile Number</td><td>Transaction Date</td><td>Transaction Time</td>

<td>Amount</td><td> Status</td></tr>";

// print the results
if(mysql_num_rows($result)>0){
while($info = mysql_fetch_assoc($result))

{
echo "<tr>"; 
				echo "<td>" . $info['order_no'] . " </td>"; 
				echo "<td>" . $info['mobile_no'] . "</td>"; 
				echo "<td>" . $info['trans_date'] . "</td>"; 
				echo "<td>" . $info['trans_time'] . "</td>"; 
				echo "<td>" . $info['amt'] . "</td>"; 
				echo "<td>" . $info['status'] . "</td>"; 
			echo "</tr>";


}
echo '</table>';
echo '</div>' ;
// Find the number of rows in the query

$query = "SELECT COUNT(order_no) AS numrows FROM recharge WHERE email='$username'";

$result = mysql_query($query) or die('Error, couldn\'t get count title=\"$page\"').mysql_error();

//use an associative array

$row = mysql_fetch_assoc($result);

$numrows = $row['numrows'];

// find the last page number

$lastPage = ceil($numrows/$rowsPerPage);

//we use ceil which rounds up the result, because if we have 4.2 as an answer, we'd need 5 pages.

$phpself = $_SERVER['PHP_SELF'];

//if the current page is greater than 1, that is, it isn't the first page

//then we print first and previous links

if ($pageNum > 1)

{

$page = $pageNum - 1;

$prev = " <a href=\"$phpself?page=$page\" title=\"Page $page\">[Back]</a> ";

$first = " <a href=\"$phpself?page=1\" title=\"Page 1\">[First Page]</a> ";

}

else

//otherwise we do not print a link, because the current page is

//the first page, and there are no previous pages

{

$prev = ' [Back] ';

$first = ' [First Page] ';

}

// We print the links for the next and last page only if the current page

//isn't the last page

if ($pageNum < $lastPage)

{

$page = $pageNum + 1;

$next = " <a href=\"$phpself?page=$page\" title=\"Page $page\">[Next]</a> ";

$last = " <a href=\"$phpself?page=$lastPage\" title=\"Page $lastPage\">[Last Page]</a> ";

}

//the current page is the last page, so we don't print links for

//the last and next pages, there is of course no next page.

else

{

$next = ' [Next] ';

$last = ' [Last Page] ';

}

//We print the links depending on our selections above

echo "<br>";

echo "<center>";
echo "<font size='4' face='Arial, Helvetica, sans-serif' color=#339900>".$first . $prev . " Showing page <bold>$pageNum</bold> of

<bold>$lastPage</bold> pages " . $next . $last. "</font>";
echo "</center>";
}else{echo "<tr><center>You haven't made a recharge yet!</center></tr>";}

}else{echo "Please sign in to continue";header('Location: www.rechargers.co.in');}

?>
</div>
</body>

</html>