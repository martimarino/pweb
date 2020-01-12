<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();	

	$label = $_GET['label'];
	$table = $_GET['table'];
	$field = $_GET['field'];
	$value = $_GET['value'];
	$panel = $_GET['panel'];	//nel caso di stock è il garmentId
	$fieldToFind = $_GET['fieldToFind'];

	switch ($table) {
		case 'order_garment':
			$result = getOrderGarmentActualValue($table, $field, $value, $fieldToFind);
			break;

		case 'stock';
			$result = getStockActualQuantity($table, $value, $panel);
			break;
		
		default:
			$result = getActualValue($table, $field, $value, $fieldToFind);
			break;
	}

	if($fieldToFind == 'articoli')
	{
		$message = "Case garment details";
		$response = setGarmentResponse($message);
		echo json_encode($response);
		return;
	}

	if(checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}

	$message = "OK";
	$response = setResponse($result, $message, $fieldToFind);
	echo json_encode($response);
	return;

	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}

	function setEmptyResponse(){
		$message = "Nothing to load";
		return new AjaxResponse("-1", $message);
	}

	function setResponse($result, $message, $fieldToFind){
		$response = new AjaxResponse("0", $message);
			
		if ($row = $result->fetch_assoc()){

			$response->data = $row[$fieldToFind];

		}
		
		return $response;
	}

	function setGarmentResponse($message){
		$response = new AjaxResponse("0", $message);
		$response->data = "";
		return $response;
	}

?>