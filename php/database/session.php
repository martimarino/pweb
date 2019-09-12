<?php

	function setSession($username)
	{
		$_SESSION['username'] = $username;
	}

	function isLogged()
	{
		if(isset($_SESSION['username']))
			return true;
		else
			return false;
	}

?>