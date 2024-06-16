<?php
# ThaiRIS (Thai Radiology Information System)
# Version: 1.8
# File last modified: 4-Oct 2020
# File name: 
# http://www.thairis.net
# By ThaiRIS.Net
# Email : info.xraythai@gmail.com
##############################################################################
# COPYRIGHT NOTICE                                                           
# Copyright 2009-2024 ThaiRIS All Rights Reserved.              
#                                                                            
# This script may be used and modified free of charge by anyone so long as   
# this copyright notice and the comments above remain intact. By using this  
# code you agree to indemnify ThaiRIS.net from any liability that might
# arise from it's use.                                                       
#                                                                            
# Selling the code for this program without prior written consent is         
# expressly forbidden. In other words, please ask first before you try and   
# make money off this program.                                               
#                                                                            
# Obtain permission before redistributing this software over the Internet or 
# in any other medium. In all cases copyright and header must remain intact. 
# This Copyright is in full effect in any country that has International     
##############################################################################
include "connectdb.php";
$result = mysqli_query($dbconnect, "SELECT * FROM xray_referrer");
?>
<html>
<head>
<title>View Referrer</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "View Referrer";
include "topbar.php";

echo "<table border='1'>

<tr>

<th>CODE</th>
<th>DEGREE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>English Name</th>
<th>English LASTNAME</th>
</tr>\n";

while($row = mysqli_fetch_array($result))
  {

if($bg == "#FFFFFF") { 

$bg = "#FFCCCC";

} else {

$bg = "#FFFFFF";

}
  echo "<tr bgcolor=$bg>";
  echo "<td>" . $row['REFERRER_ID'] . "</td>";
  echo "<td>" . $row['DEGREE'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['LASTNAME'] . "</td>";
  echo "<td>" . $row['NAME_ENG'] . "</td>";
  echo "<td>" . $row['LASTNAME_ENG'] . "</td>";
  echo "</tr>\n";
  }
echo "</table>";
?>

</body>
</html>
