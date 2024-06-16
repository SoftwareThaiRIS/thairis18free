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
//include ("connectdb.php");
header('Cache-Control: no cache');
include ("session.php");
$MRN = isset($_GET['MRN']) ? $_GET['MRN'] : null;
$ACCESSION = isset($_GET['ACCESSION']) ? $_GET['ACCESSION'] : null;
$XRAYCODE = isset($_GET['XRAYCODE']) ? $_GET['XRAYCODE'] : null;
$CHANGESTATUS = isset($_GET['CHANGESTATUS']) ? $_GET['CHANGESTATUS'] : null;

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


$sql1 = "select MRN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result1= mysqli_query($dbconnect, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql2 = "select   
			xray_code.DESCRIPTION AS DESCRIPTION,
			xray_code.XRAY_CODE AS PROCEDUREID,
			xray_code.BIRAD_FLAG AS MAMMO,
			xray_request.NOTE,
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_NO,
			xray_request_detail.CASE_NO,
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
			$REQNO = $row2['REQUEST_NO'];
			$CASENO = $row2['CASE_NO'];
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
if ($CHANGESTATUS == 1)
	{
		$sql = "UPDATE xray_request_detail SET URGENT = '1' WHERE ACCESSION ='$ACCESSION'";
		mysqli_query($dbconnect, $sql);
	}
if ($CHANGESTATUS == 'Y')
	{
		$sql = "UPDATE xray_request_detail SET URGENT = '0' WHERE ACCESSION ='$ACCESSION'";
		mysqli_query($dbconnect, $sql);
	}
echo "<body bgcolor=#E8E8E8 topmargin=0 leftmargin=0>";	
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Order Detail </td>
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
echo "<table bgcolor=#79acf3 align=center border=0 width=800 ><tr><td align=right><a href=\"javascript:history.back()\"><img src=fancybox/fancy_close.png border=0></a></td></tr>";
echo "<tr bgcolor=#E8E8E8 width=100%><td>";
echo "<center><u>Order Detail</u></center>";
echo "<table align=center width=95% border=0 bgcolor=#E8E8E8><tr><td valign=top >";
echo"<table width=100% border=0 bordercolor=#FFFFFF>";
echo "<tr><td bgcolor=#79acf3 width=100% align=center>";
echo "Patient Information";
echo "</td></tr>";
echo "<tr><td>";
echo "<img src=icons/man.png align=left>";
echo "MRN : <a href=patient-info.php?MRN=".$MRN.">".$MRN."</a><br />";// <a href=patient-edit.php?MRN=".$MRN.">Edit</a><br />";
echo "Name : ".$row1['NAME']." ".$row1['LASTNAME']."<br />";
echo "Age :  Sex : <br />";
echo "DOB : ".$row1['BIRTH_DATE']."<br />";
echo "</td></tr>";
echo "<tr><td bgcolor=#79acf3 width=100% align=center>";	
echo "<img src=icons/information-shield.png> Order Information";
echo "</td></tr>";
echo "<tr><td>\n";
echo "Accession  : ".$ACCESSION."<br/>";
echo "Request No : ".$REQNO."<br/>";
echo "Case No    : ".$CASENO."<br/>";
echo "Procedure  : ".$DESCRIPTION." ";

if ($user_update_code == 1)
	{
		echo "<a href=order-change-procedure.php?MRN=$MRN&ACCESSION=$ACCESSION&PROCEDUREID=$PROCEDUREID><img src=icons/pencil.png></a>";
	}
echo $row2['DESCRIPTION']."<br/>";
$sql ="SELECT URGENT FROM xray_request_detail where xray_request_detail.ACCESSION = '$ACCESSION'";

$result =mysqli_query($dbconnect, $sql);
while($row=mysqli_fetch_array($result))
	{
		$URGENT = $row[0];
	}

if ($URGENT == 0)
	{
		echo "Change Status  : <a href=order-info.php?ACCESSION=$ACCESSION&CHANGESTATUS=1>Urgent</a><br />\n";
	}
	
if ($URGENT == 1)
	{
		echo "Status : <img src=./icon/urgent.jpg>Urgent <br/>\n";
		echo "Change Status : <a href=order-info.php?ACCESSION=$ACCESSION&CHANGESTATUS=Y>Not Urgent</a><br />\n";
	}

echo "Physician : </br>";

if (($usertype == 'ADMIN') OR ($superadmin == 1) OR ($admin == 1)) 
	{ 
		echo "Study UID : <font size=-3>$STUDY_UID</font><br/>";
	}
	
$sql = "SELECT ID,ACCESSION,APPROVE_DATE, APPROVE_TIME FROM xray_report WHERE ACCESSION='$ACCESSION' ORDER BY ID desc";
$result =mysqli_query($dbconnect, $sql);
while($row=mysqli_fetch_array($result))
	{
		echo "<img src=./image/report.gif> <a href=showreport.php?ACCESSION=".$row['ACCESSION']."&ID=".$row['ID'].">";
		echo "Report : ID ".$row['ID']."</a> : ";
		echo $row['APPROVE_DATE']." ".$row['APPROVE_TIME']."<br />";
	}

echo "</td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Attach Files</td></tr>";
echo "<tr><td>File Name :  No File <br />";
$path = "document-uploads/uploads/".$ACCESSION."/";

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
						$ext = end(explode('.', $file));
					}
			}
		while (sizeof($string) != 0)
			{
				$img = array_pop($string);
				echo "<a href=resizeimage$ext.php?image=$filePath$img><img src='$filePath$img'  width='100px'/></a> ";
				if ($user_del_upload =='1')
					{
						echo "<a href=order-info-delpic.php?filename=$img&ACCESSION=$ACCESSION&MRN=$MRN><img src=icons/minus-circle.png border=0></a> Delete ";
					}
			}
	}

echo "</td></tr>";
echo "<tr><td><img src=arrow.gif><a href=document-uploads/index.php?MRN=$MRN&ACCESSION=$ACCESSION> Upload New File</td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Utility</td></tr>";
echo "<tr><td>";
echo "</td></tr>";
echo "</table></td>";
echo "<td valign='top' width='50%'>";
echo "<table border='1' bordercolor='#FFFFFF' width='100%'><tr><td bgcolor='#76acf3' align=center>";
echo "Inventory Use";
echo "</td></tr>";
echo "<tr><td>";
echo "</td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Exam Note</td></tr>";
echo "<tr><td><img src=icons/notebook--plus.png>";
if ($NOTE !== '' or $XDNOTE !=='')
	{
		echo $NOTE;
		echo "<br />";
		echo $XDNOTE."<br/>";
	}
echo "<a href=order-info-note.php?MRN=$MRN&ACCESSION=$ACCESSION&REQUEST_NO=$REQUEST_NO>Add note </a></td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Update Status</td></tr>";
echo "<tr><td>Status : ".$STATUS."<br />";
if ($STATUS =='QC')
	{
		echo "<br /> Update QC";
	}
	
if (($usertype == 'ADMIN') OR ($superadmin == 1) OR ($admin == 1) OR ($change_status == 1)) 
	{
		echo "<form method=\"post\"  action=order-changestatus.php>";
		echo "<input type=hidden name=accession value=".$ACCESSION.">";
		echo "<input type=hidden name=MRN value=".$MRN.">";
		echo "<select name=changestatus>";
				echo "<option name='changestatus' value=''>Change Status</option>";
				echo "<option name='changestatus' value='TOREPORT'>Back To Report Worklist</option>";				
				echo "<option name='changestatus' value='EXAMROOM'>Back To Exam Room</option>";
				echo "<option name='changestatus' value='QC'>Back To QC</option>";				
				echo "<option name='changestatus' value='ORDER'>Back To Order</option>";
		if ($delete_order == 1)
			{
				echo "<option name='changestatus' value='CANCEL'>Cancel Order</option>";
			}
		echo "</select><input type=submit value=Submit>";
		echo "</form>\n";
	}
echo "Radiographer	: ";
if ($TECH1 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$TECH1'");
		while($row = mysqli_fetch_array($result)) 
			{
				$TECH1= $row['NAME'];
			}
		echo "<img src=arrow.gif>  ".$TECH1;
	}
	
if ($TECH2 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$TECH2'");
		while($row = mysqli_fetch_array($result)) 
			{
				$TECH2= $row['NAME'];
			}
		echo "<img src=arrow.gif>  ".$TECH2;
	}
	
if ($TECH3 !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$TECH3'");
		while($row = mysqli_fetch_array($result)) 
			{
				$TECH3= $row['NAME'];
			}
		echo "<img src=arrow.gif>  ".$TECH3;
	}
echo "<br />";
echo "Assign By : ";
if ($ASSIGN_BY !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$ASSIGN_BY'");
		while($row = mysqli_fetch_array($result)) 
			{
				$ASSIGN_BY= $row['NAME'];
			}
		echo "<img src=arrow.gif>  ".$ASSIGN_BY;
	}

echo "<br />";
if ($ASSIGN !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$ASSIGN'");
		while($row = mysqli_fetch_array($result)) 
			{
				$ASSIGN= $row['NAME'];
			}
		echo "Assign To : <img src=arrow.gif>  ".$ASSIGN;
	}
echo "<br />";

$APPROVE_BY = '';

if ($STATUS == 'APPROVED')
	{
		$sql = "SELECT APPROVE_BY FROM xray_report WHERE ACCESSION='$ACCESSION' ORDER BY ID desc";
		$result = mysqli_query($dbconnect, $sql);
		while($row = mysqli_fetch_array($result)) 
			{
				$APPROVE_BY= $row['APPROVE_BY'];
			}
	}


if ($APPROVE_BY !='')
	{
		$result = mysqli_query($dbconnect, "SELECT NAME FROM xray_user WHERE ID='$APPROVE_BY'");
		while($row = mysqli_fetch_array($result)) 
			{
				$APPROVE_BY= $row['NAME'];
			}
		echo "Report By : <img src=arrow.gif>  ".$APPROVE_BY;
	}	

	
echo "</td></tr></table>";
echo "<table width=100%>";
echo "<tr><td bgcolor=#79acf3 align=center>Time Stamp </td></tr>";
echo "<tr><td>";
echo "<table>";
echo "<tr><td><img src=icons/clock.png> Order Time </td> <td> : $ORDERTIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> Arrived Time </td> <td> : $ARRIVETIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> Start Exam Time </td><td> : $STARTTIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> End Exam Time </td><td> : $COMPLETETIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> QC/Assign Time </td><td> : $ASSIGNTIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> Reported Time </td><td> : $APPROVETIME </td></tr>\n";
echo "</table>\n";
echo "</td></tr></table>\n";
echo "</td></tr></table>";	
?>
<iframe id="pacsResult2" name="pacsResult2" frameborder="0" width="0" height="0"></iframe>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>