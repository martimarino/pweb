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
	    <script src="../js/profile.js"></script>
	    <title>Orders</title>
  	</head>

	<?php
  		include"./layout/top_bar.php";
  		$searchType = LATEST_GARMENTS_SEARCH;
  		echo '<body onLoad="GarmentLoader.init(); ';
  		echo 'GarmentLoader.loadGarment(' . $searchType . ')">';

  			include DIR_LAYOUT . "aside_menu.php";

	?>
	<script type="text/javascript">
		document.getElementById("orders_link").setAttribute("class", "highlighted_text");
	</script>
	<?php
		echo '<section id="garmentDashboard" class="garment_dashboard"></section>'; // Fill dinamically with Ajax Request 
	?>
	<!--
	<section>
		Consulta la tabella per trovare la tua taglia.
		<img src="../immagini/tabella_misure.jpg" alt="size_table">
	</section>
	-->

	</body>
</html>