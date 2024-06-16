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
?>

<!DOCTYPE html>
<html>

<head>

<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   

<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
	<style type="text/css">  
/* Overide css code width-high of calendar*/  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 
</head>
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<?php
echo "<body bgcolor=#E8E8E8 >";
$topbar = "Search";
include "topbar.php";
?>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2><img src=./images/magnifier.png>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><center><img src="./images/icoRegister.png"></center><br /><center>Patient</center></font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="search-all2.php" accept-charset="UTF-8">
			<font face="MS Sans Serif">
			<table>
			<tr>
			<td>MRN </td><td> <input type="text" name="mrn" value=""></td>
			<td>Accession</td><td>  <input type="text" name="accession" value=""></td>
			</tr>
			<tr>
			<td>Name </td><td> <input type="text" name="fname" value=""></td>
			<td>Lastname </td><td> <input type="text" name="lname" value=""></td>
			</tr>
			</table>
            <input type="submit" name="Submit" value="Search">
            
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>

<br />
<br />
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2><img src=./images/magnifier.png>Search Study</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><center><img src="./images/icoSearch.png"></center><br /><center>Study</center></font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchstudy" method="post" action="search-all-study.php" accept-charset="UTF-8">
          <p>
		  <font face="MS Sans Serif">

		<table>
		<tr>
		<SCRIPT LANGUAGE="JavaScript" ID="js18">
var cal18 = new CalendarPopup("testdiv1");
cal18.setCssPrefix("TEST");
</SCRIPT>
		<td>Date From</td><td><INPUT TYPE="date" NAME="date001" id="date001" VALUE="" SIZE=10></td>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 


		<td>Date To</td><td> <INPUT TYPE="date" NAME="date002" id="date002" VALUE="" SIZE=10></td>
		</tr>
		<tr>
		<td>Procedure </td><td>  <input type="text" name="Procedure" value=""></td>
        <td>Physician </td><td> <input type="text" name="Physician" value=""></td>
		</tr>
		<tr>
        <td>Department </td><td> <input type="text" name="department" value=""></td>
		<td></td><td> </td>
		</tr>
		
		</font>
		  </p>

		<table>
				<tr>
					<td><input type="checkbox" name=Mod_option1 value="CT" /><label for="demo_box_1" name="demo_lbl_1" class="css-label"> CT</label></td>
					<td><input type="checkbox" name=Mod_option2 value="MRI" /><label for="demo_box_1" name="demo_lbl_2" class="css-label"> MR</label></td>
					<td><input type="checkbox" name=Mod_option3 value="XRAY" /><label for="demo_box_1" name="demo_lbl_3" class="css-label"> CR/DR</label></td>
					<td><input type="checkbox" name=Mod_option4 value="MAMMO" /><label for="demo_box_1" name="demo_lbl_4" class="css-label"> MG</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" name=Mod_option5 value="US" /><label for="demo_box_1" name="demo_lbl_5" class="css-label"> US</label></td>
					<td><input type="checkbox" name=Mod_option6 value="ANGIO" /><label for="demo_box_1" name="demo_lbl_6" class="css-label"> FLU/IVP</label></td>
					<td><input type="checkbox" name=Mod_option7 value="BMD" /><label for="demo_box_1" name="demo_lbl_7" class="css-label"> BMD</label></td>
					<td><input type="checkbox" name=Mod_option8 value="PORTABLE" /><label for="demo_box_1" name="demo_lbl_8" class="css-label"> OT</label></td>
				</tr>
				</table>	
			
			
            <input type="submit" name="Submit" value="Search">
          </p>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
<script language=javascript>
document.searchpatient.mrn.focus();
</script>
</body>

</html>

