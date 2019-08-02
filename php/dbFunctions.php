<?php

require "configuraDB.php";
$supernova = new supernova(); // creo un'istanza della classe database 

class supernova{
	private $mysqli_conn = null;

	function supernova(){	//funzione che apre la connessione
		$this->openConnection();
	}

	function openConnection(){ 		//controlla che la connessione sia aperta o meno

    	if (!$this->isOpened()){	//se non lo è cerca di aprirla
    		global $dbHostname;
    		global $dbUsername;
    		global $dbPassword;
    		global $dbName;
    			
    		$this->mysqli_conn = new mysqli($dbHostname, $dbUsername, $dbPassword);

			if ($this->mysqli_conn->connect_error) 
				die('Connect Error (' . $this->mysqli_conn->connect_errno . ') ' . $this->mysqli_conn->connect_error);

			$this->mysqli_conn->select_db($dbName) or die ('Can\'t use pweb: ' . mysqli_error());
		}//altrimenti non fa nulla

    }

    //Check if the connection to the database id opened
    function isOpened(){
       	return ($this->mysqli_conn != null);
    }

   	// Executes a query and returns the results
	function performQuery($queryText) {
		if (!$this->isOpened())
			$this->openConnection();
			
		return $this->mysqli_conn->query($queryText);
	}
		
	function sqlInjectionFilter($parameter){
		if(!$this->isOpened())
			$this->openConnection();
				
		return $this->mysqli_conn->real_escape_string($parameter);
	}

	function prepareQuery($text){
		if(!$this->isOpened())
			$this->openConnection();

		return $this->mysqli_conn->prepare($text);

	}

	function closeConnection(){
 	    //Close the connection
 	    if($this->mysqli_conn !== null)
			$this->mysqli_conn->close();
			
		$this->mysqli_conn = null;
	}
	
}
?>