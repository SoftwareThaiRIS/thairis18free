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

$code = trim($_POST['code']);
$name = trim($_POST['name']);
$name_eng = trim($_POST['name_eng']);


echo "$code";
echo "$name";
echo "$name_eng";

if($code == '' or $name =='' or $name_eng =='')
	{
		echo "Please input Code , Name and English Name";
		exit;
	}

 $strSQL = ("SELECT CODE FROM xray_center WHERE CODE ='$code'");
 $objQuery = mysqli_query($dbconnect, $strSQL);
 $objResult = mysqli_fetch_array($objQuery);
 if ($objResult)
 {
	echo  "<font color=red>Center already exit</font>";
	}
	

$code = strtoupper($code);

$sql_insert_center = "insert INTO xray_center (CODE,NAME,NAME_ENG)VALUES('$code','$name','$name_eng')";
mysqli_query($dbconnect, $sql_insert_center);

$sql_news = "insert INTO xray_news (CENTER_CODE,NEWS)VALUES('$code','Welcome to ThaiRIS.Net')";
mysqli_query($dbconnect, $sql_news);
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=center.php">