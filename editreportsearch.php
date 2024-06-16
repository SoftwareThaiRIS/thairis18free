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
header("Content-type: text/html;  charset=TIS-620");
include "connectdb.php";
include "session.php";
$mrn = trim($_GET['HN']);

echo "<div id=showsearch>";
echo $mrn;

$sql = "SELECT 
MRN,
NAME,
LASTNAME 
FROM xray_patient_info 
WHERE 
(MRN LIKE '%$mrn%') 
AND (NAME LIKE '%$fname%')
AND (LASTNAME LIKE '%$lname%') 
AND (CENTER_CODE ='$center_code') 
LIMIT 0 , 99";
$result = mysqli_query($dbconnect, "$sql");
echo "<table border='0' cellspacing='1' width=100%>\n
<tr bgcolor=#CCCCCC>\n
<td><center>HN</center></td>\n
<td><center>Firstname</center></td>\n
<td><center>Lastname</center></td>\n
<td><center></center></td>\n
</tr>";
while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td align=right>" . $row['MRN'] . "</td>";
		echo "<td>" . $row['NAME'] . "</td>";
		echo "<td>" . $row['LASTNAME'] . "</td>";
		echo "<td><form id=selectpt  name=\"selectpt\"><input type=\"button\" value=\"Select\" onclick=select_pt(".$row['MRN'].")></form>";
		echo "<a href=editreportselect.php?MRN=".$row['MRN'].">".$row['MRN']."</a>";
		echo "</tr>";
	}

echo "</table>";

if ($row = 0 )
	{
		echo "Patient not found </br> \n";
	}

echo "</div>";
?>