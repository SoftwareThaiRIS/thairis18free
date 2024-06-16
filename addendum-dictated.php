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
require_once './htmlpurifier/library/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'TIS-620'); // replace with your encoding
//$config->set('Core.Encoding', 'ISO-8859-1'); // replace with your encoding
$config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
$purifier = new HTMLPurifier($config);

include ("session.php");
include ("connectdb.php");
$ORDERID = $_POST['ORDERID'];
$RADID = $_POST['RADID'];
$TEXTREPORT = $_POST['TEXTREPORT'];
$OLDREPORT = $_POST['OLDREPORT'];
$ACCESSION = $_POST['ACCESSION'];
$BIRAD = $_POST['BIRAD'];
$COPYREPORT = $_POST['COPYREPORT'];

//HTMLPulrifier
$TEXTREPORT = "<b><u>Addendum</u></b> : <br />".$TEXTREPORT."<br /><center>---------------------------------------------------------------------------------</center><br /><b><u>Original Report</u></b><br />".$OLDREPORT;
$TEXTREPORT = $purifier->purify($TEXTREPORT);

if ($ACCESSION =="")
	{
		echo "Can't update something wrong";
		exit;
	}

if ($BIRAD !=='')
	{
		$sql ="select LEVEL,DESCRIPTION FROM xray_birad WHERE BIRAD='$BIRAD'";
		$result = mysqli_query($dbconnect, $sql);
		while ($row =mysqli_fetch_array($result))
			{
				$BIRAD = $row['DESCRIPTION']."<br />";
				$BIRAD_LEVEL = $row['LEVEL'];
			}
	}


$sql = "UPDATE xray_request_detail SET STATUS='APPROVED', REPORT_STATUS='1', PAGE='END', APPROVED_TIME=now() where ID='$ORDERID'";
mysqli_query($dbconnect, $sql);
$TEXTREPORT = $BIRAD.$TEXTREPORT;
$sql2 = "INSERT INTO xray_report 
					(ACCESSION, REPORT, BIRAD, DICTATE_BY, DICTATE_DATE, DICTATE_TIME, APPROVE_BY, APPROVE_DATE, APPROVE_TIME) 
					values 
					('$ACCESSION', '$TEXTREPORT', '$BIRAD_LEVEL', '$userid',  CURDATE(), NOW(), '$userid', CURDATE(), NOW())";
		
mysqli_query($dbconnect, $sql2);

//////////////////////////// For update in xray_request_detail
$last_id = (mysqli_insert_id());
$sql = "UPDATE xray_request_detail SET LASTREPORT_ID='$last_id' WHERE ACCESSION='$ACCESSION'";
mysqli_query($dbconnect,$sql);

?>
<!--
<script type="text/javascript">
	window.location="dictate-worklist.php";
</script>
-->
<body backgroundgcolor=gray>
    <script>
        var timer = setTimeout(function() {
            window.location='dictate-worklist.php'
        }, 500);
    </script>
