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
$result = mysqli_query($dbconnect, "SELECT * FROM xray_user WHERE (CODE LIKE '%$code%') AND (NAME LIKE '%$name%') AND (LASTNAME LIKE '%$lastname%') ");


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
<?php
$topbar = "Staff Edit";
include "topbar.php";
?>
<body bgcolor="#d4d4d4">

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
<th>Code</th>
<th>DF_CODE</th>
<th>LOGIN</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Type</th>
<th>E</th>
<th>V</th>
<th>Status</th>
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
		echo "<td>" . $row['CODE'] . "</td>";
		echo "<td>" . $row['DF_CODE'] . "</td>";
		echo "<td>" . $row['LOGIN'] . "</td>";
		echo "<td align=right>" . $row['NAME'] . "</td>";
		echo "<td align=right>" . $row['LASTNAME'] . "</td>";
		echo "<td align=right>" . $row['USER_TYPE_CODE'] . "</td>";
		echo "<td><a href=staff_edit.php?id=".$row['ID'].">Edit</a></td>";
		echo "<td><a href=staff-view.php?code=".$row['CODE'].">View</a></td>";
		$status = $row['ENABLE'];
		if ($status == '0') {
			echo "<td>Disabled</td>";
		}
		else {
			echo "<td></td>";
		}
			
		echo "</tr>\n";
	}

echo "</table>";
echo "</body></html>";

?>
