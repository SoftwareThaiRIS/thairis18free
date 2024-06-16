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
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Procedure Edit</title>
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
include "connectdb.php";
echo "<body bgcolor=\"#d4d4d4\">";
include "topbar.php";
$topbar = "Password";
$userid = $_GET['userid'];
$result = mysqli_query($dbconnect, "SELECT * FROM xray_user WHERE ID='$userid'");
if ($reset_user_password == '0')
	{
		echo "<center> You can't reset userpassword</center>";
	}
while($row = mysqli_fetch_array($result)) 

	{
			$ID = $row['ID'];
			$CODE =$row['CODE'];
			$DF_CODE = $row['DF_CODE'];
			$LOGIN = $row['LOGIN'];
			$NAME=$row['NAME'];
			$LASTNAME = $row['LASTNAME'];
			$USER_TYPE_CODE =$row['USER_TYPE_CODE'];
			$PREFIX = $row['PREFIX'];
			$CENTER_CODE = $row['CENTER_CODE'];
			$ENABLE = $row['ENABLE'];
			$ALL_CENTER = $row['ALL_CENTER'];
			$PACS_LOGIN = $row['PACS_LOGIN'];
			
	}
echo "<FORM method=\"post\"action=resetpassword_save.php>";
echo "<b>Edit Procedure detail</b>";
echo "<table>";
echo "<tr><td>ID</td><td><input type=hidden name=ID value=$ID>".$ID."</td></tr>";
echo "<tr><td>Code</td><td><input type=\"text\" name=CODE value=$CODE>".$CODE."</td></tr>";
echo "<tr><td>DF Code</td><td><input type=\"text\" name=\"DFCODE\"  size=50 value='$DF_CODE'>".$DF_CODE."</td></tr>";
echo "<tr><td>Login</td><td><input type=\"text\" name=\"LOGIN\"  size=50 value='$LOGIN'>".$LOGIN."</td></tr>";
echo "<tr><td>Name</td><td> <input type=\"text\" name=\"NAME\"  size=50 value='$NAME'>".$NAME."</td></tr>";
echo "<tr><td>Lastname</td><td><input type=\"text\" name=\"LASTNAME\"  size=50 value=$LASTNAME>".$LASTNAME."</td></tr>";
echo "<tr><td>User Type</td>";
echo "<td>";
$result = mysqli_query($dbconnect, "SELECT TYPE FROM xray_user_type");
echo "<select name=\"USER_TYPE_CODE\" id=\"USER_TYPE_CODE\">";
echo "<option value=$USER_TYPE_CODE>".$USER_TYPE_CODE."</option>";
while ($row =mysqli_fetch_array($result))
	{
		echo "<option value='".$row['TYPE']."'>".$row['TYPE']."</option>";
	}
echo"</select>";

echo "$USER_TYPE_CODE</td></tr>";

//<td><input type=\"text\" name=\"USER_TYPE_CODE\"  size=50 value=$USER_TYPE_CODE>".$USER_TYPE_CODE."</td></tr>";
echo "<tr><td>Prefix</td><td><input type=\"text\" name=\"PREFIX\"  size=50 value=$PREFIX>".$PREFIX."</td></tr>";
echo "<tr><td>CENTER CODE</td><td><input type=\"text\" name=\"CENTER_CODE\"  size=50 value=$CENTER_CODE>".$CENTER_CODE."</td></tr>";
echo "<tr><td>PACS User</td><td><input type=\"text\" name=\"PACS_LOGIN\"  size=5 value=$PACS_LOGIN>".$PACS_LOGIN."</td></tr>";
echo "<tr><td>ENABLE</td><td><input type=\"text\" name=\"ENABLE\"  size=5 value=$ENABLE>".$ENABLE."</td></tr>";


echo "<tr><td height=\"26\" align=\"left\" >New Password</td><td bgcolor=\"#f8d290\"><input type=\"password\" name=\"newpassword1\" id=\"textfield2\" /></td></tr>";
echo "<tr><td height=\"26\" align=\"left\" >Re-type New Password </td><td bgcolor=\"#f8d290\"><input type=\"password\" name=\"newpassword2\" id=\"textfield3\" /></td></tr>";

echo "</table>";
echo "<input type=\"submit\" name=\"button\" id=\"button\" value=\"Update\" />";
echo "</FORM>";
?>