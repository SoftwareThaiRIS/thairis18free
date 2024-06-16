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
$ID = isset($_GET['ID']) ? $_GET['ID'] : '';
$TYPE = isset($_GET['TYPE']) ? $_GET['TYPE'] : '';
if (isset($_POST['multiarr1']))
	{
		$multiarr1 = $_POST['multiarr1'];
	}
	
include "connectdb.php";

if ($TYPE=='ARRIVAL')
	{
		mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='ARRIVAL', ARRIVAL_TIME =now() WHERE ID=$ID");
		mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='READY', PAGE = 'EXAM ROOM' WHERE ID=$ID"); // For no ready step
		mysqli_query($dbconnect, "UPDATE xray_request_detail SET READY_TIME=now() WHERE ID=$ID"); // For no ready step
		echo "<font color=red>Waiting</font><br/><font size=-3 color=red>Exam room</font>"; // For no ready step
		exit;
	}

if ($TYPE=='READY') // no active
	{
		mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='READY', PAGE = 'EXAM ROOM' WHERE ID=$ID");
		mysqli_query($dbconnect, "UPDATE xray_request_detail SET READY_TIME=now() WHERE ID=$ID");
		echo "<font color=red>Waiting</font><br/><font size=-3>Exam room</font>";
		exit;

	}
	

if ($multiarr1 == "multiarr1")
	{
		if(isset($_POST['submitmultiarrive']))
		{
			if(!empty($_POST["multiarr"]))
				{
					$multiarr2 = $_POST['multiarr'];
					foreach($multiarr2 as $acc)
						{
							$acc = trim($acc);
							//mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='ARRIVAL', ARRIVAL_TIME =now() WHERE ACCESSION=$acc");
							mysqli_query($dbconnect, "UPDATE xray_request_detail SET STATUS='READY', PAGE = 'EXAM ROOM' WHERE ACCESSION='$acc'");
							mysqli_query($dbconnect, "UPDATE xray_request_detail SET READY_TIME=now() WHERE ACCESSION='$acc'");
							echo $acc."<br>";
							echo "<script>location.href='order.php';</script>";
						}
				}
		}
	}
?>