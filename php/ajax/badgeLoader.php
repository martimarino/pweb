<?php
	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";

	$response = new AjaxResponse();
	$email = null;

	if (!isset($_SESSION['username'])){
		echo json_encode($response);
		return;
	}		

	$email = $_SESSION['username'];

	$wishlistNumber = getHowManyInWishList($email);
	$cartNumber = getHowManyInCart($email);

	if(checkEmptyResult($wishlistNumber) || checkEmptyResult($cartNumber)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}

	$message = "OK";
	$response = setResponse($wishlistNumber, $cartNumber, $message);
	echo json_encode($response);
	return;

	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}

	function setEmptyResponse(){
		$message = "Empty result";
		return new AjaxResponse("-1", $message);
	}

	
	function setResponse($wishlistNumber, $cartNumber, $message){

		$response = new AjaxResponse("0", $message);

		if((mysqli_num_rows($cartNumber) != 1) || (mysqli_num_rows($wishlistNumber) != 1)) { 
			showError();	
			return;
		}

		$badge = new Badge();
		$wishlistRow = $wishlistNumber->fetch_assoc();
		$badge->wishlist = $wishlistRow['wishlistBadge'];
		
		$cartRow = $cartNumber->fetch_assoc();
		$badge->cart = $cartRow['cartBadge'];

		$response->data = $badge;
		return $response;
	}

?>
