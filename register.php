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
header("Content-type: text/html;  charset=utf-8");
if ($create_order == 0)
	{
		echo "<body bgcolor=#E8E8E8 topmargin=0 leftmargin=0>";
		$topbar = "Registration";
		include "topbar.php";
		echo "<br /><br /><br /> <center>Your Right now arrow create new order Please check with system admin.</center>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"8;URL=main.php\">";
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  

    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  


   
</head>
<body bgcolor="#d4d4d4">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Registration</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif">
            	<div class="jclock" style="float:left; margin:5px 10px;" ></div>
				</td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle" valign="center">Find</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="regis_search.php" accept-charset="UTF-8">
		<table>
			<tr><td><font face="MS Sans Serif">MRN   </font> </td><td><input type="text" name="mrn"></td><td></td><td></td></tr>
			<tr><td><font face="MS Sans Serif">Name </td><td> <input type="text" name="fname" value=""></td><td>Lastname </font></td><td> <input type="text" name="lname"><br /></td></tr>
           <tr><td colspan=4> <center><input type="submit" name="Submit" value="Search"></center></td></tr>
        </table>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
<br />

<table width="794" border="0" cellpadding="0" cellspacing="2" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2><center><b>Create new patient</b></center></td></tr>
  <tr>
     <td width="561">
	<form name="form2" method="post" action="regis.php">
	<table width="100%" cellspacing="1" cellpadding="0" border=0 >
      <tr><td bgcolor=#79acf3 colspan=2>Basic Information</td></tr>

        <tr >
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000"><b>MRN</b></font></td>
          <td width="57%"><input type="text" name="mrn" maxlength="10"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">XN</font></td>
          <td width="57%"><input type="text" name="xn" maxlength="10"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000"><b>Firstname</b></font></td>
          <td width="57%"><input type="text" name="fname" maxlength="100"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000"><b>Lastname</b></font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="lname" maxlength="100">
          </font></td>
          </tr>
   
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Middle  Name</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="mname" maxlength="100">
          </font></td>
        </tr>
		<!--
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">Name (English)</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="efname" maxlength="100" >
          </font></td>
        </tr>
        
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">Lastname (English)</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="elname" maxlength="100" >
          </font></td>
        </tr>
        -->
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">SSN</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="ID" size="20" maxlength="13">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000"><b>Sex</b></font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="radio" name="sex" value="M">
            Male
            <input type="radio" name="sex" value="F">
            Female
            <input type="radio" name="sex" value="U">
            Unknow</font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="red"><b>Date of Birth</b></font></td>
          <td width="57%"><font face="MS Sans Serif">


<!----------------calander---->
<input type="date" name="dob" id="dob" size="10" value=""> 

<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
        </font></td>
        </tr>
      <tr>
        <td bgcolor="#F0F0F0">Height</td>
        <td><input type="text" name="ptheight" id="textfield3"></td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0">Weight</td>
        <td><input type="text" name="ptweight" id="textfield4"></td>
      </tr>		
</table>
<table width=100%>
		
        <tr>
          <td colspan="2" bgcolor="#F0F0F0"><p>&nbsp;</p>
            <p align="center">
			
              <input type="reset" name="Submit4" value="Clear">
              <input type="submit" name="Submit4" value="OK">
            </p>
            <p>&nbsp;</p></td>
        </tr>
    </table>
</tr>
</FORM>
</table>
<p>&nbsp; </p>
<script language=javascript>
document.searchpatient.mrn.focus();
  </script>
</body>
</html>

