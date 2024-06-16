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
$center_code = trim($_POST['center_code']);
$code = trim($_POST['code']);
$name = trim($_POST['name']);
$shortname = trim($_POST['shortname']);
$type = $_POST['type'];
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
echo "<body bgcolor=#E8E8E8 >";
$topbar = "Add New Staff";
include "topbar.php";
if (($center_code == '') OR ($name == '') OR ($shortname == '') OR ($code == '') OR ($type ==''))
	{
		echo "<br/> <br/><center>Please input data before submit</center>";
		exit;
	}
echo "<strong><a href=staff_new.php>Add New Start</a> </strong><br />";
$sql1 = "insert INTO xray_department (CENTER, DEPARTMENT_ID, NAME_THAI, NAME_ENG, TYPE) 
			VALUES
			('$center_code','$code','$name','$shortname','$type')";
mysqli_query($dbconnect, $sql1);

?>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Add New Department</td></tr>
<tr>
<td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle"><br />New Department Insert</font></td>
<td width="587" bgcolor="#f8d290">
<?php
echo "<br />";
echo "Add Department Nmae : $name  <br />";
echo "Login : $loginname <br />";
echo "Center : $center_code <br /> User Type : $user_type <br />";
?>
</td></tr>
</table>
