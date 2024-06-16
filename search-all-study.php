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
include ("function.php");
set_time_limit(0);

$searchbox = $_POST['searchbox'];
$searchdate = $_POST['searchdate'];
$datestart = $_POST['date001'];
$dateend = $_POST['date002'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchhn = $_POST['searchhn'];
$searchxn = $_POST['searchxn'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];
$department = $_POST['department'];
$mod1 = $_POST['Mod_option1'];
$mod2 = $_POST['Mod_option2'];
$mod3 = $_POST['Mod_option3'];
$mod4 = $_POST['Mod_option4'];
$mod5 = $_POST['Mod_option5'];
$mod6 = $_POST['Mod_option6'];
$mod7 = $_POST['Mod_option7'];
$mod8 = $_POST['Mod_option8'];
$status_start = $_POST['status_start'];
$status_end = $_POST['status_end'];
$status_qc = $_POST['status_qc'];
$PAGE = $_POST['PAGE'];

$ARRIVAL1 = date("Y-m-d")." 00:00:00";
$ARRIVAL2 = date("Y-m-d")." 23:59:59";
//echo $ARRIVAL1.$ARRIVAL2;
//exit;

if ($datestart =="")
	{
		//$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-360,date("Y"))); // Yesterday
		$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-3,date("Y")));  //3 day back
		//$datestart = date("Y-m-d"); // today
	}

if ($dateend =='')
	{
		$dateend = date("Y-m-d");
	}
	

?>

<!DOCTYPE html>
<html>
<head>
<title>Search Study</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
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

<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="4:39"
if (document.images)
	{ 
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}
function beginrefresh()
	{
		if (!document.images)
			return
		if (parselimit==1)
			window.location.reload()
		else
			{
				parselimit-=1
				curmin=Math.floor(parselimit/60)
				cursec=parselimit%60
				if (curmin!=0)
					curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
				else
					curtime=cursec+" seconds left until page refresh!"
					window.status=curtime
					//setTimeout("beginrefresh()",1000)
					setTimeout("beginrefresh()",500)
			}
	}

window.onload=beginrefresh
//-->
</script>
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>
	<!-- Add jQuery library -->
	<script type="text/javascript" src="./lib/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="./source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css" media="screen" />
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$(".fancybox").fancybox({
				afterClose : function() {
					location.reload();
					return;
				}
			});
			

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>

<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
			
<?php

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-A".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-B".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}
			?>	
			
			
		});
</script>
</head>
<body bgcolor="gray">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Search Study</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<center>
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
		<td>Date From</td><td><INPUT TYPE="text" NAME="date001" id="date001" VALUE="" SIZE=10></td>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 

<script type="text/javascript">  
$(function(){  
    var dateBefore=null;
    $("#date001").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'icons/calendar-select.png',  
        buttonImageOnly: true,  
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'Sa'],   
        monthNamesShort: ['January','February','March','April','May','June','July','August','September','October','November','December'],  
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  

            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#date002").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'icons/calendar-select.png',  
        buttonImageOnly: true,  
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'Sa'],   
        monthNamesShort: ['January','February','March','April','May','June','July','August','September','October','November','December'],  
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  
            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>

		<td>Date To</td><td> <INPUT TYPE="text" NAME="date002" id="date002" VALUE="" SIZE=10></td>
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
</table></center>
<br />

<?php
//$sql = "SELECT xray_patient_info.MRN, xray_request.REQUEST_NO, xray_request_detail.ACCESSION, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.HN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)WHERE xray_request_detail.XRAY_CODE = 'C0106'";

		if (($searchbox =='1') AND ($searchhn =='') AND ($searchxn =='') AND ($searchname =='') AND ($searchlast =='') AND ($mod1 =='') AND ($mod2 =='') AND ($mod3 =='') AND ($mod4 =='') AND ($mod5 =='') AND ($mod6 =='') AND ($mod7 =='') AND ($mod8 =='') AND ($department =='') AND ($datestart =='') AND  ($dateend ==''))
		//if (($searchbox =='1') AND ($searchhn =='') AND ($searchxn =='') AND ($searchname =='') AND ($searchlast =='') AND ($mod1 =='') AND ($mod2 =='') AND ($mod3 =='') AND ($mod4 =='') AND ($mod5 =='') AND ($mod6 =='') AND ($mod7 =='') AND ($mod8 =='') AND ($datestart =='') AND  ($dateend ==''))
		{
				echo "Please search some keyword before click search";
				exit;
			}
		
		if (($mod1 == '') AND ($mod2  =='') AND ($mod3  =='') AND ($mod4  =='') AND ($mod5  =='') AND ($mod6  =='') AND ($mod7  =='') AND ($mod8 ==''))
			{
					$mod1 = 'CT';
					$mod2 = 'MRI';
					$mod3 = 'XRAY';
					$mod4 = 'MAMMO';
					$mod5 = 'US';
					$mod6 = 'ANGIO';
					$mod7 = 'BMD';
			}	
//echo "date";		
//echo $datestart;
//echo $dateend;
//echo $mod1.$mod2.$mod3.$mod4.$mod5.$mod6.$mod7.$mod8;
//echo "<br />";
//echo $searchhn;
/*
echo $searchbox;
echo $searchdate;
echo $datestart;
echo $dateend;
echo $searchtoday;
echo $todaytype;
echo $searchhn;
echo $searchxn;
echo $searchname;
echo $searchlast;
echo $mod1;
echo $mod2;
echo $mod3;
echo $mod4;
echo $mod5;
echo $mod6;
echo $mod7;
echo $mod8;
echo $department;
echo $status_start;
echo $status_end;
echo $status_qc;
*/

//if (($searchdate =='') AND ($searchdate =='') AND ($datestart =='') AND ($dateend =='') AND ($)
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
			(xray_request_detail.STATUS != 'CANCEL')
			AND ((xray_request_detail.REQUEST_DATE between '$datestart' AND '$dateend') OR (xray_request_detail.ARRIVAL_TIME between '$ARRIVAL1' AND '$ARRIVAL2'))
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchhn%'	AND xray_patient_info.XN like '%$searchxn%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (
			xray_code.XRAY_TYPE_CODE = '$mod1'	OR
			xray_code.XRAY_TYPE_CODE = '$mod2'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod3'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod4'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod5'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod6'	OR 
			xray_code.XRAY_TYPE_CODE = '$mod7' 	AND
			xray_code.DESCRIPTION like '%$mod8%'
			)
			AND xray_department.NAME_THAI like '%$department%'
			ORDER BY URGENT desc, ORDERTIME ASC 
			LIMIT 0 , 999";

$result = mysqli_query($dbconnect, $sql);

echo "<table border='0' cellspacing='0' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>ICON</font></th>
<th><font color=#000000>MRN (HN)</font></th>
<th><font color=#000000>ACC</font></th>
<th><font color=#000000>Patient</font></th>
<th><font color=#000000>Sex</font></th>
<th><font color=#000000>Mod</font></th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician</font></th>
<th><font color=#000000>Order Time</font></th>
<th>Status</th>
</tr>\n";
$bg ="#FFCCCC";
$count = 0;
while($row = mysqli_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ ///Change colour
				$bg = "#C8C8C8";
			} 
		else
			{
				$bg = "#FFFFFF";
			}
		$count = $count+1;
		echo "<tr bgcolor=$bg onMouseOver=this.bgColor='gold'; onMouseOut=this.bgColor='".$bg."';>";
		echo "<td>";
		$URGENT = $row['URGENT'];
		if ($URGENT == 1) 
			{
				$ALERT = "<img src=./icon/urgent.jpg> <img src=icons/notebook--exclamation.png>";
			}
		if ($URGENT == 0 ) 
			{
				$ALERT = "";
			}
		echo $ALERT;
		echo "</td>";
		echo "<td>" .$row['MRN'] . "</td>";
		echo "<td><a id='variousL-A".$count."' href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."&XRAYCODE=".$row['XRAY_CODE']."&PAGE=examroom><img border=0 src=./icon-info.png></a>".$row['ACCESSION']."</td>";
		echo "<td><a id='variousL-B".$count."' href='patient-info.php?MRN=".$row['MRN']."&PAGE=examroom'>";
		if ($row['SEX'] == 'M')
			{
				echo "<img border=0 src=./icons/user-green.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
			}
		if ($row['SEX'] == 'F')
			{
				echo "<img border=0 src=./icons/user-female.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
			}
		if ($row['SEX'] == 'U')
			{
				echo "<img border=0 src=./icons/users.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
			}
		
		$birthday = $row['BIRTH_DATE'];
		echo "<font color=gray size=-2>".AgeCal($birthday)."$birthday</font>";
		echo "</td>\n";
		echo "<td>".$row['SEX']."</td>";
		echo "<td>".$row['XRAY_TYPE_CODE']."</td>\n";
		echo "<td>".$row['DESCRIPTION']."<br />".$row['XDNOTE']."</td>";
		echo "<td>".$row['NAME']." ".$row['LASTNAME']."<br /><font color=green><img src=arrow.gif>".$row['DEP'];
		echo "</font><td>".EngEachDate($row['REQ_DATE'])." ".$row['REQ_TIME']."</td>\n";
		$status = $row['STATUS'];
		$ORDERID = $row['ORDERID'];
		echo "<td>".$row['STATUS']."</td></tr>";

 }
echo "<tr><th colspan=8 align=right>";
echo "Total =".$count;
echo "</th></tr></table>\n";
?>
<script language=javascript>
document.searchpatient.searchhn.focus();
</script>
</body>
</html>