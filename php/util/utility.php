<?php
    require_once "supernovaDbManager.php"; //includes Database Class
    require_once "garmentManagerDb.php";

	function recoverInformations($field, $table, $username) {

		global $supernovaDb;
		$query = "select " . $field . " from `" . $table . "` where email='" . $username . "'";
		$result = $supernovaDb->performQuery($query);
		$elem = "";
		$row = $result->fetch_row();
		$elem = $row[0];
		
		return $elem;
	}

	function setCartBadge(){
		
		$result = getHowManyInCart($_SESSION['username']);

		$num = mysqli_num_rows($result);
		if($num != 1) { 
			showError();	
			return;
		}
		
		$row = $result->fetch_assoc();
		return $row['cartBadge'];
	}

	function setWishlistBadge(){
		$result = getHowManyInWishList($_SESSION['username']);

		$num = mysqli_num_rows($result);
		if($num != 1) { 
			showError();	
			return;
		}
		
		$row = $result->fetch_assoc();
		return $row['wishlistBadge'];		
	}

	function allGarmentsID(){
		$result = getAllGarmentsID();
		$num = mysqli_num_rows($result);

		while ($row = $result->fetch_assoc()){
			$id = $row['garmentId'];
			echo '<option value=\'' . $id . '\'>' . $id . '</option>';
		}
	}

	function allOrdersID(){
		$result = getAllOrdersID();

		while ($row = $result->fetch_assoc()) {
			$order = $row['codice'];
			echo '<option value=\'' . $order . '\'>' . $order . '</option>';
		}
	}

	function allCollections(){
		$result = getAllCollections();

		while ($row = $result->fetch_assoc()){
			$collection = $row['collection'];
			echo '<option value=\'' . $collection . '\'>' . $collection . '</option>';
		}
	}

?>