<?php

	require "config.php";
	$connection = new connection();	//istanzio la classe

	class connection
	{
		private $mysqli_conn = null;

		function connection()		//apre la connessione
		{
			$this->openConnection();
		}

		function openConnection()	
		{
			if (!$this->isOpened()) 	//se la connessione non è già aperta
			{
				global $dbHostname;
				global $dbUsername;
				global $dbPassword;
				global $dbName;

				$this->mysqli_conn = new mysqli($dbHostname, $dbUsername, $dbPassword);	//ne apre una nuova

				if($this->mysqli_conn->connect_error)
					die('Connect Error (' . $this->mysqli_conn->connect_errno . ') ' . $this->mysqli_conn->connect_error);

				$this->mysqli_conn->select_db($dbName) or die ('Can\'t use pweb: ' . mysql_error());
			}
		}

		function isOpened()
		{	
			return ($this->mysqli_conn != null);
		}

		function performQuery($queryText)	//esegue la query e ne restituisce il risultato
		{
			if(!$this->isOpened())
				$this->openConnection();
			return $this->mysqli_conn->query($queryText);
		}

		function sqlInjectionFilter($parameter)
		{
			if(!$this->isOpened())
				$this->openConnection();

			return $this->mysqli_conn->real_escape_string($parameter);
		}


		function prepareQuery($text)
		{
			if(!$this->isOpened())
				$this->openConnection();

			return $this->mysqli_conn->prepare($text);
		}

		function closeConnection()
		{
			if($this->mysqli_conn != null)
				$this->mysqli_conn->close();

			$this->mysqli_conn = null;
		}

	}

?>
