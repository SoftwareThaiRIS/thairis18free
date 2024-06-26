<?php
# ThaiRIS (Thai Radiology Information System)
# Version: 1.8
# File last modified: 4-Oct 2020
# File name: createdoder.php
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
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
$mrn = $_GET['MRN'];

if ($mrn == '')
{
	$mrn = $_POST['MRN'];
}
$sql = "select MRN, NAME, LASTNAME, HEIGHT, WEIGHT, BIRTH_DATE FROM xray_patient_info WHERE MRN = '$mrn'";
$result = mysqli_query($dbconnect, $sql);
$list = mysqli_fetch_array($result);
$hn = $list['MRN'];
$name = $list['NAME'];
$lastname = $list['LASTNAME'];
$dob = $list['BIRTH_DATE'];
$height = $list['HEIGHT'];
$weight = $list['WEIGHT'];
echo "<html>\n";
echo "<head><title>ThaiRIS</title>";
echo "<script language=JavaScript src=\"frames_body_array.js\" type=text/javascript></script>\n";
echo "<script language=JavaScript src=\"mmenu.js\" type=text/javascript></script> \n";
echo "</head>\n";
echo "<body bgcolor=#d4d4d4><meta http-equiv=\"Content-Type\" content=\"text/html; charset=tis-620\">\n";
?>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<body bgcolor="gray" leftmargin="3">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Create Order</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />
<script type="text/JavaScript" src="ordercart.js"></script>

<?php
echo "<div id=showcompleateorder>";
echo "<table border=0 width=100%><tr valign=top><td bgcolor=#848484 width=200>";
echo "<table>";
echo "<tr><td bgcolor=#79acf3><center><b>Patient Infomation</b></center></td></tr><tr><td>";
echo "<table width=100%><tr><td bgcolor=#EBEBEB>";
echo "<b>MRN </b>: <a href=patient-edit.php?MRN=$hn>".$hn."</a><br>";
echo "<b>Name </b>: ".$name."<br/><b>Lastname </b>: ".$lastname."<br/>";
echo "<b>DOB </b>: ".$dob."<br/>";
echo "<b>Height </b>: ".$height."<br/><b>Weight </b>: ".$weight;
echo "</td></tr></table>";
echo "<hr>";
echo "<table><tr><td bgcolor=#79acf3>";
echo "<b>Referrer Physician</b></td></tr><tr><td bgcolor=#EBEBEB>";
echo "<form name=referrerform>";
echo "<div id=referrer><font color=red>Please search Doctor</font>";
echo "<input type=\"hidden\" name=\"referrer\" id=\"referrer\" value=''></div>";
echo "<input type=\"text\" name=\"referrer2\" id=\"referrer2\" onKeyup=\"select_referrer()\" onkeypress=\"return event.keyCode!=13\">";
echo "<input type=\"button\" value=\"Search\" onclick=select_referrer()>";
echo "</form>";
echo "</td></tr></table><hr>";
echo "<table width=100%><tr><td bgcolor=#79acf3>";
echo "<b>Department</b></td></tr><tr><td bgcolor=#EBEBEB>";
echo "<form name=departmentform>";
echo "<div id=department><font color=red>Please search department</font>";
echo "<input type=\"hidden\" name=\"department_selected\" value=''></div>";
echo "<input type=\"text\" name=\"department\" id=\"department\" onKeyup=\"select_department()\" onkeypress=\"return event.keyCode!=13\" ><input type=\"button\" name=\"search\" value=\"Search\"  onclick=select_department()>";
echo "</form></td></tr></table><hr>";
echo "<table width=100%><tr><td bgcolor=#79acf3>";
echo "<b>Select Procedure</b></td></tr>";
echo "<tr><td bgcolor=#EBEBEB>";
$sql2 ="select * FROM xray_type";
$result2 = mysqli_query($dbconnect, $sql2);

echo "<select id=procedurelist onChange=open_procedure('xxxx','".$mrn."');>";
echo "<OPTION>Please Select Type</OPTION>";
while ($row =mysqli_fetch_array($result2))
	{
		echo "<option value='".$row['XRAY_TYPE_CODE']."'>".$row['TYPE_NAME']."</option>";
	}
echo "</select>";
echo "<form name=procedureform>";
echo "<input type=\"text\" name=\"proceduretext\" id=\"proceduretext\" onKeyup=\"search_procedure('".$mrn."')\" onkeypress=\"return event.keyCode!=13\" >";
echo "<input type=\"button\" name=\"TYPE\" value=\"Search\"  onclick=search_procedure()>";
echo "</form>";
echo "</td></tr></table>\n";
echo "</td></tr></table>\n";
echo "<form name=typeselect>";
echo "<input type=\"hidden\" name=\"TYPE\" value=\"CT\">\n";
echo "</form>\n"; 
echo "<td width=50%>";
echo "<table width=100% border=0>";
echo "<tr>";
echo "<td><font face=\"MS Sans Serif\"><div id=show>Create order by : <br/>select Referrer, Department, Procedure from left menu</div></font></td></tr></table></td>\n";
echo "<form>";
echo "<td align=center bgcolor=#CCCCCC>";
echo "<table width=100%><tr><td>";
echo "<div id=selectorder>Selected Order</div>";
echo "</tr></td></table>";
echo "</td></form>";
echo"</tr><table>";
echo "</div>"; //end showselectorder
?>