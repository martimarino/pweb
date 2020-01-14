<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	$message = "OK";
	
	if (!isset($_GET['garmentId'])){
		echo json_encode($response);
		return;
	}		

	$garmentId = $_GET['garmentId'];	

	// check desired flag
	if (isset($_GET['desired'])){
		$currentFlag = $_GET['desired'];
		if (setDesiredUserStat($garmentId, $currentFlag))
			$response = setCorrectResponse($garmentId, $message);
		echo json_encode($response);
		return;
	}		

	function isUserGarmentStatInDb($garmentId, $email){
		$result = getUserGarment($email, $garmentId);
		$numRows = $result->num_rows;
		return $numRows === 1;
	}

	function setDesiredUserStat($garmentId, $desiredFlag){
		if(isUserGarmentStatInDb($garmentId, $_SESSION['username']))
			$result = updateDesiredUserGarmentStat($garmentId, $_SESSION['username'], $desiredFlag);
		else
			$result = insertDesiredUserGarmentStat($garmentId, $_SESSION['username'], $desiredFlag);
		
		return $result;
	}
	
	function setCorrectResponse($garmentId, $message){
		$response = new AjaxResponse("0", $message);
		$result = getUserGarment($_SESSION['username'], $garmentId);
		$userGarmentRow = $result->fetch_assoc();
		
		$garmentUser = new garmentUser();
		$garmentUser->garmentId = $garmentId;
		$garmentUser->desired = $userGarmentRow['desired'];
		
		$response->data = $garmentUser;
		
		return $response;
	}

?>
