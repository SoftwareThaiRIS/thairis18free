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
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
</head>

<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
$topbar = "Change Password";
include "topbar.php";
?>
<p>&nbsp;</p>

 <form id="form2" name="form2" method="post" action="passwordchange.php">
<table width="37%" height="118" border="0" align="center" cellspacing=1 bgcolor=white>
<tr>
<td bgcolor=#79acf3 colspan=2> Change Password User : <?php echo $username; ?>
<tr>

  <tr>
    <td width="56%" height="26" align="left" ><strong>Old Password</strong></td>
    <td width="44%"bgcolor="#f8d290" >
      <input type="password" name="oldpassword" id="oldpassword" />
</td>
  </tr>
  <tr>
    <td height="26" align="left" >New Password</td>
    <td bgcolor="#f8d290">
      <input type="password" name="newpassword1" id="textfield2" />
</td>
  </tr>
  <tr>
    <td height="26" align="left" >Re-type New Password </td>
    <td bgcolor="#f8d290">
      <input type="password" name="newpassword2" id="textfield3" />
</td>
  </tr>
</table><br/>
     <center> <input type="submit" name="button" id="button" value="Submit" /></center>

  </form>

<p>&nbsp;</p>
</body>
</html>
