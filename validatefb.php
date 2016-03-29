<?php
	session_start();

	include "helpers.php";
	$baseurl = get_base_url();


	$fbid = $_SESSION['FBID'];
    $fbfullname = $_SESSION['FULLNAME'];
	$femail = $_SESSION['EMAIL'];
	$mobile = rand(100, 100000);
	if($femail == ""){
		echo "Error getting email";
		exit();
	}
	$method = "facebook";
	//echo $fbid."--".$fbfullname."---".$femail."----";

	$pass = md5($fbid);
	$ip = $_SERVER['REMOTE_ADDR'];
	$user = $_GET["user"];
	$check = login($femail, $pass, $user, $method, $baseurl);
	//echo $check."--";
	if($check == "false"){
		//echo "not registered";
		$req_signup_obj = new stdClass();
		if($user == "buyer"){
			$req_signup_obj->name=$fbfullname;
			$req_signup_obj->email=$femail;
			$req_signup_obj->mobile=$mobile;
			$req_signup_obj->password=$pass;
			$req_signup_obj->locality="0";
			$req_signup_obj->city="0";
			$req_signup_obj->zip="0";
			$req_signup_obj->designer="0";
			$req_signup_obj->user=$user;
			$req_signup_obj->ip=$ip;
			//$req_signup_obj->method=$method;
		}elseif($user == "seller"){
			$req_signup_obj->name=$fbfullname;
			$req_signup_obj->email=$femail;
			$req_signup_obj->mobile=$mobile;
			$req_signup_obj->password=$pass;
			$req_signup_obj->address="0";
			$req_signup_obj->designer="0";
			$req_signup_obj->user=$user;
			$req_signup_obj->ip=$ip;
			//$req_signup_obj->method=$method;
		}

		$final_req_signup_obj = json_encode($req_signup_obj);

		$ch = curl_init();
		$url = $baseurl."/signup";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $final_req_signup_obj);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);
		//var_dump($server_output);
		curl_close ($ch);

		$response = json_decode($server_output, true);
		$result = $response["data"];
		
		if ($result == "true") {
			login($femail, $pass, $user, $method, $baseurl);
			header('Location: index.php');
		}else{
			header('Location: login-register.php');
		}
	}else{
		// echo "REgistered";
		header('Location: index.php');
	}

?>