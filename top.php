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
<!DOCTYPE HTML>
<html>
<head>
<title>Thai RIS</title>


	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/home_style.css" rel="stylesheet" type="text/css" />    
	<script type="text/javascript" src='Scripts/jquery-1.4.4.js'></script>
    <script type="text/javascript" src="Scripts/jquery-ui-1.8.10.custom.min.js"></script>
    <script type="text/javascript" src="Scripts/PM.UIPage.Home.js"></script>     
	<script type="text/javascript" src="Scripts/PM.UIPage.js"></script> 
    <script type="text/javascript" src="Scripts/jquery.jclock.js"></script>  
	<script language=JavaScript src="frames_header_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script> 
	<script type="text/javascript">
    $(function($) {
       var options = {
            timeNotation: '12h',
            am_pm: true,
            fontFamily: 'Verdana',
            fontSize: '16px',
            foreground: 'black'
          }; 
       $('.jclock').jclock(options);
    });
    </script>     
	<script type="text/javascript">
	setInterval(
  function() {
    document.getElementById("searchinput").value = "";
  }, 60000);
    </script>
<style>
#search-text-input{
    border-top:thin solid  #e5e5e5;
    border-right:thin solid #e5e5e5;
    border-bottom:0;
    border-left:thin solid  #e5e5e5;
    box-shadow:0px 1px 1px 1px #e5e5e5;
    float:left;
    height:17px;
    margin:.8em 0 0 .5em; 
    outline:0;
    padding:.4em 0 .4em .6em; 
    width:100px; 
}
  
#button-holder{
    background-color:#f1f1f1;
    border-top:thin solid #e5e5e5;
    box-shadow:1px 1px 1px 1px #e5e5e5;
    cursor:pointer;
    float:left;
    height:27px;
    margin:11px 0 0 0;
    text-align:center;
    width:30px;
}
  
#button-holder img{
    margin:4px;
    width:20px; 
}
</style>
</head>

<body>
	<div id="header">

		
        <div id="main-menu">
            <ul id="navigation">
                <li class="home">

                </li>
                <li class="line">&nbsp;</li>
                <li class="register">
 
                </li>
                <li class="line">&nbsp;</li>                
                <li class="order">

                </li>
                <li class="line">&nbsp;</li>                
                <li class="operate">

                </li>  
                <li class="line">&nbsp;</li>                
                <li class="reporting">

                </li>
                <li class="line">&nbsp;</li>     
                <li class="search">

                </li>


                <li class="line">&nbsp;</li>     
                <li class="help">

                </li>
                <li class="line">&nbsp;</li>  
				<form action="search-all3.php" method="post" id="searchform" class="searchform" target=main>
				
				<table>
				<tr><td>
				


				</td></tr></table>
				</form>				
            </ul> 
            <div id="account-status">
<style>
<?php 
$filename = "images/user/".$userid.".jpg";

if (file_exists($filename)) 
	{
		$display=$filename;
	} 

$filename1 = "images/user/".$userid.".png";
if (file_exists($filename1)) 
	{
		$display=$filename1;
	} 

$filename2 = "images/user/".$userid.".gif";
if (file_exists($filename2)) 
	{
		$display=$filename2;
	} 
	
if ($display=='')
	{
		$display="tmp/display.png";
	}

?>
#account-status .photo-display2
	{
		background:#FFF url(<?php echo $display; ?>) no-repeat;
		background-size:82px 82px;
		height:82px;	
		width:82px;
		float:left;		
	}
</style>		
            	<div class="photo-display2">
	            	<div class="photo-frame">
					</div>
                </div>
            	<div class="Acc-Info">
				
                	<h2>Code : 
					<?php
					echo $usercode;
					?>
					
					</a></h2>
                    <h2>User :  
					<?php
					 echo "<a href=usercode.php target=main>".$username." ".$userlastname."</a>";
					?>

					</h3></h2>
                    <h2>Login since : 
					<?php
					echo $logintime;
					?>
					</h2><br/>
					<font size=1 color=yellow><b>ThaiRIS FreeVersion 1.8</b></font>					
                </div>
            	<div class="Acc-Status">
                <a href=logoff.php target=_top><img src="image/exit.png" width="32" height="32" border=0 /></a></div>                
          </div>       
        </div>
	</div>

</body>
</html>