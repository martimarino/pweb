<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";	
	require_once DIR_UTIL . "verify_input.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['garmentId']) || !isset($_GET['size']) || !isset($_GET['quantity'])){
		return;
	}	

	$garmentId = $_GET['garmentId']; 
	$size = $_GET['size'];
	$quantity = $_GET['quantity'];

	$errorMessage = "";
	$errorMessage = verifyModifyStockInput($quantity);
	
	function verifyModifyStockInput($quantity)
	{
		if (($quantity == "") || ($quantity == "quantity"))
			return 'Empty field';

		if(!preg_match("/[0-9]$/", $quantity))
			return "Invalid quantity";
	}

	if(!$errorMessage){
	
		$query = modifyStockQuantity($garmentId, $size, $quantity);
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