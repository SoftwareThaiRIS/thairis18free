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
//header("Content-type: text/html;  charset=TIS-620");
include "connectdb.php";
include "session.php";
$mrn = $_GET['HN'];

//echo "<div id=showsearch>";
$result = mysqli_query($dbconnect, "SELECT xray_patient_info.MRN,
						xray_patient_info.NAME,
						xray_patient_info.LASTNAME 
						FROM xray_patient_info 
						WHERE 
						(xray_patient_info.MRN LIKE '%$mrn%') 
						AND (xray_patient_info.NAME LIKE '%$fname%') 
						AND (xray_patient_info.LASTNAME LIKE '%$lname%') 
						AND (xray_patient_info.CENTER_CODE ='$center_code') LIMIT 0 , 999");

echo "<table border='0' cellspacing='1' width=100%>\n
<tr bgcolor=#CCCCCC>\n
<td><center>HN</center></td>\n
<td><center>Firstname</center></td>\n
<td><center>Lastname</center></td>\n
<td><center></center></td>\n
</tr>";
$count = 0;
while($row = mysqli_fetch_array($result))
  {
	$count = $count+1;
	$MRN = $row['MRN'];
	echo "<tr>";
	echo "<td align=right>$MRN</td>";
	echo "<td>" . $row['NAME'] . "</td>";
	echo "<td>" . $row['LASTNAME'] . "</td>";
	echo "<td>";
	echo "<a href=addendumselect.php?MRN=$MRN>$MRN</a>";
  	echo "</td></tr>";
  }

echo "</table>";

if ($row = 0 )
	{
		echo "Patient not found </br> \n";
	}
	
//echo "</div>";
echo "Total : ".$count;
?>