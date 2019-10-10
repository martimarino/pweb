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

		if (($field = "email") || ($field == "pagamento") || ($field == "stato"))
			if(!preg_match("/[a-zA-Z]$/", $value))
				return "Input should be alphabetical";

		if ($field == "data")
			if(!preg_match("/[0-9]{4}+-+[0-9]{2}+-+[0-9]{2}$/", $value))
				return "Date format is incorrect (AAAA-MM-DD)";

		if($field == "totale")
			if(!preg_match("/[0-9]\.[0-9]{2}$/", $value))
				return "Input should be a real number (es '50.00')";
	}

	if(!$errorMessage){

		$query = modifyOrder($orderId, $field, $value);
		if($query)
			$result = null;
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