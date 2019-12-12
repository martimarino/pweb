<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	$message = "OK";
	
	$garmentId = null;
	if (!isset($_GET['garmentId'])){
		echo json_encode($response);
		return;
	}		

	$garmentId = $_GET['garmentId'];
	$currentFlag = 0;		

	// check desired flag
	if (isset($_GET['desired'])){
		$currentFlag = $_GET['desired'];
		if (setDesiredUserStat($garmentId, $currentFlag))
			$response = setCorrectResponse($garmentId, $message);
		echo json_encode($response);
		return;
	}	

	// check like flag		
	if (isset($_GET['like'])){
		$currentFlag = $_GET['like'];
		if (setLikeUserStat($garmentId, $currentFlag))
			$response = setCorrectResponse($garmentId, $message);
			
		echo json_encode($response);
		return;
	}	

	// check dislike flag		
	if (isset($_GET['dislike'])){
		$currentFlag = $_GET['dislike'];
		if (setDislikeUserStat($garmentId, $currentFlag))
			$response = setCorrectResponse($garmentId, $message);
				
		echo json_encode($response);
		return;
	}		

	function isUserGarmentStatInDb($garmentId, $email){
		$result = getUserGarmentStat($email, $garmentId);
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
	
	function setLikeUserStat($garmentId, $isLiked){
		if (!$isLiked) // if isLiked flag is equal to 0 (user remove the like flag)
			$isLiked = null;
					
		return setLikeDislikeUserStat($garmentId, $isLiked);
	}
	
	function setDislikeUserStat($garmentId, $isDisliked){
		if (!$isDisliked) // if isDisiked flag is equal to 0 (user remove the dislike flag)
			$isDisliked = null;
		else
			$isDisliked = 0; // In the DB the 'isLiked' column is set to: NUll -> no user preferences; 0 -> dislike; 1 -> like
	
		return setLikeDislikeUserStat($garmentId, $isDisliked);
	}
	
	function setLikeDislikeUserStat($garmentId, $preference){
		if(isUserGarmentStatInDb($garmentId, $_SESSION['username']))
			$result = updateLikeDislikeUserGarmentStat($garmentId, $_SESSION['username'], $preference);
		else
			$result = insertLikeDislikeUserGarmentStat($garmentId, $_SESSION['username'], $preference);
	
		return $result;
	}
	
	function setCorrectResponse($garmentId, $message){
		$response = new AjaxResponse("0", $message);
		$result = getUserGarmentStat($_SESSION['username'], $garmentId);
		$userGarmentRow = $result->fetch_assoc();
		
		// Set UserStat class
		$userStat = new UserStat();
		$userStat->desired = $userGarmentRow['desired'];
		$userStat->liked = ($userGarmentRow['isLiked'] === null)? 0 : (int)$userGarmentRow['isLiked'];
		$userStat->disliked = ($userGarmentRow['isLiked'] === null)? 0 : (int)!$userGarmentRow['isLiked'];
		$likedCountResult = getGarmentLikes($garmentId);
		$likedCountRow = $likedCountResult->fetch_assoc();
		$userStat->likedCount = $likedCountRow['num'];
		$dislikedCountResult = getGarmentDislikes($garmentId);
		$dislikedCountRow = $dislikedCountResult->fetch_assoc();
		$userStat->dislikedCount = $dislikedCountRow['num'];
		
		// Set Garment class
		$garment = new Garment();
		$garment->garmentId = $garmentId;

		// Set GarmentUserStat class		
		$garmentUserStat = new GarmentUserStat($garment, $userStat);
		
		$response->data = $garmentUserStat;
		
		return $response;
	}

?>
