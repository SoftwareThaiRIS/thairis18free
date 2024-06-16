<?php# ThaiRIS (Thai Radiology Information System)
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
?>
<!DOCTYPE html>
<html>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
<script src="bootstrap/js/bootstrap.min.js" ></script>
<?php
include "session.php";
header("Content-type: text/html;  charset=utf-8");
if (($usertype !== 'ADMIN') AND ($superadmin == 0) AND ($admin == 0))
	{
		?>
		<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
		<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
		<?php
		echo "<body bgcolor=gray>";
		echo "Admin area  you can't use this page";
		echo "<meta http-equiv=\"refresh\" content=\"4;url=main.php\" />";
		mysqli_query($dbconnect, "insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','Try Login Edit Exam','$URL','','')");
		exit;
	}
echo "<table><tr><td colspan=3></td></tr>\n";
echo "<tr><td>Patient Info</td><td>Order Info</td><td>Order Detail</td></tr>";
echo "<tr>";
echo "<td>";
echo "</td>";
echo "<td>";
echo "<td>";
echo "</td>";
echo "</tr>";
echo "</table>";
?>