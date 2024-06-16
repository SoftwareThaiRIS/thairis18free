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
$MOD = $_GET['MODALITY'];
include ("session.php");
$sql = "SELECT ID, NAME, XRAY_TYPE_CODE from xray_report_template WHERE  XRAY_TYPE_CODE = '$MOD' AND USER_ID = '$userid'";
$result = mysqli_query($dbconnect, $sql);
echo "<table>";
while($row = mysqli_fetch_array($result))
	{
		echo "<tr><td>".$row['NAME']."</td><td>".$row['XRAY_TYPE_CODE']."</td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=template-view.php?TEMPLATE_ID=".$row['ID']."><button type=button class=\"positive\" value=\"View\"><img src=\"images/magnifier.png\" alt=\"\"/> View</button></a></td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=template-delete.php?TEMPLATE_ID=".$row['ID']."><button type=button class=\"positive\" value=\"Delete\"><img src=\"images/magnifier.png\" alt=\"\"/> Delete</button></a></td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=template-edit-show.php?TEMPLATE_ID=".$row['ID']."><button type=button class=\"positive\" value=\"edit\"><img src=\"images/magnifier.png\" alt=\"\"/> Edit </button></a></td>";
		echo "</tr>";
	}

echo "</table>";
?>
