
<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Martina Marino">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Supernova">
		<link rel="stylesheet" href="../css/login.css" type="text/css" media="screen">
    	<link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 	
		<script src="../js/home.js"></script>
		<link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
		<link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
		<title>Supernova</title>
	</head>
	<body>
		<?php
	    	include"./layout/top_bar.php";
	  	?>

		<form action="./util/signin.php" method="post" id="reg_form">
			<div class="container">

				<?php
		            if (isset($_GET['errorMessage'])){
		                echo '<div class="sign_in_error">';
		                echo '<span><b>' . $_GET['errorMessage'] . '</b></span>';
		                echo '</div>';
		          	}
		        ?>

				<h2>Personal informations</h2>

				<label>First name</label>
				<input type="text" id="firstname" name="firstname" autofocus autocomplete="off" required>
		
				<label>Surname</label>
				<input type="text" id="lastname" name="lastname" autocomplete="off" required>
		
				<label>E-mail</label>
				<input type="text" id="email" name="email" autocomplete="off" required>
			
				<label>Genre</label>
				<input type="radio" id="female" name="gender" value="female" checked="checked">F
				<input type="radio" id="male" name="gender" value="male">M

				<h2>Access informations</h2>

				<label>Password</label>
				<input type="password" id="password" name="password" autocomplete="off" required>
		
				<label>Confirm password</label>
				<input type="password" id="confirm" name="confirm"  autocomplete="off" required>
				
				<button type="submit" class="button">Invia</button>
			</div>
		</form>
	</body>
</html>