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
include ("session.php");
//include "connectdb.php";
$owner = $_POST['owner'];
$modality = $_POST['modality'];
$bodypart = $_POST['BODYPART'];
$xraycode = $_POST['PROCEDURE'];
$templetename = $_POST['TEMPLATENAME'];
$template_id = $_POST['TEMPLATE_ID'];
$text = $_POST['TEXTREPORT'];
$all_user ='0';
?>
<script language=JavaScript src="frames_body_array.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<?php
if ($owner == 'ALL')
	{
		$owner = $usercode;
		$all_user = '1';
	}

if ($bodypart == '' && $xraycode =='')
	{
		echo "<font color=blue><b>Please select a modality type and body part</b></font> ";
		exit;
	}

if ($xraycode !='')
	{
		if ($bodypart == '')
			{

				$sql = "select BODY_PART from xray_code WHERE XRAY_CODE ='$xraycode'";
				$result = mysqli_query($dbconnect, $sql);
				while($row = mysqli_fetch_array($result))
					{ 
						$bodypart = $row['BODY_PART'];
					}
			}
	}

if ($bodypart =='')
	{
		echo "Please select Body Part Or Procedure";
		exit;
	}

$sql = "UPDATE xray_report_template SET XRAY_CODE ='$xraycode', 
			XRAY_TYPE_CODE = '$modality', 
			BODY_PART = '$bodypart', 
			REPORT_DETAIL = '$text'
			WHERE ID= '$template_id'";
			
mysqli_query($dbconnect, $sql);
echo "Complate";
?>
