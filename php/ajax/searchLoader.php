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
			// Set UserStat class
			$userStat = new UserStat();
			
			if(isset($_SESSION['username'])){
				$userGarmentResult = getUserGarmentStat($_SESSION['username'], $row['garmentId']);
				if ($userGarmentRow = $userGarmentResult->fetch_assoc()){
					$userStat->desired = $userGarmentRow['desired'];
					$userStat->inCart = $userGarmentRow['inCart'];
					$userStat->liked = ($userGarmentRow['isLiked'] === null)? 0 : (int)$userGarmentRow['isLiked'];
					$userStat->disliked = ($userGarmentRow['isLiked'] === null)? 0 : (int)!$userGarmentRow['isLiked'];		
				}
				
				$likedCountResult = getGarmentLikes($row['garmentId']);
				$likedCountRow = $likedCountResult->fetch_assoc();
				$userStat->likedCount = $likedCountRow['num'];
				$dislikedCountResult = getGarmentDislikes($row['garmentId']);
				$dislikedCountRow = $dislikedCountResult->fetch_assoc();
				$userStat->dislikedCount = $dislikedCountRow['num'];
			}

			// Set Garment class
			$garment = new Garment();
			$garment->garmentId = $row['garmentId'];
			$garment->model = $row['model'];
			$garment->img = $row['img'];
			$garment->price = $row['price'];

			// Set GarmentUserStat class		
			$garmentUserStat = new GarmentUserStat($garment, $userStat);
		
			$response->data[$index] = $garmentUserStat;

			$index++;
		}
		
		return $response;
	}

?>
