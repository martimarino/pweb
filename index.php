<?php
	require_once __DIR__ . "/php/config.php";
	include('php/util/session.php');
	session_start();
	include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "utility.php";
?>

<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Martina Marino">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Supernova">
		<link rel="stylesheet" href="css/home.css" type="text/css" media="screen">
		<script type="text/javascript" src="./js/home.js"></script>
		<script src="./js/ajax/ajaxManager.js"></script>
		<script type="text/javascript" src="./js/ajax/userGarmentNavBarEventHandler.js"></script>	
		<script type="text/javascript" src="./js/ajax/GarmentLoader.js"></script>
		<script type="text/javascript" src="./js/ajax/GarmentDashboard.js"></script>	
		<link rel="icon" href = "immagini/supernova.png" sizes="32x32" type="image/png"> 
		<link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
		<title>Supernova</title>
	</head>
	<body <?php if(isset($_GET['errorMessage'])) echo 'onload="IndexEffects()"'; ?>>
		<header>

			<nav id="right-icons">
				<ul id="right-list">
					<li id="favourites"><a href="php/wishList.php"><img src="immagini/heart.png" alt="favourites"></a></li>
					<li onclick="location.href='./php/loginPage.php';"><img src='./immagini/login.png' alt="login"></li>
					<li id="cart"><a href="php/cart.php"><img src="immagini/cart.png" alt="cart"></a></li> 
				</ul>
			</nav>
			<h1>
				<a id="titolo" href="index.php"> Supernova </a>
			</h1>
		</header>  
		<?php
			include('php/layout/home_menu.php');
		?>
		<div class="slideshow-container">

			<div class="mySlides fade">
			  <img src="immagini/image7.jpg" alt="img-1">
			</div>

			<div class="mySlides fade">
			  <img src="immagini/image2.jpg" alt="img-2">
			</div>

			<div class="mySlides fade">
			  <img src="immagini/image3.jpg" alt="img-3">
			</div>

			<div class="mySlides fade">
			  <img src="immagini/image4.jpg" alt="img-4">
			</div>

			<div class="mySlides fade">
			  <img src="immagini/image8.jpg" alt="img-5">
			</div>

			<div class="mySlides fade">
			  <img src="immagini/image6.jpg" alt="img-5">
			</div>

		</div>
		<br>

			<?php
		            if (isset($_GET['errorMessage'])){
		                echo '<div class="sign_in_error" id="index_message">';
		                echo '<span><b>' . $_GET['errorMessage'] . '</b></span>';
		                echo '</div>';
		          	}
		        ?>
		<script>
			var slideIndex = 0;
			showSlides();
		</script>
		<footer>
	  		<form action="./php/util/newsletter.php" method="post">
	  			<input id="newsletter" name="newsletter" placeholder="Newsletter" type="email" required>
				<button type=submit>Invia</button>
			</form>
		</footer>
	</body>
</html>