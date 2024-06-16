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
include ("function.php");
$searchbox = $_POST['searchbox'];
$datestart = $_POST['date1'];
$dateend = $_POST['date2'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchmrn = trim($_POST['mrn']);
$searchmrn2 = trim($_POST['mrn']);

if ($searchbox == '1')
	{	
		$searchmrn = $searchmrn;
	}	

if ($searchbox != '1')
	{	
		$searchmrn = $_SESSION['cookie_dictate_mrn'];
	}

$_SESSION['cookie_dictate_mrn'] = $searchmrn;

$searchacc = $_POST['acc'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];
$mod1 = $_POST['Mod_option1']; //CT
$mod2 = $_POST['Mod_option2']; //MRI
$mod3 = $_POST['Mod_option3']; //XRAY
$mod4 = $_POST['Mod_option4']; //MAMMO
$mod5 = $_POST['Mod_option5']; //US
$mod6 = $_POST['Mod_option6']; //ANGIO
$mod7 = $_POST['Mod_option7']; //BMD
$mod8 = $_POST['Mod_option8']; //
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$selectuserID = $_POST['selectuserID1'];
if ($date1 =='')
	{
		$date1 = '2021-01-01';
	}

if ($date2 =='')
	{
		$date2 = date('Y-m-d');
	}

if ($selectuserID !='')
	{
		($usercodesearch = $selectuserID);
	}
		
if ($selectuserID =='')
	{
		($usercodesearch = $userid);
	}
?>

<!DOCTYPE HTML>
<html>>
<head>
<title>Reporting</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/button.css" />
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
<style type="text/css">  
/* Overide css code กำหนดความกว้างของปฏิทินและอื่นๆ */  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 
<script type="text/JavaScript" src="reporting.js"></script>
<script type="text/javascript" src="unlockexam.js"></script>
<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="2:59"
if (document.images)
	{ 
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}
function beginrefresh()
	{
		if (!document.images)
			return
		if (parselimit==1)
			window.location.reload()
		else
			{
				parselimit-=1
				curmin=Math.floor(parselimit/60)
				cursec=parselimit%60
				if (curmin!=0)
					curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
				else
					curtime=cursec+" seconds left until page refresh!"
					window.status=curtime
					//setTimeout("beginrefresh()",1000)
					setTimeout("beginrefresh()",500)
			}
	}

window.onload=beginrefresh
//-->
</script>
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
	<link href="css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
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

<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>

<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
			
<?php

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-A".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-B".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}
			?>	
			
			
		});
</script>
</head>


<body bgcolor="gray" leftmargin="3">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right><img src=icons/application-table.png><a href=workload-my.php><font color=white>  My Work Load </font></a></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Radiologist Worklist</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />

<?php

		if (($mod1 == '') AND ($mod2  =='') AND ($mod3  =='') AND ($mod4  =='') AND ($mod5  =='') AND ($mod6  =='') AND ($mod7  =='') AND ($mod8 ==''))
			{
					$mod1 = 'CT';
					$mod2 = 'MRI';
					$mod3 = 'XRAY';
					$mod4 = 'MAMMO';
					$mod5 = 'US';
					$mod6 = 'ANGIO';
					$mod7 = 'BMD';
			}	
			

$sql1 = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.LOCKBY= '$userid'";
mysqli_query($dbconnect, $sql1);

// Default Display (No search)
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.BIRTH_DATE, 
			xray_patient_info.SEX,
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.START_TIME AS START_TIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN_ID AS ASSIGN_ID,
			xray_request_detail.ASSIGN_CODE AS ASSIGN_CODE,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.READY_TIME AS TIMEREADY,
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_request_detail.REPORT_BOOK,
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_department.NAME_THAI AS DEP,
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_user.ID AS USERID,
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request_detail.ASSIGN_ID = '$usercodesearch') 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN_ID = xray_user.ID) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_request_detail.STATUS ='TOREPORT' OR xray_request_detail.STATUS = 'PRELIM') 
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchmrn%' AND xray_request_detail.ACCESSION like '%$searchacc%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (xray_request_detail.REQUEST_DATE between '$date1' AND '$date2') 
			AND xray_code.DESCRIPTION like '%$mod8%'
			AND (
			xray_code.XRAY_TYPE_CODE = '$mod1'	OR
			xray_code.XRAY_TYPE_CODE = '$mod2'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod3'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod4'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod5'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod6'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod7' 	AND
			xray_code.DESCRIPTION like '%$mod8%'
			)
			ORDER BY URGENT desc, FLAG1 ASC, ORDERTIME ASC
			LIMIT 0 , 999 ";

if ($usertype =='ADMIN')
	{
		$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.BIRTH_DATE, 
			xray_patient_info.SEX,
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.START_TIME AS START_TIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN_ID AS ASSIGN_ID,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.READY_TIME AS TIMEREADY,
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_request_detail.REPORT_BOOK,
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_department.NAME_THAI AS DEP,
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN_ID = xray_user.ID) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_request_detail.STATUS ='TOREPORT' OR xray_request_detail.STATUS = 'PRELIM') 
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchmrn%' AND xray_request_detail.ACCESSION like '%$searchacc%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (xray_request_detail.REQUEST_DATE between '$date1' AND '$date2') 
			AND xray_code.DESCRIPTION like '%$mod8%'
			AND (
			xray_code.XRAY_TYPE_CODE = '$mod1'	OR
			xray_code.XRAY_TYPE_CODE = '$mod2'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod3'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod4'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod5'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod6'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod7' 	AND
			xray_code.DESCRIPTION like '%$mod8%'
			)
			ORDER BY URGENT desc, FLAG1 ASC, ORDERTIME ASC
			LIMIT 0 , 999 ";
	}
	
if ($usertype =='TRANSCRIPTIONIST')
	{	
		$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.BIRTH_DATE, 
			xray_patient_info.SEX,
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.START_TIME AS START_TIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN_ID AS ASSIGN_ID,
			xray_request_detail.ASSIGN_CODE AS ASSIGN_CODE,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.READY_TIME AS TIMEREADY,
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_request_detail.REPORT_BOOK,
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_department.NAME_THAI AS DEP,
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_user.ID AS USERID,
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN_ID = xray_user.ID) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_request_detail.STATUS ='TOREPORT' OR xray_request_detail.STATUS = 'PRELIM') 
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchmrn%' AND xray_request_detail.ACCESSION like '%$searchacc%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (xray_request_detail.REQUEST_DATE between '$date1' AND '$date2') 
			AND xray_code.DESCRIPTION like '%$mod8%'
			AND (
			xray_code.XRAY_TYPE_CODE = '$mod1'	OR
			xray_code.XRAY_TYPE_CODE = '$mod2'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod3'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod4'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod5'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod6'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod7' 	AND
			xray_code.DESCRIPTION like '%$mod8%'
			)
			ORDER BY URGENT desc, FLAG1 ASC, ORDERTIME ASC
			LIMIT 0 , 999 ";
	}
$result = mysqli_query($dbconnect, $sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#79acf3">
		<tr>
				<td align=center width=20%><b>Select Worklist</b></td><td align=center width=25%><b>Patient Search</b></td>
				<td align=center width=25%><b>Modaility</b></td><td align=center width=25%><b>Date</b></td>
		</tr>
  <tr>
    <td bgcolor="#f8d290" align=center>
	<form method="post" action="dictate-worklist.php" name="searchform">
      <select name="selectuserID1" id="select">
        <option value="<?php echo $userid; ?>">My Worklist</option>
        <option value="ALL">All Worklost</option>

<?php
$sql2= "SELECT xray_user.NAME AS name, xray_user.ID AS USERID
	FROM xray_user 
	WHERE xray_user.center_code ='$center_code'
	AND xray_user.USER_TYPE_CODE ='RADIOLOGIST'";
$result2 = mysqli_query($dbconnect, $sql2);
while($row2 = mysqli_fetch_array($result2)) 
	{
		echo "<option value=".$row2['USERID']." >".$row2['name']."</option>";
	}
?>
	
      </select>
	  </td>
	  
    <td  bgcolor="#f8d290"><p>
		<INPUT TYPE=hidden NAME="searchbox" value="1">
 				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
							<td  valign="top"  >MRN</td>
							<td><input type="text" name="mrn" id="MRN" value=<?php echo $searchmrn; ?>></td>
							<td>ACC </td>
							<td><input type="text" name="acc" value=<?php echo $searchacc; ?>></td>
						</tr>
						<tr>
							<td> Name </td><td><input type="text" name="searchname" value=<?php echo $searchname; ?>></td>
							<td>Lastname </td><td><input type="text" name="searchlast" value=<?php echo $searchlast; ?>></td>
						</tr>
					</table>
					<center>

					</center>
    </p>
    </td>
			<td align=center bgcolor="#f8d290"> 

				<table>
				<tr>
<?php
 if ($mod1 == 'CT') 
 {
		echo "<td><input type=\"checkbox\" name=Mod_option1 value=\"CT\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_1\" class=\"css-label\"> CT</label></td>";
 }
 else
	{
		echo "<td><input type=\"checkbox\" name=Mod_option1 value=\"CT\"/><label for=\"demo_box_1\" name=\"demo_lbl_1\" class=\"css-label\"> CT</label></td>";
	}
	
 if ($mod2 == 'MRI')
 {
	
		echo "<td><input type=\"checkbox\" name=Mod_option2 value=\"MRI\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_2\" class=\"css-label\"> MR</label></td>";
 }
	else 
	{
		echo "<td><input type=\"checkbox\" name=Mod_option2 value=\"MRI\" /><label for=\"demo_box_1\" name=\"demo_lbl_2\" class=\"css-label\"> MR</label></td>";
	}
	
 if ($mod3 == 'XRAY')
 {
	 echo "<td><input type=\"checkbox\" name=Mod_option3 value=\"XRAY\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_3\" class=\"css-label\"> XRAY</label></td>";
 }
	else 
	{
	 echo "<td><input type=\"checkbox\" name=Mod_option3 value=\"XRAY\" /><label for=\"demo_box_1\" name=\"demo_lbl_3\" class=\"css-label\"> XRAY</label></td>";
	}
	
 if ($mod4 == 'MAMMO')
 {
	 echo "<td><input type=\"checkbox\" name=Mod_option4 value=\"MAMMO\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_4\" class=\"css-label\"> MG</label></td>";
 }
	else 
	{
	echo "<td><input type=\"checkbox\" name=Mod_option4 value=\"MAMMO\" /><label for=\"demo_box_1\" name=\"demo_lbl_4\" class=\"css-label\"> MG</label></td>";
	}

	echo "</tr><tr>";
	
	
 if ($mod5 == 'US')
 {
	 echo "<td><input type=\"checkbox\" name=Mod_option5 value=\"US\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_5\" class=\"css-label\"> US</label></td>";
 }
	else 
	{
	echo "<td><input type=\"checkbox\" name=Mod_option5 value=\"US\" /><label for=\"demo_box_1\" name=\"demo_lbl_5\" class=\"css-label\"> US</label></td>";
	}
	
 if ($mod6 == 'ANGIO')
 {
	 echo "<td><input type=\"checkbox\" name=Mod_option6 value=\"ANGIO\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_6\" class=\"css-label\"> FLU/IVP</label></td>";
 }
	else 
	{
	 echo "<td><input type=\"checkbox\" name=Mod_option6 value=\"ANGIO\" /><label for=\"demo_box_1\" name=\"demo_lbl_6\" class=\"css-label\"> FLU/IVP</label></td>";
	}
	
 if ($mod7 == 'BMD')
 {
	 echo "<td><input type=\"checkbox\" name=Mod_option7 value=\"BMD\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_7\" class=\"css-label\"> BMD</label></td>";
 }
	else 
	{
	 echo "<td><input type=\"checkbox\" name=Mod_option7 value=\"BMD\" /><label for=\"demo_box_1\" name=\"demo_lbl_7\" class=\"css-label\"> BMD</label></td>";
	}
	


	
?>		
				</tr>
				</table>

				<!--<center><input type=button value="refresh" onClick="window.open('order.php','main')"></center>-->
			</td>

<td bgcolor="#f8d290">
<center>
<input type="date" name="date1" id="dateInput1" value=<?php echo $date1; ?> size=8/> 
 
To 

<INPUT TYPE="date" NAME="date2" id="dateInput2" VALUE="<?php echo $date2; ?>" SIZE=10>

</center>
	</td>
	</tr>

  <tr><td colspan=4 bgcolor=#79acf3><center>
  <button type=reset class="positive" name="reset" value="reset"><img src="icons/arrow-circle-225-left.png" width=15 alt="reset" border=0 /> Reset </button>
  <button type=submit class="positive" value="submit"><img src="icons/find.png" width=15 alt="Search" border=0 /> Search </button>
  </center></td></tr>
</form>
</table>
</table>
<br />
<?php

echo "<table border='0' cellspacing='0' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>Flag</font></th>
<th><font color=#000000> MRN / ACC</font></th>
<th><font color=#000000>Assign To</font></th>
<th><font color=#000000>Patient Name</font></th>
<th><font color=#000000>Mod</font></th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician/Dep.</font></th>
<th><font color=#000000>Report Date</font></th>
<th><font color=#000000>Exam Time</font></th>
<th></th>
</tr>\n";
$bg ="#FFCCCC";
$count = 0;
while($row = mysqli_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ //Chang Color
				$bg = "#C8C8C8";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		$count = $count+1;
		echo "<tr bgcolor=$bg onMouseOver=this.bgColor='gold'; onMouseOut=this.bgColor='".$bg."';>";
		echo "<td>";
		$URGENT = $row['URGENT'];
		if ($URGENT == 1) 
			{
				$ALERT = "<img src=./icons/exclamation-red-frame.png> ";
			}
		$req_no = $row['req_no'];
		$result1 = mysqli_query($dbconnect, "SELECT NOTE FROM xray_request WHERE REQUEST_NO ='$req_no' ");
		while($row1 = mysqli_fetch_array($result1)) 
			{
				$NOTE= $row1['NOTE'];
			}
		
		if ($NOTE !=='')
			{
				echo "<img src=icons/notebook--exclamation.png>";
			}
		if ($URGENT == 0 ) 
			{
				$ALERT = "";
			}
		if ($row['STATUS'] == 'PRELIM')
			{
				echo "<img src=icons/book-open-text.png>";
			}
		if ($row['FLAG1'] ==1)
			{
				echo "<img src=icons/award_star_bronze_1.png>";
			}
		echo $ALERT;
		echo "</td>";
		echo "<td>".$row['MRN']."<br />";
		echo "<img src=arrow.gif><a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."&PAGE=dictate-worklist>";
		//echo "<img src=arrow.gif> <a id='variousL-A".$count."' href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION'].">";
		echo "<font size=-2 color=green>".$row['ACCESSION']."</font></a></td>";
		echo "<td>".$row['RAD']."</td>";
		//echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ACCESSION=".$row[ACCESSION]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a><font size=-1>".$row[ACCESSION]."</font></td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=patient-info.php?MRN=".$row['MRN']."&PAGE=dictate-worklist>";
		if ($row['SEX'] == 'M')
		{
			echo "<img border=0 src=./icons/user-green.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
		}
		
		if ($row['SEX'] == 'F')
		{
			echo "<img border=0 src=./icons/user-female.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
		}
		if ($row['SEX'] == 'U')
		{
			echo "<img border=0 src=./icons/users.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
		}
		$birthday = $row['BIRTH_DATE'];
		echo "<font color=gray size=-2>".AgeCal($birthday)."</font>";
		echo "</td>";
		echo "<td>".$row['MODALITY']." </td>";
		echo "<td>".$row['DESCRIPTION']."<br />".$row['XDNOTE']."</td>";
		echo "<td>".$row['DOCTORNAME']." ".$row['DOCTORLASTNAME']."<br /><font size=-1 color=green><img src=arrow.gif> ".$row['DEP']."</font></td>";
		echo "<td>";
		if ($row['FLAG1'] ==1)
			{
				echo "<br /><img src=icons/award_star_bronze_1.png><font color=red>Urgent</font>";
			}
		if ($row['FLAG1'] ==2)
			{
				echo "<br /><font color=#61210B>One day</font>";
			}
		if ($row['FLAG1'] ==3)
			{
				echo "<br /><font color=#61210B>Two days</font>";
			}			
		if ($row['FLAG1'] ==4)
			{
				echo "<br /><font color=#61210B>One Week</font>";
			}		
		if ($row['FLAG1'] ==5)
			{
				echo "<br /><font color=#61210B>In date ".EngEachDate($row['REPORT_BOOK'])."</font>";
			}	
		echo "</td>";
		echo "<td>".EngEachDate($row['START_TIME'])."<br />".DateThai3($row['START_TIME']);
		echo "</td><td><div id=".$row['ORDERID'].">";
		$status = $row['STATUS'];
		$ORDERID = $row['ORDERID'];
		$LOCKBY = $row['LOCKBY'];
		$LOCKBY = trim($LOCKBY);
		//if (($usertype =='RADIOLOGIST' OR $superadmin =='1') and ($LOCKBY == ''))
		if (($usertype =='RADIOLOGIST') and ($LOCKBY == ''))
			{
				echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'>";
				echo "<button type=submit class=\"positive\" name=\"start\"> <img src=\"images/page_edit.png\" alt=\"\"/> Read</button></form>";
			}
		if (($usertype =='TRANSCRIPTIONIST') and ($LOCKBY == ''))
			{
				echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'>";
				echo "<input type=hidden name=usertype value='transcriptionist'>";
				echo "<button type=submit class=\"positive\" name=\"start\"> <img src=\"images/page_edit.png\" alt=\"\"/> Transcription</button></form>";
			}
		if ($superadmin =='1' and $LOCKBY !=='')
			{
				echo "<center><img src=icon/lock.gif onClick=unlockexam2(".$row['ORDERID'].")></center>";
			}
		//if ($usertype !=='RADIOLOGIST' AND $superadmin =='0')
		if ($usertype !='RADIOLOGIST' AND $usertype !='TRANSCRIPTIONIST')
			{
				echo "<td>Wait reporting</td>";
			}
		if ($LOCKBY !=='')
			{
				echo "<img src=icon/lock.gif>";
			}
		echo "</div></td></tr>\n";	
	}
echo "<tr><th colspan=9 align=right>";
echo "Total =".$count;
echo "</th></tr></table>";
echo "</br>";
echo "<center><font color=white>CopyRight(C)</font></center>";

?>
<script language=javascript>
document.searchform.mrn.focus();
</script>
</body>
</html>