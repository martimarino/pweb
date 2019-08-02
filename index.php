<?php
	session_start();
	include("db_con.php");
	$_SESSION["email"]=$_POST["email"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
	$_SESSION["password"]=$_POST["password"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password
	$query = mysql_query("SELECT * FROM user WHERE e-mail= $_POST["email"] AND password = $_POST["password"]")  //per selezionare nel db l'utente e pw che abbiamo appena scritto nel log
	or DIE('query non riuscita'.mysql_error());
	if(mysql_num_rows($query)&gt;0){        //se c'è una persona con quel nome nel db allora loggati
		$row = mysql_fetch_assoc($query); // metto i risultati dentro una variabile di nome $row
		$_SESSION["logged"] =true; 
		header("location:prova.php");
	}else{
		echo "non ti sei loggato con successo";
	}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Martina Marino">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Supernova">
		<link rel="stylesheet" href="css/home.css" type="text/css" media="screen">
		<script src="js/home.js"></script>
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
					<li id="login" onclick="fade('element')"><img src="immagini/login.png" alt="login"></li>
					<li id="cart"><a href="php/cart.php"><img src="immagini/cart.png" alt="cart"></a></li> 
				</ul>
				<form id="element" class="fadeout" method="post">
					<h2>Login</h2>
					<div class="input-box">
						<div class="form-label">E-mail</div>
						<input class="signIn" id="email" name="email" type="email" size="15" maxlength="65" placeholder="E-mail" required>
					</div>
					<div class="input-box">
						<div class="form-label">Password</div>
						<input class="signIn" id="password" name="password" type="password" size="15" maxlength="15" placeholder="Password" required>
					</div>
					<a href="php/registration.php">Do not have an account? Sign in</a>
					<button type="submit" name="registration">Invia</button>
					<img onclick="fade('element')" src="immagini/ex.png" alt="ex">
				</form>
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
						<li id="instagram"><a href="ig_page.php"><img src="immagini/instagram.png" alt="ig"></a></li>
						<li id="facebook"><a href="fb_page.php"><img src="immagini/facebook.png" alt="fb"></a></li>
						<li id="pinterest"><a href="pin_page.php"><img src="immagini/pinterest.png" alt="pin"></a></li>
					</ul>
				</nav>
			</nav>
		</aside>

		<div class="slideshow-container">

			<div class="mySlides fade">
			  <img src="immagini/image1.jpg" alt="img-1">
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