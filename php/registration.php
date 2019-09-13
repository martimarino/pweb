
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
	<?php
		require('db.php');
		// If form submitted, insert values into the util.
		if (isset($_REQUEST['username'])){
		        // removes backslashes
			$username = stripslashes($_REQUEST['username']);
			        //escapes special characters in a string
			$username = mysqli_real_escape_string($con,$username); 
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($con,$email);
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($con,$password);
			$trn_date = date("Y-m-d H:i:s");
		    $query = "INSERT into `users` (username, password, email, trn_date)
					VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
		    $result = mysqli_query($con,$query);
		    if($result){
		        echo "<div class='form'>
				<h3>You are registered successfully.</h3>
				<br/>Click here to <a href='login.php'>Login</a></div>";
	        }
	    }else{
	?>
	<?php
    	include"./layout/top_bar.php";
  	?>
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
	<?php } ?>
	</body>
</html>