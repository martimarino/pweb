<?php
    require_once "./supernovaDbManager.php"; //includes Database Class
    require_once "./session.php"; //includes session util functions
 
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$errorMessage = login($username, $password);
	$supernovaDb->closeConnection();
	echo $errorMessage;

	function login($username, $password){   
		if ($username != null && $password != null){
			
			$userId = authenticate($username, $password);
			if($userId != null)
			{
				session_start();
				setSession($username, $userId);
				if($userId == "amministratore"){
					header('Location: ../admin_profile.php');
				}
				if($userId == "cliente"){
					header('Location: ../profile.php');
				}
				return null;
			}
    	} 
    	else
    		return 'You should insert something';
    	
    	return 'Username and password not valid.';
	}
	
	function authenticate ($username, $password){   
		global $supernovaDb;
		$username = $supernovaDb->sqlInjectionFilter($username);
		$password = $supernovaDb->sqlInjectionFilter($password);

		$queryText = "select amministratore from user where username='" . $username . "' AND password='" . $password . "'";

		$result = $supernovaDb->performQuery($queryText);
		$numRow = mysqli_num_rows($result);
		if ($numRow){
			$amm = "";
			while ($row = $result->fetch_assoc()) {
				$amm = $row['amministratore'];
			}
			if($amm == 1){
				return "amministratore";
			}
			return "cliente";
		}
		return null;
	}

?>