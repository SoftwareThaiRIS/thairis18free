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
include "connectdb.php";
$code = $_POST['code'];
$description = $_POST['description'];
$typecode = $_POST['typecode'];
$result = mysqli_query($dbconnect, "SELECT * FROM xray_code WHERE (XRAY_CODE LIKE '%$code%') AND (DESCRIPTION LIKE '%$description%') AND (XRAY_TYPE_CODE LIKE '%$typecode%') AND DELETE_FLAG ='0'");
?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
</head>
<body>
<p>Procedure </p>
<p>
<form name="searchcode" method="post" action="procedureshow.php" accept-charset="UTF-8">
CODE <input type="text" name="code" id="textfield" />
Description <input type="text" name="description" id="textfield2" />
Type <input type="text" name="typecode" id="textfield3" />
<input type="submit" name="button" id="button" value="Search" />
</p>
</form>
<?php
echo "<table border='0'>
<tr>
<th>Code</th>
<th>DESCRIPTION</th>
<th>Type</th>
<th>Price</th>
<th>DF</th>
<th>Duration</th>
<th>Prep</th>
<th>E</th>
<th>V</th>
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
		echo "<td>" . $row['XRAY_CODE'] . "</td>";
		echo "<td>" . $row['DESCRIPTION'] . "</td>";
		echo "<td>" . $row['XRAY_TYPE_CODE'] . "</td>";
		echo "<td align=right>" . $row['CHARGE_TOTAL'] . "</td>";
		echo "<td align=right>" . $row['DF'] . "</td>";
		echo "<td align=right>" . $row['TIME_USE'] . "</td>";
		echo "<td ></td>";
		echo "<td><a href=procedure-edit.php?code=".$row['XRAY_CODE'].">Edit</a></td>";
		echo "<td><a href=procedure-view.php?code=".$row['XRAY_CODE'].">View</a></td>";
		echo "</tr>\n";
	}
echo "</table>";
echo "</body></html>";
?>
