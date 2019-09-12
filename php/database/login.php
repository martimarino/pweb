<?php
	require_once "../database/connection.php";
	require_once "./session.php";

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$errore = login($username, $password);
	$connection->closeConnection();
	echo $errore;
	

	function login($username, $password){

		if($username != null && $password != null){

			$result = identifica($username, $password);
			
			if($result == "amministratore") {
				return "../php/admin_profile.php";
			}

    		if($result == "base"){
    			return "../php/profile.php";
    		}
    	}
		
		else 
			return 'Manca username e/o password.';
    	
    	return 'Username e/o password non valido.';
	}
	
	function identifica($username, $password){

		global $connection;
		$username = $connection->sqlInjectionFilter($username);
		$password = $connection->sqlInjectionFilter($password);

		$query = "select amministratore from users where username='" . $username . "' AND password='" . $password . "'";

		$result = $connection->performQuery($query);

		$numRow = mysqli_num_rows($result);

		if($numRow) {
			session_start();
			setSession($username);
			$amm = "";
			while ($row = $result->fetch_assoc()){
				$amm = $row['amministratore'];
			}

			if($amm == 1){	// accesso amministratore
				
				return "amministratore";
			}
			
			return "base";
		}
		
		return null;
	}
?>