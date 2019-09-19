<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "session.php";
    include DIR_UTIL . "supernovaDbManager.php";
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
	    <link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 
	    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script type="text/javascript" src="./../js/ajax/ajaxManager.js"></script>	
		<script type="text/javascript" src="./../js/ajax/userGarmentNavBarEventHandler.js"></script>	
		<script type="text/javascript" src="./../js/ajax/GarmentLoader.js"></script>
		<script type="text/javascript" src="./../js/ajax/GarmentDashboard.js"></script>	
	    <title>Supernova-Catalog</title>
  	</head>

	<?php

  		include"./layout/top_bar.php";

  		$searchType = ALL_GARMENTS_SEARCH;
  		echo '<body onLoad="GarmentLoader.init(); ';
  		echo 'GarmentLoader.loadGarment(' . $searchType . ')">';

			include DIR_LAYOUT . "aside_menu.php";

			echo '<div id="content">';

	?>

	<?php

		include DIR_LAYOUT . "navigation_page.php";

		echo '<section id="garmentDashboard" class="garment_dashboard">Ciao</section>';

		include DIR_LAYOUT . "navigation_page.php";

		echo '</div>';

	?>

	</body>
</html>




