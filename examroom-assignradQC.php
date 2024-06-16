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
header("Content-type: text/html;  charset=utf-8");
include "session.php";
$ID = $_GET['ORDERID']; 
//$TYPE = $_GET['TYPE'];
$RADID = $_GET['selectrad'];
$TECH1 = $_GET['tech1'];
$TECH2 = $_GET['tech2'];
$TECH3 = $_GET['tech3'];
$FLAG1 =$_GET['readtime'];
//$FLAG2 = $_GET['flag02']; // special
$EXAMNOTE =$_GET['examnote'];
$READ_BOOK = $_GET['dateInput'];
$READ_BOOK = date('Y-m-d', strtotime($READ_BOOK));

if ($READ_BOOK == '1970-01-01') 
	{
		$READ_BOOK ='';
	}
$result = mysqli_query($dbconnect, "SELECT REQUEST_NO FROM xray_request_detail WHERE ID='$ID'");
		while($row = mysqli_fetch_array($result)) 
			{
				$REQ_NO= $row['REQUEST_NO'];
			}
echo "<!DOCTYPE HTML>\n";
echo "<HTML>\n<HEAD>\n";
echo "<META CHARSET=\"UTF-8\">\n";
echo "<TITLE>QC Show Information</TITLE>\n";
echo "</HEAD>\n";
echo "<BODY bgcolor=#E8E8E8 topmargin=0 leftmargin=0>\n";
?>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">QC Information</td>
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
  	mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='TOREPORT',PAGE='RADIOLOGIST',ASSIGN_TIME = NOW(),ASSIGN_ID='$RADID', ASSIGN_CODE='$RADID', ASSIGN_BY='$userid',TECH1='$TECH1', TECH2='$TECH2', TECH3='$TECH3', FLAG1='$FLAG1', FLAG2='$FLAG2', REPORT_BOOK='$READ_BOOK' WHERE ID=$ID");
	mysqli_query($dbconnect, "UPDATE xray_request SET NOTE ='$EXAMNOTE' WHERE  REQUEST_NO ='$REQ_NO'");
echo "<center><table><tr><td>";

$result1 = mysqli_query($dbconnect, "SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH1'");
		while($row1 = mysqli_fetch_array($result1)) 
			{
				$TECH1= $row1['NAME']." ".$row1['LASTNAME'];
			}
if ($TECH2 !== '')
	{
		$result2 = mysqli_query($dbconnect, "SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH2'");
		while($row2 = mysqli_fetch_array($result2)) 
			{
				$TECH2= $row2['NAME']." ".$row2['LASTNAME'];
			}
	}
if ($TECH3 !== '')
	{
		$result3 = mysqli_query($dbconnect, "SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH3'");
		while($row3 = mysqli_fetch_array($result3)) 
			{
				$TECH3= $row3['NAME']." ".$row3['LASTNAME'];
			}
	}
echo "<center><b><font color=green>QC Information</font></b></center>";
echo "<br> Technician1 : ".$TECH1;
echo "<br> Technician2 : ".$TECH2;
echo "<br> Technician3 : ".$TECH3;
//echo "<br> kadee :  ".$FLAG01;
echo "<br> Rad id : ".$RADID;
echo "<br> Exam note : ".$EXAMNOTE;
echo "</td></tr></table></center>";

$sql1 = "select REQUEST_NO, ACCESSION, XRAY_CODE, REQUEST_TIMESTAMP, STUDY_UID FROM xray_request_detail where ID ='$ID' ";
$result1 = mysqli_query($dbconnect, $sql1);
while($row=mysqli_fetch_array($result1))
	{
		$req_no = $row['REQUEST_NO'];
		$ACCESSION = $row['ACCESSION'];
		$xray_code = $row['XRAY_CODE'];
		$timestamp = $row['REQUEST_TIMESTAMP'];
		$suid = $row['STUDY_UID'];
	}
	
$sql2 = "select MRN, REFERRER FROM xray_request where REQUEST_NO ='$req_no' ";
$result2 = mysqli_query($dbconnect, $sql2);
while($row=mysqli_fetch_array($result2))
	{
		$hn = $row['MRN'];
		$referrer_id = ['REFERRER'];
	}	

$sql3 = "select NAME, LASTNAME, SEX, BIRTH_DATE FROM xray_patient_info where MRN ='$hn' ";
$result3 = mysqli_query($dbconnect, $sql3);
while($row=mysqli_fetch_array($result3))
	{
		$lastname = $row['LASTNAME'];
		$name = $row['NAME'];
		$dob = $row['BIRTH_DATE'];
		$sex = $row['SEX'];
	}

$sql4 = "select DEGREE, NAME, LASTNAME FROM xray_referrer where REFERRER_ID ='$referrer_id' ";
$result4 = mysqli_query($dbconnect, $sql4);
while($row=mysqli_fetch_array($result4))
	{
		$degree = $row['DEGREE'];
		$referrer_lastname = $row['LASTNAME'];
		$referrer_name = $row['NAME'];
	}

$sql5 = "select DESCRIPTION, XRAY_TYPE_CODE FROM xray_code where XRAY_CODE ='$xray_code' ";
$result5 = mysqli_query($dbconnect, $sql5);
while($row=mysqli_fetch_array($result5))
	{
		$xray_name = $row['DESCRIPTION'];
		$modality_type = $row['XRAY_TYPE_CODE'];
	}
	
$timestamp = date('YmdHis');
?>
<br />
<br />
<center><a href="javascript:history.back()">Go Back QC</a>  <a href=examroom.php>Back to Examroom</a>
<!--
<a href="javascript:parent.jQuery.fancybox.close();"><input type=button value=Close></a>
-->
</center>
</BODY>
</HTML>