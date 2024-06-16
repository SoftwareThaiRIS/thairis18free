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
include "session.php";
include ("function.php");
set_time_limit(0);

$searchbox = $_POST['searchbox'];
$searchdate = $_POST['searchdate'];
$datestart = $_POST['date001'];
$dateend = $_POST['date002'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchhn = $_POST['searchhn'];
$searchxn = $_POST['searchxn'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];
$department = $_POST['department'];
$mod1 = $_POST['Mod_option1'];
$mod2 = $_POST['Mod_option2'];
$mod3 = $_POST['Mod_option3'];
$mod4 = $_POST['Mod_option4'];
$mod5 = $_POST['Mod_option5'];
$mod6 = $_POST['Mod_option6'];
$mod7 = $_POST['Mod_option7'];
$mod8 = $_POST['Mod_option8'];
$mod9 = '';
$status_start = $_POST['status_start'];
$status_end   = $_POST['status_end'];
$status_qc    = $_POST['status_qc'];
$PAGE = $_POST['PAGE'];

$ARRIVAL1 = date("Y-m-d")." 00:00:00";
$ARRIVAL2 = date("Y-m-d")." 23:59:59";

if (($mod1 == '') AND ($mod2  =='') AND ($mod3  =='') AND ($mod4  =='') AND ($mod5  =='') AND ($mod6  =='') AND ($mod7  =='') AND ($mod8 ==''))
	{
		$mod1 = 'CT';
		$mod2 = 'MRI';
		$mod3 = 'XRAY';
		$mod4 = 'MAMMO';
		$mod5 = 'US';
		$mod6 = 'ANGIO';
		$mod7 = 'BMD';
		$mod8 = 'FLUORO';
	}
			
$perpage = 25;
 if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
 
 $start = ($page - 1) * $perpage;
 
if ($datestart =="")
	{
		$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-1,date("Y"))); // Yesterday
		//$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-3,date("Y")));  //3 day back
		//$datestart = date("Y-m-d"); // today
	}

if ($dateend =='')
	{
		$dateend = date("Y-m-d");
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Exam Room</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
<style type="text/css">  
/* Overide css code width-high of calendar*/  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 

<script type="text/JavaScript" src="examroom-examlist.js"></script>
<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="4:39"
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
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>
	<!-- Add jQuery library -->
	<script type="text/javascript" src="./lib/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="./source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css" media="screen" />
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$(".fancybox").fancybox({
				afterClose : function() {
					location.reload();
					return;
				}
			});
			

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

    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('multiqc[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
	
</head>
<body bgcolor="gray">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Exam Room (Radiographer)</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#79acf3">
		<tr>
				<td align=center width=25%>Search Order Xray </td><td align=center width=25%>Option Search Today</td><td align=center width=25%>Department</td><td align=center width=25%>Select Date</td>
		</tr>
		
<tr bgcolor="#79acf3"> 
    <td  bgcolor="#f8d290"> 
		<FORM method="post" action="examroom.php" name="searchpatient">
		<INPUT TYPE=hidden NAME="searchbox" value="1">
 				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr> 
							<td  valign="top"  >MRN</td>
							<td><input type="text" name="searchhn" value=<?php echo $searchhn; ?>></td>
							<td>XN </td>
							<td><input type="text" name="searchxn"></td>
						</tr>
						<tr>
							<td> Name </td><td><input type="text" name="searchname" value=<?php echo $searchname; ?>></td>
							<td>Lastname </td><td><input type="text" name="searchlast" value=<?php echo $searchlast; ?>></td>
							
						</tr>
					</table>

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

 if ($mod8 == 'FLUORO')
 {
	 echo "<td><input type=\"checkbox\" name=Mod_option8 value=\"FLUORO\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_7\" class=\"css-label\"> FLUORO</label></td>";
 }
	else 
	{
	 echo "<td><input type=\"checkbox\" name=Mod_option8 value=\"FLUORO\" /><label for=\"demo_box_1\" name=\"demo_lbl_7\" class=\"css-label\"> FLUORO</label></td>";
	}
	


	
?>
</tr>
</table>



			</td>
			<td bgcolor="#f8d290"><center>Department
			<input type="text" name="department" size=15 value=<?php echo $department; ?> ></center>

			</td>
<td bgcolor="#f8d290" align=center> 
<SCRIPT LANGUAGE="JavaScript" ID="js18">
var cal18 = new CalendarPopup("testdiv1");
cal18.setCssPrefix("TEST");
</SCRIPT>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 

<INPUT TYPE="date" NAME="date001" id="date001" VALUE="<?php echo $datestart; ?>" SIZE=10>

To 

<INPUT TYPE="date" NAME="date002" id="date002" VALUE="<?php echo $dateend; ?>" SIZE=10>

      </p>
      </td>

  </tr>
  <tr><td colspan=4 bgcolor=#79acf3><center>

  <button type=reset class="positive" value="reset" onClick="refreshPage()"><img src="icons/arrow-circle-225-left.png" width=15 alt="reset" border=0 /> Reset </button>
  <button type=submit class="positive" value="submit"><img src="icons/find.png" width=15 alt="Search" border=0 /> Search </button>
  </center></td></tr>
</form>
</table>
<br />
<p></p>
<?php
//$sql = "SELECT xray_patient_info.MRN, xray_request.REQUEST_NO, xray_request_detail.ACCESSION, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.HN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)WHERE xray_request_detail.XRAY_CODE = 'C0106'";

		if (($searchbox =='1') AND ($searchhn =='') AND ($searchxn =='') AND ($searchname =='') AND ($searchlast =='') AND ($mod1 =='') AND ($mod2 =='') AND ($mod3 =='') AND ($mod4 =='') AND ($mod5 =='') AND ($mod6 =='') AND ($mod7 =='') AND ($mod8 =='') AND ($department =='') AND ($datestart =='') AND  ($dateend ==''))
		//if (($searchbox =='1') AND ($searchhn =='') AND ($searchxn =='') AND ($searchname =='') AND ($searchlast =='') AND ($mod1 =='') AND ($mod2 =='') AND ($mod3 =='') AND ($mod4 =='') AND ($mod5 =='') AND ($mod6 =='') AND ($mod7 =='') AND ($mod8 =='') AND ($datestart =='') AND  ($dateend ==''))
		{
				echo "Please search some keyword before click search";
				exit;
			}
		
	

		if (($status_start == '') AND ($status_end  =='') AND ($status_qc  ==''))
			{
				$status_start = 'READY';
				$status_end = 'STARTED';
				$status_qc = 'QC';
			}

$sql = "SELECT DISTINCT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.SEX, 			
			xray_patient_info.BIRTH_DATE, 					
			xray_request.REQUEST_NO, 					
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE,
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,	
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE,
			xray_department.NAME_THAI AS DEP,			
			xray_code.DESCRIPTION, 
			xray_referrer.NAME, 
			xray_referrer.LASTNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
			LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'EXAM ROOM') 
			AND ((xray_request_detail.STATUS  != 'CANCEL') 	AND	((xray_request_detail.STATUS  = '$status_start') OR (xray_request_detail.STATUS  = '$status_end') OR (xray_request_detail.STATUS  = '$status_qc')))
			AND ((xray_request_detail.REQUEST_DATE between '$datestart' AND '$dateend') OR (xray_request_detail.ARRIVAL_TIME between '$ARRIVAL1' AND '$ARRIVAL2'))
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchhn%'	AND xray_patient_info.XN like '%$searchxn%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (
			xray_code.XRAY_TYPE_CODE = '$mod1'	OR
			xray_code.XRAY_TYPE_CODE = '$mod2'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod3'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod4'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod5'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod6'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod7' 	OR
			xray_code.XRAY_TYPE_CODE = '$mod8' 	AND
			xray_code.DESCRIPTION like '%$mod9%'
			)
			AND xray_department.NAME_THAI like '%$department%'
			ORDER BY URGENT desc, ORDERTIME ASC 
			LIMIT {$start} , {$perpage}";

$result = mysqli_query($dbconnect, $sql);
$total_recoard = mysqli_num_rows ($result);
$total_page = ceil($total_record / $perpage);

echo "<form method=\"post\" action=qc-multi.php>";
echo "<table border='0' cellspacing='0' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>ICON</font></th>
<th><font color=#000000>MRN (HN)</font></th>
<th><font color=#000000>ACC</font></th>
<th><font color=#000000>Patient</font></th>
<th><font color=#000000>Sex</font></th>
<th><font color=#000000>Mod</font></th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician</font></th>
<th><font color=#000000>Order Time</font></th>
<th>Status </th>
</tr>\n";

$bg ="#FFCCCC";
$count = 0;
while($row = mysqli_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ ///Change colour
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
				$ALERT = "<img src=./icon/urgent.jpg> <img src=icons/notebook--exclamation.png>";
			}
		if ($URGENT == 0 ) 
			{
				$ALERT = "";
			}
		echo $ALERT;
		echo "</td>";
		echo "<td>" .$row['MRN'] . "</td>";
		echo "<td><a id='variousL-A".$count."' href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."&XRAYCODE=".$row['XRAY_CODE']."&PAGE=examroom><img border=0 src=./icon-info.png>".$row['ACCESSION']."</a></td>";
		echo "<td><a id='variousL-B".$count."' href='patient-info.php?MRN=".$row['MRN']."&PAGE=examroom'>";
		if ($row['SEX'] == 'M')
			{
				echo "<img border=0 src=./icons/user-green.png> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
			}
		if ($row['SEX'] == 'F')
			{
				echo "<img border=0 src=./icons/user-female.png> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
			}
		if ($row['SEX'] == 'U')
			{
				echo "<img border=0 src=./icons/users.png> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
			}
		echo "</a>";
		$birthday = $row['BIRTH_DATE'];
		echo "<font color=gray size=-2>".AgeCal($birthday)."$birthday</font>";
		echo "</td>\n";
		echo "<td>".$row['SEX']."</td>";
		echo "<td>".$row['XRAY_TYPE_CODE']."</td>\n";
		echo "<td>".$row['DESCRIPTION']."<br />".$row['XDNOTE']."</td>";
		echo "<td>".$row['NAME']." ".$row['LASTNAME']."<br /><font color=green><img src=arrow.gif>".$row['DEP'];
		echo "</font><td>".EngEachDate($row['REQ_DATE'])." ".$row['REQ_TIME']."</td>\n";
		$status = $row['STATUS'];
		$ORDERID = $row['ORDERID'];
		if ($row['STATUS']=='READY')
			{
				// "<td><div id='".$row[ORDERID]."'><input type=button name=Start value=START onclick=pt_arrive('".$row[ORDERID]."','STARTED')></div></td>\n";
				echo "<td><div id='".$row['ORDERID']."'><button type=button class=\"positive\" value=\"START\" onclick=pt_arrive('".$row['ORDERID']."','STARTED')> <img src=\"images/book_go.png\" alt=\"\"/> Start Exam</button></div></td>\n";
			}
		if ($row['STATUS']=='STARTED')
			{
				echo "<td><div id='".$row['ORDERID']."'><button type=button class=\"positive\" value=COMPLETE onclick=pt_arrive('".$row['ORDERID']."','ENDEXAM')> <img src=\"images/camera_go.png\" alt=\"\"/> Complete Exam</button></div></td>\n";
			}
		//////////////////////////////////// QC ////////////////////////		
		if ($row['STATUS']=='QC') 
			{		
				$ACCESSION = $row['ACCESSION'];
				echo "<!-- popup form #$ACCESSION".$row['ACCESSION']." -->\n";
				echo "<td>\n";
				echo "<a class=\"fancybox fancybox.iframe\" href=qc.php?ACCESSION=".$row['ACCESSION']."&ORDERID=".$row['ORDERID']."&MRN=".$row['MRN']." >\n";
				echo "<button type=button class=\"positive\" value=\"QC\"><img src=\"images/chart_bar_edit.png\" alt=\"\" border=0 /> QC </button></a>\n";
				echo "</td>\n";
			}
			
	if ($row['STATUS']=='ENDEXAM')
		{
			$sql2 ="select * 
						FROM xray_user 
						WHERE USER_TYPE_CODE ='RADIOLOGIST' AND CENTER_CODE='$center_code' order by NAME";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<td><div id='".$row['ORDERID']."'>\n";
			echo "<select name=selectrad id=selectrad".$row['ORDERID'].">";
			echo "<option value=''>Select Radiologist</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					echo "<option name=radid value=\"".$row['CODE']."\">".$row['NAME']."  ".$row['LASTNAME']."</option>\n";
				}
				echo "</select><input type=button name=Start value=ASSIGN onclick=assignrad('".$ORDERID."','ASSIGN')></div>";
		}
		echo "</td></tr>\n";	
 }
echo "<tr><th colspan=9 align=right>";
echo "Total =".$count;
echo "</th>";
echo "<th></th></tr></table>\n";
echo "</form>";
 $sql2 = "SELECT DISTINCT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.SEX, 			
			xray_patient_info.BIRTH_DATE, 					
			xray_request.REQUEST_NO, 					
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE,
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,	
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE,
			xray_department.NAME_THAI AS DEP,			
			xray_code.DESCRIPTION, 
			xray_referrer.NAME, 
			xray_referrer.LASTNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
			LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'EXAM ROOM') 
			AND ((xray_request_detail.STATUS  != 'CANCEL') 	AND	((xray_request_detail.STATUS  = '$status_start') OR (xray_request_detail.STATUS  = '$status_end') OR (xray_request_detail.STATUS  = '$status_qc')))
			AND ((xray_request_detail.REQUEST_DATE between '$datestart' AND '$dateend') OR (xray_request_detail.ARRIVAL_TIME between '$ARRIVAL1' AND '$ARRIVAL2'))
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchhn%'	AND xray_patient_info.XN like '%$searchxn%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
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
			AND xray_department.NAME_THAI like '%$department%'
			ORDER BY URGENT desc, ORDERTIME ASC 
			";
 $query2 = mysqli_query($dbconnect, $sql2);
 $total_record = mysqli_num_rows($query2);
 $total_page = ceil($total_record / $perpage);
 echo "totalpage : ".$total_page;
 // include ('order_from_dcm.php') use for sk hospital retrive data from dcm4chee to exam room.
?>
 
 <a href="examroom.php?page=1" aria-label="Previous">
 <span aria-hidden="true">&laquo;</span>
 </a>

 <?php for($i=1;$i<=$total_page;$i++){ ?>
 <a href="examroom.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
 <?php } ?>
  <a href="examroom.php?page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span>
 </a>
 
 <script language=javascript>
document.searchpatient.searchhn.focus();
</script>
</body>
</html>