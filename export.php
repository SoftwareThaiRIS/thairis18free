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
# https://groups.google.com/forum/#!forum/thairis ThaiRIS OpernSource Forum                                                                
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
include "connectdb.php";
$timenow = time();
$strExcelFileName="Workload-ThaiRIS_".time().".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$sql_select = "
SELECT
xray_request_detail.ACCESSION,
xray_patient_info.MRN,
xray_patient_info.PREFIX AS PAT_PREFIX,
xray_patient_info.NAME AS PAT_NAME,
xray_patient_info.LASTNAME AS PAT_LASTNAME,
xray_patient_info.SEX AS PAT_SEX,
xray_request_detail.REQUEST_DATE,
xray_request_detail.REQUEST_TIME,
xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
xray_request_detail.APPROVED_TIME AS APPROVE, 
xray_request_detail.XRAY_CODE,
xray_code.DESCRIPTION,
xray_code.XRAY_TYPE_CODE,
xray_department.NAME_THAI AS DEP,	
xray_report.APPROVE_DATE,
xray_report.APPROVE_TIME,
xray_user.NAME AS DOCTOR_NAME,
xray_user.LASTNAME AS DOCTOR_LASTNAME
FROM
xray_report
Left Join xray_user ON xray_user.ID = xray_report.APPROVE_BY
Left Join xray_request ON xray_request.REQUEST_NO = xray_report.ACCESSION
Left Join xray_request_detail ON xray_request_detail.ACCESSION = xray_report.ACCESSION
Left Join xray_patient_info ON xray_patient_info.MRN = xray_request.MRN
Left Join xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE
LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
WHERE
xray_report.APPROVE_DATE BETWEEN  '2014-06-01' AND '2014-06-30' 
";
$sql = mysqli_query($dbconnect, $sql_select);
$num = mysqli_num_rows($sql);


function timeDiff($firstTime,$lastTime)
		{
			// convert to unix timestamps
			$firstTime=strtotime($firstTime);
			$lastTime=strtotime($lastTime);
			// perform subtraction to get the difference (in seconds) between times
			$timeDiff=$lastTime-$firstTime;
			// return the difference
			return $timeDiff;
		}
		
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<strong>Query Report Date<?php echo date("d/m/Y");?> Total<?php echo number_format($num);?> Number</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<tr>
<td><strong>ACCESSION</strong></td>
<td><strong>MRN</strong></td>
<td><strong>NAME</strong></td>
<td><strong>SEX</strong></td>
<td><strong>REQUEST DATE</strong></td>
<td><strong>REQUEST TIME</strong></td>
<td><strong>XRAY CODE</strong></td>
<td><strong>XRAY TYPE</strong></td>
<td><strong>DESCRIPTION</strong></td>
<td><strong>Department</strong></td>
<td><strong>APPROVE DATE</strong></td>
<td><strong>APPROVE TIME</strong></td>
<td><strong>Radiologist</strong></td>
<td><strong>Turn arround Time (Arrived To Approved)</strong></td>
</tr>
<?php
if($num>0)
	{
		while($row=mysqli_fetch_array($sql))
			{
				$time_arrival = $row[ARRIVAL];
				$time_approve = $row[APPROVE];
				$time_diff = timeDiff($time_arrival,$time_approve);
				// Convert to text
				$years = abs(floor($time_diff / 31536000));
				$days = abs(floor(($time_diff-($years * 31536000))/86400));
				$hours = abs(floor(($time_diff-($years * 31536000)-($days * 86400))/3600));
				$mins = abs(floor(($time_diff-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($time_diff / 60);
?>
<tr>
<td><?php echo $row['ACCESSION'];?></td>
<td><?php echo $row['MRN'];?></td>
<td><?php echo $row['PAT_PREFIX']." ".$row['PAT_NAME']." ".$row['PAT_LASTNAME'];?></td>
<td><?php echo $row['PAT_SEX'];?></td>
<td><?php echo $row['REQUEST_DATE'];?></td>
<td><?php echo $row['REQUEST_TIME'];?></td>
<td><?php echo $row['XRAY_CODE'];?></td>
<td><?php echo $row['XRAY_TYPE_CODE'];?></td>
<td><?php echo $row['DESCRIPTION'];?></td>
<td><?php echo $row['DEP'];?></td>
<td><?php echo $row['APPROVE_DATE'];?></td>
<td><?php echo $row['APPROVE_TIME'];?></td>
<td><?php echo $row['DOCTOR_NAME']." ".$row['DOCTOR_LASTNAME'];?></td>
<td><?php echo $days . " Days, " . $hours . " Hours, " . $mins; ?>Minutes</td>
</tr>
<?php
}
}
?>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>