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
if(is_array($_FILES)) 
	{
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) 
			{
				$sourcePath = $_FILES['userImage']['tmp_name'];
				//$targetPath = "images/user/".$_FILES['userImage']['name'];

				$ext=end(explode(".", $_FILES['userImage']['name']));//gets extension
				$targetPath = "images/user/".$userid.".".$ext;
				move_uploaded_file($sourecPath,"/images/user/".$userid.".".$ext);
				

				if(move_uploaded_file($sourcePath,$targetPath)) 
						{
							echo "<img src=".$targetPath." width=\"100px\" height=\"100px\" />";
						}
			}
	}
?>
