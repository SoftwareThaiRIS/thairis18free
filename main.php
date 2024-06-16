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
header("Content-type: text/html;  charset=utf-8");
?>
<!DOCTYPE html>
<html>

<head>
<title>Main</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  

</head>



<body bgcolor="#d4d4d4">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Main</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>


<table width="80%" border="0" cellspacing="0" cellpadding="0" height="311" bgcolor="#d4d4d4" align=center>

  <tr> 

    <td rowspan="2" valign="top" width="60%"> 

      <div> 

        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">

          <tr >

            <td  valign="top" height="442"> 


               <table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td><img src="icon/news.gif" height=50></td></tr>
					
                  <tr bgcolor="#79acf3">   <td width="100%"><font face="MS Sans Serif"><b><font color="#000066"><?php  echo $_NEWS_HEADER; ?></font></b></font></td>  </tr>
            

<tr bgcolor=#EBEBEB><td>

<?php 

 $sql = "select NEWS from xray_news WHERE CENTER_CODE='$center_code'";
 $result = mysqli_query($dbconnect, $sql);
 $row = mysqli_fetch_array($result);
 echo $row['NEWS'];

?>

   </td></tr>
       </table>

            </td>

          </tr>

        </table>

      </div>

      </td>

    <td width="40%" height="191" valign="top"> 

      <font face="MS Sans Serif"><b><img src="icon/stat.gif" width="70" height=50></b></font>

      

      <table width="100%" border="0" cellspacing="2" cellpadding="0">

        <tr> <td  colspan=2 widht=100% bgcolor=#79acf3 ><font face="MS Sans Serif"><b><?php  echo $_TODAY_STATUS; ?></b></font></td></tr>
		<tr>
		
		  <td width="71%" bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php  echo "Studies Today"; ?></font></td>
          <td width="29%" bgcolor="#EBEBEB"><font face="MS Sans Serif">
<?php 

$sql = "SELECT xray_request.CENTER_CODE, 
xray_request_detail.ID 
FROM xray_request_detail 
LEFT JOIN xray_request
ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
WHERE xray_request_detail.REQUEST_DATE = DATE(NOW()) 
AND xray_request.CENTER_CODE ='$center_code'";

$result = mysqli_query($dbconnect, $sql);
$num_rows = @mysqli_num_rows($result);
echo $num_rows;
?>
		  <?php echo "Studies"; ?></font></td>

        </tr>		  
	<tr>	  
		  <td width="71%" bgcolor="#D7D7D7"><font face="MS Sans Serif"><?php  echo "New Order"; ?></font></td>
          <td width="29%" bgcolor="#D7D7D7"><font face="MS Sans Serif">
<?php 
$sql = "SELECT xray_request.CENTER_CODE,xray_request_detail.ID
FROM xray_request_detail
LEFT JOIN xray_request 
ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
WHERE xray_request_detail.STATUS ='NEW' 
AND xray_request_detail.REQUEST_DATE = DATE(NOW())
AND xray_request.CENTER_CODE ='$center_code'";

$result = mysqli_query($dbconnect, $sql); 
$num_rows = @mysqli_num_rows($result);
echo "<a href=order.php>".$num_rows."</a> Studies</font></td>";
?>	  
		  
		  
	  

	</tr>
        <tr> 

          <td width="71%" bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php  echo "Waiting"; ?></font></td>
          <td width="29%" bgcolor="#EBEBEB"><font face="MS Sans Serif">
<?php 
$sql = "SELECT xray_request.CENTER_CODE,xray_request_detail.ID
FROM xray_request_detail
LEFT JOIN xray_request 
ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
WHERE xray_request_detail.STATUS ='READY' 
AND xray_request_detail.REQUEST_DATE = DATE(NOW())
AND xray_request.CENTER_CODE ='$center_code'";

	$result = mysqli_query($dbconnect, $sql);// And Complate Date =  
	$num_rows = @mysqli_num_rows($result);
	//echo "<a href=waiting.php>".$num_rows."</a>";
	echo $num_rows;
?>

<?php echo "Studies"; ?></font></td>

        </tr>
        <tr> 
          <td width="71%" bgcolor="#D7D7D7"><font face="MS Sans Serif"><?php  echo "Schedule"; ?></font></td>
          <td width="29%" bgcolor="#D7D7D7"><font face="MS Sans Serif">0 <?php echo "Studies"; ?></font></td>
        </tr>
        <tr> 
          <td width="71%" bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php echo "Waiting Report"; ?></font></td>
          <td width="29%" bgcolor="#EBEBEB"><font face="MS Sans Serif">

<?php 

$sql = "SELECT DISTINCT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.SEX, 			
			xray_patient_info.BIRTH_DATE, 					
			xray_request.REQUEST_NO, 					
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE,
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,	
			xray_request_detail.NOTE AS XDNOTE,
			xray_code.XRAY_TYPE_CODE,
			xray_department.NAME_THAI AS DEP,			
			xray_code.DESCRIPTION, 
			xray_referrer.NAME, 
			xray_referrer.LASTNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
			LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'EXAM ROOM') 
			AND ((xray_request_detail.STATUS  != 'CANCEL') 	AND	((xray_request_detail.STATUS  = '$status_start') OR (xray_request_detail.STATUS  = DATE(NOW()) OR (xray_request_detail.STATUS  = DATE(NOW())))
			ORDER BY URGENT desc, ORDERTIME ASC 
			LIMIT 0 , 999";
			

$sql2 = "SELECT xray_request.CENTER_CODE,xray_request_detail.ID
FROM xray_request_detail
LEFT JOIN xray_request 
ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
WHERE xray_request_detail.STATUS ='TOREPORT' 
AND xray_request_detail.REQUEST_DATE = DATE(NOW())
AND xray_request.CENTER_CODE ='$center_code'";
		$result = mysqli_query($dbconnect, $sql2);
		$num_rows = @mysqli_num_rows($result);
		echo $num_rows;
?>
		 <?php echo "Studies"; ?></font></td>

        </tr>

        <tr> 
          <td width="71%" bgcolor="#D7D7D7"><font face="MS Sans Serif"><?php echo "Approved Report"; ?></font></td>
          <td width="29%" bgcolor="#D7D7D7"><font face="MS Sans Serif">
<?php 
$sql = "SELECT xray_request.CENTER_CODE,xray_request_detail.ID
FROM xray_request_detail
LEFT JOIN xray_request 
ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
WHERE xray_request_detail.STATUS ='APPROVED' 
AND xray_request_detail.REQUEST_DATE = DATE(NOW())
AND xray_request.CENTER_CODE ='$center_code'";

$result = mysqli_query($dbconnect, $sql);  
$num_rows = @mysqli_num_rows($result);
echo "<a href=reported.php>".$num_rows."</a>";
?>
	<?php echo "Studies"; ?></font></td>

        </tr>

        <tr> 
          <td width="71%"  bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php echo "Cancel"; ?></font></td>
          <td width="29%"  bgcolor="#EBEBEB"><font face="MS Sans Serif">
<?php 
$sql = "SELECT xray_request.CENTER_CODE,xray_request_detail.ID
FROM xray_request_detail
LEFT JOIN xray_request 
ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
WHERE xray_request_detail.STATUS ='CANCEL' 
AND xray_request_detail.REQUEST_DATE = DATE(NOW())
AND xray_request.CENTER_CODE ='$center_code'";
$result = mysqli_query($dbconnect, $sql);
$num_rows = @mysqli_num_rows($result);
echo $num_rows;
?>
		  <?php echo "Studies"; ?></font></td>

        </tr>

      </table>


    </td>

  </tr>

  <tr> 

    <td width="61%" valign="top"> 
<p></p>
<center>	   
<img src="main-graph.php?_jpg_csimd=1" ismap="ismap" usemap="#__mapname37500__" height="300" alt="" />
</center>
 
    </td>
  </tr>

</table>
<!--
<table width=100% cellspacing=2 border=0>
<tr width=100%><td colspan=4> Status Summary </td></tr>
<tr><td width=25%>Today Study <br><font size=+5>10</font></td><td width=25%>Today Study <br><font size=+5>10</td><td width=25%>Today Study <br><font size=+5>10</td><td width=25%>Today Study <br><font size=+5>10</td></tr>
</table>
-->

</body>
</html>

