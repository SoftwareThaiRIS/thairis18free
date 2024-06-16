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
header("Content-type: text/html;  charset=TIS-620");
$MRN = $_POST[MRN];
echo $MRN;
exit;
?>
<html>
<head>
<title>Reporting</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<script type="text/JavaScript" src="reporting.js"></script>
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
					setTimeout("beginrefresh()",100)
			}
	}

window.onload=beginrefresh
//-->
</script>
</head>



<body bgcolor="gray" leftmargin="3">


<?php
include "connectdb.php";

//$sql = "SELECT xray_patient_info.MRN, xray_request.REQUEST_NO, xray_request_detail.ACCESSION, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.HN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)WHERE xray_request_detail.XRAY_CODE = 'C0106'";
$sql = "SELECT xray_patient_info.MRN, xray_request_detail.ID  AS ORDERID, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, xray_user.LOGIN AS RAD FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request_detail.ASSIGN= '$usercode') INNER JOIN xray_user ON (xray_request_detail.ASSIGN = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.STATUS ='TOREPORT') AND (xray_request_detail.PAGE = 'RADIOLOGIST') ORDER BY ORDERTIME desc";

if ($MRN !=='')
	{
		$sql = "SELECT xray_patient_info.MRN, xray_request_detail.ID  AS ORDERID, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, xray_user.LOGIN AS RAD FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_patient_info.MRN= '$MRN') INNER JOIN xray_user ON (xray_request_detail.ASSIGN = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.STATUS ='TOREPORT') AND (xray_request_detail.PAGE = 'RADIOLOGIST') ORDER BY ORDERTIME desc";
		echo $MRN;
		exit;
	}
$result = mysql_query($sql);
echo "<font color=white>Reporting WorkList</font>";
?>
<table width="100%" border="0" cellspacing="1">

  <tr>
    <td width="29%" bgcolor="#CCCCCC">Select Worklist 
	<form method="post" action="reporting2.php">
      <select name="select" id="select">
        <option selected value="<? echo $usercode ?>">My Worklist</option>
        <option value="ALL">All Worklost</option>
		<option value="0">Not Assign</option>
      </select>
	   <label>
        <input type="submit" name="button" id="button" value="Submit">
      </label> </form></td>
    <td width="36%" bgcolor="#E8E8E8"><p>Search MRN 
	<form method="post" action="reporting.php">
      <label>
        <input type="text" name="MRN" id="MRN">
      </label>
      <input type="submit" name="button2" id="button2" value="Submit">
	 </form>
    </p>
    <p>Seach Date </p></td>
    <td width="35%" bgcolor="#CCCCCC">Modality </td>
  </tr>

</table>
<?php
echo "<table border='0' cellspacing='2' bgcolor='#000000' width=100%>
<tr>
<th><font color=white>ICON</font></th>
<th><font color=white>MRN</font></th>
<th><font color=white><b>Assign TO</b></font></th>
<th><font color=white>ACC</font></th>
<th><font color=white>Patient</font></th>
<th><font color=white>Procedure</font></th>
<th><font color=white>Physician</font></th>
<th><font color=white>Order Time</font></th>
<th></th>
</tr>\n";
$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ //Switch colour of background
				$bg = "#FFCCCC";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		$count = $count+1;
		echo "<tr bgcolor=$bg>";
		echo "<td></td>";
		echo "<td>".$row[MRN]."</td>";
		echo "<td>".$row[RAD]."</td>";
		echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ACCESSION=".$row[ACCESSION]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a> ".$row[ACCESSION]."</td>";
		echo "<td><a href='#'><img border=0 src=./image/folder.png onClick=\"window.open('patient-info.php?MRN=".$row[MRN]."','mywindow2','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row[PTNAME]."   ".$row[PTLASTNAME]."</td>";
		echo "<td>".$row[DESCRIPTION]."</td>";
		echo "<td>".$row[NAME]." ".$row[LASTNAME]."</td>";
		echo "<td>".$row[ORDERTIME]."</td>";
		$status = $row[STATUS];
		$ORDERID = $row[ORDERID];
		if ($usertype =='RADIOLOGIST')
			{
				echo "<td><form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form></td>";
			}
		if ($usertype !=='RADIOLOGIST')
			{
				echo "<td>Wait reporting</td>";
			}
		echo "</td></tr>\n";	
	}
echo "</table>";
echo "All Study=".$count;
echo "<div id=test></div>";
echo "</br>";
echo "MRN====".$MRN;
echo "<center><font color=white>ThaiRIS.net</font></center>";
?>
</body>
</html>



