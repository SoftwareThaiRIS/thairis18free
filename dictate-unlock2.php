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
//include ("connectdb.php");
$ORDERID = $_GET['ORDERID'];
$USERID = $_GET['USERID'];

$sql ="select LOCKBY FROM xray_request_detail WHERE ID='$ORDERID'";
$result = mysqli_query($dbconnect,$sql);
while ($row = mysqli_fetch_array($result))
	{
		$USERLOCKID = $row['LOCKBY'];
	}
if ($USERLOCKID == '')
	{
		echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form>";
	}
if (($USERLOCKID !== '')and ($USERLOCKID !== $userid)) 
	{
		echo "<center><img src=icon/lock.gif onClick=unlockexam2(".$row['ORDERID'].")></center>";
	}
if ($USERLOCKID == $userid)
	{
		$sql = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.ID = '$ORDERID'";
		mysqli_query($dbconnect,$sql);
		echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form>";
	}
?>