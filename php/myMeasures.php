<?php
	require_once __DIR__ . "/config.php";
    include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "garmentManagerDb.php";
    include DIR_UTIL . "utility.php";

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
	    <title>My measures</title>
  	</head>

	<?php
  		include"./layout/top_bar.php";
	?>

		<script>
			document.getElementById("my_measures_link").setAttribute("class", "highlighted_text");
		</script>

		<section id="size_table">
			<h2 id="personal_informations_title">Consulta la tabella per trovare la tua taglia</h2>
			<img src="../immagini/tabella_misure.jpg" alt="size_table">
		</section>
	</body>
</html>