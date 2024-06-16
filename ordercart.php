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
include ("session.php");
include ("connectdb.php");
$sessionID = session_id();
$addcode = isset($_GET['XRAY_CODE']) ? $_GET['XRAY_CODE'] : null;
$hn = isset($_GET['HN']) ? $_GET['HN'] : null;
$addorder = isset($_GET['ADDORDER']) ? $_GET['ADDORDER'] : null;
$REFERRER = isset($_GET['REFERRER']) ? $_GET['REFERRER'] : null;
$DEPARTMENT = isset($_GET['DEPARTMENT']) ? $_GET['DEPARTMENT'] : null;
$type = isset($_GET['TYPE']) ? $_GET['TYPE'] : null;
$today = date("Y-m-d");
$code = isset($_GET['CODE']) ? $_GET['CODE'] : null;
//Delete an exam in cart
if ($type =='DEL')
	{
		echo $addcode;
		$sql= "delete FROM xray_order_cart where XRAY_CODE='$code'";
		mysqli_query($dbconnect, $sql);
	}
//Delete all in cart
if ($type == 'DELALL') 
	{
		//$sqldel = "delete FROM xray_order_cart where MRN='$hn'";
		$sqldel = "delete FROM xray_order_cart where SESSION_ID='$sessionID'";
		//$delresult = mysql_query($sqldel);
		mysqli_query($dbconnect, $sqldel);
	}
//Insert to request table 
if ($type == 'INSERTNEW') 
	{
		$sql_last_no = "select LAST_REQUEST_NO FROM xray_auto";
		$last_num = "";

		// Fucntion Budha Year
		$yearPHP = date("Y");
		$year = $yearPHP+543;
		$year = substr($year,-2);
		$findyear1 = "SELECT YEAR(CURRENT_DATE())"; //SELECT YEAR(NOW())
		$findyear = mysqli_query($dbconnect, $findyear1);
		while ($row = mysqli_fetch_array($findyear))
			{
				$yearMySQL = $row[0]; //[YEAR(CURRENT_DATE())]
				//echo $yearMySQL."<br />";
			}
		////////////////// CHECK Last AUTO Number ////////////////////////
		$sqlyear1 = "SELECT LAST_REQUEST_NO,YEAR FROM xray_auto";
		$sqlyear2 = mysqli_query($dbconnect, $sqlyear1);
		while ($row = mysqli_fetch_array($sqlyear2)) 
			{
				$last_no = $row['LAST_REQUEST_NO'];
				$sqlyear = $row['YEAR'];
				//echo "<br />SQLyear =".$sqlyear;
				//echo "<br />Last =".$last_no;
				echo "<br />";
			}
		/////////////////////////////////////////////////////////////////////////////////////
		//$yearPHP = $yearPHP+91;
		if ($yearPHP != $sqlyear)
			{
				$last_no = 0;
				echo "Year not same<br />";
				echo $yearPHP;
				mysqli_query($dbconnect, "UPDATE  xray_auto SET LAST_REQUEST_NO='$last_no'");
				mysqli_query($dbconnect, "UPDATE  xray_auto SET YEAR='$yearPHP'");
			}
		$last_no = $last_no+1;
		$request_no = "X".$year."-".$last_no;
		$result = mysqli_query($dbconnect, "select CODE FROM xray_user WHERE LOGIN ='$username'");
			while ($row = mysqli_fetch_array($result))
				{
					$usercode = $row['CODE']	;
				}
		mysqli_query($dbconnect, "Update xray_auto SET LAST_REQUEST_NO='$last_no'");
		//loop from cart
		$sql_from_cart = "select xray_code.XRAY_CODE, xray_code.DESCRIPTION, xray_code.CHARGE_TOTAL from xray_code, xray_order_cart WHERE xray_order_cart.xray_code=xray_code.XRAY_CODE and xray_order_cart.SESSION_ID='$sessionID' and xray_order_cart.MRN='$hn'";
		$result = mysqli_query($dbconnect, $sql_from_cart);
		$del= "delete FROM xray_order_cart where XRAY_CODE='$code'";
		$sqlinsertorder = "insert INTO xray_request (REQUEST_NO,MRN,REFERRER,REQUEST_DATE, REQUEST_TIMESTAMP, DEPARTMENT_ID, USER,CANCEL_STATUS,CENTER_CODE) VALUES  ('$request_no','$hn','$REFERRER',CURDATE(), NOW(),'$DEPARTMENT','$usercode','1','$center_code')";
		mysqli_query($dbconnect, $sqlinsertorder);
		$resultdate = mysqli_query($dbconnect, "select curdate()");
		$rowdate=mysqli_fetch_array($resultdate);
		$dbdate = $rowdate[0];
		//while($row=mysqli_fetch_array($result))  // multiple procedure not work on fetch array last one not insert to db
		while($row=mysqli_fetch_assoc($result))
			{	
				$code = $row['XRAY_CODE'];
				$description =$row['DESCRIPTION'];
				$ACCESSION = $request_no."-".$code;
				$resulttime = mysqli_query($dbconnect, "select curtime()");
				$rowtime=mysqli_fetch_array($resulttime);
				$dbtime = $rowtime[0];
				$sqlinsertorder_datail ="insert INTO xray_request_detail (REQUEST_NO,ACCESSION,XRAY_CODE,REQUEST_TIMESTAMP,REQUEST_TIME,REQUEST_DATE,STATUS,PAGE,LOCKBY)VALUES('$request_no','$ACCESSION','$code',NOW(),'$dbtime','$dbdate','NEW','ORDER LIST','')";
				/////////////INSERT LOG/////////////
				if ($CREATELOG_FILE==1)
					{
						$URL=$_SERVER["HTTP_REFERER"];
						mysqli_query($dbconnect, "insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','CREATEORDER','$URL','$hn','$ACCESSION')");
					}
				////////////////Create HL7///////////////ORM NEW
				if ($CREATEHL7==1)
					{
						$timestamp = date('YmdHis');
						$fh = fopen("./HL7/ORM/HL7-ORM-".$ACCESSION."-".$timestamp.".txt", "a");
						$sql1 = "select MRN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE, HEIGHT, WEIGHT, TELEPHONE, ADDRESS, ROAD, COUNTRY_CODE FROM xray_patient_info WHERE MRN='$hn'";
						$result1 = mysqli_query($dbconnect, $sql1);
						$row1 = mysqli_fetch_array($result1);
						$name =  $row1['NAME'];
						$lastname = $row1['LASTNAME'];
						$sex = $row1['SEX'];
						$dob = $row1['BIRTH_DATE'];
						$dob = str_replace('-', '', $dob); 
						//$dob = date('Ydm', strtotime($dob)); 
						$ptheight = $row1['HEIGHT'];
						$ptweight = $row1['WEIGHT'];
						$phone = $row1['TELEPHONE'];
						$address = $row1['ADDRESS'];
						$road = $row1['ROAD'];
						$countrycode = $row1['COUNTRY_CODE'];
						$sql2 = "select DEGREE, NAME, LASTNAME FROM xray_referrer WHERE REFERRER_ID = '$REFERRER'";
						$result2 = mysqli_query($dbconnect,$sql2);
						$row2 = mysqli_fetch_array($result2);
						$referrer_name =  $row2['NAME'];
						$referrer_lastname =  $row2['LASTNAME'];
						$referrer_prefix =  $row2['DEGREE'];
						$sql3 = "select  XRAY_CODE, DESCRIPTION, XRAY_TYPE_CODE FROM xray_code WHERE  XRAY_CODE = '$code'";
						$result3= mysqli_query($dbconnect, $sql3);
						$row3 = mysqli_fetch_array($result3);
						$xray_code =  $row3['XRAY_CODE'];
						$xray_name =  $row3['DESCRIPTION'];
						$xray_type =  $row3['XRAY_TYPE_CODE'];
						$modality_type =  $row3['XRAY_TYPE_CODE'];
						if ($xray_type == 'XRAY')
							{
								$modality_type = 'DX';
							}
						if ($xray_type == 'FLUORO')
							{
								$modality_type = 'RF';
							}
						if ($xray_type == 'MRI')
							{
								$modality_type = 'MR';
							}	
						if ($xray_type == 'DR')
							{
								$modality_type = 'DX';
							}
						if ($xray_type == 'MRI')
							{
								$modality_type = 'MR';
							}		
						if ($xray_type == 'CR')
							{
								$modality_type = 'DX';
							}	
						if ($xray_type == 'ANGIO')
							{
								$modality_type = 'XA';
							}	
						$sql4 = "select  TYPE FROM xray_department WHERE DEPARTMENT_ID = '$DEPARTMENT'";
						$result4= mysqli_query($dbconnect, $sql4);
						$row4 = mysqli_fetch_array($result4);
						$patientclass =  $row4['TYPE'];							
						$random = substr(number_format(time() * rand(),0,'',''),0,10);  //random time for SUID (DCM4CHE)
					}
				////////////////////////////////////////
				mysqli_query($dbconnect, $sqlinsertorder_datail);
				mysqli_query($dbconnect, "delete FROM xray_order_cart where XRAY_CODE='$code'and xray_order_cart.SESSION_ID='$sessionID'");
				mysqli_query($dbconnect, "UPDATE xray_request_detail SET STUDY_UID = '$ZDS1' WHERE ACCESSION ='$ACCESSION'");
			}

		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=order.php\">";
		echo "<font size=8>Created Order</font><br />";

	}
	
$sql = "select ID FROM xray_order_cart where XRAY_CODE ='$addcode' and MRN='$hn' and SESSION_ID='$sessionID'";
$del_old_cart  = "delete FROM xray_order_cart where DATE <> '$today'";
mysqli_query($dbconnect, $del_old_cart);
$result = mysqli_query($dbconnect, $sql);
//echo "HN=".$hn." CODE=".$addcode;
if (@mysqli_num_rows($result) == 1)
	{

	}
else
	{
		if ($addcode !='')
			{
				$sql = "insert INTO xray_order_cart (SESSION_ID,MRN,XRAY_CODE,DATE,REFERRER_ID) VALUES('$sessionID','$hn','$addcode','$today','')";
				mysqli_query($dbconnect, $sql);
			}
	}
$sql = "select  xray_code.XRAY_CODE, xray_code.DESCRIPTION, xray_code.CHARGE_TOTAL from xray_code, xray_order_cart WHERE xray_order_cart.xray_code=xray_code.XRAY_CODE and xray_order_cart.SESSION_ID='$sessionID' and xray_order_cart.MRN='$hn'";
$result = mysqli_query($dbconnect, $sql);
if (@mysqli_num_rows($result)==0) 
	{
		exit;
	}
echo "<table width=100%><tr bgcolor=#FFFF11><td>Code</td><td align=center>Detail</td><td>Cost</td><td align=center>Del</td></tr>";
$sum =0;
while($row=mysqli_fetch_array($result))
	{
		$code = $row['XRAY_CODE'];
		$des = $row['DESCRIPTION'];
		$cost = $row['CHARGE_TOTAL'];
		$sum += $row['CHARGE_TOTAL'];
		echo "<tr><td>".$code."</td><td><font size=-1>".$des."</font></td><td align=right>".$cost."</td><td><img src=image/delete.gif border=0 onclick=delanexam('".$hn."','".$code."','DEL')></td></tr>";
	}
echo "<tr><td></td><td align=right><font>Total : </font></td><td align=right>".$sum."</td><td align=center></td></tr>";
echo "</table>";
echo "<br \><center><input type=button value='Delete All' onclick=delallcart('".$hn."','DELALL')> <input type=button value=OK onclick=insertexam('".$hn."')></center></form>";
?>
