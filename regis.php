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
error_reporting( error_reporting() & ~E_NOTICE );

$mrn = $_POST['mrn'];
$xn = $_POST['xn'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mname = $_POST['mname'];
$efname = $_POST['efname'];
$elname = $_POST['elname'];
$sex = $_POST['sex'];
$dob = $_POST['dob'];
$ssn = $_POST['ssn'];
$ptheight = $_POST['ptheight'];
$ptweight = $_POST['ptweight'];
$address = $_POST['address'];
$road = $_POST['road'];
$tambon = $_POST['tambon'];
$ampher = $_POST['ampher'];
$province = $_POST['province'];
$country = $_POST['country'];
$telephone = $_POST['telephone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$payment = $_POST['payment'];
$rel1_type = $_POST['rel1_type'];
$rel1_name = $_POST['rel1_name'];
$rel1_address = $_POST['rel1_address'];
$rel1_city = $_POST['rel1_city'];
$rel1_zip = $_POST['rel1_zip'];
$rel1_stage = $_POST['rel1_stage'];
$rel1_phone = $_POST['rel1_phone'];
$rel1_email = $_POST['rel1_email'];
$rel2_type = $_POST['rel2_type'];
$rel2_name = $_POST['rel2_name'];
$rel2_address = $_POST['rel2_address'];
$rel2_city = $_POST['rel2_city'];
$rel2_zip = $_POST['rel2_zip'];
$rel2_stage = $_POST['rel2_stage'];
$rel2_phone = $_POST['rel2_phone'];
$rel2_email = $_POST['rel2_email'];

// Check Duplicat MRN
$result = mysqli_query($dbconnect, "SELECT MRN,NAME,LASTNAME FROM xray_patient_info WHERE (MRN = '$mrn') AND (CENTER_CODE ='$center_code')");
$numrows = @mysqli_num_rows($result);
if($numrows !== 0)
	{
		echo "<center><font color=red size=+1>Found Duplicate MRN/ Similar</font></center>";
		echo "<table border='0' cellspacing='1' width=30% align=center>\n
		<tr bgcolor=#CCCCCC>\n
		<td><center>MRN</center></td>\n
		<td><center>Firstname</center></td>\n
		<td><center>Lastname</center></td>\n
		<td><center></center></td>\n
		</tr>";
		while($row = mysqli_fetch_array($result))
			{
				echo "<tr>";
				echo "<td align=right>" . $row['MRN'] . "</td>";
				echo "<td>" . $row['NAME'] . "</td>";
				echo "<td>" . $row['LASTNAME'] . "</td>";
				echo "<td><form id=createorder  name=createorder method=post action=\"createorder.php\"> <input name=\"MRN\" type=\"hidden\" id=\"MRN\" value=". $row['MRN'] . "><input type=\"submit\" name=\"button\" id=\"button\" value=\"Create Order\" /></form>";
				echo "</tr>";
			}
		echo "</table>\n";
	exit;
	}
/////////////////////////

if ($mrn=="") 
	{
		echo "<br /><font color=red>please input Medical Record Number (MRN)</font>";
		exit;
	}
if ($fname=="") 
	{
		echo "<br /><font color=red>please input name</font>";
		exit;
	}
if ($lname=="") 
	{
		echo "<br /><font color=red>Please input lastname</font>";
		exit;
	}
if ($sex=="") 
	{
		echo "<br /><font color=red>Please input sex</font>";
		exit;
	}
if ($dob=="")
	{
		echo "<br /><font color=red>Please input Date of Birth</font>";
		exit;
	}
$dob = date('Ydm', strtotime($dob)); 
$sql = "insert into xray_patient_info(CENTER_CODE,MRN,XN,SSN,NAME,LASTNAME,MIDDLE_NAME,SEX,NAME_ENG,LASTNAME_ENG,BIRTH_DATE,HEIGHT,WEIGHT,TELEPHONE,EMAIL,CREATE_DATE,ADDRESS,ROAD,TAMBON_CODE,AMPHOE_CODE,PROVINCE_CODE,COUNTRY_CODE, PAYMENT) values ('$center_code','$mrn','$xn','$ssn','$fname','$lname','$mname','$sex','$efname','$elname','$dob','$ptheight','$ptweight','$telephone','$email',now(),'$address','$road','$tambon','$ampher','$province','$country','$payment')";
$sql2 = "insert into xray_patient_rel (CENTER_CODE, MRN, REL1_TYPE, REL1_NAME, REL1_ADDRESS, REL1_CITY, REL1_ZIP, REL1_STAGE, REL1_PHONE, REL1_EMAIL, REL2_TYPE, REL2_NAME, REL2_ADDRESS, REL2_CITY, REL2_ZIP, REL2_STAGE, REL2_PHONE, REL2_EMAIL) value ('$center_code','$mrn','$rel1_type','$rel1_name','$rel1_address','$rel1_city','$rel1_zip','$rel1_stage','$rel1_phone','$rel1_email','$rel2_type','$rel2_name','$rel2_address','$rel2_city','$rel2_zip','$rel2_stage','$rel2_phone','$rel2_email')";
mysqli_query($dbconnect, $sql);


$result = mysqli_query($dbconnect, "SELECT MRN FROM xray_patient_rel WHERE (MRN = '$mrn') AND (CENTER_CODE ='$center_code')");
$numrows = @mysqli_num_rows($result);
if($numrows == 0)
{
	mysqli_query($dbconnect, $sql2);
}
	

echo "<table align=center>";
echo "<tr><td>Patient Created";
echo "Name : $fname  <br />Lastname : $lname <br />Sex : $sex<br />\n";
echo "<br /> DOB : ".$dob;
echo "Created on DB<br />";
echo "<form method=post action=createorder.php>";
echo "<input type=hidden name=MRN value='$mrn'>";
echo "<input type=submit value=CreateOrder>";
echo "</form>\n";
echo "</tr></td></table>";
?>