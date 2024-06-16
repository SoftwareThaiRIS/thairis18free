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
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
$TEMPLATE_ID = $_GET['TEMPLATE_ID'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script type="text/JavaScript" src="createtemplate.js"></script>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor({iconsPath : 'nicEditIcons-latest.gif'}).panelInstance('area2');
});
</script>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<script language="javascript">
function fncSubmit()
	{
			if(document.template.modality.value == "")
			{
				alert('Please Select a modality type !');
				document.template.modality.focus();       
				return false;
			}  
			if(document.template.BODYPART.value == "")
			{
				alert('Please Select body part !');
				document.template.BODYPART.focus();       
				return false;
			}
		document.template.submit();
	}
</script>
<body bgcolor='#d4d4d4' topmargin=0>
<?php
//include "connectdb.php";
include "session.php";
echo "<b><u><h2>View Template </h2></u></b><p>";
echo "<form name=template method=post action=template-edit-save.php enctype=\"multipart/form-data\" onSubmit=\"JavaScript:return fncSubmit();\">";
?>
<table style=border-style:solid;border-width:1px; bgcolor=#EEEEEE cellspacing="0" cellpadding="0">
<tr><td>
<div id=showprocedure></div>
<div id="reportspace">
<textarea cols="105" rows="20" id="area2" name="TEXTREPORT" readonly>
<?php
$sql ="select ID, NAME, XRAY_CODE, XRAY_TYPE_CODE, BODY_PART, USER_ID, REPORT_DETAIL FROM xray_report_template WHERE ID='$TEMPLATE_ID'";
$result = mysqli_query($dbconnect, $sql);
while($row = mysqli_fetch_array($result))
				{
					echo $row['REPORT_DETAIL'];
					$TEMPLATE_ID = $row['ID'];
					$TEMPLATE_NAME =  $row['NAME'];
				}
?>
</textarea><br>
</td></tr></table>
Template Name : 
<?php
echo "<b>".$TEMPLATE_NAME."</b>";
echo "<input type=hidden name='TEMPLATE_ID' value=\"".$TEMPLATE_ID."\">";
?>
</div>
<?php
echo "</form>\n";
echo "<center>CopyRight(C) ThaiRIS.Net</center>"
?>