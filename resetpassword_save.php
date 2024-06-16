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
$ID = $_POST['ID'];
$CODE = $_POST['CODE'];
$DF_CODE = $_POST['DFCODE'];
$LOGIN = $_POST['LOGIN'];
$NAME = $_POST['NAME'];
$LASTNAME = $_POST['LASTNAME'];
$USER_TYPE_CODE = $_POST['USER_TYPE_CODE'];
$PREFIX = $_POST['PREFIX'];
$ENABLE = $_POST['ENABLE'];
$CENTER_CODE = $_POST['CENTER_CODE'];
$PACS_LOGIN = $_POST['PACS_LOGIN'];
$NEWPASS1 = trim($_POST['newpassword1']);
$NEWPASS1 = md5($NEWPASS1);
$NEWPASS2 = trim($_POST['newpassword2']);
$NEWPASS2 = md5($NEWPASS2);
if (!($NEWPASS1 == $NEWPASS2)){
	echo "Please check New Password";
	exit;
}



$sql = "UPDATE xray_user SET 
				CODE='$CODE', 
				DF_CODE='$DF_CODE', 
				LOGIN='$LOGIN', 
				NAME='$NAME', 
				LASTNAME='$LASTNAME', 
				USER_TYPE_CODE='$USER_TYPE_CODE', 
				PREFIX='$PREFIX',
				PASSWORD = '$NEWPASS2',
				ENABLE = '$ENABLE',
				CENTER_CODE = '$CENTER_CODE', 
				PACS_LOGIN='$PACS_LOGIN' 
				where ID='$ID'";
mysqli_query($dbconnect, $sql);
		echo "<body bgcolor=\"#d4d4d4\">";
		echo "<meta http-equiv=\"refresh\" content=\"3;url=resetpassword.php\" />";
		echo "<center> Staff Updated</center>";
?>
