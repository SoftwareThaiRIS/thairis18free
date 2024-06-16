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
$centercode = $_POST['center_code'];
$code = trim($_POST['code']);
$degree = trim($_POST['degree']);
$name = trim($_POST['name']);
$lastname = trim($_POST['lastname']);
$email = trim($_POST['email']);
$fax = trim($_POST['fax']);
include ("session.php");


if (($centercode == '') OR ($code == '') OR ($name == '') OR ($lastname == ''))
{
	echo "<body bgcolor=\"gray\"><center><font size=+2>Please Input Data before submit </font></center>";
?>
	<center><button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
<center>
<?php
	echo "</body>";
	exit;
}


$sql_insert_refer = "insert INTO xray_referrer (REFERRER_ID,DEGREE, NAME,LASTNAME,CENTER_CODE,EMAIL,FAX)VALUES('$code','$degree','$name','$lastname','$centercode','$email','$fax')";
mysqli_query($dbconnect, $sql_insert_refer);
echo "Done";
?>

    <script>
        var timer = setTimeout(function() {
            window.location='referrer_new.php'
        }, 4000);
    </script>
