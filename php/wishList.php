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
	    <link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 
	    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script src="./../js/ajax/ajaxManager.js"></script>	
		<script src="./../js/ajax/userGarmentNavBarEventHandler.js"></script>	
		<script src="./../js/ajax/GarmentLoader.js"></script>
		<script src="./../js/ajax/GarmentDashboard.js"></script>	
	    <title>Supernova-Wish list</title>
  	</head>

	<?php

  		include"./layout/top_bar.php";

  		$searchType = WISHLIST_SEARCH;
  		echo '<body onLoad="GarmentLoader.init(); ';
  		echo 'GarmentLoader.loadGarment(' . $searchType . ')">';

			include DIR_LAYOUT . "profile_menu.php";

			echo '<div id="content">';

	?>

			<script>
				document.getElementById("wish_list_link").setAttribute("class", "highlighted_text");
			</script>

	<?php

		include DIR_LAYOUT . "navigation_page.php";

		echo '<div id="garmentDashboard" class="garment_dashboard"></div>';

		include DIR_LAYOUT . "navigation_page.php";

		echo '</div>';

	?>

	</body>
</html>