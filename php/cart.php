<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "session.php";
    include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "garmentManagerDb.php";
    include DIR_UTIL . "utility.php";

    if (!isLogged()){
		    header('Location: ./../index.php?errorMessage=You are not logged');
		    exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <meta name = "author" content = "Martina Marino">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Supernova">
	    <link rel="stylesheet" href="../css/profile.css" type="text/css" media="screen"> 
	    <link rel="stylesheet" href="../css/order.css" type="text/css" media="screen"> 
	    <link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 
	    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script src="./../js/ajax/ajaxManager.js"></script>	
		<script src="./../js/ajax/userGarmentNavBarEventHandler.js"></script>	
		<script src="./../js/ajax/GarmentLoader.js"></script>
		<script src="./../js/ajax/CartDashboard.js"></script>	
		<script src="./../js/ajax/GarmentDashboard.js"></script>	
	    <title>Supernova-Wish list</title>
  	</head>

	<?php

  		include"./layout/top_bar.php";
  		include DIR_LAYOUT . "profile_menu.php";

  		echo '<body onLoad="GarmentLoader.loadCart()">';
		echo '<div id="content">';

	?>

	<h1 id="personal_informations_title">Your cart</h1>

	<?php

		echo '<section id="cartDashboard" class="cart_dashboard"></section>';

	?>

	</body>
</html>