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
header("Content-type: text/html;  charset=utf-8");
include "session.php";
include ("function.php");
//include "session.php";
$ACCESSION = $_GET['ACCESSION'];
$REPORT_ID = $_GET['ID'];

$sql = "SELECT 
			xray_request_detail.ACCESSION, 
			xray_patient_info.NAME, 
			xray_patient_info.LASTNAME, 
			xray_patient_info.MRN, 
			xray_patient_info.SEX, 
			xray_patient_info.BIRTH_DATE, 
			xray_code.DESCRIPTION, 
			xray_department.NAME_THAI,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.APPROVED_TIME,
			xray_report.REPORT,
			xray_report.DICTATE_DATE,
			xray_report.DICTATE_TIME,
			xray_user.NAME AS APPROVE_BY,
			xray_user.LASTNAME AS AP_LAST,
			xray_referrer.NAME AS RNAME,
			xray_referrer.LASTNAME AS RLAST
			FROM xray_report 
			INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' 
			INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
			INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE
			INNER JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID
			INNER JOIN xray_user ON xray_report.APPROVE_BY = xray_user.ID
			INNER JOIN xray_referrer on xray_request.REFERRER = xray_referrer.REFERRER_ID";
			

			
if($REPORT_ID > 0) 
	{
		$sql = "SELECT 
			xray_request_detail.ACCESSION, 
			xray_patient_info.NAME, 
			xray_patient_info.LASTNAME, 
			xray_patient_info.MRN, 
			xray_patient_info.SEX, 
			xray_patient_info.BIRTH_DATE, 
			xray_code.DESCRIPTION, 
			xray_department.NAME_THAI,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.APPROVED_TIME,
			xray_report.REPORT,
			xray_report.DICTATE_DATE,
			xray_report.DICTATE_TIME,
			xray_user.NAME AS APPROVE_BY,
			xray_user.LASTNAME AS AP_LAST,
			xray_referrer.NAME AS RNAME,
			xray_referrer.LASTNAME AS RLAST
			FROM xray_report 
			INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' 
			INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
			INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE
			INNER JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID
			INNER JOIN xray_user ON xray_report.APPROVE_BY = xray_user.ID
			INNER JOIN xray_referrer on xray_request.REFERRER = xray_referrer.REFERRER_ID
			WHERE xray_report.ID = '$REPORT_ID'";
	}


$result = mysqli_query($dbconnect, $sql);
while($row = mysqli_fetch_array($result))
	{
		$acc = $row['ACCESSION'];
		$ptname = $row['NAME'];
		$ptlastname = $row['LASTNAME'];
		$report =$row['REPORT'];
		$DC_DATE=$row['DICTATE_DATE'];
		$DC_TIME=$row['DICTATE_TIME'];
		$MRN= $row['MRN'];
		$procedure = $row['DESCRIPTION'];
		$examtime =$row['ARRIVAL_TIME'];
		$approvetime = $row['APPROVED_TIME'];
		$approveby = $row['APPROVE_BY'];
		$approve_lastname = $row['AP_LAST'];
		$department = $row['NAME_THAI'];
		$referrer = $row['REFERRER'];
		$AGE = $row['BIRTH_DATE'];
		$sex = $row['SEX'];
		$refer_name = $row['RNAME'];
		$refer_last = $row['RLAST'];
	}
$DICTATETIMESTAMP = $DC_DATE." ".$DC_TIME;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Radiology Report ThaiRIS : MRN <?php echo $MRN; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script>
function printpage()
  {
  window.print()
  }
</script>

<?php
echo "<body bgcolor=gray topmargin=0>";
echo "<center>";
echo "<table bgcolor=#FFFFFF width=800 height=800px >";
echo "<tr valign=top><td>";
echo "<center><img src=image/$reportlogo></center>";
echo "<center>";
echo "<table width=800 >";
echo "<tr><td width=10%>Name</td><td width=30%>: ".$ptname."  ".$ptlastname."</td><td width=12%>Report Time</td><td width=48%>: ".DateEng($DICTATETIMESTAMP)."</td></tr>";
echo "<tr><td width=10%>Age</td><td width=30%>: ".AgeCal($AGE)."  Sex : ".$sex."</td><td width=12%>Exam Time</td><td width=48%>: ".DateEng($examtime)."</tr>";
echo "<tr><td width=10%>HN</td><td width=30%>: ".$MRN."</td><td width=12%>Order</td><td width=48%>: ".$procedure."</td></tr>";
echo "<tr><td width=10%>Accession</td><td width=30%> : ".$acc."</td><td width=12%>Department </td><td width=48%>: ".$department."</td></tr></table></center>";
echo "<center><table width=800><tr><td>";
echo "<hr><font size=+1>";
echo $report;
echo "</font><hr>";
echo "</td></tr></table></center>";
echo "<center><table width=800><tr><td width=50%>Report By : ".$approveby." ".$approve_lastname."</td><td width 50%>Physician : ".$refer_name." ".$refer_last."</td></tr><table></center>";
echo "</td></tr></table></center>";
echo "</body>";

?>
