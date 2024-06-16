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
include ("session.php");
include "connectdb.php";
include ("function.php");
if ($usertype !=='RADIOLOGIST' AND $superadmin =='0')
		{
			echo "<p><p><p><br \>";
			echo "<li>You Can't Access Reporting page</li>";
			echo "<meta http-equiv=\"refresh\" content=\"4;url=main.php\" />";
			exit;
		}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
	<script language=JavaScript src="editreport.js"></script>
	<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="gray">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Searh Edit Report</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<p>
<br />
<br />
<!-------------------------------------->
<center>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient For Edit Report</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><center><img src="./images/icoSearch.png"></center><br />Search For Edit Report</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="form1"accept-charset="UTF-8">
          <p><font face="MS Sans Serif">MRN</font> <font face="MS Sans Serif">
            <input type="text" name="mrn"><font face="MS Sans Serif">ACCESSION</font> <font face="MS Sans Serif">
            <input type="text" name="acc">
          </font></p>
          <p><font face="MS Sans Serif">Name<input type="text" name="fname" value="">Lastname</font>
            <input type="text" name="lname"></p>
			<p><center>
            <input type="button" value="Search" onclick="searchedit();">
			</center>
          </p>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
  <tr><td colspan=2>
  <div id=showsearch></div>
</table>
</center>

