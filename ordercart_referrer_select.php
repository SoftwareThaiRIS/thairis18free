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
$REFERRER = isset($_GET['REFERRER']) ? $_GET['REFERRER'] : null;
$TYPE = isset($_GET['TYPE']) ? $_GET['TYPE'] : null;
$ID = isset($_GET['ID']) ? $_GET['ID'] : null;
include "session.php";
if ($TYPE=="SEARCH")
	{
		//echo "search";
		$sql = "SELECT * FROM `xray_referrer` WHERE NAME LIKE '%$REFERRER%' AND CENTER_CODE='$usercenter'";
		$result = mysqli_query($dbconnect, $sql);
		$total=mysqli_num_rows($result);
		$e_page = 10; // Items per page
		if(!isset($_GET['s_page']))
			{     
				$_GET['s_page']=0;     
			}
		else
			{     
				$chk_page=$_GET['s_page'];       
				$_GET['s_page']=$_GET['s_page']*$e_page;     
			}     
		$sql.=" LIMIT ".$_GET['s_page'].",$e_page";  
		$result=mysqli_query($dbconnect, $sql);  
		if(mysqli_num_rows($result)>=1)
			{     
				$plus_p=($chk_page*$e_page)+mysqli_num_rows($result);     
			}
		else
			{     
				$plus_p=($chk_page*$e_page);         
			}     
		$total_p=ceil($total/$e_page);     
		$before_p=($chk_page*$e_page)+1;  


		//echo $REFERRER."<br \><p>";
		echo "<table border='0' width=100%>
				<tr bgcolor=#79acf3>
				<th>Code</th>
				<th>Degree</th>
				<th>Name</th>
				<th>Lastname</th>
				<th>Select</th>
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
				echo "<td>" . $row['REFERRER_ID'] . "</td>";
				echo "<td>" . $row['DEGREE'] . "</td>";
				echo "<td>" . $row['NAME'] . "</td>";
				echo "<td>" . $row['LASTNAME'] . "</td>";
				echo "<td><input type=\"submit\" value=\"Select\" onclick=selected_referrer('".$row['REFERRER_ID']."')></td>";
				//echo "<td> <input name=\"id\" type=\"hidden\" id=\"id\" value=\"".$row['ID']."\"><input type=\"submit\" value=\"Submit\" /></td>";
				echo "</tr>\n";
			}
		echo "</table>";
		
echo "<div class=\"browse_page\">";  

if ($total > $e_page)
	{
		page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);     
	}

echo "</div>";
  
	} // end if TYPE=SEARCH

if ($TYPE=="SELECTED")
	{
		$sql = "SELECT NAME, LASTNAME, SEX FROM xray_referrer WHERE REFERRER_ID ='$ID' AND CENTER_CODE='$usercenter'";
		$result = mysqli_query($dbconnect, $sql);
		while($row = mysqli_fetch_array($result))
			{
				$name = $row['NAME'];
				$lastanme =$row['LASTNAME'];
				$sex = $row['SEX'];
			}
?>
		<img src='./image/man_icon.gif' OnLoad="ReplaceContentInContainer('show','Physician Selected <br> <font color=red>Please select Deparment</font>')">
<?php
		echo $name;
		echo "<input type=\"hidden\" name=\"referrer\" id=\"referrer\" value=\"".$ID."\">";
		}   // End Search

?>
</body>
</html>

