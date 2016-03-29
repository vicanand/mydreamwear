<?php
function get_base_url(){
	return "http://ec2-54-169-29-187.ap-southeast-1.compute.amazonaws.com/mdwapi/index.php";
}

function login($email, $pass, $user, $method, $base_url){

	$req_signin_obj = new stdClass();
	$req_signin_obj->email=$email;
	$req_signin_obj->password=$pass;
	$req_signin_obj->user=$user;
	$req_signin_obj->method=$method;
	//$final_req_signin_obj = json_encode($req_signin_obj);	

	$data = json_encode($req_signin_obj);
	//print_r($data);
	$ch = curl_init();
	$url = $base_url."/signin";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec ($ch);
	
	curl_close ($ch);
	$response = json_decode($server_output, true);
	$result = $response["data"];
	//print_r($result);
	if ($result != "error") {
		$result = $result[0];
		$_SESSION["name"] = $result["name"];
		$_SESSION["userid"] = $result["user_id"];
		$_SESSION["usertype"] = $user;
		return "true";
	}else{
		return "false";
	}
}


?>