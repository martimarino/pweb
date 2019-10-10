<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";	
	require_once DIR_UTIL . "verify_input.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['garmentId'])){
		return;
	}	

	$garmentId = $_GET['garmentId']; 
	
	$result = deleteGarment($garmentId);

	$message = "OK";
	$response = setResponse($result, $message);
	$response->data = null;
	echo json_encode($response);
	return;
	
?>