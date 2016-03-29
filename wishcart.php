<?php
session_start();
include "helpers.php";
$baseurl = get_base_url();
$itemcode = $_POST["itemcode"];
$userid = $_SESSION["userid"];
$type = $_POST["type"];
$action = $_POST["action"];
$quantity = $_POST["quantity"];
function getcart($url){
		
		//$url = $baseurl."/getcart/".$_SESSION["userid"];

		$finalobj = new stdClass();
		if (isset($_SESSION["userid"])) {
	        $result = file_get_contents($url."/getcart/".$_SESSION["userid"]);
	        $response = json_decode($result, true);
	        $data = $response["data"];
	    }
	    $count = sizeof($data);
	    $subtotal = "";
		$output = "";
		foreach($data as $item) { 
	        $imgArray = $item["imgs"];
	        $subtotal += $item["rent_price"] * $item["quantity"];
	    
		    $output .= '<li class="clearfix">
		        <a class="p-thumb" href="single-product.php">
		            <img src="images/items/'.$imgArray[0]["image"].'" alt="">
		        </a>
		        <div class="p-info">
		            <a class="p-title" href="single-product.php?item='.$item["itemcode"].'">'.ucwords($item["title"]).'</a>
		            <span class="price">
		                <ins><span class="amount units">₹'.$item["rent_price"] * $item["quantity"].'</span></ins>
		                <del>₹'.$item["retail_price"] * $item["quantity"].'</del>
		            </span>
		            <span class="p-qty">QTY: '.$item["quantity"].'</span>
		            
		        </div>
		    </li>';
	    }
	    $finalobj->cart=$output;
	    $finalobj->count=$count;
	    $finalobj->total="₹".$subtotal;
	    return $finalobj;
	
}



if($action == "removefromwish"){
	$request = new stdClass();
	$data = "";
	$ch = curl_init();
	$request->userid=$userid;
	$request->itemid=$itemcode;
	$data = json_encode($request);
	curl_setopt($ch, CURLOPT_URL, $baseurl."/removefromwishlist");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	echo "Item removed from your wishlist!";

}elseif($action == "removefromcart"){
	$request = new stdClass();
	$data = "";
	$ch = curl_init();
	$request->userid=$userid;
	$request->itemid=$itemcode;
	$data = json_encode($request);
	curl_setopt($ch, CURLOPT_URL, $baseurl."/removefromcart");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	echo "Item Removed from Cart";
}else{
	$request = new stdClass();
	$data = "";
	$finaloutput = "";
	$ch = curl_init();
	if ($type == "cart") {
		$request->userid=$userid;
		$request->itemid=$itemcode;
		$request->quantity=$quantity;
		$data = json_encode($request);
		curl_setopt($ch, CURLOPT_URL, $baseurl."/addtocart");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);
		$result = json_decode($server_output);
		
		$result = $result->data;
		if($result != "false"){
			$finaloutput = getcart($baseurl);
		}else{
			if(isset($_SESSION["name"])){
				$finaloutput->msg="exists";
			}else{
				$finaloutput->msg="false";
			}
		}
	}else{
		$request->userid=$userid;
		$request->itemid=$itemcode;
		$data = json_encode($request);
		curl_setopt($ch, CURLOPT_URL, $baseurl."/addtowishlist");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		$result = json_decode($server_output);
		$result = $result->data;
		if($result != "false"){
			$finaloutput = getcart($baseurl);
		}else{
			if(isset($_SESSION["name"])){
				$finaloutput->msg="exists";
			}else{
				$finaloutput->msg="false";
			}
		}
	}

	 
		
	
	echo json_encode($finaloutput);
	//echo $result;
	curl_close ($ch);
	
}



?>