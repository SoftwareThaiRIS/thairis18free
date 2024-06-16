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
$MOD = $_GET['MODALITY'];
include ("session.php");
include "connectdb.php";
$sql ="select BODY_PART from xray_body_part";
$result = mysqli_query($dbconnect, $sql);
$row = mysqli_fetch_array($result);
echo "Body Part : <SELECT NAME=\"BODYPART\"><OPTION VALUE=\"\"></OPTION>\n";
while($row = mysqli_fetch_array($result))
	{
		echo "<OPTION value='".$row['BODY_PART']."'>".$row['BODY_PART']."</OPTION>\n";	
	}
echo "</SELECT>";
$sql ="select XRAY_CODE, DESCRIPTION from xray_code where XRAY_TYPE_CODE = '$MOD'";
$result = mysqli_query($dbconnect, $sql);
$row = mysqli_fetch_array($result);
echo "OR : <SELECT NAME=\"PROCEDURE\"><OPTION VALUE=\"\"></OPTION>";
while($row = mysqli_fetch_array($result))
	{
		echo "<OPTION value='".$row['XRAY_CODE']."'>".$row['DESCRIPTION']."</OPTION>";
	}
echo "</SELECT>";
?>