<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();

	if (!isset($_GET['searchType']) || !isset($_GET['garmentToLoad']) || !isset($_GET['offset'])){
		echo json_encode($response);
		return;
	}	

	$searchType = $_GET['searchType'];
	$garmentToLoad = $_GET['garmentToLoad'];
	$offset = $_GET['offset'];

	switch ($searchType) {
		case 0:
			$result = getFilterGarments($offset, $garmentToLoad, "discountedFlag", "1");
			break;
		
		case 1:
			$result = getAllGarments($offset, $garmentToLoad);
			break;

		case 2:
			$result = getDesiredGarments($_SESSION['username'], $offset, $garmentToLoad);
			break;

		case 3:
			$result = getFilterGarments($offset, $garmentToLoad, "genre", "male");
			break;

		case 4:
			$result = getFilterGarments($offset, $garmentToLoad, "genre", "female");
			break;

		case 5:
			$result = getFilterGarments($offset, $garmentToLoad, "category", "accessories");
			break;

		default:
			$result = null;
			break;
	}

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
			
		return ($result->num_rows <= 0);
	}

	function setEmptyResponse(){
		$message = "No more garments to load";
		return new AjaxResponse("-1", $message);
	}

	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
			
		$index = 0;
		while ($row = $result->fetch_assoc()){

			// Set Garment class
			$garment = new Garment();
			$garment->garmentId = $row['garmentId'];
			$garment->model = $row['model'];
			$garment->img = $row['img'];
			$garment->price = $row['price'];

			$checkStockResult = getGarmentTotalQuantityInStock($garment->garmentId);
			$checkStock = $checkStockResult->fetch_assoc();
			$garment->totalInStock = $checkStock['total'];

			$response->data[$index] = $garment;
			$index++;
		}
		
		return $response;
	}
?>