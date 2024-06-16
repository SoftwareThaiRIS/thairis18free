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
echo "<body bgcolor=\"#d4d4d4\">";
include "connectdb.php";
$code = $_GET[code];

$result = mysqli_query($dbconnect, "SELECT * FROM xray_code WHERE XRAY_CODE='$code'");

while($row = mysqli_fetch_array($result))
	{
			$CENTER = $row['CENTER'];
			$CODE =$row['XRAY_CODE'];
			$DESCRIPTION = $row['DESCRIPTION'];
			$XRAY_TYPE_CODE=$row['XRAY_TYPE_CODE'];
			$BODY_PART = $row['BODY_PART'];
			$CHARGE_TOTAL =$row['CHARGE_TOTAL'];
			$PORTABLE_CHARGE = $row['PORTABLE_CHARGE'];
			$DF = $row['DF'];
			$TIME_USE = $row['TIME_USE'];
			$BIRAD_FLAG = $row['BIRAD_FLAG'];
			$PREP_ID = $row['PREP_ID'];
	}

echo "<table>";
echo "<tr><td>Center</td><td>".$CENTER."</td></tr>";
echo "<tr><td>Code</td><td>".$CODE."</td></tr>";
echo "<tr><td>Description</td><td>".$DESCRIPTION."</td></tr>";
echo "<tr><td>TYPE</td><td>".$XRAY_TYPE_CODE."</td></tr>";
echo "<tr><td>Body Part</td><td>".$BODY_PART."</td></tr>";
echo "<tr><td>Charge</td><td>".$CHARGE_TOTAL."</td></tr>";
echo "<tr><td>Portable Charge</td><td>".$PORTABLE_CHARGE."</td></tr>";
echo "<tr><td>DF</td><td>".$DF."</td></tr>";
echo "<tr><td>TIME</td><td>".$TIME_USE."</td></tr>";
echo "<tr><td>BIRAD</td><td>".$BIRAD_FLAG."</td></tr>";
echo "<tr><td>PREPARATION CODE</td><td>".$PREP_ID."</td></tr>";

echo "</table>";
?>