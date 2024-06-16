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
//include ("session.php");
include "connectdb.php";
include ("function.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
	<script language=JavaScript src="addendum.js" type=text/javascript></script>
</head>
<body bgcolor="#d4d4d4">
<center>
<table border=0 widht=70%>
<tr bgcolor="#79acf3"> <td> Search Patient order for Addendum </td></tr>
<tr bgcolor=#f8d290><td><form name="form1"accept-charset="UTF-8">
          <p><font face="MS Sans Serif">Search 
		  <br />MRN </font>
		  <font face="MS Sans Serif">
            <input type="text" name="mrn">
          </font></p>
          <p><font face="MS Sans Serif">Name
            <input type="text" name="fname" value="">  Lastname</font>
            <input type="text" name="lname">
            <input type="button" value="Search" onclick="searchedit()">
          </p>
        </form></td>
</tr>
<tr><td>
<div id=showsearch></div>
</td></tr>
</table>
</center>
