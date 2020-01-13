<?php
    require_once "./supernovaDbManager.php"; //includes Database Class
    require_once "./session.php"; //includes session util functions
echo "CIAO";
    $email = $_POST['newsletter'];

    $errorMessage = "";
    $errorMessage = setNewsletterFlag($email);
    
    if(!$errorMessage)
		header('Location: ./../../index.php?errorMessage=Now you can receive our news!');

	else
		header('Location: ./../../index.php?errorMessage=' . $errorMessage);

	function setNewsletterFlag($email)
	{
	    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) 
	    	return 'Insert a valid email address';

	    if($email != null)
	    {
	    	$verify = verifyEmail($email);
	    	echo $verify;
		    return $verify;
    	}
    	return 'Empty field';

	}

	function verifyEmail($email){

		global $supernovaDb;

	    $email = $supernovaDb->sqlInjectionFilter($email);

		$queryText = "select * from user where email='" . $email . "';";
		$result = $supernovaDb->performQuery($queryText);
		if(mysqli_num_rows($result) != 1)
			return 'User not registered';

		$res = $supernovaDb->performQuery($query);
		$supernovaDb->closeConnection();

		$query = "UPDATE user SET newsletter = 1 WHERE email = '" . $email . "';";
		$res = $supernovaDb->performQuery($query);

		return (!$res);
	}
?>