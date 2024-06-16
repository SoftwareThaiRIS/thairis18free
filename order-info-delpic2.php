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
include "session.php";
$URL=$_SERVER["HTTP_REFERER"];
$filename = $_POST['filename'];
$ACCESSION = $_POST['ACCESSION'];
$MRN = $_POST['MRN'];
$path = "document-uploads/uploads/".$ACCESSION."/".$filename;
echo $filename;
unlink($path);
echo "<br /><center> File Deleted</center>";
mysqli_query($connectdb, "insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','DELPICSCAN','$URL','$MRN','$ACCESSION')");
?>
<center>
<button onclick="goBack()">Go Back 2 Pages</button>
<script>
function goBack() {
    window.history.go(-2);
}
</script>
