<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['orderId']) || !isset($_GET['field']) || !isset($_GET['value'])){
		return;
	}	

	$orderId = $_GET['orderId']; 
	$field = $_GET['field'];
	$value = $_GET['value'];
	
	$result = modifyOrder($orderId, $field, $value);

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