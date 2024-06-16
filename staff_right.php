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
$sql1 = 
"SELECT 
xray_user.ID AS ID,
xray_user.CODE AS CODE, 
xray_user.NAME AS NAME, 
xray_user.LOGIN,
xray_user.LASTNAME AS LASTNAME, 
xray_user.CENTER_CODE,
xray_user.USER_TYPE_CODE,
xray_user_right.USER_ID AS USER_ID,
xray_user_right.SUPER_ADMIN AS SUPER_ADMIN,
xray_user_right.ADMIN AS ADMIN,
xray_user_right.DELETE_ORDER AS DELETE_ORDER,
xray_user_right.CHANGE_STATUS AS CHANGE_STATUS,
xray_user_right.EDIT_PATIENT AS EDIT_PATIENT,
xray_user_right.UPLOAD AS UPLOAD,
xray_user_right.DEL_UPLOAD AS DEL_UPLOAD,
xray_user_right.UPDATE_CODE AS UPDATE_CODE,
xray_user_right.CREATE_ORDER AS CREATE_ORDER,
xray_user_right.RESET_USER_PASSWORD AS RESET_USER_PASSWORD
FROM xray_user
RIGHT JOIN xray_user_right ON xray_user.ID = xray_user_right.USER_ID 
WHERE ENABLE = '1' ORDER BY ID";
//WHERE xray_user.CENTER_CODE ='$usercenter'";
if ($superadmin == 0)
	{
		echo "<body bgcolor=#E8E8E8 topmargin=0 leftmargin=0>";
		$topbar = "Staff Right";
		include "topbar.php";
		echo "<br /><br /><br /> <center>Only Super Admin can access, Your user right access \"Staff Right\"</center>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=admin.php\">";
		exit;
	}
$result = mysqli_query($dbconnect,$sql1);

?>
<html>
<head>
<title>User Right</title>
</head>

<?php
echo "<body bgcolor=#E8E8E8 >";
$topbar = "User Right";
include "topbar.php";

?>
<style>
* { 
	margin: 0; 
	padding: 0; 
}
body { 
	font: 14px/1.4 Georgia, Serif; 
}
#page-wrap {
	margin: 50px;
}
p {
	margin: 20px 0; 
}

	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	table { 
		width: 100%; 
		border-collapse: collapse; 
	}
	/* Zebra striping */
	tr:nth-of-type(odd) { 
		background: #eee; 
	}
	th { 
		background: #333; 
		color: white; 
		font-weight: bold; 
	}
	td, th { 
		padding: 6px; 
		border: 1px solid #ccc; 
		text-align: left; 
	}

	
</style>
<?php
echo "<center> User Right</center>";
echo "<center><table>

<tr>
<th>Center</th>
<th>ID</th>
<th>CODE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Login</th>
<th>User Type</th>
<th>Super Admin</th>
<th>Admin</th>
<th>Delete</th>
<th>Change Status</th>
<th>Edit Patient</th>
<th>Upload</th>
<th>Delete Upload</th>
<th>Update Procudure</th>
<th>Create Order</th>
<th>Reset Pass</th>
</tr>\n";

$bg ="#FFCCCC";
while($row = mysqli_fetch_assoc($result))
  {
		if($bg == "#FFFFFF") 
			{ 
				$bg = "#C8C8C8";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		
		echo "<tr bgcolor=$bg>";
		echo "<td>".$row['CENTER_CODE']."</td>";
		echo "<td>" .$row['ID'] ." </td>";
		echo "<td>" . $row['CODE'] . "</td>";
		echo "<td>" . $row['NAME'] . "</td>";
		echo "<td>" . $row['LASTNAME'] . "</td>";
		echo "<td>".$row['LOGIN']."</td>";
		echo "<td>".$row['USER_TYPE_CODE']."</td>";
		echo "<form name=\"form1\" method=\"post\" action=\"\">\n";
		echo "<input type=hidden name=id[]".$row['ID']." value=".$row['ID'].">";
		if ($row['SUPER_ADMIN'] == 1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"SUPER_ADMIN[".$row['ID']."]\" id=\"SUPER_ADMIN\" value=\"1\" checked></td>\n";
			}
		else 
			{
				echo "<td align=center><input type=\"checkbox\" name=\"SUPER_ADMIN[".$row['ID']."]\"  id=\"SUPER_ADMIN\" value=\"1\" ></td>\n";
			}
		if ($row['ADMIN'] == 1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"ADMIN[".$row['ID']."]\"  id=\"ADMIN\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"ADMIN[".$row['ID']."]\"  id=\"ADMIN\" value=\"1\"></td>\n";
			}
		if ($row['DELETE_ORDER'] == 1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"DELETE_ORDER[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"DELETE_ORDER[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		if ($row['CHANGE_STATUS'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"CHANGE_STATUS[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else 
			{
				echo "<td align=center><input type=\"checkbox\" name=\"CHANGE_STATUS[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		if ($row['EDIT_PATIENT'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"EDIT_PATIENT[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"EDIT_PATIENT[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		if ($row['UPLOAD'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"UPLOAD[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"UPLOAD[".$row['ID']."]\" value=\"1\"></td>\n";
			}			
		if ($row['DEL_UPLOAD'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"DEL_UPLOAD[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"DEL_UPLOAD[".$row['ID']."]\" value=\"1\"></td>\n";
			}			
		if ($row['UPDATE_CODE'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"UPDATE_CODE[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"UPDATE_CODE[".$row['ID']."]\" value=\"1\"></td>\n";
			}	
		if ($row['CREATE_ORDER'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"CREATE_ORDER[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"CREATE_ORDER[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		if ($row['RESET_USER_PASSWORD'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"RESET_USER_PASSWORD[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"RESET_USER_PASSWORD[".$row['ID']."]\" value=\"1\"></td>\n";
			}				
		echo "</tr>\n";
	}

echo "
<tr>
<th>Center</th>
<th>ID</th>
<th>CODE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Login</th>
<th>User Type</th>
<th>Super Admin</th>
<th>Admin</th>
<th>Delete</th>
<th>Change Status</th>
<th>Edit Patient</th>
<th>Upload</th>
<th>Delete Upload</th>
<th>Update Procudure</th>
<th>Create Order</th>
<th>Reset Pass</th>
</tr>\n";

echo "</table></center><br />\n";
echo "<center><input type=submit name=submit value=UPDATE></center>"; //<input type="submit" name="Submit" value="Submit">
echo "</form>";
echo "<br /></br />";

?>

</body>
</html>

<?php
if ( isset( $_POST["submit"] ) ) 
	{
	//echo '<pre>';
	//print_r( $_POST );
	//echo '</pre>';
	foreach( $_POST["id"] AS $id ) 
		{
			
			if (($id == '1') AND (($_POST["SUPER_ADMIN"][$id] == '') OR ($_POST["ADMIN"][$id] == '')))
				{
					echo "<center><font color=red size=+2>You can't remove Super Admin, Admin from ID1</font></center>";
					exit;
				}

				
			if ($_POST["SUPER_ADMIN"]['$id'] == '')
				{
					$_POST["SUPER_ADMIN"]['$id'] = '0';
				}
			if ($_POST["ADMIN"][$id] == '')
				{
					$_POST["ADMIN"]['$id'] = '0';
				}
			if ($_POST["DELETE_ORDER"]['$id'] == '')
				{
					$_POST["DELETE_ORDER"]['$id'] = '0';
				}
			if ($_POST["CHANGE_STATUS"]['$id'] == '')
				{
					$_POST["CHANGE_STATUS"]['$id'] = '0';
				}	
			if ($_POST["EDIT_PATIENT"]['$id'] == '')
				{
					$_POST["EDIT_PATIENT"]['$id'] = '0';
				}
			if ($_POST["UPLOAD"]['$id'] == '')
				{
					$_POST["UPLOAD"]['$id'] = '0';
				}			
			if ($_POST["DEL_UPLOAD"]['$id'] == '')
				{
					$_POST["DEL_UPLOAD"]['$id'] = '0';
				}				
			if ($_POST["UPDATE_CODE"]['$id'] == '')
				{
					$_POST["UPDATE_CODE"]['$id'] = '0';
				}
			if ($_POST["CREATE_ORDER"]['$id'] == '')
				{
					$_POST["CREATE_ORDER"]['$id'] = '0';
				}
			if ($_POST["RESET_USER_PASSWORD"]['$id'] == '')
				{
					$_POST["RESET_USER_PASSWORD"]['$id'] = '0';
				}

			$SUPER_ADMIN = $_POST['SUPER_ADMIN'][$id];
			$ADMIN = $_POST['ADMIN'][$id];
			$DELETE_ORDER= $_POST['DELETE_ORDER'][$id];
			$CHANGE_STATUS = $_POST['CHANGE_STATUS'][$id];
			$EDIT_PATIENT = $_POST['EDIT_PATIENT'][$id];
			$UPLOAD = $_POST['UPLOAD'][$id];
			$DEL_UPLOAD = $_POST['DEL_UPLOAD'][$id];
			$UPDATE_CODE = $_POST['UPDATE_CODE'][$id];
			$CREATE_ORDER = $_POST['CREATE_ORDER'][$id];
			$RESET_USER_PASSWORD = $_POST['RESET_USER_PASSWORD'][$id];
			$update ="UPDATE xray_user_right 
							SET SUPER_ADMIN='$SUPER_ADMIN', 
							ADMIN='$ADMIN', 
							DELETE_ORDER='$DELETE_ORDER', 
							CHANGE_STATUS='$CHANGE_STATUS', 
							EDIT_PATIENT='$EDIT_PATIENT',
							UPLOAD='$UPLOAD',
							DEL_UPLOAD='$DEL_UPLOAD',
							UPDATE_CODE='$UPDATE_CODE',
							CREATE_ORDER='$CREATE_ORDER',
							RESET_USER_PASSWORD = '$RESET_USER_PASSWORD'
							WHERE
							USER_ID='$id' ";
			mysqli_query($dbconnect, $update);

		}
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=staff_right.php\">";
	}

?>