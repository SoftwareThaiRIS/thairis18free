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
$MRN = $_GET['MRN'];
$ACCESSION = $_GET['ACCESSION'];
$PROCEDUREID = $_GET['PROCEDUREID'];
$PAGE = $_GET['PAGE'];

if ($PAGE == '')
	
	{
		$PAGE = 'main';
	}
//ORDER_ID
$sql0 = "SELECT xray_request.REQUEST_NO
			FROM xray_request 
			INNER JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO)
			WHERE xray_request_detail.ACCESSION ='$ACCESSION'";
 $result0= mysqli_query($dbconnect, $sql0);
while($row0 = mysqli_fetch_array($result0))
		{
			$REQUEST_NO = $row0['REQUEST_NO'];
		}
		
$result1= mysqli_query($dbconnect, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql2 = "select   
			xray_code.DESCRIPTION AS DESCRIPTION,
			xray_code.XRAY_CODE AS PROCEDUREID,
			xray_code.BIRAD_FLAG AS MAMMO,
			xray_request.NOTE,
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,
			xray_request_detail.ARRIVAL_TIME AS ARRIVETIME, 		
			xray_request_detail.START_TIME AS STARTTIME,
			xray_request_detail.COMPLETE_TIME AS COMPLETETIME,
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.APPROVED_TIME AS APPROVETIME,
			xray_request_detail.ASSIGN_ID,
			xray_request_detail.ASSIGN_BY,
			xray_request_detail.TECH1,
			xray_request_detail.TECH2,
			xray_request_detail.TECH3,
			xray_request_detail.STUDY_UID,
			xray_request_detail.NOTE AS XDNOTE
			from xray_request_detail 
			INNER JOIN  xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO)			
			WHERE xray_request_detail.ACCESSION='$ACCESSION'";
$result2= mysqli_query($dbconnect, $sql2);
while($row2 = mysqli_fetch_array($result2))
		{
			$DESCRIPTION = $row2['DESCRIPTION'];
			$PROCEDUREID = $row2['PROCEDUREID'];
			$MAMMO = $row2['MAMMO'];
			$STATUS = $row2['STATUS'];
			$ORDERID = $row2['ORDERID'];
			$ORDERTIME = $row2['ORDERTIME'];
			$ARRIVETIME = $row2['ARRIVETIME'];
			$STARTTIME = $row2['STARTTIME'];
			$COMPLETETIME = $row2['COMPLETETIME'];
			$ASSIGNTIME = $row2['ASSIGNTIME'];
			$APPROVETIME = $row2['APPROVETIME'];
			$NOTE = $row2['NOTE'];
			$ASSIGN = $row2['ASSIGN_ID'];
			$ASSIGN_BY = $row2['ASSIGN_BY'];
			$TECH1 = $row2['TECH1'];
			$TECH2 = $row2['TECH2'];
			$TECH3 = $row2['TECH3'];
			$STUDY_UID = $row2['STUDY_UID'];
			$XDNOTE = $row2['XDNOTE'];
		}
		

?>

<body  bgcolor="#d4d4d4" leftmargin=0 topmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Change Procedure </td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<script type="text/JavaScript" src="order-change.js"></script>
<br/>
<br/>
<?php		
echo "<table bgcolor=#79acf3 width=800 align=center>";
echo "<tr><td colspan=2 align=right><a href=$PAGE.php><img src=fancybox/fancy_close.png border=0></a></td></tr>";
echo "<tr bgcolor=white><td valign=top>";

echo "MRN : $MRN <br />";
echo "ACCESSION : $ACCESSION<br />";
echo "PROCEDURE ID : $PROCEDUREID<br />";
echo "$DESCRIPTION";

echo "<table width=100%><tr><td bgcolor=#79acf3>";
echo "<b>Select Procedure</b></td></tr>";
echo "<tr><td bgcolor=#EBEBEB valign=top>";
$sql2 ="select * FROM xray_type";
$result2 = mysqli_query($dbconnect, $sql2);

echo "<select id=procedurelist onChange=change_procedure('".$ORDERID."','".$MRN."');>";
echo "<OPTION>Please Select Type</OPTION>";
while ($row =mysqli_fetch_array($result2))
	{
		echo "<option value='".$row['XRAY_TYPE_CODE']."'>".$row['TYPE_NAME']."</option>";
	}
echo "</select>";
echo "<form name=procedureform>";
echo "<input type=\"text\" name=\"proceduretext\" id=\"proceduretext\" onKeyup=\"search_procedure('".$mrn."')\" onkeypress=\"return event.keyCode!=13\" >";
echo "<input type=\"button\" name=\"TYPE\" value=\"Search\"  onclick=search_procedure()>";
echo "</form>";
echo "</td></tr></table>\n";
echo "</td>";
echo "<td valign=top> ";
echo "<div id=show>Select Procedure</div>";
echo "</table>";
?>