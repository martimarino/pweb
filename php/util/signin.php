<?php
    require_once "./supernovaDbManager.php"; //includes Database Class
    require_once "./session.php"; //includes session util functions

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $errorMessage = "";
    $errorMessage = registration($firstname, $lastname, $email, $gender, $password, $confirm);
    
    if(!$errorMessage)
		header('Location: ../wishList.php');

	else
		header('Location: ./../registration.php?errorMessage=' . $errorMessage);

	function registration($firstname, $lastname, $email, $gender, $password, $confirm)
	{
	    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) 
	    	return 'Insert a valid email address';

	    if($password != $confirm)
	    	return 'Different password and confirm password';

	    if($firstname != null && $lastname != null && $email != null && $password != null && $confirm != null)
	    {
	    	$verify = verifyUsername($firstname, $lastname, $email, $gender, $password, $confirm);
	    	echo $verify;
		    return $verify;
    	}
    	return 'Some fields are empty';

	}

	function verifyUsername($firstname, $lastname, $email, $gender, $password, $confirm){
				
		global $supernovaDb;

		$firstname = $supernovaDb->sqlInjectionFilter($firstname);
	    $lastname = $supernovaDb->sqlInjectionFilter($lastname);
	    $email = $supernovaDb->sqlInjectionFilter($email);
	    $gender = $supernovaDb->sqlInjectionFilter($gender);
	    $password = $supernovaDb->sqlInjectionFilter($password);
	    $confirm = $supernovaDb->sqlInjectionFilter($confirm);

		$queryText = "select * from user where email='" . $email . "';";
		$result = $supernovaDb->performQuery($queryText);
		if(mysqli_num_rows($result) == 1)
			return 'User already registered';

		$query = "insert into user values ('" . $email . "', '" . $password . "', '" . 0 . "', '" . $firstname . "', '" . $lastname . "', '" . $gender . "');";
		$res = $supernovaDb->performQuery($query);
		$supernovaDb->closeConnection();

		session_start();
	    setSession($email, "cliente");

		return (!$res);
	}
?>