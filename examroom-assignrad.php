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
# https://groups.google.com/forum/#!forum/thairis ThaiRIS OpernSource Forum                                                  
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
$ID = $_GET['ID']; //
$TYPE = $_GET['TYPE'];
$RADID = $_GET['RADID'];
include "session.php";
  	mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='TOREPORT',PAGE='RADIOLOGIST',ASSIGN_ID='$RADID' ,ASSIGN_BY='$userid' WHERE ID=$ID");
	$sql ="select NAME FROM xray_user WHERE ID ='$RADID'";
	$result = mysqli_query($dbconnect, $sql);
		while($row = mysqli_fetch_array($result))
		{
			$radname = $row['NAME'];
		}
   if ($RADID=='0')
	{
		echo "Not Assign";
		exit;
	}
   echo "<img src=icons/arrow-turn-000-left.png><font color=green><b>Assigned to : ".$radname."</b></font>";
   exit;
?>