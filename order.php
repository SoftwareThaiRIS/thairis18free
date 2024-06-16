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
$PAGE = $_POST['PAGE'];

if ($datestart =='')
	{
		$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-1,date("Y"))); // Yesterday
	}

if ($dateend =='')
	{
		$dateend = date("Y-m-d");
	}
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
	
$perpage = 50;
 if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
 
 $start = ($page - 1) * $perpage;
?>
<!DOCTYPE html>
<html>
<head>
<title>Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src='css/taskbar.js'></script>
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
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
 
<script type="text/javascript" src='Scripts/jquery-1.4.4.js'></script>
<script type="text/javascript" src="Scripts/jquery.jclock.js"></script>  
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
<style type="text/css">
span.dropt 
	{
		border-bottom: thin dotted; background: #ffeedd;
	}
span.dropt:hover 
	{
		text-decoration: none; background: #ffffff; z-index: 6; 
	}
span.dropt span 
	{
		position: absolute; left: -9999px;
		margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
		border-style:solid; border-color:black; border-width:1px; z-index: 6;
	}
span.dropt:hover span 
	{
		left: 2%; background: #ffffff;
		margin: 20px 0 0 170px; background: #ffffff; z-index:6;
	} 
</style>
	
<script type="text/javascript">
    $(function($) {
       var options = {
            timeNotation: '12h',
            am_pm: true,
            fontFamily: 'Verdana',
            fontSize: '16px',
            foreground: 'black'
          }; 
       $('.jclock').jclock(options);
    });
 </script>  
	
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

<script>
		!window.jQuery && document.write('<script src="jquery.js"></script>');
</script>
<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
		$(document).ready(function() {


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
		echo "$(\"#variousL".$X."\").fancybox({
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
<script type="text/JavaScript" src="orderlist.js"></script>

<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="0:60"
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
<script type="text/javascript" language="javascript">
function doDelete(ORDERID) 
	{
		if (confirm("Do you really want to delete?")) 
			{
				var ORDERID;
				window.location.href ="deleteorder.php?ORDERID="+ORDERID;
			}
	}
</script>

</head>
<body  bgcolor="gray" topmargin=0>

<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Order</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif">
				 <div class="jclock" style="float:left; margin:5px 10px;" ></div></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />


<!---------------------------------------------------------------------/// New------------------------------------------------->

<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#79acf3">
		<tr>
				<td align=center width=25%>Search Order Xray </td><td align=center width=25%>Option Search Today</td><td align=center width=25% >Department</td><td align=center width=25%>Select Date</td>
		</tr>

		<tr bgcolor="#f8d290"> 
			<td>
				<FORM method="post" action="order.php" name="searchpatient">
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
			
			<td align=center> 


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
	 echo "<td><input type=\"checkbox\" name=Mod_option6 value=\"ANGIO\" checked/><label for=\"demo_box_1\" name=\"demo_lbl_6\" class=\"css-label\"> ANGIO</label></td>";
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
<td align=center> 
<input type="date" name="date001" id="date001" size="10" value="<?php echo $datestart; ?>"> 
To 
<input type="date" name="date002" id="date002" size=10 value=<?php echo $dateend; ?>> 
</p>
</td>
</tr>
<tr><td colspan =4 align=center>  <input type="submit" name="Submit6" value="Search"> </td></tr>	
</table>
</form>
 <br/>
<?php
$yesterday = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-1,date("Y")));
		if (($searchbox =='1') AND ($searchhn =='') AND ($searchxn =='') AND ($searchname =='') AND ($searchlast =='') AND ($mod1 =='') AND ($mod2 =='') AND ($mod3 =='') AND ($mod4 =='') AND ($mod5 =='') AND ($mod6 =='') AND ($mod7 =='') AND ($mod8 =='') AND ($department =='') AND ($datestart =='') AND  ($dateend ==''))
			{
				echo "Please search some keyword before click search";
				exit;
			}
		
$sql = "SELECT DISTINCT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.BIRTH_DATE, 					
			xray_patient_info.SEX, 	
			xray_request.REQUEST_NO AS req_no, 					
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE,
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,	
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE,
			xray_department.NAME_THAI AS DEP,			
			xray_referrer.NAME, 
			xray_code.DESCRIPTION,
			xray_referrer.LASTNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
			LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'ORDER LIST') 
			AND (xray_request_detail.STATUS  != 'CANCEL')
			AND (xray_request_detail.REQUEST_DATE between '$datestart' AND '$dateend')
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
			ORDER BY URGENT desc, ORDERTIME ASC";


$result = mysqli_query($dbconnect, $sql);
$total = @mysqli_num_rows($result);
echo "<table border='0' cellspacing='0' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>ICON</font></th>
<th><font color=#000000>MRN (HN)</font></th>
<th><font color=#000000>ACC</font></th>
<th><font color=#000000>Patient</font></th>
<th><font cololr=#000000>Sex</font></th>
<th>Type</th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician</font></th>
<th><font color=#000000>Order Time</font></th>
<th></th>
</tr>\n";
$bg ="#FFCCCC";
$count = 0;
while($row = mysqli_fetch_array($result))
  {
		if($bg == "#FFFFFF") 
			{ 
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
		
 		echo "<td><span class=\"dropt\" title=\"\">" .$row['MRN'];
		echo "<span style=\"width:100px;\"><img src=icons/alarm-clock.png><br />Pop-up text</span></span></td>";
		echo "<td><a id='variousL".$count."' href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."&XRAYCODE=".$row['XRAY_CODE']."&PAGE=order><img border=0 src=./icon-info.png> ".$row['ACCESSION']."</a></td>";
		echo "<td><a id='various4' href=patient-info.php?MRN=".$row['MRN'].">";
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
				
		
		if ($row['NAMEENG'] == $row['MRN'] or $row['LASTNAMEENG'] == $row['MRN'] or $row['NAMEENG'] =='' or $row['LASTNAMEENG'] =='')
			{
				//echo "<font color=red> No Eng</font>";
			}
		echo "</a>";
		$birthday = $row['BIRTH_DATE'];
		echo "<font color=gray size=-2>".AgeCal($birthday)."</font>";
		echo "</td>";
		//echo "<td></td>";
		echo "<td><center>".$row['SEX']."</center></td>";
		echo "<td>".$row['XRAY_TYPE_CODE']."</td>";
		echo "<td>".$row['DESCRIPTION']."</td>";
		echo "<td>".$row['NAME']." ".$row['LASTNAME']."<br /><font color=green><img src=arrow.gif>".$row['DEP'];
		echo "</font></td>";
		echo "<td>".EngEachDate($row['REQ_DATE'])." ".$row['REQ_TIME']."</td>";
		echo "<td></td>";
		if ($row['STATUS']=='ARRIVAL')
			{
				echo "<td><div id='".$row['ORDERID']."'><input type=button name=Start value=READY onclick=pt_arrive(".$row['ORDERID'].",'READY')>".$TYPE."</div></td>";
			}
		if ($row['STATUS']=='NEW')
			{
				//else {
				//echo "<td><div id='".$row[ORDERID]."'><a href=schedule.php?ACCESSION=".$row[ACCESSION]."><img src=./image/sc.gif border=0></a><input type=button value=Arrive onclick=pt_arrive('".$row[ORDERID]."','ARRIVAL')></div></td>";
				echo "<td>";
				echo "<div id='".$row['ORDERID']."'><input type=button value=Arrive onclick=pt_arrive('".$row['ORDERID']."','ARRIVAL')></div></td>\n";
			}
		if ($row['STATUS']=='READY')
			{
				echo "<td></td>";
			}
		echo "</tr>\n";	
	}
  
echo "<tr><th colspan=10 align=right>";
echo "Total = ".$total."  ";	
echo "";
echo "</th></tr></table>";

 $query2 = mysqli_query($dbconnect, $sql);
 $total_record = mysqli_num_rows($query2);
 $total_page = ceil($total_record / $perpage);
 //echo "totalpage : ".$total_page;
 if ($PAGE == '')
	{
	 $PAGE = 1;
	}
 echo "Page ".$PAGE."/".$total_page." ";

?>
 <a href="order.php?page=1" aria-label="Previous">First <span aria-hidden="true">&laquo;</span> </a>
 
 <?php for($i=1;$i<=$total_page;$i++){ ?>
 | <a href="order.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> |
 <?php } ?>
  <a href="order.php?page=<?php echo $total_page;?>" aria-label="Next">Last
 <span aria-hidden="true">&raquo;</span>
 </a>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
<script language=javascript>
document.searchpatient.searchhn.focus();
</script>
</body>