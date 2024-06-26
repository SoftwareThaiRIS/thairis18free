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
include "session.php";
include "connectdb.php";
include "function.php";
$ORDERID = $_GET['ORDERID'];
$RADID = $_GET['RADID'];

if ($usertype !=='RADIOLOGIST' AND $superadmin =='0')
		{
			echo "<p><p><p><br \>";
			echo "<li>You Can't Access Reporting page</li>";
			exit;
		}

function mysqlshow_result($result, $row, $field = 0)
{
	$result->data_seek($row);
	$data = $result->fetch_array();
}
?>
<!DOCTYPE HTML>
<html>
<head><title>Dictate</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>
<!--<script type="text/javascript" src="unlockexam.js"></script>-->
<script type="text/javascript" src="nicEdit.js"></script> 
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript" language="javascript">
function doReplace(templateID) {
    if (confirm("Do you Replace text by template?")) {
	var templateID;
	      templateinsert(templateID);
    }
 }
</script>

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
	<style>
		a:link {
			text-decoration: none;
			color: #424242;
			}

		a:visited {
			text-decoration: none;
			color: #424242;
			}
		a:hover {
			text-decoration: underline;
			}
		a:active {
			text-decoration: underline;
			}
</style>

	
<script type="text/javascript" src="template.js"></script>
</head>
<body bgcolor='#d4d4d4' topmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right>
					<img src=icons/arrow-curve-180-left.png><a href=dictate-worklist.php style="text-decoration: none">
					<b><font color=white> Back To Worklist </font></b></a></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif"><font color=red><b>Edit Report</b></font></td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<?php
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG  AS PTENGNAME, 
			xray_patient_info.LASTNAME_ENG  AS PTENGLAST, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.SEX,
			xray_patient_info.BIRTH_DATE AS DOB,
			xray_patient_info.NOTE AS PT_NOTE,
			xray_request.REQUEST_NO AS req_no, 			
			xray_request.NOTE,
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
			xray_request_detail.ASSIGN_ID,
			xray_request_detail.ASSIGN_BY,
			xray_request_detail.TECH1,
			xray_request_detail.TECH2,
			xray_request_detail.TECH3,
			xray_request_detail.FLAG1,
			xray_request_detail.FLAG2,
			xray_code.XRAY_TYPE_CODE AS MOTYPE,
			xray_code.BODY_PART AS PROC,
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
			WHERE (xray_request_detail.PAGE = 'END' and xray_request_detail.ID = '$ORDERID') 
			ORDER BY ORDERTIME desc";

//echo $sql;
//exit;
$result = mysqli_query($dbconnect, $sql);
while($row = mysqli_fetch_array($result))
	{
			$MRN             = $row['MRN'];
			$PATIENTNAME     = $row['PTNAME'];
			$PATIENTLASTNAME = $row['PTLASTNAME'];
			$PATIENTENGNAME	 = $row['PTENGNAME'];
			$PATIENTENGLAST	 = $row['PTENGLAST'];
			$PT_NOTE = $row['PT_NOTE'];
			$SEX = $row['SEX'];
			$DOB = $row['DOB'];
			$ACCESSION		 = $row['ACCESSION'];
			$REQUEST_NO 	 = $row['req_no'];
			$EXAM_NOTE = $row['NOTE'];
			$REQ_DATE = $row['REQ_DATE'];
			$REQ_TIME = $row['REQ_TIME'];
			$ORDERDATE	     = $row['ORDERTIME'];
			$PROCEDURE		 = $row['DESCRIPTION'];
			$MOTYPE = $row['MOTYPE'];
			$PROCBODYPART = $row['PROC'];
			//$REFERRER        = $row[];
			$DEPARTMENT      = $row['DPNAME'];
			$PHYSICIANNAME 		= $row['DOCTORNAME'];
			$PHYSICIANLASTNAME	= $row['DOCTORLASTNAME'];
			$BIRADFLAG = $row['BIRAD_FLAG'];
			$ASSIGN1 = $row['ASSIGN_ID'];
			$ASSIGN_BY1 = $row['ASSIGN_BY'];
			$TECH1 = $row['TECH1'];
			$TECH2 = $row['TECH2'];
			$TECH3 = $row['TECH3'];
			$FLAG1 = $row['FLAG1'];
			$FLAG2 = $row['FLAG2'];
			$NOTE = $row['NOTE'];
	}
	
$sql2 = "SELECT LOCKBY FROM xray_request_detail  WHERE xray_request_detail.ACCESSION='$ACCESSION'";
$result =mysqli_query($dbconnect, $sql2);
while($row=mysqli_fetch_array($result))
	{
		$LOCKBY = $row['LOCKBY'];
		$LOCKBY = trim($LOCKBY);
		if  ($LOCKBY !=='')
			{
				echo "<br /><br /><br />";
				echo "<img src=icons/exclamation-red.png> This Exam Locked by other Radiologist (".$LOCKBY.") <b> [ </b>";
				echo "<a href=dictate-worklist.php>Black to Work list </a><b>]</b>";
				exit;
			}
	}
	
// Lock Report for Reporting
$sql = "UPDATE xray_request_detail SET LOCKBY ='$userid' WHERE xray_request_detail.ID = '$ORDERID'";
mysqli_query($dbconnect, $sql);
echo "<table width=100% bgcolor=#D8D8D8>";
echo "<tr><td>";
echo "<center><table border=0 bgcolor=#c2c2c2><tr><td valign=top>";
////////////////////////////////////////////////////Auto Save Report///////////////////////////////////////

?>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" class="selected" rel="#default">Order</a></li>
<li><a href="dictate-patientinfo.php?ORDERID=<?php echo $ORDERID; ?>" rel="countrycontainer">Patient</a></li>
</ul>
<div id="countrydivcontainer" style="border:1px solid gray; width:200px; margin-bottom: 1em; padding: 1px">
<table bgcolor="#EBEBEB" width="100%" border=0>
<tr><td bgcolor=#79acf3>
<?php
echo "</td></tr><tr><td bgcolor=#79acf3>";
echo "<center><b>Order History</b></center>";
echo "</td></tr><tr><td>";
?>

<!-- HTML Codes by Quackit.com -->
<!--div style="height:490px;width:200px;font:16px/26px MS Sans Serif;overflow:scroll;"-->

<?php
$sql2 = "SELECT 
			xray_request_detail.ID,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE,
			xray_request_detail.STATUS,
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS ORDERTIME,
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIMESTAMP,
			xray_request_detail.ASSIGN_ID AS ASSIGN,
			xray_request_detail.REPORT_STATUS, 
			xray_code.DESCRIPTION 
			FROM xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request.MRN = '$MRN')
			INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) ORDER BY ORDERTIMESTAMP DESC";
$result2 = mysqli_query($dbconnect, $sql2);
$bg ="#FFCCCC";
echo "<center><table width=100% border=0><tr bgcolor=#ccDDff><td colspan=2><center><b>Date/Procedure</b></center></td></tr>";
while($row = mysqli_fetch_array($result2))
		{
			if($bg == "#FFFFFF" or $bg =="#f8d290") 
				{ 
					$bg = "#C2DFFF";
				} 
			elseif ($ORDERID !== $row['ID'])
				{
					$bg = "#FFFFFF";
				}
			if ($ORDERID == $row['ID'])
				{
					$bg = "#f8d290";
				}
			if ($row['REPORT_STATUS']=='1')
				{
					$report_icon ="<a class=\"fancybox fancybox.iframe\" href=showreport.php?ACCESSION=".$row['ACCESSION']." ><img src=icons/report1.png border=0></a>";
				}
			//xray_request_detail.ID = '$ORDERID'
			else 
				{
					$report_icon ="<img src=icons/layer--minus.png>";
					$report_icon ="";
				}
			//echo "<tr bgcolor=".$bg."><td width=45>".$report_icon."</td><td>".EngEachDate($row[REQ_DATE])."</td><td>".$row[ACCESSION]."</td><td>".$row[XRAY_CODE]."</td><td>".$row[DESCRIPTION]."</td><td>".$row[STATUS]."</td><td>View</td></tr>";
			//<a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=$MRN&ACCESSION=$ACCESSION>
			echo "<tr bgcolor=".$bg."><td valign=top>".$report_icon."</td><td><font color=#084B8A size=-1><b><a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=$MRN&ACCESSION=".$row['ACCESSION'].">".EngEachDate(($row['REQ_DATE']))."  ".($row['ORDERTIME'])."</b></font></a><br />";
			echo "<img src=arrow.gif> <font size=-2>".$row['DESCRIPTION']."</font>";
			//echo "<br /><img src=arrow.gif border=0><font size=-2>Assign To : ".$row[ASSIGN]."</font>";
			echo "</td></tr>";
		}
echo "</table></center>";

///////////////////////////////
?>
<!--/div-->
</td></tr></table>
</div>
<table>
</table>
<script type="text/javascript">
var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>

<?php
echo "</td>";
echo "<td valign=top>\n";
echo "<table width=100% align=center bgcolor=#79acf3 cellspacing=0><tr><td colspan=4><b><img src=icons/information-shield.png> Order Information</b></td></tr>";
echo "<tr bgcolor=#f8d290><td><font color=black><b>Name</b>  </td><td>: ".$PATIENTNAME." ".$PATIENTENGNAME." ".$PATIENTLASTNAME." ".$PATIENTENGLAST."</font></td><td><b>Age </b></td><td>: ".AgeCal($DOB)."</td></tr>\n";
echo "<tr bgcolor=#f8d290><td><font color=black><b>HN</b> </td><td> : ".$MRN. "</td><td><b> Order Time</b> </td><td> : ".EngEachDate($REQ_DATE)." ".$REQ_TIME."</font></td></tr>\n";
echo "<tr bgcolor=#f8d290><td><b>Sex</b></td><td>: ".$SEX."</td><td><b>Department</b></td><td> : ".$DEPARTMENT."</td></tr>\n";
echo "<tr bgcolor=#f8d290><td><b>Procedure</b></td><td> : ".$PROCEDURE."</td><td><b>Physician</b></td><td>: ".$PHYSICIANNAME." ".	$PHYSICIANLASTNAME."</td></tr>\n";
echo "<tr bgcolor=#f8d290><td><b>Accession No.</b></td><td> : ".$ACCESSION."</td><td><b></b></td><td></td></tr>\n";
echo "</table>";

if ($BIRADFLAG =='1')
		{	
			echo "<script language=\"javascript\">";
			echo "function fncSubmit()";
			echo "{";
			echo "	if(document.REPORT.BIRAD.value == \"0\")";
			echo "		{";
			echo "			alert('Please Select BIRAD');";
			echo "			document.REPORT.BIRAD.focus();";
			echo "			return false;";
			echo "		}";
			echo "document.qc.submit();";
			echo "}";
			echo "</script>"; 
		}
		
echo "<form name=REPORT method=post action=dictated.php enctype=\"multipart/form-data\" onSubmit=\"JavaScript:return fncSubmit();\">";

if ($BIRADFLAG =='1')
		{		
			$sql ="select BIRAD, DESCRIPTION FROM xray_birad";
			$result = mysqli_query($dbconnect, $sql);
			echo "<center>[Mammography option]</center><center> <b>Select BIRAD</b> : <select name=BIRAD>";
			echo "<OPTION value='0'>-</OPTION>";
				while ($row =mysqli_fetch_array($result))
					{
						echo "<option value='".$row['BIRAD']."'>".$row['DESCRIPTION']."</option>";
					}
			echo "</select></center>";
		}

echo "<input type=hidden name='ORDERID' value=\"".$ORDERID."\"><input type=hidden name='ACCESSION' value=\"".$ACCESSION."\"><inputer type=hidden name='RADID' value=\"".$usercode."\">\n";
echo "<input type=hidden name='hn' value=\"".$MRN."\">";
?>

<table style=border-style:solid;border-width:1px; bgcolor=#EEEEEE cellspacing="0" cellpadding="0">
<tr><td>
<div id="reportspace">
	<textarea id="area2" name="TEXTREPORT" cols="109" rows="22">
	<div id="REPORTAREA">
	<?php
	$result = mysqli_query($dbconnect, "SELECT REPORT FROM xray_report WHERE ACCESSION = '$ACCESSION'");
	while($row = mysqli_fetch_array($result))
		{
			$TEMP = $row['REPORT'];
			$TEMP = str_replace("<div id=\"REPORTAREA\">", "<div>", $TEMP);
			// Remove Hilight text from google chrome
				$TEMP = str_replace("<span style=\"line-height: 16.5454540252686px; background-color: rgb(238, 238, 238);\">", "", $TEMP);
				$TEMP = str_replace("<span style=\"line-height: 1.3; background-color: rgb(238, 238, 238);\">", "", $TEMP);
				$TEMP = str_replace("background-color: rgb(238, 238, 238)", "", $TEMP);			
				$TEMP = preg_replace("/<span[^>]+\>/i", "", $TEMP);
				$TEMP = str_replace("</span>", "", $TEMP);
		}
	echo $TEMP;
	?>
	</div>
	</textarea>
</div></td></tr>
</table>
<center>
<table width=100%><tr><td>
<div id="timestamp" align=right><font size=-1>Auto Save : Time</font></div>
<?php
//$sql = "select ACCESSION, XRAY_CODE from xray_request_detail where REQUEST_NO ='$REQUEST_NO' and STATUS='TOREPORT' and ASSIGN ='$usercode'";
$sql1 = "select ACCESSION, XRAY_CODE from xray_request_detail where STATUS='TOREPORT' and ASSIGN_ID ='$usercode' and ACCESSION <> '$ACCESSION'";
$amount = mysqli_query($dbconnect, $sql1);

$num_rows = mysqli_num_rows($amount);
if ($num_rows > 1)
	{
		$sql ="SELECT xray_request.MRN, 
			xray_patient_info.MRN AS MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NOTE AS PT_NOTE,
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN_ID AS ASSIGN,
			xray_request_detail.ASSIGN_BY AS ASSIGN_BY, 
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request_detail.ASSIGN_ID = '$usercode' AND ACCESSION <> '$ACCESSION') 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN_ID = xray_user.CODE) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_patient_info.MRN = '$MRN')
			AND	(xray_request_detail.STATUS ='TOREPORT') OR (xray_request_detail.STATUS = 'PRELIM')
			AND (xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_patient_info.CENTER_CODE ='POLICE')
			ORDER BY URGENT desc, FLAG1 ASC, ORDERTIME ASC
			LIMIT 0 , 10";
			
		$result = mysqli_query($dbconnect, $sql);
		//$num_rows = mysql_num_rows($result);
		$num = 0;
echo "<table border=0 width=100% bgcolor=#F5F6CE>\n";
echo "<font color=black><u>Option</u> : Copy this report to</font><br />";		
			while($row = mysqli_fetch_array($result))
				{
					$num = $num+1;
					if ($row['ID'] !=$ORDERID)
						{
							if ($row['MRN'] == $MRN)
								{
									$REQ_DATE = $row['REQ_DATE'];
									//echo "<tr><td><font color=gray><INPUT TYPE=CHECKBOX NAME=COPYREPORT".$num." VALUE='".$row[ORDERID]."'><INPUT TYPE=HIDDEN NAME='COPYACC".$num."' VALUE='".$row[ACCESSION]."'></td><td> HN:".$row[MRN]. " Acc:".$row[ACCESSION]." </td><td>".$row[MODALITY]."</td><td> ".$row[DESCRIPTION]." </td><td> ".DateThai02($row[ARRIVAL])."</font></td></tr>\n";
									echo "<tr><td><font color=gray><INPUT TYPE=CHECKBOX NAME=COPYREPORT".$num." VALUE='".$row['ORDERID']."'><INPUT TYPE=HIDDEN NAME='COPYACC".$num."' VALUE='".$row['ACCESSION']."'></td><td> HN:".$row['MRN']." </td><td>".$row['MODALITY']."</td><td> ".$row['DESCRIPTION']." </td><td> ".EngEachDate($row['ARRIVAL'])."</font></td></tr>\n";									
								}
						}
				}
	echo "</table>\n";		
	
	}
?>

<br />

	<div class="buttons">
	</div>
	<center>
	<?php echo  "<a href=http://127.0.0.1:8080/?AccessionID=$ACCESSION&UserName=$pacs_login target=pacsResult><button type=button class=positive value=OpenImage><img src=images/eye.png alt=\"\" />
	Open Image</button></a>";  
	?>
	<a  class="fancybox fancybox.iframe" href=dictate_show_preview_report_pdf.php?ACCESSION=<?php echo $ACCESSION; ?> >
	<button type=button class="positive" value="Preview"><img src="images/magnifier.png" alt=""/> Preview Report</button></a>
	<a  class="fancybox fancybox.iframe" href=createtemplate.php?Accession=<?php echo $ACCESSION; ?>>
	<button type=button class="positive" value="Save Template"><img src="images/page_add.png" alt=""/> Save As Template</button></a>
	<button type=submit class="positive" name=dictate_type value="Save"><img src="images/database_save.png" alt=""/> Save Draft</button>
	<button type=submit class="positive" name=dictate_type value="Approve"> <img src="images/disk.png" alt=""/> Approve Report</button>
	</div>
	</center>
</td></tr>
</table>
</center>

<?php
echo "</form>\n";
echo "</td><td valign=top >\n";
//echo "<img src=image/monitor1.png>\n";
?>
<table  border=0 style="width:200px;" cellspacing=1 bgcolor=#EBEBEB>
<tr><td bgcolor=#79acf3 align=center><b>Options</b></td></tr>
<tr><td bgcolor=#CFECEC>
<img src=icons/information.png> 
<?php
echo "<a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=$MRN&ACCESSION=$ACCESSION>";
?>
Order Detail </a><br />
<img src=icons/information.png>
<?php
echo "<a class=\"fancybox fancybox.iframe\" href=patient-info.php?MRN=$MRN>";
?>
Patient Detail</a><br />
<img src=arrow.gif> Save to Teaching <br />
<img src=arrow.gif> Structured Report <br />
<img src=arrow.gif> ICD <br />
<img src=arrow.gif> Reject  <br />
<img src=arrow.gif> Re-Assign
</td></tr>

<tr><td bgcolor=#79acf3><center><b>Exam Note</b></center></td></tr>
<tr><td bgcolor=#CFECEC>

<?php
	if ($FLAG2 ==1)
		{
			echo "<img src=arrow.gif> VIP <br />";
			echo $REQUEST_NO;
		}
	if ($NOTE =='')
		{
			echo "<img src=arrow.gif> No Exam note <br />";
		}
	if ($NOTE !=='')
		{
			echo "<img src=icons/information-white.png> ";
			echo $NOTE."<br />";
		}
?>
</td></tr>
<tr><td bgcolor=#79acf3><center><b>Patient Note</b></center></td></tr>
<tr><td bgcolor=#CFECEC>
<?php
	if ($PT_NOTE == '')
		{
			echo "<img src=arrow.gif> No  Note for this Patient";
		}
?>

</td></tr>
<tr>
<td bgcolor=#79acf3>
<center><b>File/Document </b></center>
</td></tr>
<tr><td bgcolor=#CFECEC>
<?php

$path = "document-uploads/uploads/".$ACCESSION."/";

if (!file_exists($path)) 
	{
		echo "<img src=arrow.gif> No File scan";
	}

if (file_exists($path)) 
	{
		$string =array();
		$filePath=$path;  
		$dir = opendir($filePath);
		while ($file = readdir($dir)) 
			{ 
				if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) 
					{ 
						$string[] = $file;
					}
			}
		while (sizeof($string) != 0)
			{
				$img = array_pop($string);
				$ext = end(explode('.', $img));
				if ($ext == 'jpg')
					{ 
						echo "<a  class=\"fancybox fancybox.iframe\" href='resizeimage.php?image=$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
					}
				if ($ext == 'gif')
					{ 
						echo "<a  class=\"fancybox fancybox.iframe\" href='resizeimagegif.php?image=$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
					}
				if ($ext == 'png')
					{ 
						echo "<a  class=\"fancybox fancybox.iframe\" href='resizeimagepng.php?image=$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
					}
	
				//echo "<a  class=\"fancybox fancybox.iframe\" href='$filePath$img'><img src='$filePath$img'   style=\"border:1px solid black;\" height=45></a> ";
			}
		
	}

?>

</td>
</tr>
<tr>
<td bgcolor=#79acf3>
<center><b>Technologist </b></center>
</td></tr>
<tr><td bgcolor=#CFECEC>
<?php
echo "<b>Tech </b>";
if ($TECH1 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$TECH1'");
		$TECH1 = mysqlshow_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH1;
	}
	
if ($TECH2 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$TECH2'");
		$TECH2 = mysqlshow_result($result, 0);
		echo "<br /><img src=arrow.gif>  ".$TECH2;
	}
	
if ($TECH3 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$TECH3'");
		$TECH3 = mysqlshow_result($result, 0);
		echo "<br /><img src=arrow.gif>  ".$TECH3;
	}
echo "<br />";
echo "<b>Assign By </b>";
if ($ASSIGN_BY1 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$ASSIGN_BY1'");
		$ASSIGN_BY1 = mysqlshow_result($result, 0);
		echo "<img src=arrow.gif>  ".$ASSIGN_BY1;
	}

echo "<br />";
if ($ASSIGN1 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE CODE='$ASSIGN1'");
		$ASSIGN1 = mysqlshow_result($result, 0);
		echo "<b>Assign To</b> <img src=arrow.gif>  ".$ASSIGN1;
	}
	
	
	
?>
</td></tr></table>
<ul id="countrytabs2" class="shadetabs">

<li><a href="template.php?MOTYPE=<?php echo $MOTYPE; ?>&procbodypart=<?php echo $PROCBODYPART; ?>" rel="countrycontainer">Template</a></li>
<li><a href="dictate-keyimage.php" rel="countrycontainer">Key Image</a></li>
</ul>
<div id="countrydivcontainer2" style="border:1px solid gray; width:180px; margin-bottom: 1em; padding: 5px">
</div>

<script type="text/javascript">
var countries=new ddajaxtabs("countrytabs2", "countrydivcontainer2")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
 

<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
 </script>

<?php
echo "</td></tr></table></center>\n";
echo "<br /><br /><br />";
echo "</td></tr></table>";
echo "<center><font color=#ACACAC>CopyRight 2024 (C)</font></center>\n";
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 

</body>
</html>
