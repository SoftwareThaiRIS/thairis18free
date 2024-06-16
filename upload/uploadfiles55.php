<?php
// session_start ();
$id=$_GET['id'];	
mkdir($id);

//if ($id=='')
//{
//	$id ="temp";
//	mkdir("$id");
//}

  $uploaddir = dirname ( $_SERVER['SCRIPT_FILENAME'] ) ."/".$id."/";

 if ( count ( $_FILES ) > 0 )
 {
  $arrfile = pos($_FILES);
  $uploadfile = $uploaddir . basename ( $arrfile['name'] );
  $_SESSION['filelist'][] = $arrfile['name'];
  if ( move_uploaded_file ( $arrfile['tmp_name'], $uploadfile ) )
   echo "UploadComplete();";

  
 }
 ?>