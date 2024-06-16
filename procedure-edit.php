<!DOCTYPE HTML>
<html>
<head>
<title>Procedure Edit</title>
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
include "connectdb.php";
include "topbar.php";
$topbar = "Add Referrer";
$code = $_GET['code'];
$result = mysqli_query($dbconnect, "SELECT * FROM xray_code WHERE XRAY_CODE='$code'");

while($row = mysqli_fetch_array($result))
	{
			$CENTER = $row['CENTER'];
			$CODE =$row['XRAY_CODE'];
			$DESCRIPTION = $row['DESCRIPTION'];
			$XRAY_TYPE_CODE=$row['XRAY_TYPE_CODE'];
			$BODY_PART = $row['BODY_PART'];
			$CHARGE_TOTAL =$row['CHARGE_TOTAL'];
			$PORTABLE_CHARGE = $row['PORTABLE_CHARGE'];
			$DF = $row['DF'];
			$TIME_USE = $row['TIME_USE'];
			$BIRAD_FLAG = $row['BIRAD_FLAG'];
			$DELETE_FLAG = $row['DELETE_FLAG'];
			$PREP_ID = $row['PREP_ID'];
			
			
	}
echo "<FORM method=\"post\"action=procedure-edit-up.php>";
echo "<b>Edit Procedure detail</b>";
echo "<table>";
echo "<tr><td>Center</td><td>".$CENTER."</td></tr>";
echo "<tr><td>Code</td><td><input type=hidden name=CODE value=$CODE>".$CODE."</td></tr>";
echo "<tr><td>Description</td><td><input type=\"text\" name=\"DESCRIPTION\"  size=50 value='$DESCRIPTION'>".$DESCRIPTION."</td></tr>";
echo "<tr><td>TYPE</td><td> <input type=\"text\" name=\"XRAY_TYPE_CODE\"  size=50 value='$XRAY_TYPE_CODE'>".$XRAY_TYPE_CODE."</td></tr>";
echo "<tr><td>Body Part</td><td><input type=\"text\" name=\"BODYPART\"  size=50 value=$BODY_PART>".$BODY_PART."</td></tr>";
echo "<tr><td>Charge</td><td><input type=\"text\" name=\"CHARGE_TOTAL\"  size=50 value=$CHARGE_TOTAL>".$CHARGE_TOTAL."</td></tr>";
echo "<tr><td>Portable Charge</td><td><input type=\"text\" name=\"PORTABLE_CHARGE\"  size=50 value=$PORTABLE_CHARGE>".$CHARGE_TOTAL."</td></tr>";
echo "<tr><td>DF</td><td><input type=\"text\" name=\"DF\"  size=5 value=$DF>".$DF."</td></tr>";
echo "<tr><td>TIME</td><td><input type=\"text\" name=\"TIME_USE\"  size=50 value=$TIME_USE>".$TIME_USE."</td></tr>";
echo "<tr><td>BIRAD</td><td><input type=\"text\" name=\"BIRAD_FLAG\"  size=50 value=$BIRAD_FLAG>".$BIRAD_FLAG."</td></tr>";
echo "<tr><td>DELETE</td><td><input type=\"text\" name=\"DELETE_FLAG\"  size=50 value=$DELETE_FLAG>".$DELETE_FLAG."</td></tr>";
echo "<tr><td>PREPARATION  FORM</td><td>";
$result = mysqli_query($dbconnect, "SELECT PREP_ID, NAME FROM xray_preparation");
echo "<select name=\"select\" id=\"select\">";
echo "<option value=\"\">-</option>";
while ($row =mysqli_fetch_array($result))
	{
		echo "<option value='".$row['PREP_ID']."'>".$row['NAME']."</option>";
	}
echo"</select>";
echo "</table>";
echo "<input type=\"submit\" name=\"button\" id=\"button\" value=\"Update\" />";
echo "</FORM>";
?>