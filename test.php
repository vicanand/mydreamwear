<?php
error_reporting(0);
session_start();

$userid = $_SESSION["userid"];

$allfile = "";



if(isset($_FILES['files'])){
	$errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $_FILES['files']['name'][$key];
		$extnsn = explode(".", $file_name);
		$file_name = md5($file_name.time()).".".$extnsn[1];
		$allfile .= $file_name.",";
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
		
		$desired_dir="images/items";
		
		if(is_dir($desired_dir)==false){
            mkdir("$desired_dir", 0755);		// Create directory if it does not exist
        }
        if(is_dir("$desired_dir/".$file_name)==false){
        	move_uploaded_file($file_tmp,"images/items/".$file_name);
        }else{									//rename the file if another one exist
        	$new_dir="images/items/".$file_name;
        	rename($file_tmp,$new_dir) ;				
        }
    }
    echo rtrim($allfile, ",");
}


?>