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
$TYPE = $_GET['XRAY_TYPE'];
echo $TYPE;
include "connectdb.php";
    $query="select XRAY_CODE, DESCRIPTION, XRAY_TYPE_CODE, CHARGE_TOTAL from xray_code where XRAY_TYPE_CODE='$TYPE' LIMIT 21";
    $result=mysql_query($query);
   echo "<table border=\"1\"><tr><td>Code</td><td>รายการ</td><td>Type</td><td>ราคา</td><td>Select</td></tr>";
while ($row =mysql_fetch_array($result))
{
  echo "<tr><td>" . $row['XRAY_CODE'] . "</td>";
  echo "<td>" . $row['DESCRIPTION'] . "</td>";
  echo "<td>" . $row['XRAY_TYPE_CODE'] . "</td>";
  echo "<td align=right>" . $row['CHARGE_TOTAL'] . "</td>";
echo "<td><input type=\"submit\" name=\"pselect\" id=\"pselect\" value=\"Select\" /></td></tr>";
}
 echo " </table>";
?> 
