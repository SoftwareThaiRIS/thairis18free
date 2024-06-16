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
$MRN = $_GET[MRN];
include ("session.php");
include ("connectdb.php");
include ("function.php");
echo "<center>Order History</center>";
$sql = "SELECT xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE,
			xray_request_detail.STATUS,
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REPORT_STATUS, 
			xray_code.DESCRIPTION 
			FROM 
			xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request.MRN = '$MRN')
			INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN)";
		
$result = mysql_query($sql);
$bg ="#FFCCCC";
echo "<center><table width=100%><tr bgcolor=#ccDDff><td>Report</td><td>Date</td></tr>";
while($row = mysql_fetch_array($result))
{
	if($bg == "#FFFFFF") 
		{ 
			$bg = "#FFCCCC";
		} 
	else 
		{
			$bg = "#FFFFFF";
		}
	if ($row[REPORT_STATUS]=='1')
		{
			$report_icon ="<a href=showreport.php?ACCESSION=".$row[ACCESSION]." target=_blank><img src=./image/report.gif border=0></a> <a href=showreportpdf.php?ACCESSION=".$row[ACCESSION]." target=_blank><img src=./image/pdf.gif border=0></a>";
		}
	else 
		{
			$report_icon ="No";
		}
		echo "<tr bgcolor=".$bg."><td width=45>".$report_icon."</td><td>".EngEachDate($row[REQ_DATE])."</td></tr><tr bgcolor=".$bg."><td colspan=2><font size=-2>".$row[DESCRIPTION]."</font></td>";
		echo "<br /><img src=./image/report.gif border=0> Assign To : ---  </tr>";
}

echo "</table></center>";

?>