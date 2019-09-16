<?php
	session_start();
    include "./util/session.php";

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
    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
    <script type="text/javascript" src="../js/profile.js"></script>
    <title>Il tuo profilo</title>
  </head>
	<body onLoad="recoverInformations($_SESSION['username'])">
		<?php
      		include"./layout/top_bar.php";
    	?>
		<div id="container">
			<div class="square">
				<h2>INFO PROFILO</h2>
				<hr>
				<p id="welcome"><?php echo $_SESSION['username']; ?></p>
				<button type="submit" id="logout" onclick="location.href='./util/logout.php';">Log out</button>
			</div>
			<div class="square">
				<h2>I TUOI ORDINI</h2>
				<hr>
				<p>Tot ordini: 6</p>
				<p>IL TUO ULTIMO ORDINE</p>
				<p>653465</p>
				<p>Stato: consegnato</p>
				<button class="goTo">Storico ordini</button>
			</div>
			<div class="square">
				<h2>WISHLIST</h2>
				<hr>
				<button class="goTo">Vai alla lista</button>
			</div>
		</div>
	</body>
</html>