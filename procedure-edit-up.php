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
$CODE = $_POST['CODE'];
$DESCRIPTION = $_POST['DESCRIPTION'];
$XRAY_TYPE = $_POST['XRAY_TYPE_CODE'];
$BODY_PART = $_POST['BODYPART'];
$CHARGE_TOTAL = $_POST['CHARGE_TOTAL'];
$PORTABLE_CHARGE = $_POST['PORTABLE_CHARGE'];
$DF = $_POST['DF'];
$TIME_USE = $_POST['TIME_USE'];
$DELETE_FLAG = $_POST['DELETE_FLAG'];
$BIRAD_FLAG = $_POST['BIRAD_FLAG'];
$sql = "UPDATE xray_code SET DESCRIPTION='$DESCRIPTION', XRAY_TYPE_CODE='$XRAY_TYPE', BODY_PART='$BODY_PART', CHARGE_TOTAL='$CHARGE_TOTAL', PORTABLE_CHARGE='$PORTABLE_CHARGE'
		, DF='$DF', TIME_USE='$TIME_USE', DELETE_FLAG='$DELETE_FLAG' ,BIRAD_FLAG='$BIRAD_FLAG' where XRAY_CODE='$CODE'";
mysqli_query($dbconnect, $sql);
		echo "<body bgcolor=gray>";
		echo "<meta http-equiv=\"refresh\" content=\"3;url=procedureshow.php\" />";
		echo "<center> Procedure Updated</center>";
?>
