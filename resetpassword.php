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
$code = $_POST['code'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
//$result = mysql_query("SELECT * FROM xray_code WHERE (XRAY_CODE LIKE '%$code%') AND (DESCRIPTION LIKE '%$description%') AND (XRAY_TYPE_CODE LIKE '%$typecode%') AND DELETE_FLAG ='0'");
$result = mysqli_query($dbconnect, "SELECT * FROM xray_user WHERE (CODE LIKE '%$code%') AND (NAME LIKE '%$name%') AND (LASTNAME LIKE '%$lastname%') AND ENABLE ='1'");

?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
</head>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<body bgcolor="#d4d4d4">

<?php
$topbar = "Reset Password";
include "topbar.php";

if ($reset_user_password == '0')
	{
		echo "<center><font size=+2>You don't have permission for change user password</font></center>";
	?>	
		<center><button onclick="goBack()">Go Back</button></center><script>function goBack() {
			window.history.back();
		}
		</script>
	<?php
	exit;
	}
?>

<p>Staff </p>
<p>
<form name="searchcode" method="post" action="staff_show.php" accept-charset="UTF-8">
CODE <input type="text" name="code" id="textfield" />
NAME <input type="text" name="name" id="textfield2" />
LASTNAME <input type="text" name="lastname" id="textfield3" />
<input type="submit" name="button" id="button" value="Search" />
</p>

</form>
<?php
echo "<table border='0'>
<tr>
<th>Center</th>
<th>Code</th>
<th>DF_CODE</th>
<th>LOGIN</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Type</th>
<th></th>
</tr>\n";
$bg = '';
while($row = mysqli_fetch_array($result))
	{ 
		if($bg == "#FFFFFF") 
			{ 
				$bg = "#EBEBEB";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		echo "<tr bgcolor=$bg>";
		echo "<td>". $row['CENTER_CODE']."</td>";
		echo "<td>" . $row['CODE'] . "</td>";
		echo "<td>" . $row['DF_CODE'] . "</td>";
		echo "<td>" . $row['LOGIN'] . "</td>";
		echo "<td align=right>" . $row['NAME'] . "</td>";
		echo "<td align=right>" . $row['LASTNAME'] . "</td>";
		echo "<td align=right>" . $row['USER_TYPE_CODE'] . "</td>";

		echo "<td><a href=resetpasswordshow.php?userid=".$row['ID'].">Edit Password</a></td>";
		echo "</tr>\n";
	}
echo "</table>";
echo "</body></html>";
?>
