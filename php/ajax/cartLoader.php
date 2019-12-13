<?php
	
	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();

	$email = $_SESSION['username'];
	$result = getInCartGarments($email);

	
	if (checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}
	
	$message = "OK";	
	$response = setResponse($result, $message);
	echo json_encode($response);
	return;
	
	
	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}
	
	function setEmptyResponse(){
		$message = "No more items to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){

			// Set Cart class
			$cart = new Cart();
			$cart->email = $row['email'];
			$cart->garmentId = $row['garmentId'];
			$cart->garmentSize = $row['size'];
			$cart->quantity = $row['quantity'];
			$cart->price = $row['price'];

			$response->data[$index] = $cart;

			$index++;
		}
		
		return $response;
	}

?>
