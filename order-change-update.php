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
echo "<form action=order-change-save.php>";
$PROCEDUREID = $_GET['PROCEDUREID'];
$ORDERID = $_GET['ORDERID'];
$MRN = $_GET['MRN'];
echo "Procedure ID = $PROCEDUREID <br />";
echo "ORDERID = $ORDERID";
echo "<br />";
echo "<input type=hidden name=ORDERID value=$ORDERID>";
echo "<input type=hidden name=PROCEDUREID value=$PROCEDUREID>";
echo "<input type=hidden name=MRN value=$MRN>";
echo "<input type=submit value=Update>";
echo "</form>";
?>