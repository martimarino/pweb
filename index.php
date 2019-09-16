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
		<script src="js/home.js"></script>
		<script src="../js/ajaxManager.js"></script>
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
					<li id="favourites" onclick="favourites()"><img src="immagini/heart.png" alt="favourites"></li>
					<li onclick="location.href='./php/loginPage.php';"><img src='./immagini/login.png' alt="login"></li>
					<li id="cart"><a href="php/cart.php"><img src="immagini/cart.png" alt="cart"></a></li> 
				</ul>
			</nav>
			<h1>
				<a id="titolo" href="index.php"> Supernova </a>
			</h1>
		</header>
		<br>
		<aside>
			<nav id="menu">
				<ul class ="menu-list">
					<li>New collection</li>
					<li>Abbigliamento</li>
					<li>Accessori</li>
				</ul>
				<ul class ="menu-list">
					<li>SALES</li>
					<li>It's Christmas time</li>
				</ul>
				<ul class ="menu-list">
					<li>Dove trovarci</li>
					<li>Contatti</li>
				</ul>
				<nav id="social">
					<ul>
						<li id="instagram"><a href="https://www.instagram.com/accounts/login/?hl=it"><img src="immagini/instagram.png" alt="ig"></a></li>
						<li id="facebook"><a href="https://it-it.facebook.com/login/"><img src="immagini/facebook.png" alt="fb"></a></li>
						<li id="pinterest"><a href="https://www.pinterest.it/login/"><img src="immagini/pinterest.png" alt="pin"></a></li>
					</ul>
				</nav>
			</nav>
		</aside>

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