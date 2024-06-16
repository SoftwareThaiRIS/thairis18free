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
$MRN = $_GET['MRN'];
$PAGE = isset($_GET['PAGE']);
include ("session.php");
include ("function.php");
if ($PAGE == '')
	
	{
		$PAGE = 'main';
	}
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  

<link rel="stylesheet" type="text/css" href="css/button.css" />
	<!-- Add jQuery library -->
	<script type="text/javascript" src="./lib/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="./source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$('.fancybox').fancybox();

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<body bgcolor="#E6E6E6" leftmargin="0" topmargin=0>
<?php
$sql = "select MRN, NAME, LASTNAME, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysqli_query($dbconnect, $sql);
$row = mysqli_fetch_array($result);

$topbar = "Patient Info";
include "topbar.php";

$patient_pic = '/patient_pic/$mrn.PNG';
 if (file_exists($patient_pic)) {
            $patient_pic ="<img src=/patient_pic/$mrn.PNG>";
        }else {
            $patient_pic="<img src=icons/man.png>";
        }
			
echo "<table bgcolor=#79acf3 align=center border=0 width=90%><tr><td align=right><a href=\"javascript:history.back(1)\"><img src=fancybox/fancy_close.png border=0></a></td></tr>";
echo "<tr bgcolor=#E8E8E8><td>";
echo "<center>";
echo "<table bgcolor=#f8d290 width=100% border=0 cellspacing=5>";
echo "<tr><td colspan=2 bgcolor=#DF7401><font color=white><b>Patient Infomation</b></font> </td></tr>";
echo "<tr>";
echo "<td valign=top width=3% bgcolor=white>$patient_pic</td>";
echo "<td valign=top width=97%>";
echo "NAME : ".$row['NAME']." ".$row['LASTNAME']."<br />";
echo "AGE : ".AgeCal($row['BIRTH_DATE'])."<br />";
echo "SEX : ".$row['SEX']."<br />";
echo "MRN : ".$MRN;
echo "</td></tr></table>";
echo "</center>";
echo "<center><table width=100%><tr><td>Tools : ";
if ($edit_patient == '1')
	{
		echo "<img src=icons/pencil-field.png><a href=patient-edit.php?MRN=".$MRN." >Edit Info  </a> ";
	}
echo "<img src=icons/plus-button.png><a href=createorder.php?MRN=$MRN>Create New Order  </a> ";
echo "</td></tr></table></center><p></p>";
$sql = "SELECT xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE,
			xray_request_detail.STATUS,
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REPORT_STATUS, 
			xray_request_detail.STUDY_UID,
			xray_code.DESCRIPTION 
			FROM 
			xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request.MRN = '$MRN')
			INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN)";
			
$result = mysqli_query($dbconnect, $sql);
$bg ="#FFCCCC";
echo "<center><table width=100%>";
echo "<tr bgcolor=#005fbf><td><font color=white><b>Report</b></font></td><td><font color=white><b>Study Date</b></font></td><td><font color=white><b>Accession</b></font></td><td><font color=white><b>Code</b></font></td><td><font color=white><b>Procedure</b></font></td><td><font color=white><b>Status</b></font></td><td><font color=white><b>View Image</b></font></td><td><font color=white>Print</font></td></b></font></tr>";
while($row = mysqli_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ 
				$bg = "#A9BCF5";
			}
		else 
			{
				$bg = "#FFFFFF";
			}
		if ($row['REPORT_STATUS']=='1')
			{
				$report_icon ="<a href=showreport.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./image/report.gif border=0></a> ";
			
			}
		else 
			{
				$report_icon ="-";
			}
		$ACCESSION = $row['ACCESSION'];
		$SUID = $row['STUDY_UID'];
		if (($row['STATUS'] == 'COMPLETE'))
		{
			$statuslink = "<a href=examroom.php>";
			$endlink = "</a>";
		}
		if (($row['STATUS'] == 'NEW'))
		{
			$statuslink = "<a href=order.php>";
			$endlink = "</a>";
		}
		if (($row['STATUS'] == 'STARTED'))
		{
			$statuslink = "<a href=examroom.php>";
			$endlink = "</a>";
		}
		if (($row['STATUS'] == 'CANCEL'))
		{
			$statuslink = "";
			$endlink = "";
		}
		if (($row['STATUS'] == 'APPROVED'))
		{
			$statuslink = "";
			$endlink = "";
		}
		if (($row['STATUS'] == 'READY'))
		{
			$statuslink = "<a href=examroom.php>";
			$endlink = "</a>";
		}	
		if (($row['STATUS'] == 'TOREPORT'))
		{
			$statuslink = "<a href=dictate-worklist.php>";
			$endlink = "</a>";
		}		
		if (($row['STATUS'] == 'QC'))
		{
			$statuslink = "<a href=examroom.php>";
			$endlink = "</a>";
		}	
		echo "<tr bgcolor=".$bg."><td width=65>".$report_icon."</td><td>".EngEachDate($row['REQ_DATE'])."</td><td><a href=order-info.php?ACCESSION=".$row['ACCESSION']."&MRN=".$MRN."><font color=black>".$row['ACCESSION']."</font></a></td><td>".$row['XRAY_CODE']."</td><td>".$row['DESCRIPTION']."</td><td>$statuslink".$row['STATUS']."$endlink</td>";
			
			if (($row['STATUS'] == 'COMPLETE') OR ($row['STATUS'] == 'PRELIM') OR ($row['STATUS'] == 'APPROVED') OR ($row['STATUS'] == 'QC') OR ($row['STATUS'] == 'TOREPORT'))
			{
				
				echo "</tr>";

			}
			else
			{
				echo "<td></td></tr>";
			}
	}
echo "</table></center>";
echo "</td></tr></table>";	
?>
<iframe name="pacsResult" frameborder="0" width="0" height="0"></iframe>

