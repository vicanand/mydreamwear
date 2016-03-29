<?php

session_start();
include "helpers.php";
$baseurl = get_base_url();
$data = json_encode($_POST);
//print_r($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseurl."/createorder");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
$result = json_decode($server_output);
curl_close ($ch);
if($result->data == "true"){
	$chh = curl_init();
	$request->userid=$_POST["userid"];
	$request->itemid=$_POST["itemcode"];
	$data = json_encode($request);
	curl_setopt($chh, CURLOPT_URL, $baseurl."/removefromcart");
	curl_setopt($chh, CURLOPT_POST, 1);
	curl_setopt($chh, CURLOPT_POSTFIELDS, $data);
	curl_setopt($chh, CURLOPT_RETURNTRANSFER, true);
	$server_output_1 = curl_exec ($chh);
	$res = json_decode($server_output);
	curl_close ($chh);
	echo $res->data;
}else{
	echo "false";
}
//echo (json_decode($server_output)->data);

?>