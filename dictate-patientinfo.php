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
include "session.php";
?>
<table width=200>
<tr><td>
<?php
$ORDERID = $_GET['ORDERID'];
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG  AS PTENGNAME, 
			xray_patient_info.LASTNAME_ENG  AS PTENGLAST, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.BIRTH_DATE, 
			xray_request.REQUEST_NO AS req_no, 			
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.STATUS, 
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_department.NAME_THAI AS DPNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
			LEFT JOIN xray_user ON (xray_user.CODE = xray_request.USER) 
			LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
			LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
			LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
			WHERE (xray_request_detail.PAGE = 'RADIOLOGIST' and xray_request_detail.ID = '$ORDERID') 
			ORDER BY ORDERTIME desc";
$result = mysqli_query($dbconnect, $sql);
while($row = mysqli_fetch_array($result))
	{
			$MRN             = $row['MRN'];
			$PATIENTNAME     = $row['PTNAME'];
			$PATIENTLASTNAME = $row['PTLASTNAME'];
			$PATIENTENGNAME	 = $row['NAMEENG'];
			$PATIENTENGLAST	 = $row['LASTNAMEENG'];
			$ACCESSION		 = $row['ACCESSION'];
			$REQUEST_NO 	 = $row['REQUEST_NO'];
			$ORDERDATE	     = $row['ORDERTIME'];
			$PROCEDURE		 = $row['DESCRIPTION'];
			$DEPARTMENT      = $row['DPNAME'];
			$PHYSICIANNAME 		= $row['DOCTORNAME'];
			$PHYSICIANLASTNAME	= $row['DOCTORLASTNAME'];
			$BIRADFLAG = $row['BIRAD_FLAG'];
	}
echo "<table bgcolor=\"#EBEBEB\" width=\"100%\"><tr><td bgcolor=#79acf3>";	
echo "<center><u><b>Order Detail</b></u></center>";
echo "</td></tr><tr><td>";
echo "<b><u>HN</u></b>  : ".$MRN."<br>\n";
echo "<b><u>ACC </u> </b> : ".$ACCESSION."<br />";
echo "<b><u>Name </u></b> <br/><img src=arrow.gif> ".$PATIENTNAME." ".$PATIENTLASTNAME."<br />\n";
echo "<b><u>Sex</u> </b> :  <b><br /><u>Age</u> </b> : <br />\n";
echo "<b><u>Date</u></b> :".$ORDERDATE."<br>\n";
echo "<b><u>Procedure</u></b> :<br/><img src=arrow.gif> ".$PROCEDURE."<br/>\n";
echo "<b><u>Physician</u></b> : <br/><img src=arrow.gif> ".$PHYSICIANNAME." ".	$PHYSICIANLASTNAME."<br />\n";
echo "<b><u>Department</u></b> : <br /><img src=arrow.gif> ".$DEPARTMENT."<br />";
echo "<hr>";
echo "</td></tr>";
?>
</td></tr>
</table>