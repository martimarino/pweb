<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	$message = "OK";
	
	if (!isset($_GET['garmentId'])){ 
		echo json_encode($response);
		return;
	}		
	$garmentId = $_GET['garmentId'];	

	if (!isset($_SESSION['username'])){ 
		echo json_encode($response);
		return;
	}		
	$email = $_SESSION['username'];

	if (isset($_GET['garmentSize'])){
		$garmentSize = $_GET['garmentSize'];
		if (modifyCart($garmentId, $email, $garmentSize)) {  
			$query = getGarmentQuantityInStock($garmentId, $garmentSize);
			$stockQuantity = $query->fetch_assoc();
			$response = setCorrectResponse($email, $garmentId, $garmentSize, $stockQuantity, $message);
		}
		echo json_encode($response);
		return;
	}

	function isGarmentInCart($garmentId, $email, $garmentSize){
		$result = getUserGarmentCart($email, $garmentId, $garmentSize);
		$numRows = $result->num_rows;
		return $numRows === 1;
	}

	function modifyCart($garmentId, $email, $garmentSize){
		if(isGarmentInCart($garmentId, $email, $garmentSize)){
			$query = getCartItemActualQuantity($garmentId, $email, $garmentSize);
			$actualQuantity = $query->fetch_assoc();
			$quantity = $actualQuantity['quantity'] -1;
			if($quantity >= 1)
				$result = updateCart($garmentId, $email, $garmentSize, $quantity);
			else
				$result = removeFromCart($garmentId, $email, $garmentSize);
		}
		
		return $result;
	}
	
	function setCorrectResponse($email, $garmentId, $garmentSize, $stockQuantity, $message){
		$response = new AjaxResponse("0", $message);
		$result = getUserGarmentCart($email, $garmentId, $garmentSize);
		$newCartItem = $result->fetch_assoc();
		
		// Set Cart class
		$cart = new Cart();
		$cart->email = $newCartItem['email'];
		$cart->garmentId = $newCartItem['garmentId'];
		$cart->garmentSize = $newCartItem['size'];
		$cart->quantity = $newCartItem['quantity'];
		$cart->stockQuantity = $stockQuantity['quantity'];
		
		$response->data = $cart;
		
		return $response;
	}

?>
