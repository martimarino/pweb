<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";	
	require_once DIR_UTIL . "verify_input.php";

	$response = new AjaxResponse();	

	if (!isset($_POST['ID']) || !isset($_POST['garmentField'])){
		return;
	}	

	$garmentId = $_POST['ID']; 
	$field = $_POST['garmentField'];

	switch ($field) 
    {
        case 'model':
        case 'color':
        case 'price':
        case 'discountedPrice':
            $newValue = $_POST['new_garment_value'];
            break;
        
        case 'category':
        case 'genre':
        case 'collection':
            $newValue = $_POST['new_garment_value_option'];
            break;
        case 'img':
        	if (!isset($_FILES['new_garment_value_option']) || !is_uploaded_file($_FILES['new_garment_value_option']['tmp_name'])) {
		  		$errorMessage = 'Non hai inviato nessun file...';
		  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		  		exit;
			}

			//Verifica se il file è effettivamente un'immagine
			if (!getimagesize($_FILES['new_garment_value_option']['tmp_name'])){
		  		$errorMessage = 'Puoi inviare solo immagini.';
		  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		  		exit;
			}

			//percorso della cartella dove mettere i file caricati dagli utenti
			$uploaddir = '../../immagini/garments/';

			//Recupero il percorso temporaneo del file
			$userfile_tmp = $_FILES['new_garment_value_option']['tmp_name'];

			//recupero il nome originale del file caricato
			$userfile_name = explode(".", $_FILES['new_garment_value_option']['name']);
			$new_userfile_name = 'garment' . $garmentId . "." . end($userfile_name);

			//copio il file dalla sua posizione temporanea alla mia cartella upload
			if (move_uploaded_file($userfile_tmp, $uploaddir . $new_userfile_name)) {
		  		//Se l'operazione è andata a buon fine...

		  		$newValue = $new_userfile_name;
			}

			else{
		  		//Se l'operazione è fallta...
		  		$errorMessage = 'Upload NON valido!';
		  		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		  		
			}

            break;

        default:
        	break;
    }

	$errorMessage = "";
	$errorMessage = verifyModifyGarmentInput($field, $newValue);

	function verifyModifyGarmentInput($field, $newValue)
	{ 
		if (($newValue == "") || ($newValue == "undefined")){
			return 'Empty field';
		}

		if (($field == "model") || ($field == "color")){
			if(!preg_match("/[a-zA-Z]$/", $newValue)){
				return "Input should be alphabetical";
			}
		}

		if(($field == "price") || ($field == "discountedPrice"))
			if(!preg_match("/[0-9]\.[0-9]{2}$/", $newValue))
				return "Input should be a real number (es '50.00')";
	}

	if(!$errorMessage){
		$query = modifyGarment($garmentId, $field, $newValue);

		if($query){
			$errorMessage = "Modified with success";
			header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);
		}
	}

	else {
		header("location: ./../admin_profile.php?errorMessage=" . $errorMessage);		
	}



?>