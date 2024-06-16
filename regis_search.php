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
header("Content-type: text/html;  charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>

<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<link href="css/main.css" rel="stylesheet" type="text/css" />

	<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>

<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
		<script type="text/javascript" src='Scripts/jquery-1.4.4.js'></script>
		<script type="text/javascript" src="Scripts/jquery.jclock.js"></script>  

	<script type="text/javascript">
    $(function($) {
       var options = {
            timeNotation: '12h',
            am_pm: true,
            fontFamily: 'Verdana',
            fontSize: '16px',
            foreground: 'black'
          }; 
       $('.jclock').jclock(options);
    });
    </script> 
	
</head>
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
echo "<body bgcolor=#E8E8E8 >";
$topbar = "Search";
include "topbar.php";

//mysql_select_db($dbname,$dbconnect);

$mrn = $_POST['mrn'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];


if ($mrn =="" && $fname =="" && $lname =="") {

?>
<br/>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle" valign="center">Find</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="regis_search.php" accept-charset="UTF-8">
		<table>
			<tr><td><font face="MS Sans Serif">MRN   </font> </td><td><input type="text" name="mrn"></td><td></td><td></td></tr>
			<tr><td><font face="MS Sans Serif">Name </td><td> <input type="text" name="fname" value=""></td><td>Lastname </font></td><td> <input type="text" name="lname"><br /></td></tr>
           <tr><td colspan=4> <center><input type="submit" name="Submit" value="Search"></center></td></tr>
        </table>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
<br />


<?php
echo "<br><center><font color=red>Please input data for search</font></center>";

exit;

}
$result = mysqli_query($dbconnect, "SELECT MRN,NAME,LASTNAME FROM xray_patient_info WHERE (MRN LIKE '%$mrn%') AND (NAME LIKE '%$fname%') AND (LASTNAME LIKE '%$lname%') AND (CENTER_CODE ='$center_code') LIMIT 0,99");
$num_rows = @mysqli_num_rows($result);
?>
<br/>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle" valign="center">Find</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="regis_search.php" accept-charset="UTF-8">
		<table>
			<tr><td><font face="MS Sans Serif">MRN   </font> </td><td><input type="text" name="mrn"></td><td></td><td></td></tr>
			<tr><td><font face="MS Sans Serif">Name </td><td> <input type="text" name="fname" value=""></td><td>Lastname </font></td><td> <input type="text" name="lname"><br /></td></tr>
           <tr><td colspan=4> <center><input type="submit" name="Submit" value="Search"></center></td></tr>
        </table>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
<br />

<?php
if ($num_rows  > 0)
			{ 
						echo "<center>Found : ".$num_rows. " items</center>";
						echo "<table border='0' cellspacing='1' width=70% align=center>\n
						<tr bgcolor=#79acf3>\n
						<td><center>MRN</center></td>\n
						<td><center>$_NAME</center></td>\n
						<td><center>$_LASTNAME</center></td>\n
						<td><center></center></td>\n
						</tr>";
						while($row = mysqli_fetch_array($result))
									{
										echo "<tr>";
										echo "<td align=right>" . $row['MRN'] . "</td>";
										echo "<td>" . $row['NAME'] . "</td>";
										echo "<td>" . $row['LASTNAME'] . "</td>";
										echo "<td><form id=createorder  name=createorder method=post action=\"createorder.php\"> <input name=\"MRN\" type=\"hidden\" id=\"MRN\" value=". $row['MRN'] . "><input type=\"submit\" name=\"button\" id=\"button\" value=\"Create Order\" /></form>";
										//echo "<td><form id=createorder  name=createorder method=post action=\"selectreferrer.php\"> <input name=\"MRN\" type=\"hidden\" id=\"MRN\" value=". $row['MRN'] . "><input type=\"submit\" name=\"button\" id=\"button\" value=\"Create Order\" /></form>";
										echo "</tr>";
									}
						echo "</table>";			
			}

if ($num_rows == 0 ){
echo "<center><b><font color=red>Patient not found  !!  </b>Search again or Create new patient </font><br/></center>\n";
echo "<br/>";
echo  "<center><a href=register.php>Create New Patient</a></center>";

}

?>
</body></html>