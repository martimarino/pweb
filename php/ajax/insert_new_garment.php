<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";	
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";	
	require_once DIR_UTIL . "verify_input.php";

	$response = new AjaxResponse();	

	if (!isset($_POST['model']) || !isset($_POST['color']) || !isset($_POST['category']) || !isset($_POST['genre']) || !isset($_POST['collection']) || !isset($_POST['price'])){
		return;
	}

	$model = $_POST['model'];
	$color = $_POST['color'];
	$category = $_POST['category'];
	$genre = $_POST['genre'];
	$collection = $_POST['collection'];
	$price = $_POST['price'];
	$image = "";

	$uploadWithSuccess = "";

	$errorMessage = "";
	$uploadWithSuccess = prepareImage();

	if(!$uploadWithSuccess)
	{
		$errorMessage =	verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price);

		if(!$errorMessage)
	}

	else 
	{
		$result = "./../php/admin_profile.php?errorMessage=" . $uploadWithSuccess;
	}

	function prepareImage()
	{

		if(!isset($_FILES['image_input']) || !is_uploaded_file($_FILES['image_input']['tmp_name'])){
			return 'Non hai inserito nessuna immagine...';
		}

		//percorso della cartella dove mettere i file caricati dagli utenti
		$uploaddir = '../../immagini/garments/';

		//recupero il percorso temporaneo del file
		$userfile_tmp = $_FILES['image_input']['tmp_name'];

		//recupero il nome originale del file caricato
		$userfile_name = explode(".", $_FILES['image_input']['name']);
		$last_file_id = lastId('garment', 'garmentId');
		$row = $last_file_id->fetch_assoc();
		$new_file_id = $row['lastId']+1;
		$new_userfile_name = 'garment' . $new_file_id;
		$image = $new_userfile_name;

		//copio il file dalla sua posizione temporanea alla mia cartella upload
		if(move_uploaded_file($userfile_tmp, $uploaddir . $new_userfile_name)){
			//se l'operazione è andata a buon fine..
			$query = garmentInsertion($model, $color, $category, $genre, $collection, $price, $image);
			if($query)
				header("location: ./../admin_profile.php");
			else
				return $query;
		}

	}

	function verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price)
	{
		if (($model == "") || ($model == "undefined") || ($color == "") || ($color == "undefined") || ($category == "") || ($category == "undefined") || ($genre == "") || ($genre == "undefined") || ($collection == "") || ($collection == "undefined") || ($price == "") || ($price == "undefined") || ($image == "") || ($image == "indefined"))
			return 'Some fields are empty';

		if(!preg_match("/[a-zA-Z]$/", $model))
			return 'Model input should be aphabetical';

		if(!preg_match("/[a-zA-Z]$/", $color))
			return 'Color input should be aphabetical';

		if(($collection != "A/I") && ($collection != "P/E"))
			return 'Collections available are A/I and P/E';

		if(($genre != "male") && ($genre != "female") && ($genre != "unisex"))
			return 'Genre options are: male, female, unisex';

		if(!preg_match("/[0-9]+\.+[0-9]{2}$/", $price))
			return "Price invalid (insert decimal)";

	}

?>