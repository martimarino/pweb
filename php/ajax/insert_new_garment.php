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

	$errorMessage = "";
	$errorMessage = verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price, $image);

	if(!$errorMessage){

		$result = garmentInsertion($model, $color, $category, $genre, $collection, $price, $image);

		if(checkEmptyResult($result)){
			$response = setEmptyResponse();
			echo json_encode($response);
			return;
		}

		$message = "OK";

	}

	else 
	{
		$result = "./../php/admin_profile.php?errorMessage=" . $errorMessage;

		$message = "INPUT ERROR";
	}

	$response = setResponse($result, $message);
	echo json_encode($response);
	return;	



	function verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price, $image)
	{
		if (($model == "") || ($model == "undefined") || ($color == "") || ($color == "undefined") || ($category == "") || ($category == "undefined") || ($genre == "") || ($genre == "undefined") || ($collection == "") || ($collection == "undefined") || ($price == "") || ($price == "undefined") || ($image == "") || ($image == "indefined"))
			return 'Some fields are empty';

		if(!preg_match("/^[a-zA-Z]+$/", $model))
			return 'Model input should be aphabetical';

		if(!preg_match("/^[a-zA-Z]+$/", $color))
			return 'Color input should be aphabetical';

		if(($collection != "A/I") && ($collection != "P/E"))
			return 'Collections available are A/I and P/E';

		if(($genre != "male") && ($collection != "female") && ($genre != "unisex"))
			return 'Genre options are: male, female, unisex';

		if(!preg_match("/^[0-9]+\.+[0-9]{2}$/", $price))
			return "Price invalid (insert decimal)";

		if(!preg_match("/^garment+[0-9]+\.jpg$/", $image))
			return 'Insert image as garment**.jpg without path (substitute ** with a number)';

	}

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
		
		$response->data = $result;

		return $response;
	}
?>