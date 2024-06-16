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
//include ("connectdb.php");
include ("function.php");
$MRN = $_GET['MRN'];
$ACCESSION = $_GET['ACCESSION'];

echo "<body bgcolor=#E8E8E8>";	
echo "<center><font color=#6600CC><b><u>Upload File</u></b></font></center>";
echo "<p></p>";
//echo "<br>MRN =".$MRN;

$sql = "select MRN, NAME, LASTNAME, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysqli_query($dbconnect $sql);
$row = mysql_fetch_array($result);

echo "<center><table bgcolor=#F5F5F5 width=500><tr><td valign=top width=110><img src=image/upload.jpg></td><td valign=top width=490>";
echo "<center><u>Patient Info</u></center>NAME : ".$row['NAME']." ".$row['LASTNAME']." AGE :<br>";
echo "HN : ".$MRN."<br>ACCESSION : ".$ACCESSION;
echo "</td></tr></table></center><p></p>";

?>
<center><font color=#6600CC>Select Upload Type</font></center>

<center>
<table width=500 bgcolor=#F5F5F5>
<tr>
<td width=120 bgcolor=white>Pataient Data<br>HN : <?php echo $MRN ?></td>
<td>
<ul><li><a href="upload/uploadpdf.php?MRN=<?php echo $MRN  ?>">Upload Document (PDF)</a>
<li><a href="upload/uploadpdf.php">Upload Image</a></ul>
</td>
</tr>
</table>
</center>
<p>
<p>

<center>
<table width=500 bgcolor=#F5F5F5>
<tr>
<td width=120 bgcolor=white>Exam Data<br><?php echo $ACCESSION ?></td>
<td>
<ul>
<li>Request From</li>
<ul>
<li><a href="upload/uploadpdf.php?id=<?php echo $MRN;?>&ACCESSION=<?php echo $ACCESSION; ?>">Request Form  (PDF)</a></li>
</ul>
</ul>
<ul>
<li>Image</li>
<ul>
<li><a href="upload/uploadzip.php?id=999">ZIP (DICOM Zip)</a></li>
<li><a href="upload/uploaddicom.php?id=999">DICOM (.DCM)</a></li>
<li><a href='upload/index.php?id=999'>JPEG, GIF</a></li>
</ul>
</ul>
</td>
</tr>
</table>
</center>

