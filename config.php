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

$auto_request_no = 1;  // Automatic create request number 0=NO, 1=Yes;
$CREATELOG_FILE=1;
$TIME_EDIT_REPORT = 60; // minute
$auto_print_request = 0; // Option
$auto_print_report = 0; // Option
$auto_pacs = 1;
$CREATEHL7=1; // if 0 = not create any HL7
$CREATEHL7_ADT=1; 
$CREATEHL7_ORU=1;
$CREATEHL7_ORM=1;
$CREATEHL7_XML=0;
$PACS = 1;
$CREATE_REPORT_PDF =1; // Create PDF report after approve the report
$REPORT_PATH = 'reportpdf'; // Path save pdf report 
$LANGUAGE = "english";//  Language menu
include "language/".$LANGUAGE.".php";
date_default_timezone_set('Asia/Bangkok');
?>