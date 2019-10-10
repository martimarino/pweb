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

		if($field == "category")
			if(($newValue != "clothing") || ($newValue != "accessories"))
				return "Category options are clothing and accessories";

		if($field == "genre")
			if(($newValue != "female") || ($newValue != "female") || ($newValue != "unisex"))
				return "Genre options are male, female and unisex";

		if($field == "collection")
			if(($newValue != "A/I") || ($newValue != "P/E"))
				return "collection options are A/I and P/E";

		if($field == "price")
			if(!preg_match("/[0-9]\.[0-9]{2}$/", $newValue))
				return "Input should be a real number (es '50.00')";

		if ($field == "img"){
			if(!preg_match("/^garment+[0-9]+\.jpg$/", $newValue)){ 
				return 'Insert image as garment**.jpg';
			}
		}
	}

	if(!$errorMessage){
		$query = modifyGarment($garmentId, $field, $newValue);

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