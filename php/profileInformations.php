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
	    <title>Supernova-Profile informations</title>
  	</head>

	<?php

  		include"./layout/top_bar.php";
  		include DIR_LAYOUT . "profile_menu.php";


  		$username = $_SESSION['username'];
		$name = recoverInformations("nome", "user", $username);
		$surname = recoverInformations("cognome", "user", $username);
		$genre = recoverInformations("genere", "user", $username);

	?>

		<script type="text/javascript">
			document.getElementById("profile_informations_link").setAttribute("class", "highlighted_text");
		</script>
	
		<section id="content">
			<h1 id="personal_informations_title">Personal details</h1>
			<p>E-mail: &nbsp <?php echo $username; ?></p>
			<p>Name: &nbsp <?php echo $name; ?></p>
			<p>Surname:  &nbsp <?php echo $surname; ?></p>
			<p>Genre:  &nbsp <?php echo $genre; ?></p>
		</section>


	</body>
</html>