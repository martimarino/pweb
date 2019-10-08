<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['garmentId']) || !isset($_GET['size']) || !isset($_GET['quantity'])){
		return;
	}	

	$garmentId = $_GET['garmentId']; 
	$size = $_GET['size'];
	$quantity = $_GET['quantity'];
	
	$result = modifyStockQuantity($garmentId, $size, $quantity);

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
	}

	function setEmptyResponse(){
		$message = "Nothing to load";
		return new AjaxResponse("-1", $message);
	}

	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		return $response;
	}
?>