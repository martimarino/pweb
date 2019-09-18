<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "sessionUtil.php";
	require_once DIR_UTIL . "garmentManagerDb.php";	
	require_once DIR_LAYOUT . "message.php";
	
	function showUserStat($garmentId, $userGarmentRow){
		echo '<nav id="user_garment_nav_bar_' . $garmentId . '">';	
		
		// desired nav bar item
		$currentFlag = false; //desired flag
		if ($userGarmentRow != null AND $userGarmentRow['desired'] != null AND $userGarmentRow['desired'] == 1)
			$currentFlag = true;
		echo '<div id="desiredItem_' . $garmentId . '" class="nav_garment_item check_img_' . (int)$currentFlag . '" ';
		echo 'onClick="UserGarmentNavBarEventHandler.desiredEvent(' . $garmentId . ')">';
		echo '</div>';
			
		// inCart nav bar item		
		$currentFlag = false; //inCart flag
		if ($userGarmentRow != null AND $userGarmentRow['inCart'] != null AND $userGarmentRow['inCart'] == 1)
				$currentFlag = true;
		echo '<div id="inCartItem_' . $garmentId . '" class="nav_garment_item in_cart_img_' . (int)$currentFlag . '" ';
		echo 'onClick="UserGarmentNavBarEventHandler.onInCartEvent(' . $garmentId . ')">';
		echo '</div>';
		
		// like nav bar item
		$currentFlag = false; //like flag
		if ($userGarmentRow != null AND $userGarmentRow['isLiked'] != null AND $userGarmentRow['isLiked'] == 1)
			$currentFlag = true;
		echo '<div id="likeItem_' . $garmentId . '" class="nav_garment_item like_img_' . (int)$currentFlag . '" ';
		echo 'onClick="UserGarmentNavBarEventHandler.onLikeEvent(' . $garmentId . ')">';
		echo '</div>';
		showGarmentLikes($garmentId);
		
		// dislike nav bar item
		$currentFlag = false; //dislike flag
		if ($userGarmentRow != null AND $userGarmentRow['isLiked'] != null AND $userGarmentRow['isLiked'] == 0)
			$currentFlag = true;
		echo '<div id="dislikeItem_' . $garmentId . '" class="nav_garment_item dislike_img_' . (int)$currentFlag . '" ';
		echo 'onClick="UserGarmentNavBarEventHandler.onDislikeEvent(' . $garmentId . ')">';
		echo '</div>';
		showGarmentDislikes($garmentId);
		
		echo '</nav>';	
	}
	
	function showGarmentLikes($garmentId){
		echo '<div id="likeCountItem_' . $garmentId . '" class="nav_garment_item stats_user_garment">';
		$numLikesResult = getGarmentLikes($garmentId);
		$numLikesRow = $numLikesResult->fetch_assoc();
		echo '(' . $numLikesRow['num'] . ')';
		echo '</div>';		
	}
	
	function showGarmentDislikes($garmentId){
		echo '<div id="dislikeCountItem_' . $garmentId . '" class="nav_garment_item stats_user_garment">';
		$numDislikesResult = getGarmentDislikes($garmentId);
		$numDislikesRow = $numDislikesResult->fetch_assoc();
		echo '(' . $numDislikesRow['num'] . ')';
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
			echo '<img src="' . $garmentRow['img'] . '" alt="img">';
		}
		echo '</div>';
		
		echo '<div class="content_garment_wrapper">';
		echo '<span class="title_stats">Model</span>: ' . $garmentRow['model'] . '<br>';
		echo '<span class="title_stats">ID: </span>: ' . $garmentRow['garmentId'] . '<br>';
		echo '<span class="title_stats">Price</span>: ' . $garmentRow['price'] . '<br>';
		echo '</div>';		
		echo '</div>';
		echo '<div id="main">';
		
		$userGarmentStatResult = getUserGarmentStat($_SESSION['username'], $garmentRow['garmentId']);
		$userGarmentRow = null;
		if (mysqli_num_rows($userGarmentStatResult) == 1)
			$userGarmentRow = $userGarmentStatResult->fetch_assoc();
			
		showUserStat($garmentRow['garmentId'], $userGarmentRow);
		
		echo '<div class="content_garment_wrapper">';
		echo '<h2>Size:</h2>';
		echo $garmentRow['size'] . '<br>';		
		echo '</div>';
		echo '<div class="content_garment_wrapper">';
		echo '<h2>Color:</h2>';
		echo '<span><span class="title_stats">Director</span>: ' . $garmentRow['color'] . '</span><br>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
?>