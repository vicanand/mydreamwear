<?php
session_start();
include "helpers.php";
$baseurl = get_base_url();

if ($_POST["action"] == "emailverify") {
	$data = json_encode($_POST);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $baseurl."/forgotpassword");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	echo json_decode($server_output, true)["data"];
}else{

	$data = json_encode($_POST);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $baseurl."/resetpassword");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	echo json_decode($server_output, true)["data"];
}
?>