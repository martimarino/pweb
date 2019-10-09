<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['percentage']) || !isset($_GET['collection'])){
		return;
	}	

	$percentage = $_GET['percentage']; 
	$collection = $_GET['collection'];

	$errorMessage = "";
	$errorMessage = verifyInsertSaleInput($percentage);

	function verifyInsertSaleInput($percentage)
	{
		if (($percentage == "") || ($percentage == "undefined"))
			return 'Empty field';

		if(!preg_match("/^[0-90]$/", $percentage))
			return "Invalid value";
	}

	if(!$errorMessage){
	
		$result = getElementsToDiscount($collection);

		if(checkEmptyResult($result)){
			$response = setEmptyResponse();
			echo json_encode($response);
			return;
		}

		$message = "OK";
		$response = setResponse($percentage, $result, $message);

	}

	else {
		$result = "./../php/admin_profile.php?errorMessage=" . $errorMessage;

		$message = "INPUT ERROR";
		$response = setErrorInputResponse($result, $message);
	}

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

	function setResponse($percentage, $result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){

			$newPrice = round($row['price']*((100 - $percentage)/100));
			insertNewSale($row['garmentId'], $newPrice);

			$index++;
		}
		
		return $response;
	}

	function setErrorInputResponse($result, $message){
		$response = new AjaxResponse("0", $message);
		$response->data = $result;
		return $response;
	}

?>

