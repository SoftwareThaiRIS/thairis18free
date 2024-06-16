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
session_start(); 
$sessionID = session_id();
$userlogin = $_POST['userlogin']; 
$userlogin = trim($userlogin);
$userpassword = $_POST['password'];
$userpassword = md5($userpassword);
$_SESSION['ID'] = $sessionID;
include ("connectdb.php");
$sql = "select LOGIN, PASSWORD, USER_TYPE_CODE, ENABLE FROM xray_user WHERE LOGIN='$userlogin'and PASSWORD='$userpassword'";
$result = mysqli_query($dbconnect, $sql); // 
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$usertypecode = $row["USER_TYPE_CODE"];
$ENABLE = $row["ENABLE"];
	
		if ($ENABLE == 0) 
			{
				header("Location: login.html");
				exit;
			}	
		
$numrows = @mysqli_num_rows($result);
if($numrows == 1)
	{ 
		$updatelogin = ''; //Clear Session previous login
		mysqli_query($dbconnect, "update xray_user SET SESSION ='' WHERE SESSION ='$sessionID'");
		mysqli_query($dbconnect, "update xray_user SET SESSION ='$sessionID', LOGINTIME=NOW() WHERE LOGIN='$userlogin'");

		$_SESSION['userlogin']= $userlogin; 
		$IP=getenv('REMOTE_ADDR');
		$URL=$_SERVER["HTTP_REFERER"];
		mysqli_query($dbconnect, "insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','LOGIN','$URL')");
		if ($usertypecode == 'VIEWER')
			{
				header("Location: xrayreport\index.php");
				exit;
			}
		header("Location: main.html");

		exit;
	} 
if ($numrows == 0) 
	{ 
		header("Location: login.html"); 
		exit;
	} 
?>
