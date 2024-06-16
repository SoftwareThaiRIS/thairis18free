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
$result = mysqli_query($dbconnect, "SELECT CENTER, DEPARTMENT_ID,NAME_THAI,NAME_ENG FROM xray_department");

?>
<html>
<head>
<title>View Department</title>

</head>
<body id=main_body>
<script type="text/javascript" src="form/view.js"></script>
<?php
echo "<table border='1'><tr><td>Center</td><td>Departmnet ID</td><td>NAME</td><td>English Name</td></tr>\n";
$bg = '#FFCCCC';
while($row = mysqli_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ // Switch colour for background
				$bg = "#FFCCCC";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		echo "<tr bgcolor=$bg>";
		echo "<td>" .$row['CENTER']."</td>";
		echo "<td>" . $row['DEPARTMENT_ID'] . "</td>";
		echo "<td>" . $row['NAME_THAI'] . "</td>";
		echo "<td>" . $row['NAME_ENG'] . "</td>";
		echo "</tr>\n";
	}
echo "</table>";
?>
</body>
</html>