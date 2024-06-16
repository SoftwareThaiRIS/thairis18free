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
$templateMo = $_GET['templateMo'];
$templateOwner = $_GET['templateOwner'];
$templateBodyPart = $_GET['bodypart'];
$MOTYPE = $_GET['MOTYPE'];
$type = $_GET['type'];
$textsearch = $_GET['text'];
$procbodypart = $_GET['procbodypart'];
if (($templateMo =='ALL') and ($templateOwner !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$userid'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if ($templateOwner =='')
	{
		$sql = "select ID,NAME FROM xray_report_template where XRAY_TYPE_CODE='$MOTYPE' and USER_ID='$userid'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if ($procbodypart !='')
	{
		$sql = "select ID,NAME FROM xray_report_template where XRAY_TYPE_CODE='$MOTYPE' and USER_ID='$userid' and BODY_PART='$procbodypart'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if ($templateOwner !='')
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$templateOwner'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if (($templateOwner !='') and ($templateMo !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$templateOwner' and XRAY_TYPE_CODE='$templateMo'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if (($templateOwner =='ALL') and ($templateMo !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where ALL_USER='1' and XRAY_TYPE_CODE='$templateMo'";//where USER_ID='$templateOwner'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if ($templateMo =='ALL')
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$templateOwner' ";//where USER_ID='$templateOwner'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if (($templateBodyPart !='') and ($templateOwner !='') and ($templateMo !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where BODY_PART='$templateBodyPart' and USER_ID='$templateOwner' and XRAY_TYPE_CODE='$templateMo'";//where USER_ID='$templateOwner'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if ($type == 'search')
	{
		$sql = "select ID,NAME FROM xray_report_template WHERE NAME LIKE '%$textsearch%' and USER_ID='$userid'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}
if (($type == 'search') and ($templateOwner =='ALLxx'))
	{
		$sql = "select ID,NAME FROM xray_report_template WHERE NAME LIKE '%$textsearch%'";
		$result = mysqli_query($dbconnect,$sql);
		$result2 = mysqli_query($dbconnect,$sql);
	}

$newr = $result;
$rowcount =	mysqli_num_rows($result);
if ($rowcount < 7)
	{
		$rowcount = 7;
	}
$rowcount = $rowcount +3;
//////////////////////////////////////////////////////////////
?>

<div id="tableContainer" class="tableContainer">
<table border="0d" cellpadding="0" cellspacing="0" width="100%" class="scrollTable">
<thead class="fixedHeader">
	<tr>
		<th width="90%">Template Name</th>
		<th width="10%">View</th>

	</tr>
</thead>
<tbody class="scrollContent">
<?php			
while($row3 = mysqli_fetch_array($result))
	{
		$value = $row3['ID'];
		echo "<tr  widht=100%>";
		echo "<td width=90% valign=left><p onmouseover=template id=selectlistid VALUE=$value onclick=showtemplate3('$value') style=\"cursor: pointer;\">".$row3['NAME']."</p></td>";
		echo "<td width=10% valign=right><a class=\"fancybox fancybox.iframe\" href=template-view.php?TEMPLATE_ID=".$row3['ID']."><img src=icons/magnifier-zoom-in.png height=11 width=11 border=0></a></td>";
		echo "</tr>\n";

	}


///////////////////////////////////////////////////////////////
echo "<table border=0 cellspacing=0 cellpadding=0>";
echo "<tr><td valign=top>";
echo "<SELECT id=selectid SIZE=$rowcount style=\"background-color:#FFFFDD;width:183px\" onChange=showtemplate2()>";
while($row = mysqli_fetch_array($result))
	{
		echo "<OPTION VALUE=\"".$row['ID']."\" >".$row['NAME']."</OPTION>\n";

	}
echo "<OPTION>-</OPTION>\n";


echo "</td></tr>";
echo "<tr><td valign=top>";

echo "<table><tr><td>";
while($row = mysqli_fetch_array($newr))
	{
		echo "<tr><td><p onmouseover=\"\" style=\"cursor: pointer;\" id=selectlistid".$row['ID']. " VALUE=".$row['ID']."onclick=showtemplate3();>".$row['NAME']."</p><td><a class=\"fancybox fancybox.iframe\" href=template-view.php?TEMPLATE_ID=".$row['ID']."><img src=icons/magnifier-zoom-in.png height=11 width=11 border=0></a></td></tr>\n";
	}
echo "</td></tr>";
echo "</table>";
echo "</td></tr></table>";
echo "<div id=templateshow></div>\n";
?>