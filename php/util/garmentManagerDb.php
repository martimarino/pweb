<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "supernovaDbManager.php"; //includes Database Class
 	

	function getAllGarments($offset, $numRecord){  
		global $supernovaDb;
		$offset = $supernovaDb->sqlInjectionFilter($offset);
		$numRecord = $supernovaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * '
						. 'FROM garment '
						. 'LIMIT ' . $offset . ',' . $numRecord;
						
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getGarmentById($garmentId){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$queryText = 'SELECT * '
						. 'FROM garment '
						. 'WHERE garmentId = \'' . $garmentId . '\'';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function getUserGarmentStat($email, $garmentId){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
 		$queryText = 'SELECT * '
					. 'FROM user_garment '
					. 'WHERE email = \'' . $email . '\' AND garmentId = \'' . $garmentId . '\'';
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}	

	function getDesiredGarments($email, $offset, $numRecord){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
 		$offset = $supernovaDb->sqlInjectionFilter($offset);
		$numRecord = $supernovaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT g.* '
					. 'FROM user_garment ug JOIN garment g ON ug.garmentId = g.garmentId '
					. 'WHERE ug.email = \'' . $email . '\' AND ug.desired = 1 '
					. 'LIMIT ' . $offset . ',' . $numRecord ;
 		
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function getInCartGarments($email, $offset, $numRecord){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
 		$offset = $supernovaDb->sqlInjectionFilter($offset);
		$numRecord = $supernovaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT g.* '
					. 'FROM user_garment ug JOIN garment g ON ug.garmentId = g.garmentId '
					. 'WHERE ug.email = \'' . $email . '\' AND ug.inCart = 1 '
					. 'LIMIT ' . $offset . ',' . $numRecord ;
 		
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function getGarmentLikesOrDislikes($garmentId, $like_dislke){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($garmentId);
		$like_dislake = $supernovaDb->sqlInjectionFilter($like_dislke);
 		$queryText = 'SELECT COUNT(*) as num '
					. 'FROM user_garment '
					. 'WHERE garmentId = \'' . $garmentId . '\' AND isLiked = ' . $like_dislake;
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function getGarmentLikes($garmentId){
 		return getGarmentLikesOrDislikes($garmentId, 1);
	}
	
	function getGarmentDislikes($garmentId){
		 return getGarmentLikesOrDislikes($garmentId, 0);
	}
	
	function getSearchGarmentsByModel($pattern){
		global $supernovaDb;
		$pattern = $supernovaDb->sqlInjectionFilter($pattern);
		$queryText = 'SELECT * ' 
					. 'FROM garment '
					. 'WHERE model LIKE \'%' . $pattern . '%\''; 
 	
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}

	function insertDesiredUserGarmentStat($garmentId, $email, $desiredFlag){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
 		$desiredFlag = $supernovaDb->sqlInjectionFilter($desiredFlag);
		$queryText = 'INSERT INTO user_garment (id, email, garmentId, desired, inCart, isLiked) ' 
						. 'VALUES (NULL, \'' . $email . '\', \'' . $garmentId . '\', ' . $desiredFlag . ', 0, NULL)';
 	
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function updateDesiredUserGarmentStat($garmentId, $email, $desiredFlag){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$desiredFlag = $supernovaDb->sqlInjectionFilter($desiredFlag);
		$queryText = 'UPDATE user_garment '
					. 'SET desired=' . $desiredFlag . ' '
					. 'WHERE email=\'' . $email . '\' AND garmentId = \'' . $garmentId . '\'';
 		return $supernovaDb->performQuery($queryText);
	}

	function insertInCartUserGarmentStat($garmentId, $email, $inCartFlag){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$inCartFlag = $supernovaDb->sqlInjectionFilter($inCartFlag);
		$queryText = 'INSERT INTO user_garment (id, email, garmentId, desired, inCart, isLiked) ' 
						. 'VALUES (NULL, \'' . $email . '\', \'' . $garmentId . '\', 0, ' . $inCartFlag . ', NULL)';
 	
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function updateInCartUserGarmentStat($garmentId, $email, $inCartFlag){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$inCartFlag = $supernovaDb->sqlInjectionFilter($inCartFlag);
		$queryText = 'UPDATE user_garment '
					. 'SET inCart=' . $inCartFlag . ' '
					. 'WHERE email=\'' . $email . '\' AND garmentId = \'' . $garmentId . '\'';
 		return $supernovaDb->performQuery($queryText);
	}
	
	function insertLikeDislikeUserGarmentStat($garmentId, $email, $preference){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$preference = $supernovaDb->sqlInjectionFilter($preference);
		$queryText = 'INSERT INTO user_garment (id, email, garmentId, desired, inCart, isLiked) ' 
						. 'VALUES (NULL, \'' . $email . '\', \'' . $garmentId . '\', 0, 0, ' . $preference . ')';
 		
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
	
	function updateLikeDislikeUserGarmentStat($garmentId, $email, $preference){
		if ($preference === null)
			$preference = "null";
			
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$preference = $supernovaDb->sqlInjectionFilter($preference);
		$queryText = 'UPDATE user_garment '
					. 'SET isLiked= ' . $preference . ' '
					. 'WHERE email = \'' . $email . '\' AND garmentId = \'' . $garmentId . '\'';
 	
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}


    function getFilterGarments($offset, $numRecord, $field, $value){
		global $supernovaDb;
		$offset = $supernovaDb->sqlInjectionFilter($offset);
		$numRecord = $supernovaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * '
						. 'FROM garment '
						. 'WHERE ' . $field . ' = \'' . $value . '\' '
						. 'LIMIT ' . $offset . ',' . $numRecord;

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
    }

	function getUserOrders($email){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$queryText = 'SELECT * '
						. 'FROM `order` '
						. 'WHERE email = ' . '\'' . $email . '\' ';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}

	function getOrderById($orderId){
		global $supernovaDb;
		$orderId = $supernovaDb->sqlInjectionFilter($orderId);
		$queryText = 'SELECT * '
						. 'FROM `order` '
						. 'WHERE codice = ' . $orderId;

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}

	function getOrderGarments($orderId){
		global $supernovaDb;
		$orderId = $supernovaDb->sqlInjectionFilter($orderId);
		$queryText = 'SELECT O.orderId, O.garmentId, G.model, '
						. 'O.quantity, O.garmentSize, O.color, O.price '
						. 'FROM `order_garment` O JOIN `garment` G ON O.garmentId = G.garmentId '
						. 'WHERE orderId = ' . $orderId;

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getHowManyInCart($email){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$queryText = 'SELECT COUNT(*) AS cartBadge '
						. 'FROM user_garment '
						. 'WHERE email = \'' . $email . '\' AND inCart = 1';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getAllGarmentsID(){
		global $supernovaDb;
		$queryText = 'SELECT garmentId '
						. 'FROM garment';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getAllOrdersID(){
		global $supernovaDb;
		$queryText = 'SELECT codice '
						. 'FROM `order`';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getAllCollections(){
		global $supernovaDb;
		$queryText = 'SELECT DISTINCT collection '
						. 'FROM garment';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;		
	}

	function getStock(){
		global $supernovaDb;
		$queryText = 'SELECT * '
						. 'FROM `stock`';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;		
	}

	function getAllGarmentSize($garmentId){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$queryText = 'SELECT * '
						. 'FROM `stock` '
						. 'WHERE garmentId = \''. $garmentId . '\'';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getHowManyInWishList($email){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$queryText = 'SELECT COUNT(*) AS wishlistBadge '
						. 'FROM user_garment '
						. 'WHERE email = \'' . $email . '\' AND desired = 1';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getActualValueFromField($garmentId, $field){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$field = $supernovaDb->sqlInjectionFilter($field);
		$queryText = 'SELECT ' . $field . ' '
						. 'FROM garment '
						. 'WHERE garmentId = \'' . $garment . '\'';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function getActualValue($table, $field, $fieldToFind, $value){
		global $supernovaDb;
		$table = $supernovaDb->sqlInjectionFilter($table);
		$field = $supernovaDb->sqlInjectionFilter($field);
		$fieldToFind = $supernovaDb->sqlInjectionFilter($fieldToFind);
		$value = $supernovaDb->sqlInjectionFilter($value);
		$queryText = 'SELECT ' . $fieldToFind . ' '
						. 'FROM `' . $table . '` '
						. 'WHERE ' . $field . ' = \'' 
						. $value . '\''; 
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

	function garmentInsertion($model, $color, $category, $genre, $collection, $price, $image){
		global $supernovaDb;
		$model = $supernovaDb->sqlInjectionFilter($model);
		$color = $supernovaDb->sqlInjectionFilter($color);
		$category = $supernovaDb->sqlInjectionFilter($category);
		$genre = $supernovaDb->sqlInjectionFilter($genre);
		$collection = $supernovaDb->sqlInjectionFilter($collection);
		$price = $supernovaDb->sqlInjectionFilter($price);
		$image = $supernovaDb->sqlInjectionFilter($image);

		$queryText = 'INSERT INTO garment (garmentId, model, color, category, genre, collection, released, price, img) ' 
						. 'VALUES (NULL, \'' . $model . '\', '
						. '\'' . $color . '\', ' 
						. '\'' . $category . '\', '
						. '\'' . $genre . '\', '
						. '\'' . $collection . '\', '
						. date("Y-m-d") . ', '
						. '\'' . $price . '\', '
						. '\'' . $image . '\')'; 

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;	
	}

	function modifyGarment($garmentId, $field, $newValue){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$field = $supernovaDb->sqlInjectionFilter($field);
		$newValue = $supernovaDb->sqlInjectionFilter($newValue);

		$queryText = 'UPDATE garment '
					. 'SET ' . $field . '= \'' .$newValue . '\' '
					. 'WHERE garmentId = \''. $garmentId . '\'';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();	
		return $result;		
	}

	function deleteGarment($garmentId){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);

		$queryText = 'DELETE FROM garment '
					. 'WHERE garmentId = \''. $garmentId . '\'';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();	
		return $result;			
	}

	function getElementsToDiscount($collection){
		global $supernovaDb;
		$collection = $supernovaDb->sqlInjectionFilter($collection);
		$queryText = 'SELECT garmentId, price '
						. 'FROM garment '
						. 'WHERE collection = \'' . $collection . '\'';
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();	
		return $result;							
	}

	function insertNewSale($garmentId, $newPrice){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$newPrice = $supernovaDb->sqlInjectionFilter($newPrice);

		$queryText = 'UPDATE garment '
					. 'SET discountedFlag = 1 AND '
					. 'price = \''. $newPrice . '\' '
					. 'WHERE garmentId = \'' . $garmentId . '\'';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();	
		return $result;			
	}

	function modifyOrder($orderId, $field, $value){
		global $supernovaDb;
		$orderId = $supernovaDb->sqlInjectionFilter($orderId);
		$field = $supernovaDb->sqlInjectionFilter($field);
		$value = $supernovaDb->sqlInjectionFilter($value);

		$queryText = 'UPDATE `order` '
					. 'SET ' . $field . '= \'' . $value . '\' '
					. 'WHERE codice = \''. $orderId . '\'';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();	
		return $result;			
	}

	function modifyStockQuantity($garmentId, $size, $quantity){
		global $supernovaDb;
		$garmentId = $supernovaDb->sqlInjectionFilter($garmentId);
		$size = $supernovaDb->sqlInjectionFilter($size);
		$quantity = $supernovaDb->sqlInjectionFilter($quantity);

		$queryText = 'UPDATE `stock` '
					. 'SET quantity = \'' . $quantity . '\' '
					. 'WHERE garmentId = \''. $garmentId . '\' '
					. 'AND size = \'' . $size . '\'';

		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();	
		return $result;				
	}

?>
