<?php
	session_start(); // serve ad aprire la sessione
	include("db_con.php"); // includo il file di connessione al database
	
	if($_POST["firstname"] != "" && $_POST["lastname"] != "" && $_POST["email"] != "" && $_POST["password"]!= "" && $_POST["confirm"] != ""){  // se i parametri non sono vuoti
		$query_registrazione = mysql_query("INSERT INTO user (name,surname,e-mail,password,gender)
		VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["email"]."','".$_POST["password"]."','".$_POST["gender"]."')") // scrivo sul DB questi valori
		or die ("query di registrazione non riuscita".mysql_error()); // se la query fallisce mostrami questo errore
	}else{
		header('location:index.php?action=registration&errore=Non hai compilato tutti i campi obbligatori'); // se le prime condizioni non vanno bene entra in questo ramo else
	}
	
	if(isset($query_registrazione)){ //se la reg è andata a buon fine
		$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
		header("location:index.php");
	}else{
		echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa
	}
?>