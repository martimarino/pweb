<?php
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['pattern'])){
		echo json_encode($response);
		return;
	}		
	
	$pattern = $_GET['pattern'];
	$result = getSearchGarmentsByModel($pattern);
	
	if (checkEmptyResult($result)){
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

			$response->data[$index] = $garment;

			$index++;
		}
		
		return $response;
	}

?>
