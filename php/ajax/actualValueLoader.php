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
	$fieldToFind = $_GET['fieldToFind'];
	$result = getActualValue($table, $field, $fieldToFind, $value);

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

?>