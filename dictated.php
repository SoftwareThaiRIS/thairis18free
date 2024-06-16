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
include ("connectdb.php");
$ORDERID = $_POST['ORDERID'];
$MRN = $_POST['hn'];
$RADID = $_POST['RADID'];
$TEXTREPORT = $_POST['TEXTREPORT'];
$TEXTREPORT= str_replace("'", "`", $TEXTREPORT); 
$ACCESSION = $_POST['ACCESSION'];
$BIRAD = $_POST['BIRAD'];
$DICTATE_TYPE = $_POST['dictate_type'];
$COPYREPORT1 = $_POST['COPYREPORT1']; //ORDER ID
$COPYACC1 = $_POST['COPYACC1']; //ACCESSION
$COPYACC10 = $_POST['COPYACC10'];
$DF = $_POST['DF'];
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.PREFIX, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 	
			xray_patient_info.BIRTH_DATE AS DOB,	
			xray_patient_info.SEX,
			xray_request.REQUEST_NO, 					
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.CASE_NO,
			xray_request_detail.XRAY_CODE AS XRAY_CODE,
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,	
			xray_request_detail.APPROVED_TIME,
			xray_code.XRAY_TYPE_CODE,
			xray_department.DEPARTMENT_ID,
			xray_department.NAME_THAI AS DEP,	
			xray_code.XRAY_CODE,
			xray_code.DESCRIPTION, 
			xray_referrer.REFERRER_ID AS RE_ID,
			xray_referrer.NAME AS REF_NAME,
			xray_referrer.LASTNAME AS REF_LASTNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
			LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_patient_info.MRN = '$MRN') 
			AND (xray_request_detail.ACCESSION ='$ACCESSION')
			AND (xray_request_detail.STATUS != 'CANCEL') 
			AND (xray_patient_info.CENTER_CODE ='$center_code')
			AND (xray_department.CENTER ='$center_code')			
			ORDER BY URGENT desc, ORDERTIME ASC ";

$result = mysqli_query($dbconnect, $sql);
while($row = mysqli_fetch_array($result))
	{
			$MRN             = $row['MRN'];
			$PREFIX	= $row['PREFIX'];
			$PATIENTNAME     = $row['PTNAME'];
			$PATIENTLASTNAME = $row['PTLASTNAME'];
			$PATIENTENGNAME	 = $row['NAMEENG'];
			$PATIENTENGLAST	 = $row['LASTNAMEENG'];
			$SEX = $row['SEX'];
			$DOB = $row['DOB'];
			$REQUEST_NO 	 = $row['REQUEST_NO'];
			$CASE_NO = $row['CASE_NO'];
			$REQ_DATE = $row['REQ_DATE'];
			$REQ_TIME = $row['REQ_TIME'];
			$ORDERDATE	     = $row['ORDERTIME'];
			$PRO_CODE	= $row['XRAY_CODE'];
			$PROCEDURE		 = $row['DESCRIPTION'];
			$DEP_ID		= $row['DEPARTNENT_ID'];
			$DEP      = $row['DEP'];
			$REF_ID	= $row['RE_ID'];
			$REF_NAME 		= $row['REF_NAME'];
			$REF_LASTNAME	= $row['REF_LASTNAME'];
			$BIRADFLAG = $row['BIRAD_FLAG'];
	}
	
// Remove Temp Report (From Auto Save) 
$allow = '<br />,<br>,<br/>,<div>,<p>';
$result= strip_tags($TEXTREPORT,$allow);
$result1 = trim(preg_replace('/\s+/', ' ', $result));
$result1= preg_replace('#<div\s*/?>#i', '', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#<p\s*/?>#i', '\n', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#</p\s*/?>#i', '', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#<br\s*/?>#i', '\n', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#</div\s*/?>#i', '\n', $result1);  // Replace <br > with new line \n
$result1= preg_replace('/[\n\r\t]/', '\n', $result1);
$result1= preg_replace('/<[^>]*>/', '', $result1);
$result1 = str_replace("&nbsp;", " ", $result1);
$result1 = str_replace("&amp;", "&", $result1);
$result1 = str_replace("&lt;", "<", $result1);
$result1 = str_replace("&gt;", ">", $result1);
$result2 = trim(preg_replace('/\s+/', ' ', $result));
$result2= preg_replace('#<div\s*/?>#i', '', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#<p\s*/?>#i', '\n', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#</p\s*/?>#i', '\n', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#<br\s*/?>#i', '\n', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#</div\s*/?>#i', '\n', $result2);  // Replace <br > with new line \n
$result2= preg_replace('/<[^>]*>/', '', $result2);
$result2 = str_replace("&nbsp;", " ", $result2);
$result2 = str_replace("&amp;", "&", $result2);
$result2 = str_replace("&lt;", "<", $result2);
$result2 = str_replace("&gt;", ">", $result2);

$result1=$result1."\n-------------------------------------------------------------------------------------- \nReported By : ".$username." ".$userlastname;
$result1=$result1."\nReport time : ".date("d-m-Y H:i:s");

//date for hl7
$sqltime = "SELECT now() AS time1,curtime() AS date1";
$result = mysqli_query($dbconnect, $sqltime);
			while($row = mysqli_fetch_array($result))
				{
					$reporttimeSQL = $row['time1'];
					$reportdate = $row['date1'];
					$reportdate = substr_replace($reportdate ,"",-3);
				}
		
$TEXTREPORT_HL7 = $result1;
$TEXTREPORT_HL7_2 = $result2;
//Clean the inside of the tags
function clean_inside_tags($txt,$tags)
	{
        preg_match_all("/<([^>]+)>/i",$tags,$allTags,PREG_PATTERN_ORDER);
		foreach ($allTags[1] as $tag)
			{
				$txt = preg_replace("/<".$tag."[^>]*>/i","<".$tag.">",$txt);
			}
		return $txt;
	}
///////////////////
if ($ACCESSION =="")
	{
		echo "Can't update something wrong<br />";
		echo "Report have reported or You have Log out the system";
		exit;
	}
if ($BIRAD !=="")
	{
		$sql ="select LEVEL,DESCRIPTION FROM xray_birad WHERE LEVEL='$BIRAD'";
		$result = mysqli_query($dbconnect, $sql);
		while ($row =mysqli_fetch_array($result))
			{
				$BIRAD_REPORT = $row['DESCRIPTION']."<br />";
				$BIRAD_LEVEL = $row['LEVEL'];
			}
	}
$TEXTREPORT = $BIRAD_REPORT.$TEXTREPORT;
if ($DICTATE_TYPE =='Save')
	{
		$sql1 = "UPDATE xray_request_detail SET PRELIM_TIME=now(), PRELIM_ID= '$userid', STATUS='PRELIM', REPORT_STATUS='1', PAGE='RADIOLOGIST' where ID='$ORDERID'";
		$sql2 = "UPDATE xray_request_detail SET TEMP_REPORT='$TEXTREPORT' WHERE ID='$ORDERID'";
		mysqli_query($dbconnect, $sql1);
		mysqli_query($dbconnect, $sql2);
	}

if ($DICTATE_TYPE == 'Approve')
	{
		$sql1 = "UPDATE xray_request_detail SET STATUS='APPROVED', REPORT_STATUS='1', PAGE='END', APPROVED_TIME=now() where ID='$ORDERID'";
		$sql2 = "INSERT INTO xray_report 
					(ACCESSION, REPORT, BIRAD, DICTATE_BY, DICTATE_DATE, DICTATE_TIME, APPROVE_BY, APPROVE_DATE, APPROVE_TIME, CENTER_CODE, REFERRER_ID) 
					values 
					('$ACCESSION', '$TEXTREPORT', '$BIRAD_LEVEL', '$userid',  CURDATE(), NOW(), '$userid', CURDATE(), NOW(), '$center_code', '$REF_ID')";
		$sql4 = "UPDATE xray_request_detail SET TEMP_REPORT='$TEXTREPORT' WHERE ID='$ORDERID'";
		mysqli_query($dbconnect, $sql1);
		mysqli_query($dbconnect, $sql2);
		mysqli_query($dbconnect, $sql4);

	}


    <script>
        var timer = setTimeout(function() {
            window.location='dictate-worklist.php'
        }, 1000);
    </script>
