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
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add New Staff</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Add New User";
include "topbar.php";
?>

<form id="form1" name="form1" method="post" action="staff_insert.php">
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Add New Staff</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle"> New User </font></td>
	
    <td width="587" bgcolor="#f8d290">




<?php
			$sql2 ="select * FROM xray_center order by NAME";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<div id='".$row['ORDERID']."'>\n";
			echo "Center Code: <select name=center_code id=select_center".$row['ORDERID'].">";
			echo "<option value=''>Select Center</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					echo "<option name=center_code value=".$row['CODE'];
					if ($row['CODE'] == $center_code)
						{ 
							echo " selected=selected "; 
						}   
					echo " >".$row['CODE']." - ".$row['NAME']."</option>\n";
				}
				
				echo "<select></div>";

?>


<br />
   
<?php
			$sql2 ="select * FROM xray_user_type order by NAME";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<div id='".$row['ORDERID']."'>\n";
			echo "<font color=red>Staff Type :</font><select name=user_type id=selectrad".$row['ORDERID'].">";
			echo "<option value=''>Select User Type</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					echo "<option name=user_type value=\"".$row['TYPE']."\">".$row['NAME']."  ".$row['LASTNAME']."</option>\n";
				}
				echo "</select></div>";
?>



<br/>
  <p><font color=red>Login Name</font>
    <label>
      <input type="text" name="loginname" id="loginname" />
    </label>
  </p>

  <p><font color=red>CODE</font>
    <label>
      <input type="text" name="code" id="code" /> DF Code <input type="text" name="dfcode" id="dfcode" />
    </label>
  </p>
  <p><font color=red>Name </font>
    <label>
      <input type="text" name="name" id="name" />
<font color=red>Lastname </font>

      <input type="text" name="lastname" id="lastname" />
    </label>
  </p>

  <p> <font color=red>Password :</font> <label> <input type="text" name="password" id="password" />  <font color=red>Confirm Password</font><input type="text" name="password2" id="password2" /></label>
  
  
  <br />----------------------------------------------<br />
  PACS USER
    <label>
      <input type="text" name="pacs_user" id="pacs_user" />
    </label>
	
  <p>
    <label>
      <input type="reset" name="clear" id="clear" value="Reset" />
    </label>
    <label>
      <input type="submit" name="button" id="button" value="Submit" />
    </label>
  </p>
  <p>&nbsp;</p>
  
  </form>
  
  </td></tr><table>
   
  </body></html>