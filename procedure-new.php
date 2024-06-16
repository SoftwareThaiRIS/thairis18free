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
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Procedure</title>
</head>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 

<body bgcolor="#d4d4d4">

<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Add New Procedure";
include "topbar.php";

echo "<b>Add New Procedure </b><br />";

?>


<FORM method="post"action=procedure-ins.php>


<table><tr><td>Center</td><td>
<?php
$sql2 ="select * FROM xray_center order by NAME";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<select name=center_code id=select_center".$row['ORDERID'].">";
			echo "<option value=''>Select Center</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					
					echo "<option name=center_code value=".$row['CODE'];
					if ($row['CODE'] == $center_code)
						{ 
							echo " selected=selected "; 
						}   
					echo " >".$row['CODE']." - ".$row['NAME']."</option>\n";
					echo $row['CODE']."VS".$center_code."<br>";
				}
				
				echo "<select></div>";
?>
</td></tr>
<tr><td><font color=red>Code</font></td><td><input type="text" name=CODE value=''></td></tr>
<tr><td><font color=red>Description</font></td><td><input type="text" name="DESCRIPTION"  size=50 /></td></tr>


<tr><td><font color=red>TYPE</font></td><td>
<?php
$sql2 ="select * FROM xray_type order by XRAY_TYPE_CODE";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<select name=type_code id=select_type".$row['ORDRID'].">";
			echo "<option value=''>Select type</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					
					echo "<option name=type_code value=".$row['XRAY_TYPE_CODE'].">".$row['XRAY_TYPE_CODE']." - ".$row['TYPE_NAME']."</option>\n";

				}
				
				echo "<select></div>";
?>




</td></tr>
<tr><td><font color=red>Body Part</font></td><td>
<?php
$sql2 ="select * FROM xray_body_part order by BODY_PART";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<select name=bodypart id=select_type".$row['ORDRID'].">";
			echo "<option value=''>Select Body Part</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					
					echo "<option name=bodypart value=".$row['BODY_PART'].">".$row['BODY_PART']."</option>\n";

				}
				
				echo "<select></div>";
?>
</td></tr>
<tr><td>Charge</td><td><input type="text" name="charge"  size=50 ></td></tr>
<tr><td>Portable Charge</td><td><input type="text" name="portablecharge"  size=50 ></td></tr>
<tr><td>DF</td><td><input type="text" name="df"  size=5 ></td></tr>
<tr><td>TIME</td><td><input type="text" value="15" name="timeuse"  size=50 ></td></tr>
<tr><td>BIRAD</td><td><input type="text" value="0" name="mammo"  size=3 > Mammo = 1</td></tr>
<tr><td>PREPARATION  FORM</td>
<td>
<?php
$sql2 ="select * FROM xray_preparation order by PREP_ID";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<select name=prep id=select_type".$row['ORDRID'].">";
			echo "<option value=''>Select Preparation From</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					
					echo "<option name=prep value=".$row['PREP_ID'].">".$row['MODALITY']." - ".$row['NAME']."</option>\n";

				}
				
				echo "<select></div>";
?>
</td></tr>
</table><input type="submit" name="button" id="button" value="Create New" />
</FORM>
</body>
</html>