<?php
    require_once "./supernovaDbManager.php"; //includes Database Class
    require_once "./session.php"; //includes session util functions
 
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$errorMessage = login($email, $password);
	$supernovaDb->closeConnection();
	header('location: ./../loginPage.php?errorMessage=' . $errorMessage );
	//echo $errorMessage;

	function login($email, $password){   
		if ($email != null && $password != null){
			
			$userId = authenticate($email, $password);
			if($userId != null)
			{
				session_start();
				setSession($email, $userId);
				if($userId == "amministratore"){
					header('Location: ../admin_profile.php');
				}
				if($userId == "cliente"){
					header('Location: ../wishList.php');
				}
				return null;
			}
    	} 
    	else
    		return 'You should insert something';
    	
    	return 'E-mail and password not valid.';
	}
	
	function authenticate ($email, $password){   
		global $supernovaDb;
		$email = $supernovaDb->sqlInjectionFilter($email);
		$password = $supernovaDb->sqlInjectionFilter($password);

		$queryText = "select amministratore from user where email='" . $email . "' AND password='" . $password . "'";

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