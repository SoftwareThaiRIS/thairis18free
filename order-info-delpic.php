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
$filename = $_GET['filename'];
$ACCESSION = $_GET['ACCESSION'];
$MRN = $_GET['MRN'];
$path = "document-uploads/uploads/".$ACCESSION."/";
echo "<body bgcolor=#E8E8E8>";	
echo "<center> Delete Image</center>";
echo "<center><table>";
echo "<tr><td>";
echo "<img src=$path/$filename width=350><br />";
echo "<center>Filename : $filename </center>";
echo "</td>";
echo "<td>";
echo "<form action=order-info-delpic2.php method=post>";
echo "<input type=hidden name=filename value=$filename>";
echo "<input type=hidden name=ACCESSION value=$ACCESSION>";
echo "<input type=hidden name=MRN value=$MRN>";
echo "<input type=submit value=Delete>";
echo "Delete this images";
echo "</td></tr></table>";
?>