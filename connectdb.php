<?php
# ThaiRIS (Thai Radiology Information System)
# Version: 1.8
# File last modified: 23 Mar 2018
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
$host ="localhost";
$user ="yourusername";
$password ="yourpassword";
$dbname ="ris";
error_reporting(E_ERROR);
$dbconnect = mysqli_connect($host,$user,$password,$dbname);
if (!$dbconnect) 
	{
		echo "Can't connect to Server Please contect Admin";
		exit;
	}
MYSQLI_SELECT_DB($dbconnect, $dbname) OR DIE("Error".mysql_error());
include ("config.php");
?>
