<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";	
	require_once DIR_UTIL . "verify_input.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['garmentId']) || !isset($_GET['field']) || !isset($_GET['newValue'])){
		return;
	}	

	$garmentId = $_GET['garmentId']; 
	$field = $_GET['field'];
	$newValue = $_GET['newValue'];

	$errorMessage = "";
	$errorMessage = verifyModifyGarmentInput($newValue);

	function verifyModifyGarmentInput($newValue)
	{
		if (($newValue == "") || ($newValue == "undefined"))
			return 'Empty field';

		if(!preg_match("/^[a-zA-Z]$/", $newValue))
			return "ID invalid";
	}

	if(!$errorMessage){
		$result = modifyGarment($garmentId, $field, $newValue);

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