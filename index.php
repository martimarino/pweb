<?php
	include('php/util/session.php');
	session_start();
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
		<link rel="icon" href = "immagini/supernova.png" sizes="32x32" type="image/png"> 
		<link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
		<title>Supernova</title>
	</head>
	<body>
		<header>
			<form id="search">
				<input type="text" name="search" placeholder="Search..">
				<img src="immagini/search.png" alt="search">
			</form>
			<nav id="right-icons">
				<ul id="right-list">
					<li id="favourites"><img src="immagini/heart.png" alt="favourites"></li>
					<li onclick="location.href='./php/loginPage.php';"><img src='./immagini/login.png' alt="login"></li>
					<li id="cart"><a href="php/cart.php"><img src="immagini/cart.png" alt="cart"></a></li> 
				</ul>
			</nav>
			<h1>
				<a id="titolo" href="index.php"> Supernova </a>
			</h1>
		</header>
		<br>
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

		<script>
			var slideIndex = 0;
			showSlides();
		</script>
		<footer>
	  		<form>
	  			<input id="newsletter" name="newsletter" placeholder="Newsletter" type="email" required>
				<button type=submit>Invia</button>
			</form>
		</footer>
	</body>
</html>