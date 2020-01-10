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
	if($newValue == "radio")
		$newValue = $_POST['new_garment_value_option'];

	$errorMessage = "";
	$errorMessage = verifyModifyGarmentInput($field, $newValue);

	function verifyModifyGarmentInput($field, $newValue)
	{ 
		if (($newValue == "") || ($newValue == "undefined")){
			return 'Empty field';
		}

		if (($field == "model") || ($field == "color")){
			if(!preg_match("/[a-zA-Z]$/", $newValue)){
				return "Input should be alphabetical";
			}
		}

		if(($field == "price") || ($field == "discountedPrice"))
			if(!preg_match("/[0-9]\.[0-9]{2}$/", $newValue))
				return "Input should be a real number (es '50.00')";
	}

	if(!$errorMessage){
		$query = modifyGarment($garmentId, $field, $newValue);

		if($query)
			$result = null;
		else $result="ERRORE NELLA QUERY";

		$message = "OK";
	}

	else {
		$result = "./../php/admin_profile.php?errorMessage=" . $errorMessage;

		$message = "INPUT ERROR";
	}

	if(checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}

	$response = setResponse($result, $message);
	echo json_encode($response);
	return;

?>