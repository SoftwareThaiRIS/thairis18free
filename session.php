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
include ('connectdb.php');
$IP=getenv('REMOTE_ADDR');
$sql ="select SESSION FROM xray_user WHERE SESSION = '$sessionID'";
$result = mysqli_query($dbconnect, $sql);
$numrows = @mysqli_num_rows($result);
if ($numrows == 0)
	{
		echo "<center>Session Expried or duplicate login</center>";
		echo "<script type=\"text/javascript\">top.location.href = 'index.html';</script>";
		exit;
	}

$userlogin = $_SESSION['userlogin']; 
$sql2 = "select ID,CODE,DF_CODE, LOGIN,NAME,LASTNAME,USER_TYPE_CODE,CENTER_CODE, LOGINTIME, PACS_LOGIN  FROM xray_user WHERE LOGIN ='$userlogin'";
$result2 = mysqli_query($dbconnect, $sql2);
$numrows = @mysqli_num_rows($result2);
if($numrows == 0)
	{
		echo "<center>Session Expried or duplicate login</center>";
		echo "<script type=\"text/javascript\">top.location.href = 'index.html';</script>";
		exit;
	}
while($row = mysqli_fetch_array($result2)) 
	{
		$userid = $row['ID'];
		$usercode = $row['CODE'];
		$df_code = $row['DF_CODE'];
		$username = $row['NAME'];
		$userlastname = $row['LASTNAME'];
		$usertype = $row['USER_TYPE_CODE'];
		$usercenter = $row['CENTER_CODE'];
		$logintime = $row['LOGINTIME'];
		$pacs_login = $row['PACS_LOGIN'];
	}
$sql = "SELECT CODE, NAME, NAME_ENG, REPORTLOGO FROM xray_center WHERE CODE = '$usercenter'";
$result = mysqli_query($dbconnect, $sql);
while ($row = mysqli_fetch_array($result))
	{
		$center_code = $row['CODE'];
		$center_name = $row['NAME'];
		$center_name_eng = $row['NAME_ENG'];
		$reportlogo = $row['REPORTLOGO'];
	}
if ($reportlogo == '')
	{
		$reportlogo = banner-report.jpg;
	}
$sql = "SELECT * FROM xray_user_right WHERE USER_ID ='$userid'";
$result = mysqli_query($dbconnect, $sql);
while ($row = mysqli_fetch_array($result))
	{
		$superadmin = $row['SUPER_ADMIN'];
		$admin = $row['ADMIN'];
		$delete_order = $row['DELETE_ORDER'];
		$change_status = $row['CHANGE_STATUS'];
		$edit_patient = $row['EDIT_PATIENT'];
		$user_upload = $row['UPLOAD'];
		$user_del_upload = $row['DEL_UPLOAD'];
		$user_update_code = $row['UPDATE_CODE'];
		$create_order = $row['CREATE_ORDER'];
		$reset_user_password = $row['RESET_USER_PASSWORD'];
	}
?>