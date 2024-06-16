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
$center_code = trim($_POST['center_code']);
$user_type = trim($_POST['user_type']);
$loginname = trim($_POST['loginname']);
$code = trim($_POST['code']);
$dfcode = trim($_PORT['dfcode']);
$name = trim($_POST['name']);
$lastname = trim($_POST['lastname']);
$name_eng = trim($_POST['name_eng']);
$lastname_eng = trim($_POST['lastname_eng']);
$password = trim($_POST['password']);
$password = md5($password);
?>

<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
echo "<body bgcolor=#E8E8E8 >";
$topbar = "Add New Staff";
include "topbar.php";



if (($user_type == '') OR ($loginname == '') OR ($code == '') OR ($name == '') OR ($lastname ==''))
	{
		echo "<br/> <br/><center>Please input data before submit</center>";
		?>
			<center><button onclick="goBack()">Go Back</button>
	<script>
		function goBack() {
			window.history.back();
		}
	</script>
	</center>
	<?php
		exit;
	}

	
$sql = "SELECT LOGIN FROM xray_user WHERE LOGIN = '$loginname'";
$result = mysqli_query($dbconnect, $sql);
$row = mysqli_fetch_row($result);
$userexit = $row[0];
if ($userexit != '')
{ 
	echo "<center> <b> <font size=+2>Found User login you can't create same user login</font></center>";
	exit;
}
	
	
echo "<strong><a href=staff_new.php>Add New Start</a> </strong><br />";
$sql1 = "insert INTO xray_user (CODE, DF_CODE, LOGIN, NAME,LASTNAME,NAME_ENG,LASTNAME_ENG, USER_TYPE_CODE, PASSWORD, CENTER_CODE) 
			VALUES
			('$code','$dfcode','$loginname','$name','$lastname','$name_eng','$lastname_eng','$user_type','$password','$center_code')";
mysqli_query($dbconnect, $sql1);
$sql2 = "insert INTO xray_user_right (SUPER_ADMIN) VALUES ('0')";
mysqli_query($dbconnect, $sql2);
//echo $sql;

?>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Add New Staff</td></tr>
<tr>
<td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle"><br />New Staff Insert</font></td>
<td width="587" bgcolor="#f8d290">

<?php
echo "<br />";
echo "Add username : $name $lastname <br />";
echo "Login : $loginname <br />";
echo "Center : $center_code <br /> User Type : $user_type <br />";
?>


</td></tr>
</table>
<?php
