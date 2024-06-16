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
$CENTER = $_POST['center_code'];
$XRAY_CODE = $_POST['CODE'];
$DESCRIPTION = $_POST['DESCRIPTION'];
$XRAY_TYPE_CODE = $_POST['type_code'];
$BODY_PART = $_POST['bodypart'];
$CHARGE_TOTAL = $_POST['charge'];
$PORTABLE_CHARGE = $_POST['portablecharge'];
$DF = $_POST['df'];
$TIME_USE = $_POST['timeuse'];
$BIRAD_FLAG = $_POST['mammo'];
$PREP_ID = $_POST['prep'];

if (($XRAY_CODE == '') OR ($DESCRIPTION == '') OR ($XRAY_TYPE_CODE == '') OR ($BODY_PART == ''))
{
	echo "Please Input Data before submit ";
	exit;
}
$sql2 = "INSERT INTO xray_code(CENTER,XRAY_CODE,DESCRIPTION,XRAY_TYPE_CODE,BODY_PART,CHARGE_TOTAL,PORTABLE_CHARGE,DF,TIME_USE,BIRAD_FLAG,PREP_ID,DELETE_FLAG,ACTIVE) 
values 
('$CENTER','$XRAY_CODE','$DESCRIPTION','$XRAY_TYPE_CODE','$BODY_PART','$CHARGE_TOTAL','$PORTABLE_CHARGE','$DF','$TIME_USE','$BIRAD_FLAG','$PREP_ID','0','1')";
mysqli_query($dbconnect, $sql2);
echo "Added Procedure";
?>