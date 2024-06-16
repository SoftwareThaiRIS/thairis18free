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
echo "<html><head><title>Change Password</title>";
?>

    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   

<?php
echo "</head><body bgcolor=\"#d4d4d4\">";
$OLDPASS = trim($_POST['oldpassword']);
$OLDPASS = md5($OLDPASS);
$NEWPASS1 = trim($_POST['newpassword1']);
$NEWPASS1 = md5($NEWPASS1);
$NEWPASS2 = trim($_POST['newpassword2']);
$NEWPASS2 = md5($NEWPASS2);
$sql = "SELECT ID, LOGIN,PASSWORD FROM xray_user WHERE ID='$userid'";
$result =mysqli_query($dbconnect, $sql);
while($row=mysqli_fetch_array($result))
	{
		$PASSWORD1 = $row['PASSWORD'];
	}

if (!($OLDPASS == $PASSWORD1))
	{
		//echo $OLDPASS;
		//echo "<br>";
		echo "<font color=red><center>Wrong Old Password</center></font>";
		exit;
	}

if (!($NEWPASS1 == $NEWPASS2)){
	echo "Please check New Password";
	exit;
}

$sql = "UPDATE xray_user SET PASSWORD = '$NEWPASS1' WHERE LOGIN = '$userlogin'";
mysqli_query($dbconnect, $sql);
/////////////INSERT LOG/////////////
$URL=$_SERVER["HTTP_REFERER"];
mysqli_query($dbconnect, "insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','CHANGEPASSWORD','$URL')");
echo "PASSWORD Changed";
echo "<br> Please LogOut and LogIN";
exit;
?>
<CENTER>
<FORM>
<INPUT type="button" value="Close Window" onClick="window.close()">
</FORM>
</CENTER>
</body>
</htmL>