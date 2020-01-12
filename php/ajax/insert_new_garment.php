<?php
	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";	
	require_once DIR_UTIL . "verify_input.php";

	if (!isset($_FILES['image_input']) || !is_uploaded_file($_FILES['image_input']['tmp_name'])) {
  		$errorMessage = 'Non hai inviato nessun file...';
  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
  		exit;
	}

	//Verifica se il file è effettivamente un'immagine
	if (!getimagesize($_FILES['image_input']['tmp_name'])){
  		$errorMessage = 'Puoi inviare solo immagini.';
  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
  		exit;
	}

	//percorso della cartella dove mettere i file caricati dagli utenti
	$uploaddir = '../../immagini/garments/';

	//Recupero il percorso temporaneo del file
	$userfile_tmp = $_FILES['image_input']['tmp_name'];

	//recupero il nome originale del file caricato
	$userfile_name = explode(".", $_FILES['image_input']['name']);
	$last_file_id = lastId('garment', 'garmentId');
	$row = $last_file_id->fetch_assoc();
	$new_file_id = $row['lastId']+1;
	$new_userfile_name = 'garment' . $new_file_id . "." . end($userfile_name);

	//copio il file dalla sua posizione temporanea alla mia cartella upload
	if (move_uploaded_file($userfile_tmp, $uploaddir . $new_userfile_name)) {
  		//Se l'operazione è andata a buon fine...

  		$errorMessage = addImage($new_file_id, $new_userfile_name);
  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
	}

	else{
  		//Se l'operazione è fallta...
  		$errorMessage = 'Upload NON valido!';
  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
  		
	}

	function verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price)
	{
		if (($model == "") || ($model == "undefined") || ($color == "") || ($color == "undefined") || ($category == "undefined") || ($genre == "undefined") || ($collection == "undefined") || ($price == "") || ($price == "undefined"))
			return 'Some fields are empty';

		if(!preg_match("/[a-zA-Z]$/", $model))
			return 'Model input should be aphabetical';

		if(!preg_match("/[a-zA-Z]$/", $color))
			return 'Color input should be aphabetical';

		if(!preg_match("/[0-9]+\.+[0-9]{2}$/", $price))
			return "Price invalid (insert decimal)";

	}

	function addImage($id, $image){

		$model = $_POST['model_input'];  
		$color = $_POST['color_input'];
		$category = $_POST['category_input'];
		$genre = $_POST['genre_input'];
		$collection = $_POST['collection_input'];
		$price = $_POST['price_input'];

		$verify = verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price);
		if(!$verify){ 
			$query = garmentInsertion($id, $model, $color, $category, $genre, $collection, $price, $image);
			if($category == 'clothing')
				$stockQuery = insertDefaultClothingSizeInStock($id);
			else
				$stockQuery = insertDefaultAccessoriesSizeInStock($id);
			if($query && $stockQuery)
				return 'Garment added with success';
			return $query;
		}
		return $verify;
	}

?> 