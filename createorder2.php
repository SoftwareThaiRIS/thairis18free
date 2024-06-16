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
include ("session.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body>

<?php

// Query Procedure
$TYPE = $_GET['TYPE'];
$HN = $_GET['HN'];
$REFERRER = $_GET['REFERRER'];
$DEPARTMENT = $_GET['DEPARTMENT'];
$PROCEDURETEXT = $_GET['PROCEDURETEXT'];

if ($REFERRER == '')
	{
		echo "Please Select Physician";
		exit;
	}
if ($DEPARTMENT == '')
	{
		echo "Please Select Department";
		exit;
	}
$sql = "select * FROM xray_code WHERE XRAY_TYPE_CODE = '$TYPE' AND CENTER='$usercenter'" ;
if ($TYPE=="SEARCHTEXT")
	{
		$sql = "SELECT * FROM xray_code WHERE DESCRIPTION LIKE '%$PROCEDURETEXT%' AND CENTER='$usercenter'";
	}
$result = mysqli_query($dbconnect, $sql);

echo "<table border='0' width=100%>

<tr bgcolor=#79acf3>
<th>Code</th>
<th>Procedure</th>
<th>Type</th>
<th>Price</th>
<th>Select</th>
</tr>\n";


while($row = mysqli_fetch_array($result))

  { 
	if($bg == "#FFFFFF") 
		{
			$bg = "#EBEBEB";
		} 
	else 
		{
			$bg = "#FFFFFF";
		}

  echo "<tr bgcolor=$bg>";
  echo "<td>" . $row['XRAY_CODE'] . "</td>";
  echo "<td>" . $row['DESCRIPTION'] . "</td>";
  echo "<td>" . $row['XRAY_TYPE_CODE'] . "</td>";
  echo "<td align=right>" . $row['CHARGE_TOTAL'] . "</td>";
  echo "<td><input type=\"submit\" name=\"pselect\" id=\"pselect\" value=\"Select\" onclick=add_cart('".$HN."','".$row['XRAY_CODE']."')></td>";
  echo "</tr>\n";
  }

echo "</table>";
?>

</body>
</html>
