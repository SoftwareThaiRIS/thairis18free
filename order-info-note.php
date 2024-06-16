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
$REQUEST_NO = $_GET['REQUEST_NO'];
$ACCESSION = $_GET['ACCESSION'];
$MRN = $_GET['MRN'];
include ("session.php");
$sql2 = "select   
			xray_request.NOTE
			from xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO)			
			WHERE xray_request_detail.ACCESSION='$ACCESSION'";
$result2= mysqli_query($dbconnect, $sql2);
while($row2 = mysqli_fetch_array($result2))
		{
			$NOTE = $row2['NOTE'];
		}

echo "<table width=100 align=center><tr><td>";
echo "ORDER = ".$REQUEST_NO;
echo "<br />";
echo "ACCESSION = ".$ACCESSION;
echo "<br />";
echo "<form action=order-info-note-add.php>";
echo "<input type=hidden name=REQUEST_NO value=$REQUEST_NO>";
echo "<input type=hidden name=ACCESSION value=$ACCESSION>";
echo "<input type=hidden name=MRN value=$MRN>";
echo "<textarea name=examnote rows=\"15\" cols=\"20\">$NOTE</textarea>";
echo "<br />";
echo "<input type=submit value=Submit>";
echo "</form>";
echo "</td></tr></table>";
?>