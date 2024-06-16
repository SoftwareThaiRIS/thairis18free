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
include "connectdb.php";

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add New Referrer</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Add Department";
include "topbar.php";
?>
<form id="form1" name="form1" method="post" action="department_insert.php">
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Add New Department</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle"> New Department</font></td>
	
    <td width="587" bgcolor="#f8d290">




<?php
			$sql2 ="select * FROM xray_center order by NAME";
			$result2 = mysqli_query($dbconnect, $sql2);
			echo "<div id='".$row['ORDERID']."'>\n";
			echo "Center Code: <select name=center_code id=select_center".$row['ORDERID'].">";
			echo "<option value=''>Select Center</option>\n";
			while ($row =mysqli_fetch_array($result2))
				{
					echo "<option name=center_code value=".$row['CODE'];
					if ($row['CODE'] == $center_code)
						{ 
							echo " selected=selected "; 
						}   
					echo " >".$row['CODE']." - ".$row['NAME']."</option>\n";
					echo $row['CODE']."VS".$center_code."<br>";
				}
				
				echo "<select></div>";

?>


<br />
   
  <p>CODE
    <label>
      <input type="text" name="code" id="code" /> 
    </label>
  </p>

  <p>Department Name 
    <label>
      <input type="text" name="name" id="name" />
</p>
<p>
Department short name 

      <input type="text" name="shortname" id="lastname" />
    </label>
</p>
  <p>
    <label>
      <input type="reset" name="clear" id="clear" value="Reset" />
    </label>
    <label>
      <input type="submit" name="button" id="button" value="Submit" />
    </label>
  </p>
<input type="radio" name="type" id="dtype" value="O" /></label>OPD <label>
<input type="radio" name="type" id="dtype" value="I" /></label>IPD <label>
  <p>&nbsp;</p>
  
  </form>
  
  </td></tr><table>
  
  
  </body></html>