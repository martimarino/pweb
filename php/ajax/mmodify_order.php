<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";

	if (!isset($_POST['ordersID']) || !isset($_POST['order_select']) || !isset($_POST['order_new_value'])){
		$errorMessage = "Empty selection";
		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		exit;
	}	

	$orderId = $_POST['ordersID']; 
	$orderField = $_POST['order_select'];
	$value = $_POST['order_new_value'];

	if ($orderField == 'articoli'){
		if(!isset($_POST['select_order_garment_id']) || (!isset($_POST['select_order_garment_field']))){
			$errorMessage = "Empty selection";
			header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
			exit;
		}
		$garmentId = $_POST['select_order_garment_id'];
		$garmentField = $_POST['select_order_garment_field'];

		$errorMessage = "";
		$errorMessage = verifyModifyOrderGarmentInput($garmentField, $value);

		if(!$errorMessage){
			$query = modifyOrderGarment($orderId, $garmentId, $garmentField, $value);
			if($query){
				$errorMessage = $orderId . $garmentId . $garmentField . $value;
				//$errorMessage = "Order modified with success";
				header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
			}
			else{
				$errorMessage = "Query error";
				header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
			}
		}
		else{
			header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		}

	}
	else{
		
		$errorMessage = "";
		$errorMessage = verifyModifyOrderInput($orderField, $value);

		if(!$errorMessage){
			$query = modifyOrder($orderId, $orderField, $value);
			if($query){
				$errorMessage = "Order modified with success";
				header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
			}
			else{
				$errorMessage = "Query error";
				header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
			}
		}

		else {
			header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		}
	
	}
	
	function verifyModifyOrderInput($orderField, $value)
	{
		if (($value == "") || ($value == "undefined"))
			return 'Empty field';

		if (($orderField == "email") || ($orderField == "pagamento") || ($orderField == "stato"))
			if(!preg_match("/[a-zA-Z]$/", $value))
				return "Input should be alphabetical";

		if ($orderField == "data")
			if(!preg_match("/[0-9]{4}+-+[0-9]{2}+-+[0-9]{2}$/", $value))
				return "Date format is incorrect (AAAA-MM-DD)";

		if($orderField == "totale")
			if(!preg_match("/[0-9]\.[0-9]{2}$/", $value))
				return "Input should be a real number (es '50.00')";
	}

	function verifyModifyOrderGarmentInput($garmentField, $value)
	{
		if (($value == "") || ($value == "undefined"))
			return 'Empty field';

		if ($garmentField == "price")
			if(!preg_match("/[0-9]\.[0-9]{2}$/", $value))
				return "Input should be a real number (es '50.00')";

		if ($garmentField == "quantity")
			if(!preg_match("/[0-9]$/", $value))
				return "Invalid quantity";

		if (($garmentField == "color") || ($garmentField == "garmentSize"))
			if(!preg_match("/[a-zA-Z]$/", $value))
				return "Input should be alphabetical";
	}

?>