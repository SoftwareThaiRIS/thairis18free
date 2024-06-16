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
include ("function.php");

?>
<head>
<link href="css/styles-user.css" rel="stylesheet" type="text/css" />
<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "user-upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>
</head>
<body  bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">User Code</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<?php

echo "<center><table>";
echo "<tr><td valign=top><table width=100% bgcolor=white>";
echo "<tr><td bgcolor=#79ACF3> User Center </td><td bgcolor=#E0E0E0>".$usercenter."</td></tr>";
echo "<tr><td bgcolor=#79ACF3> User ID </td><td bgcolor=#E0E0E0>".$userid."</td></tr>";
echo "<tr><td bgcolor=#79ACF3> User Code  </td><td bgcolor=#E0E0E0> ".$usercode." </td></tr>";
echo "<tr><td bgcolor=#79ACF3> User Name </td><td bgcolor=#E0E0E0>".$username." ".$userlastname."</td></tr>";
echo "<tr><td bgcolor=#79ACF3> User Type </td><td bgcolor=#E0E0E0>".$usertype."</td></tr>";
$sql2 = "select USER_ID, DF_CODE, NAME_THAI, NAME_ENG  FROM XRAY_USER_DF_CODE WHERE USER_ID ='$userid'";
$result2 = mysqli_query($dbconnect, $sql2);
//$numrows = mysql_num_rows($result2);
//if($numrows == 0)
//	{
//		echo "<tr><td bgcolor=#79ACF3>Change Doctor Fee Code </td><td bgcolor=#E0E0E0>Create New Doctor Code</td></tr>";
//	}

?>
<tr><td bgcolor=#79ACF3>Default Page Logon</td><td  bgcolor=#E0E0E0> Main </td></tr>
<tr><td bgcolor=#79ACF3>User Image</td>
<td bgcolor=#E0E0E0>

<?php
$filename = "images/user/".$userid.".jpg";

if (file_exists($filename)) 
	{
		$display=$filename;
	} 
if ($display=='')
	{
		$display="tmp/display.png";
	}
echo "<img src=".$display." width=80 height=80>";
?>

</td></tr>
</table>
<div class="bgColor">
<form id="uploadForm" action="upload.php" method="post">
<div id="targetLayer">No Image</div>
	<div id="uploadFormLayer">
		<label>Upload Image File: (.jpg) </label><br />
		<input name="userImage" type="file" class="inputFile" />
		<input type="submit" value="Submit" class="btnSubmit" />
	</div>
</form>
</td>

<?php
// Signature in paid version
?>
</table>
</td></tr>
</table></center>
<center>
<table bgcolor =white>
<?php

if ($PACS == '1')
	{ 
		echo "<tr><td>Option : <br />";
		echo "<input type=\"checkbox\" name=\"autopacs\" value=autopacs checked> AUTO Open PACS on Report PACS <br />";
		echo "Landing Page ";
		echo " <select>
				<option value=\"main\">Main</option>
				<option value=\"order\">Order</option>
				<option value=\"examroom\">Exam Room</option>
				<option value=\"dictate\">Dictate Worklist</option>
			</select> <br />";
		echo "Menu LANGUAGE";
		echo " <select>
				<option value=\"eng\">English</option>
				<option value=\"thai\">ภาษาไทย (Thai)</option>
			</select>"	;
	}
?>
<br />
Worklist Display <br />
<input type="radio" name="gender" value="male"> 1 Day<br>
<input type="radio" name="gender" value="female"> 1 Week<br>
<input type="radio" name="gender" value="other"> 1 Month <br />
<input type="radio" name="gender" value="other" checked> All <br /> 
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
</td></tr></table></center>