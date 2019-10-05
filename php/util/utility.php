<?php
    require_once "supernovaDbManager.php"; //includes Database Class

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

	function setCatalogFields(){
		$result = getCatalogFields();

		
	}

?>