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
	
	$result = getElementsToDiscount($collection);

	if(checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}

	$message = "OK";
	$response = setResponse($percentage, $result, $message);
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

?>

