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

//$template = $_GET['TEMPLATE'];
$MOTYPE = $_GET['MOTYPE'];
$procbodypart = $_GET['procbodypart'];
echo "<script type=\"text/javascript\" src=\"template.js\"></script>";
echo "<form name=templateform>";
echo "<input type=hidden name=MOTYPE value=$MOTYPE>";
echo "<b>Template Filter</b>";
echo "<select id=typeOwner onChange=showtemplateOwner() style=\"background-color:#BDBDBD;width:183px\">";
echo "<OPTION value=".$userid.">My Template</OPTION>";
echo "<OPTION value=ALL>Public Template</OPTION>";
echo "</select><br />\n";
echo "<select id=typeMo onChange=showtemplateMo() style=\"background-color:#A4A4A4;width:183px\">";
echo "<OPTION>Select Modality</OPTION>";
echo "<OPTION value=ALL>All</OPTION>";
echo "<OPTION value=CT>CT</OPTION>";
echo "<OPTION value=MRI>MRI</OPTION>";
echo "<OPTION value=XRAY>XRAY</OPTION>";
echo "<OPTION value=US>US</OPTION>";
echo "<OPTION value=MAMMO>MAMMO</OPTION>";
echo "<OPTION value=BMD>BMD</OPTION>";
echo "<OPTION value=ANGIO>ANGIO</OPTION>";
echo "<OPTION value=FLUORO>FLUORO</OPTION>";
echo "</select>";
echo "<br \>";

$sqlbodypart ="select BODY_PART from xray_body_part";
$result0 = mysqli_query($dbconnect, $sqlbodypart);
$row1 = mysqli_fetch_array($result0);
echo "<SELECT id=bodypart onChange=showtemplateBodyPart() style=\"background-color:#BDBDBD;width:183px\">";
echo "<OPTION VALUE=\"\">Select Body Part</OPTION>";
while($row1 = mysqli_fetch_array($result0))
	{
		echo "<OPTION value='".$row1['BODY_PART']."'>".$row1['BODY_PART']."</OPTION>\n";
	}
echo "</SELECT><br \>";
echo "Search :<input type=box id=text onKeyup=\"searchtemplate()\" style=width:179px>";

$sql = "select ID,NAME FROM xray_report_template where USER_ID ='$userid' and XRAY_TYPE_CODE='$MOTYPE'";
if ($procbodypart !='')
	{
			$sql = "select ID,NAME FROM xray_report_template where USER_ID ='$userid' and XRAY_TYPE_CODE='$MOTYPE' and BODY_PART='$procbodypart'";
			$result1 = mysqli_query($dbconnect, $sql);
				$countrow =  mysqli_num_rows($result1);
					if ($countrow == 0)
							{
								$sql = "select ID,NAME FROM xray_report_template where USER_ID ='$userid' and XRAY_TYPE_CODE='$MOTYPE'";
							}
	}
$result1 = mysqli_query($dbconnect, $sql);
$result2 = mysqli_query($dbconnect, $sql);
$result3 = mysqli_query($dbconnect, $sql);

/*
echo "<br />Template Name :";
*/
echo "<div id=templatebox>";


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
while($row3 = mysqli_fetch_array($result3))
	{
		$value = $row3['ID'];
		echo "<tr  widht=100%>";
		echo "<td width=90% valign=left><p onmouseover=template id=selectlistid VALUE=$value onclick=showtemplate3('$value') style=\"cursor: pointer;\">".$row3['NAME']."</p></td>";
		echo "<td width=10% valign=right><a class=\"fancybox fancybox.iframe\" href=template-view.php?TEMPLATE_ID=".$row3['ID']."><img src=icons/magnifier-zoom-in.png height=11 width=11 border=0></a></td>";
		echo "</tr>\n";

	}

echo "</div>";
echo "</form>\n";
?>
</tbody>
</table>
</div>




