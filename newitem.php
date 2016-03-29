<?php
session_start();

include "helpers.php";
$baseurl = get_base_url();

if(isset($_SESSION["userid"])){
	if($_POST["update"] == "true"){
		$ch = curl_init();
		$request->userid=$userid;
		$request->itemid=$itemcode;
		$data = json_encode($_POST);
		curl_setopt($ch, CURLOPT_URL, $baseurl."/updateitem");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		if ($server_output) {
			echo json_decode($server_output)->data;
		}else{
			"some error has occured. Try Again.";
		}
	}else{
		$ch = curl_init();
		$request->userid=$userid;
		$request->itemid=$itemcode;
		$data = json_encode($_POST);
		curl_setopt($ch, CURLOPT_URL, $baseurl."/additem");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		if ($server_output) {
			echo json_decode($server_output)->data;
		}else{
			"some error has occured. Try Again.";
		}
	}
}else{
	echo "Unauthorised Access please signin!";
}
?>