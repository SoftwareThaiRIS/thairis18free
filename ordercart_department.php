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
header("Content-type: text/html;  charset=utf-8");
$DEPARTMENT = isset($_GET['DEPARTMENT']) ? $_GET['DEPARTMENT'] : null;
$DEPARTMENT_ID = isset($_GET['DEPARTMENT_ID']) ? $_GET['DEPARTMENT_ID'] : null;
$REFERRER = isset($_GET['REFERRER']) ? $_GET['REFERRER'] : null;
$TYPE = isset($_GET['TYPE']) ? $_GET['TYPE'] : null;
if ($REFERRER =='')
		{
			echo "Please select Physician first";
			exit;
		}

include ("session.php");
if ($TYPE=="SEARCH")
	{
		$result = mysqli_query($dbconnect, "SELECT * FROM `xray_department` WHERE NAME_THAI LIKE '%$DEPARTMENT%' AND CENTER='$usercenter'");
		echo "<table border='0' width=100%>
				<tr bgcolor=#79acf3>
				<th >Department ID</th>
				<th >Department Name</th>
				<th ></th>
				</tr>\n";
		while($row = mysqli_fetch_array($result))
			{
				if($bg == "#FFFFFF") 
					{ 
						$bg = "#EBEBEB";
					} 
				else 
					{
						$bg = "#FFFFFF";
					}
				echo "<tr bgcolor=$bg>";
				echo "<td>" . $row['DEPARTMENT_ID'] . "</td>";
				echo "<td>" . $row['NAME_ENG'] . "</td>";
				echo "<td><input type=\"submit\" value=\"Select\" onclick=selected_department('".$row['DEPARTMENT_ID']."')></td>";
				echo "</tr>\n";
			}
		echo "</table>";
	} 

if ($TYPE=="SELECTED")
	{
		$sql = "SELECT NAME_THAI, TYPE FROM xray_department WHERE DEPARTMENT_ID ='$DEPARTMENT' AND CENTER='$usercenter'";
		$result = mysqli_query($dbconnect, $sql);
		while($row = mysqli_fetch_array($result))
			{
				$name = $row['NAME_THAI'];
				$department_type =$row['TYPE'];
			}
		echo "<img src='./image/".$department_type.".gif' OnLoad=\"ReplaceContentInContainer('show','Physician Selected <br> Deparment Selected <br> <font color=red>Please Select Order</font>')\">";
		echo " ".$name;
		echo "<input type=\"hidden\" name=\"department_selected\" id=\"department_selected\" value=\"".$DEPARTMENT."\"></form>";
	}

?>