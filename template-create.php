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
include "connectdb.php";
include "session.php";

?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script type="text/JavaScript" src="createtemplate.js"></script>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	//new nicEditor().panelInstance('area1');
	//new nicEditor({fullPanel : true}).panelInstance('area2');
	//new nicEditor({fullPanel : true}).panelInstance('area2');
	//new nicEditor({iconsPath : 'nicEditorIcons.gif'}).panelInstance('area3');
	new nicEditor({iconsPath : 'nicEditIcons-latest.gif'}).panelInstance('area2');
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html']}).panelInstance('area2');
	//new nicEditor({maxHeight : 100}).panelInstance('area5');
});
</script>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
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
		if(document.template.TEMPLATENAME.value == "")
			{
				alert('Please input Template Name !');
				document.template.TEMPLATENAME.focus();       
				return false;
			}
		document.template.submit();
	}
	
</script>
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Create Template</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<?php

$sql = "select XRAY_TYPE_CODE from xray_type";
$result = mysqli_query($dbconnect, $sql);
echo "<center><table bgcolor=white ><tr><td>";
echo "<b><u>Create Template</u></b><p>";
echo "<form name=template method=post action=createtemplate-save.php enctype=\"multipart/form-data\" onSubmit=\"JavaScript:return fncSubmit();\">";
echo "<input type=hidden name='CENTER' value=\"".$center_code."\">";
echo "<input type=\"hidden\" name=\"department_selected\" value=''></div>";
echo "Template In :";
echo "<SELECT NAME=\"owner\">\n<OPTION VALUE=".$usercode.">My Template</OPTION>\n";
echo "<OPTION VALUE=\"ALL\">ALL User</OPION></SELECT>";
echo "Modality Type : <SELECT id=\"modality\" name=\"modality\" onChange=select_mod('xxx')>";
echo "<OPTION></OPTION>";
while($row = mysqli_fetch_array($result)){
	echo "<OPTION VALUE=".$row['XRAY_TYPE_CODE'].">".$row['XRAY_TYPE_CODE']."</OPTION>";
}
echo "</SELECT>";

?>
<div id=showprocedure></div>
<div id="reportspace">
<textarea cols="105" rows="20" id="area2" name="TEXTREPORT"></textarea><br />
<center>Template Name : <input type=text name=TEMPLATENAME maxlength="30">
<input type=submit value="Save Template"> </center></div>
<?php
echo "</form>\n";
echo "</td></tr></table>";
echo "<center>CopyRight(C) ThaiRIS.Net</center>"
?>