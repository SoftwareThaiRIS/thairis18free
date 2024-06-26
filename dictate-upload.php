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
 $ID = $_GET[id];

//define a maxim size for the uploaded images in Kb
define ("MAX_SIZE","100"); 
//This function reads the extension of the file. It is used to determine if the file is an image by checking the extension. 
function getExtension($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

//This variable is used as a flag. The value is initialized with 0 (meaning no error found) and it will be changed to 1 if an errro occures. If the error occures the file will not be uploaded.
$errors=0;
//checks if the form has been submitted
if(isset($_POST['Submit'])) 
	{
		//reads the name of the file the user submitted for uploading
		$image=$_FILES['image']['name'];
		//if it is not empty
		if ($image) 
			{
				//get the original name of the file from the clients machine
				$filename = stripslashes($_FILES['image']['name']);
				//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				//if it is not a known extension, we will suppose it is an error and will not upload the file, otherwize we will do more tests
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
					{
						//print error message
						echo '<h1>Unknown extension!</h1>';
						$errors=1;
					}
				else
					{
						//get the size of the image in bytes
						//$_FILES['image']['tmp_name'] is the temporary filename of the file in which the uploaded file was stored on the server
						$size=filesize($_FILES['image']['tmp_name']);
						//compare the size with the maxim size we defined and print error if bigger
						if ($size > MAX_SIZE*1024)
							{
								echo '<h1>You have exceeded the size limit!</h1>';
								$errors=1;
							}
						//we will give an unique name, for example the time in unix time format
						$image_name=time().'.'.$extension;
						//the new name will be containing the full path where will be stored (images folder)
						$newname="uploads/".$image_name;
						//we verify if the image has been uploaded, and print error instead
						$copied = copy($_FILES['image']['tmp_name'], $newname);
						if (!$copied) 
							{
								echo '<h1>Copy unsuccessfull!</h1>';
								$errors=1;
							}
					}
			}
	}

//If no errors registred, print the success message
if(isset($_POST['Submit']) && !$errors) 
{
	echo "<h1>File Uploaded Successfully! Try again!</h1>";
}

?>
