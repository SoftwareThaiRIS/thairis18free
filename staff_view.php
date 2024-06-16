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
$result = mysqli_query($dbconnect, "SELECT * FROM xray_user");

?>
<html>
<head>
<title>View Referrer</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body bgcolor=#d4d4d4 >
Radiology User<br>
<?php
echo "<center><table border='0' bgcolor='#79acf3' >

<tr>
<th>ID</th>
<th>CODE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Login</th>
<th>English Name</th>
<th>English LASTNAME</th>
<th>User TYPE</th>
<th>User RIS</th>
<th>PACS Login</th>
</tr>\n";
$bg ="#FFCCCC";
while($row = mysqli_fetch_array($result))

  {

if($bg == "#FFFFFF") 
	{ //ส่วนของการ สลับสี 
		$bg = "#C8C8C8";
	} 
else 
	{
		$bg = "#FFFFFF";
	}
  echo "<tr bgcolor=$bg>";
  echo "<td>" . $row['ID'] ."</td>";
  echo "<td>" . $row['CODE'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['LASTNAME'] . "</td>";
  echo "<td>" . $row['LOGIN']. "</td>";
  echo "<td>" . $row['NAME_ENG'] . "</td>";
  echo "<td>" . $row['LASTNAME_ENG'] . "</td>";
  echo "<td>" . $row['USER_TYPE_CODE'] ."</td>";
  echo "<td>" . $row['LOGIN']. "</td>";  
  echo "<td>" . $row['PACS_LOGIN']. "</td>";
  echo "</tr>\n";

  }

echo "</table></center>";

?>

</body>
</html>
