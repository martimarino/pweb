<?php

	session_start();
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "garmentManagerDb.php";

	if (!isset($_GET['model']) || !isset($_GET['color']) || !isset($_GET['category']) || !isset($_GET['genre']) || !isset($_GET['collection']) || !isset($_GET['price']) || !isset($_GET['image'])){
		return;
	}	

	$model = $_GET['model']; 
	$color = $_GET['color'];
	$category = $_GET['category'];
	$genre = $_GET['genre'];
	$collection = $_GET['collection'];
	$price = $_GET['price'];
	$image = $_GET['image'];
	
	$errore = garmentInsertion($model, $color, $category, $genre, $collection, $price, $image);

	echo $errore;
?>