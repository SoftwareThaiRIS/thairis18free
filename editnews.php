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
//include "connectdb.php";
include "session.php";

//echo $usertype.$superadmin;
if (($usertype !== 'ADMIN') AND ($superadmin == 0) AND ($admin == 0))
	{
		echo "Admin area  you can't use this page";
		exit;
	}
?>
<!DOCTYPE html>
<meta charset="utf-8" />
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   

<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
//echo "<body bgcolor=#E8E8E8 >";
$topbar = "News Dashboard";
include "topbar.php";
?>
<center>
<table bgcolor=white>
<tr><td>
<form method=post action=editnews-edit.php enctype=\"multipart/form-data\">
<img src=./icon/news.jpg><u>Internal Infomation in Radiology</u><br>
<div id="reportspace">
<textarea cols="105" rows="20" id="area2" name="TEXTREPORT">
   <?php
   $sql = "select NEWS from xray_news WHERE CENTER_CODE='$center_code'";
   $result = mysqli_query($dbconnect, $sql);
   $row = mysqli_fetch_array($result);
   echo $row['NEWS'];
   ?>
</textarea><br>
<input type="reset" value=Clear> <input type=submit value=SAVE> 
</div>

<script type="text/javascript" src="nicEdit.js"></script> 
<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
 </script>
 </td></tr>
</table>
</center>
</body>
</html>