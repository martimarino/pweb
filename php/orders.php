<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "session.php";
    include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "garmentManagerDb.php";
    include DIR_UTIL . "utility.php";

    if (!isLogged()){
		    header('Location: ./../index.php');
		    exit;
    }	
?>
<!DOCTYPE html>
<html>
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
	    <script type="text/javascript" src="../js/ajax/ajaxManager.js"></script>
		<script type="text/javascript" src="../js/ajax/GarmentLoader.js"></script>
		<script type="text/javascript" src="../js/ajax/OrderDashboard.js"></script>	
		<script type="text/javascript" src="../js/ajax/GarmentDashboard.js"></script>	
	    <title>Supernova-Orders</title>
  	</head>

	<?php

  		include"./layout/top_bar.php";
  		include DIR_LAYOUT . "profile_menu.php";

		echo '<body onLoad="GarmentLoader.loadOrder()">';
		echo '<div id="content">';
	?>
			<h1 id="personal_informations_title">Order history</h1>

	<?php
			
		echo '<section id="orderDashboard" class="order_dashboard"></section>';

		echo '</div>';

	?>
		<script type="text/javascript">
			document.getElementById("orders_link").setAttribute("class", "highlighted_text");
		</script>
	</body>
</html>