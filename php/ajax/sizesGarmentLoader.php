<?php
	
	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();

	if (!isset($_GET['garmentId'])){
		echo json_encode($response);
		return;
	}	

	$garmentId = $_GET['garmentId'];
	$result = getGarmentSizes($garmentId);
	
	if(checkEmptyResult($result)){
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
		$message = "No more garments to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){

			// Set Stock class
			$stock = new Stock();
			$stock->garmentId = $row['garmentId'];
			$stock->sizeLetter = $row['size'];
			$stock->quantity = $row['quantity'];

			$response->data[$index] = $stock;

			$index++;
		}
		
		return $response;
	}

?>
