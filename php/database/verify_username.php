<?php

	$username = $connection->sqlInjectionFilter($_POST['email']);

	global $connection;
	$username = $connection->sqlInjectionFilter($username);
	
	$query = "select * from users where username='" . $username . "'";
	$result = $connection->performQuery($query);
	$numRow = mysqli_num_rows($result);
	$connection->closeConnection();

	if($numRow)
	{
		echo false;
	}
	else
		echo true;

?>