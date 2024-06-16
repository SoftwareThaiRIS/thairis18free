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
$result = mysqli_query($dbconnect, "SELECT CODE, NAME, NAME_ENG, REPORTLOGO FROM xray_center");
?>
<html>
<head>
<title>CENTER</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
<script src="bootstrap/js/bootstrap.min.js" ></script>

<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</head>
<body class="p-0 mb-0 bg-secondary text-white" topmargin=0 leftmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Center</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<?php
if ($superadmin == 0)
	{
		echo "<body bgcolor=#E8E8E8 topmargin=0 leftmargin=0>";
		$topbar = "Staff Right";
		include "topbar.php";
		echo "<br /><br /><br /> <center>Only Super Admin can access, Your user right access \"System CENTER\"</center>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"7;URL=admin.php\">";
		exit;
	}
?>

<?php
echo "<table border='0' class=\"table table-dark table-striped\">
<tr bgcolor=#79acf3>
<th>CODE</th>
<th>Name</th>
<th>English</th>
<th>File</th>
<th>Logo</th>
</tr>\n";

while($row = mysqli_fetch_array($result))
  {
		if($bg == "#FFFFFF") 
			{ //
				$bg = "#FFCCCC";

			} else {

				$bg = "#FFFFFF";

					}
  echo "<tr bgcolor=$bg>";
  echo "<td>" . $row['CODE'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['NAME_ENG'] . "</td>";
  echo "<td>" .$row['REPORTLOGO']."</td>";
  echo "<td>";
  $logo = "image/".$row['REPORTLOGO'];
  if ((file_exists($logo)) and ($row['REPORTLOGO'] != '')) 
	{
		echo "<img src=$logo>";
	}

  echo "</td>";
  echo "</tr>\n";

  }
echo "</table>";

?>
<hr>

Add Center
<form id="form1" name="form1" method="post" action="center-add.php">
CODE <input type="text" name="code"/>
Name <input type="text" name="name"/>
English <input type="text" name="name_eng"/>
<input type="reset" /><input type="submit" />
</form>
</body>
</html>