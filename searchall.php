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
include ("connectdb.php");
include ("session.php");
$hn = $_POST['hn'];
$xn = $_POST['xn'];
$request = $_POST['request'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
?>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type="text/javascript"></script>  
</head>
<body>
<?php
if ($hn =="" && $xn =="" && $request =="" && $fname =="" && $lname =="") 
	{
		echo "<br><font color=red>Please Input Data for Searching</font>";
		exit;
	}
$result = mysqli_query($dbconnect, "SELECT NAME,LASTNAME FROM xray_patient_info WHERE NAME LIKE '%$fname%' or LASTNAME LIKE '%lname%' LIMIT 0,99");
echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
	echo "<tr>";
	echo "<td>" . $row['NAME'] . "</td>";
	echo "<td>" . $row['LASTNAME'] . "</td>";
	echo "</tr>";
  }
echo "</table>";
echo "<br><b>First Name : $fname</b></br>";
echo "<br><b>Last Name : $lname</b></br>";
?>