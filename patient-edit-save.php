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
include ("function.php");

$MRN = $_GET['MRN'];
$ssn = $_GET['ssn'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$firstnameeng = $_GET['firstnameeng'];
$lastnameeng = $_GET['lastnameeng'];
$ptheight = $_GET['ptheight'];
$ptweight = $_GET['ptweight'];

echo "<u>Data Saved</u>";
echo "</br>";
echo "Name : ";
echo $firstname;
echo "</br>";
echo "Lastname : ";
echo $lastname;
echo "</br>";
echo "MRN= ".$MRN;
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=patient-info.php?MRN=".$MRN."\">";
$sql = "UPDATE xray_patient_info SET SSN='$ssn', NAME='$firstname', LASTNAME = '$lastname', HEIGHT='$ptheight', WEIGHT='$ptweight' WHERE MRN='$MRN'";
mysqli_query($dbconnect, $sql);
?>