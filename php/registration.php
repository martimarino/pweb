<?php
	session_start(); // serve ad aprire la sessione
	include("db_con.php"); // includo il file di connessione al database
	
	if($_POST["firstname"] != "" && $_POST["lastname"] != "" && $_POST["email"] != "" && $_POST["password"]!= "" && $_POST["confirm"] != ""){  // se i parametri non sono vuoti
		$query_registrazione = mysql_query("INSERT INTO user (name,surname,e-mail,password,gender)
		VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["email"]."','".$_POST["password"]."','".$_POST["gender"]."')") // scrivo sul DB questi valori
		or die ("query di registrazione non riuscita".mysql_error()); // se la query fallisce mostrami questo errore
	}else{
		header('location:index.php?action=registration&errore=Non hai compilato tutti i campi obbligatori'); // se le prime condizioni non vanno bene entra in questo ramo else
	}
	
	if(isset($query_registrazione)){ //se la reg è andata a buon fine
		$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
		header("location:index.php");
	}else{
		echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa
	}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Martina Marino">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Supernova">
		<link rel="stylesheet" href="../css/signin.css" type="text/css" media="screen">
		<script type="text/javascript" src="../js/home.js"></script>
		<link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
		<link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
		<title>Supernova</title>
	</head>
	<body>
		<header>
			<form id="search">
				<input type="text" name="search" placeholder="Search..">
				<img src="../immagini/search.png" alt="search">
			</form>
			<nav id="right-icons">
				<ul id="right-list">
					<li id="favourites" onclick="favourites()"><img src="../immagini/heart.png" alt="favourites"></li>
					<li id="login" onclick="fade('element')"><img src="../immagini/login.png" alt="login"></li>
					<li id="cart"><a href="cart.php"><img src="../immagini/cart.png" alt="cart"></a></li> 
				</ul>
				<div id="element" class="fadeout">
					<h2>Login</h2>
					<div class="input-box">
						<div class="form-label">E-mail</div>
						<input class="signIn" id="userName" name="userName" type="email" size="15" maxlength="65" placeholder="E-mail" autocapitalize="off">
					</div>
					<div class="input-box">
						<div class="form-label">Password</div>
						<input class="signIn" id="password" name="password" type="password" autocomplete="off" size="15" maxlength="15" placeholder="Password">
					</div>
					<div class="input-box">
						<a href="registration.php">Do not have an account? Sign in</a>
					</div>
					<img onclick="fade('element')" src="../immagini/ex.png" alt="ex">
				</div>
			</nav>
			<h1>
				<a id="titolo" href="../index.php"> Supernova </a>
			</h1>
		</header>
		<div class="main-container">
			<div class="popup">
				<span class="popuptext" id="myPopup">A Simple Popup!</span>
			</div>
			<form name="formToValidate" action="registration.php" method="post">
				<fieldset class="fieldset">
					<h2>Personal informations</h2>
					<ul class="form-list">
						<li class="field">
							<label for="firstname">Name</label>
							<div class="input-box">	
								<input type="text" id="firstname" name="firstname"  autocomplete="off" onblur="validate()">
							</div>
						</li>
						<li class="field">
							<label for="lastname">Surname</label>
							<div class="input-box">
								<input type="text" id="lastname" name="lastname" autocomplete="off" onblur="validate()">
							</div>
						</li>
						<li class="field">
							<label for="email">E-mail</label>
							<div class="input-box">	
								<input type="text" id="email" name="email" autocomplete="off" onblur="validate()">
							</div>
						</li>
						<li class="field">
							<label>Gender</label>
								<input type="radio" id="female" name="gender" required value="female" checked="checked">F
								<input type="radio" id="male" name="gender" value="male">M
						</li>
					</ul>
					<h2>Access informations</h2>
					<ul class="form-list">
						<li class="field">
							<label for="password">Password</label>
							<div class="input-box">	
								<input type="password" id="pwd" name="password" autocomplete="off" onblur="validate()">
							</div>
						</li>
						<li class="field">
							<label for="confirm">Confirm password</label>
							<div class="input-box">
								<input type="password" id="confirm" name="confirm"  autocomplete="off" onblur="validate()">
							</div>
						</li>
					</ul>
					<button class="login-submit" type="submit" name="submit" value="SUBMIT" onclick="submitForm()">Invia</button>
				</fieldset>
			</form>
		</div>
	</body>
</html>