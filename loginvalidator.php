<?php
session_start();
include "helpers.php";
$baseurl = get_base_url();

if($_POST["type"] == "signin"){
	$data = json_encode($_POST);

	$ch = curl_init();
	$url = $baseurl."/signin";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec ($ch);
	//var_dump($server_output);
	curl_close ($ch);

	$response = json_decode($server_output, true);
	$result = $response["data"];
	//echo $result;
	if ($result != "error") {
		$result = $result[0];
		$_SESSION["name"] = $result["name"];
		$_SESSION["userid"] = $result["user_id"];
		$_SESSION["usertype"] = $_POST["user"];
		echo "true";
	}else{
		echo "false";
	}
	
	
	//header("Location: index.php");
}elseif ($_POST["type"] == "signup") {
	$data = json_encode($_POST);
	$ch = curl_init();
	$url = $baseurl."/signup";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec ($ch);
	//var_dump($server_output);
	curl_close ($ch);

	$response = json_decode($server_output, true);
	$result = $response["data"];
	
	if ($result != "false") {
		echo "true";
	}else{
		echo "false";
	}
	
	
}

?>