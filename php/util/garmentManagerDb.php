<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "supernovaDbManager.php"; //includes Database Class
 	
	function getLatestGarments($offset, $numRecord){  
		global $supernovaDb;
//		$today = date('Y-m-d');
		$today = DateTime::createFromFormat('m-d-Y', '12-01-2014')->format('Y-m-d');
		$today = $supernovaDb->sqlInjectionFilter($today);
		$offset = $supernovaDb->sqlInjectionFilter($offset);
		$numRecord = $supernovaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * '
						. 'FROM garment '
						. 'WHERE released <= \'' . $today . '\' '
						. 'ORDER BY released DESC '
						. 'LIMIT ' . $offset . ',' . $numRecord;
						
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result;
	}

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
	
	/*
	function getUpcomingGarments($offset, $numRecord){
		global $supernovaDb;
//		$today = date('Y-m-d');
		$today = DateTime::createFromFormat('m-d-Y', '12-01-2014')->format('Y-m-d');
		$today = $supernovaDb->sqlInjectionFilter($today);
		$offset = $supernovaDb->sqlInjectionFilter($offset);
		$numRecord = $supernovaDb->sqlInjectionFilter($numRecord);
		$queryText = 'SELECT * '
					. 'FROM garment '
					. 'WHERE  > \'' . $today . '\' '
					. 'ORDER BY  ASC '
					. 'LIMIT ' . $offset . ',' . $numRecord;
					
		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
	}
*/
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
	
	function getGarmentLikesOrDislikes($garmentId, $like_dislake){
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($garmentId);
		$like_dislake = $supernovaDb->sqlInjectionFilter($like_dislake);
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
					. 'SET desired=' . $desiredFlag
					. 'WHERE email=\'' . $email . '\' AND garmentId = \'' . $garmentId . '\'';
 		
 		$result = $supernovaDb->performQuery($queryText);
		$supernovaDb->closeConnection();
		return $result; 
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
						. 'VALUES (NULL, \'' . $email . '\', \'' . $garmentId . '\', 1, 0, ' . $preference . ')';
 		
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
?>
