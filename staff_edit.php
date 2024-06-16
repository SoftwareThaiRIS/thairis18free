<!DOCTYPE HTML>
<html>
<head>
<title>Procedure Edit</title>
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
include "connectdb.php";
include "topbar.php";
$topbar = "Staff Edit";
echo "<body bgcolor=\"#d4d4d4\">";
$userid = $_GET['id'];
$result = mysqli_query($dbconnect, "SELECT * FROM xray_user WHERE ID='$userid'");

while($row = mysqli_fetch_array($result)) //ID CODE DF_CODE NAME LASTNAME  USER_TYPE_CODE  PREFIX CENTER_CODE  ALL_CENTER PACS_LOGIN
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
echo "<FORM method=\"post\"action=staff_edit_save.php>";
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
echo "</table>";
echo "<input type=\"submit\" name=\"button\" id=\"button\" value=\"Update\" />";
echo "</FORM>";
?>