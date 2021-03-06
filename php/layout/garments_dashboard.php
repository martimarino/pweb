<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "session.php";
	require_once DIR_UTIL . "garmentManagerDb.php";	
	require_once DIR_LAYOUT . "message.php";
	
	function showDesiredButton($garmentId, $userGarmentRow){

		$currentFlag = false; //desired flag
		if ($userGarmentRow != null AND $userGarmentRow['desired'] != null AND $userGarmentRow['desired'] == 1)
			$currentFlag = true;
		echo '<div id="desiredItem_' . $garmentId . '" class="nav_garment_item desired_img_' . (int)$currentFlag . '" ';
		echo 'onClick="UserGarmentNavBarEventHandler.onDesiredEvent(' . $garmentId . '); UserGarmentNavBarEventHandler.onBadgeNumber()">';
		echo '</div>';
			
	}
	
	function showDetailedGarment($result){
		$numGarments = mysqli_num_rows($result);
		if($numGarments != 1) { 
			showError();	
			return;
		}
		
		$garmentRow = $result->fetch_assoc();
		echo '<div id="detailed_garment_tab">';
			echo '<div id="left">';
				echo '<div id="detailed_img">';
					if($garmentRow['img'] == "N/A"){
						echo '<img src="../../immagini/place_holder.jpg">'; 
					} else {
						echo '<img src="../' . $garmentRow['img'] . '" alt="img">';
					}
				echo '</div>';
		
				echo '<div class="content_garment_wrapper">';
					echo '<span class="title_stats">Model: </span> ' . $garmentRow['model'] . '<br>';
					echo '<span class="title_stats">ID: </span> ' . $garmentRow['garmentId'] . '<br>';
					if($garmentRow['discountedPrice'] == NULL)
						echo '<span class="title_stats">Price: </span> ' . $garmentRow['price'] . ' €' . '<br>';
					else{
						echo '<span class="title_stats">Price: </span><del> ' . $garmentRow['price'] . ' €</del>';
						echo '<span class="discountedPrice"> ' . $garmentRow['discountedPrice'] . ' €</span><br>';
					}
				echo '</div>';		
			echo '</div>';
			echo '<div id="main">';
				if(isset($_SESSION['username'])){
					$userGarmentStatResult = getUserGarment($_SESSION['username'], $garmentRow['garmentId']);
					$userGarmentRow = null;
					if (mysqli_num_rows($userGarmentStatResult) == 1)
						$userGarmentRow = $userGarmentStatResult->fetch_assoc();
						
					showDesiredButton($garmentRow['garmentId'], $userGarmentRow);
				}
				echo '<div class="content_garment_wrapper">';
					echo '<h2>Color:</h2>' . $garmentRow['color'] . '<br>';
					echo '<h2>Size:</h2>' . '<select id="size_options" onChange="enableCartButton()"></select>' . '<br>';
				echo '</div>';
				echo '<p id = "go_to_measures">Not sure about the size? <a href="././myMeasures.php">Click here!</a></p>';
			if(isLogged())
				echo '<button id="add_to_cart" onClick="UserGarmentNavBarEventHandler.onCartEvent(' . $garmentRow['garmentId'] . '); UserGarmentNavBarEventHandler.onBadgeNumber()">Add to cart</button>';
			else
				echo '<button id=\'add_to_cart\' onClick="location.href=\'./loginPage.php\';">Add to cart</button>';
			echo '</div>';
		echo '</div>';
	}

	function showOrderDetails($result){
		$numOrders = mysqli_num_rows($result);
		if($numOrders != 1) { 
			showError();	
			return;
		}
		
		$orderRow = $result->fetch_assoc();
		echo '<h1 class="page_title">Order details</h1>';
		echo '<div id="detailed_order">';
			echo '<div id="general_info">';
				echo '<p class="orderDetailsInfo">Order number: ' . $orderRow['codice'] . '</p>';
				echo '<p class="orderDetailsInfo">Date placed: ' . $orderRow['data'] . '</p>';
				echo '<hr>';
				echo '<p class="orderDetailsInfo">Shipping information: ' . $orderRow['stato'] . '</p>';
				echo '<hr>';
				echo '<p class="orderDetailsInfo">Contact e-mail: ' . $orderRow['email'] . '</p>';
				echo '<p class="orderDetailsInfo">Payment method: ' . $orderRow['pagamento'] . '</p>';
				//echo '<hr>';
			echo '</div>';
			echo '<div class="items_container">';
				echo '<table id="shopping_cart_items" class="cart_container">';
						echo '<tr>';
							echo '<th colspan="1">Your items</th>';
							echo '<th colspan="1">Model</th>';
							echo '<th colspan="1">QUANTITY</th>';
							echo '<th colspan="1">SIZE</th>';
							echo '<th colspan="1">COLOR</th>';
							echo '<th colspan="1">PRICE</th>';
						echo '</tr>';
				echo '</table>';
			echo '</div>';
			echo '<br><br>';
			echo '<div class="totalPrice"><b>Total price: ' . $orderRow['totale'] . ' €</b></div>';	//A DESTRA GRANDE
		echo '</div>';
		echo '<br><br><br>';
	}

?>