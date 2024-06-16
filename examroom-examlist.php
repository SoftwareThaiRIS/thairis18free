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
header("Content-type: text/html;  charset=TIS-620");
$ID = $_GET['ID']; 
$TYPE = $_GET['TYPE'];
$ORDERID = isset($_GET['ORDERID']);
$ACCESSION = isset($_GET['ACCESSION']);
$MRN = $_GET['MRN'];

include "connectdb.php";

$sql = "SELECT 
			xray_request.MRN, 
			xray_request_detail.ACCESSION
			FROM xray_request
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			WHERE xray_request_detail.ID='$ID'";

$result = mysqli_query($dbconnect, $sql);
while($row = mysqli_fetch_array($result))
	{
		$ACC = $row['ACCESSION'];
		$MRN = $row['MRN'];
	}	

if ($TYPE=='STARTED')
	{
		mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='STARTED',  START_TIME= NOW() WHERE ID=$ID");
		echo "<button type=button class=\"positive\" value=COMPLETE onclick=pt_arrive('".$ID."','QC')><img src=\"images/camera_go.png\" alt=\"\"/> Complete Exam</button>\n";
		exit;
	}

if ($TYPE=='QC') 
			{		
				mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='QC',COMPLETE_TIME=NOW() WHERE ID=$ID");			
				echo "<td>";
				echo "<input id=\"qcid\" type=\"checkbox\"  name=\"multiqc[]\" value=$ACC> ";
				echo "<a class=\"fancybox fancybox.iframe\" href=qc.php?ACCESSION=".$ACC."&ORDERID=".$ID."&MRN=".$MRN.">";
				echo "<button type=button class=\"positive\" value=\"QC\"><img src=\"images/chart_bar_edit.png\" alt=\"\" border=0 /> QC </button></a>\n";
				echo "</td>";
			}			

if ($TYPE=='ENDEXAM') 
			{		
				mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='QC', COMPLETE_TIME=NOW() WHERE ID=$ID");			
				echo "<td>";
				echo "<input id=\"qcid\" type=\"checkbox\" name=\"multiqc[]\" value=$ACC> ";
				echo "<a class=\"fancybox fancybox.iframe\" href=qc.php?ACCESSION=".$ACC."&ORDERID=".$ID." >";
				echo "<button type=button class=\"positive\" value=\"QC\"><img src=\"images/chart_bar_edit.png\" alt=\"\" border=0 /> QC </button></a>\n";
				echo "</td>";
			}		
			
//if ($TYPE=='ENDEXAM')
//	{
//		mysql_query("UPDATE xray_request_detail SET STATUS='ENDEXAM' WHERE ID=$ID");
//		$sql2 ="select * FROM xray_user WHERE USER_TYPE_CODE ='RADIOLOGIST' ORDER BY NAME";
//		$result2 = mysql_query($sql2);
//		echo "<select name=selectrad id=selectrad".$ID.">";
//		echo "<option value=''>Select Radiologist</option> ";
//		while ($row =mysql_fetch_array($result2))
//			{
//				echo "<option name=radid value=\"".$row[CODE]."\">".$row[NAME]."  ".$row[LASTNAME]."</option>";
//			}
//		echo "</select><input type=button name=Start value=ASSIGN onclick=assignrad('".$ID."','ASSIGN')> ENDEXAM";
//		exit;
//	}
	
if ($TYPE=='ASSIGN')
	{
		echo "ASSIGN TO RADIOLOGIST";
	}

?>