<?php
	session_start();
    include "./util/session.php";
    include "./util/supernovaDbManager.php";
    include "./util/utility.php";

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
    <script src="../js/profile.js"></script>
    <title>Il tuo profilo</title>
  </head>
	<body>
		<?php
      		include"./layout/top_bar.php";
    	?>
    	<section>
    		Consulta la tabella per trovare la tua taglia.
    		<img src="../immagini/tabella_misure.jpg" alt="size_table">
    	</section>
		<aside>
			<nav id="menu">
				<ul class ="menu-list">
					<li id="first"><b>Welcome
					<?php
						$username = $_SESSION['username'];
						$name = recoverUserInformations("nome", "user", $username);
						echo $name . "</b></li>";
					?>
				</ul>
				<ul>
					<li>Profile informations</li>
					<li>Orders</li>
					<li>Whishlist</li>
					<li>Forme di pagamento</li>
					<li>Le mie misure</li>
				</ul>
			</nav>
			<button type="submit" id="logout" onclick="location.href='./util/logout.php';">Log out</button>
		</aside>
	</body>
</html>