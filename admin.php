<?php
# ThaiRIS (Thai Radiology Information System)
# Version: 1.8
# File last modified: 4-Oct 2020
# File name: admin.php
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
//include "connectdb.php";
header("Content-type: text/html;  charset=utf-8");
//echo $usertype.$superadmin;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Administrator </title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
<script src="bootstrap/js/bootstrap.min.js" ></script>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</head>
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
if (($usertype !== 'ADMIN') AND ($superadmin == 0) AND ($admin == 0))
	{
		?>
		<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
		<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
		<?php
		echo "<body bgcolor=gray>";
		echo "<center><br><br><br><b>Admin area  you can't use this page</b></center>";
		echo "<meta http-equiv=\"refresh\" content=\"5;url=main.php\" />";
		mysqli_query($dbconnect, "insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','Try Login Admin','$URL','','')");
		exit;
	}
$URL=$_SERVER["HTTP_REFERER"];
mysqli_query($dbconnect, "insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','Login Admin','$URL','','')");
?>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Administrator</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>

<table class="p-0 mb-0 bg-secondary text-white" width=90% bgcolor=#5D6D7E align=center>
<tr>
  <td colspan="3" class="p-3 mb-2 bg-primary text-white" bgcolor=#7F8C8D><h1><strong>Administrator</strong></h1></td>
  </tr>
<tr class="bg-secondary.bg-gradient"><td width=33% valign="top" ><font face="MS Sans Serif">1.) Procedure Code</font> <ul>
  <li><a href=procedure-new.php><font color=#FFFFFF>New</a></font></li>
  <li><a href=procedureshow.php><font color=#FFFFFF>Edit</a></font></li>
</ul>
    <font face="MS Sans Serif">2.) Radiology Staff</font>
    <ul>
      <li><a href=staff_new.php><font color=#FFFFFF>New</a></font></li>
      <li><a href=staff_show.php><font color=#FFFFFF>Edit</a></font></li>
      <li><a href=staff_view.php><font color=#FFFFFF>View</a></font></li>
	  <li><a href=staff_right.php><font color=#FFFFFF>Staff Right</a></font></li>
    </ul>
    <font face="MS Sans Serif">3.)  Referrer Physician</font>
    <ul>
      <li><a href=referrer_new.php><font color=#FFFFFF>New</a></font></li>
      <li>Edit</font></li>
      <li><a href=referrer_view.php><font color=#FFFFFF>View</a></font></li>
      <li><a href=referrer_delete.php><font color=#FFFFFF>Delete</a></font></li>
    </ul>
    </td>
<td width=33% valign="top" >


</ul>
<font face="MS Sans Serif">4.) Department</font>
<ul>
<li><a href=department_new.php><font color=#FFFFFF>New</a></font></li>
<li><a href=department_view.php><font color=#FFFFFF>Edit</a></font></li>
<li><a href=department_view.php><font color=#FFFFFF>View</a></font></li>
<li><a href=department_view.php><font color=#FFFFFF>Delete</a></font></li>
</ul>
<p>5.) Admin</p>
<ul>
  <li><a href=center.php><font color=#FFFFFF>Center</font></a><br />
  </font></li>
  <li><a href=editexam.php><font color=#FFFFFF>Edit Exam</a></font></li>
  <li><a href=editnews.php><font color=#FFFFFF>Edit NEWS Page (Main screen)</a></font></li>
  <li><a href=showlog1.php><font color=#FFFFFF>Show Log</a></font></li>
  <li><a href=re-assign.php><font color=#FFFFFF>Re-Assign Radiologist</a></font></li>
  <li><a href=template-edit-admin.php><font color=#FFFFFF>Edit template</a></font></li>
</td>
<td width=33% valign="top" >

6.) <a href=resetpassword.php><font color=#FFFFFF>Reset User Password</font></a>
</td>
</tr></table>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   
</body>
</html>

