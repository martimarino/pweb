<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";	
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();	

	if (!isset($_GET['model']) || !isset($_GET['color']) || !isset($_GET['category']) || !isset($_GET['genre']) || !isset($_GET['collection']) || !isset($_GET['price']) || !isset($_GET['image'])){
		return;
	}	

	$model = $_GET['model']; 
	$color = $_GET['color'];
	$category = $_GET['category'];
	$genre = $_GET['genre'];
	$collection = $_GET['collection'];
	$price = $_GET['price'];
	$image = $_GET['image'];
	
	$result = garmentInsertion($model, $color, $category, $genre, $collection, $price, $image);

	if(checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}

	$message = "OK";
	$response = setResponse($result, $message);
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

	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		return $response;
	}
?>