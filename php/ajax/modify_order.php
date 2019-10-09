<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";	
	require_once DIR_UTIL . "verify_input.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['orderId']) || !isset($_GET['field']) || !isset($_GET['value'])){
		return;
	}	

	$orderId = $_GET['orderId']; 
	$field = $_GET['field'];
	$value = $_GET['value'];

	$errorMessage = "";
	$errorMessage = verifyModifyOrderInput($value);
	
	function verifyModifyOrderInput($value)
	{
		if (($value == "") || ($value == "undefined"))
			return 'Empty field';

		if(!preg_match("/^[a-zA-Z]$/", $value))
			return "Invalid value";
	}

	if(!$errorMessage){

		$result = modifyOrder($orderId, $field, $value);

		if(checkEmptyResult($result)){
			$response = setEmptyResponse();
			echo json_encode($response);
			return;
		}

		$message = "OK";
	}

	else {
		$result = "./../php/admin_profile.php?errorMessage=" . $errorMessage;

		$message = "INPUT ERROR";
	}

	$response = setResponse($result, $message);
	echo json_encode($response);
	return;

?>