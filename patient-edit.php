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
$MRN = $_GET['MRN'];
include ("session.php");
include ("function.php");
?>

<body bgcolor="#d4d4d4" leftmargin="3" topmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Edit Patient</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />

<?php
echo "<u>Patient Informataion </u><br/>";
if ($edit_patient == '0')
{
	echo "You don't have permission for Edit Patient Info";
}
echo "MRN : ".$MRN."<br />";
$sql = "select MRN, SSN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE, HEIGHT, WEIGHT FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysqli_query($dbconnect, $sql);
$row = mysqli_fetch_array($result);
$ssn = $row['SSN'];
$dob = $row['BIRTH_DATE'];
$ptheight = $row['HEIGHT'];
$ptweight = $row['WEIGHT'];
echo "<form action=patient-edit-save.php?>";
echo "<input type=hidden name=MRN value=".$MRN.">";
echo "Name : <input type=text name=firstname value=".$row['NAME']."><br />";
echo "Lastname : <input type=text name=lastname value=".$row['LASTNAME']."><br />";
echo "SEX : ";

if ($row['SEX'] =='M') 
	{
		echo "<input type=\"radio\" name=\"sex\" value=\"male\" checked/> Male ";
		echo "<input type=\"radio\" name=\"sex\" value=\"female\" /> Female ";
		echo "<input type=\"radio\" name=\"sex\" value=\"unknow\" /> Unknow <br />";
	}

if ($row['SEX'] == 'F') 
	{
		echo "<input type=\"radio\" name=\"sex\" value=\"male\" /> Male";
		echo "<input type=\"radio\" name=\"sex\" value=\"female\" checked/> Female ";
		echo "<input type=\"radio\" name=\"sex\" value=\"female\" /> Unknow <br />";
	}
	
if ($row['SEX'] == 'U') 
	{
		echo "<input type=\"radio\" name=\"sex\" value=\"male\" /> Male";
		echo "<input type=\"radio\" name=\"sex\" value=\"female\" /> Female ";
		echo "<input type=\"radio\" name=\"sex\" value=\"unknow\" /> Unknow <br />";
	}

echo "DOB : <input type=text value=".$dob." readonly><br/>";
echo "SSN : <input type=text name=ssn value=".$ssn."><br/>";
echo "Height : <input type=text name=ptheight value=".$ptheight."><br/>";
echo "Weight : <input type=text name=ptweight value=".$ptweight."><br/>";

echo "<br/>";
echo "<input type=\"submit\" value=\"Submit\" />";
echo "</form>";
?>