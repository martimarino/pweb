<?php
	
	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();

	$email = $_SESSION['username'];
	$result = getUserOrders($email);

	
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
		$message = "No more orders to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){

			// Set Order class
			$order = new Order();
			$order->orderId = $row['codice'];
			$order->date = $row['data'];
			$order->state = $row['stato'];
			$order->tot = $row['totale'];

			$response->data[$index] = $order;

			$index++;
		}
		
		return $response;
	}

?>
