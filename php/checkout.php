<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "session.php";
    include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "garmentManagerDb.php";
    include DIR_UTIL . "utility.php";

    if (!isLogged()){
		    header('Location: ./../index.php');
		    exit;
    }	
?>
<!doctype html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Martina Marino">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Supernova">
		<link rel="stylesheet" href="../css/login.css" type="text/css" media="screen">
    	<link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 
		<script src="./../js/home.js"></script>	
		<link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
		<link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
		<title>Supernova</title>
	</head>
	<body>
		<?php
	    	include"./layout/top_bar.php";
	  	?>

		<form method="post" id="checkout_form">
			<div class="container">

				<div id="form_error"></div>

				<h2>Shipping informations</h2>

				<label>First name</label>
				<input type="text" placeholder="*First Name" class="" id="firstname" name="firstname" autofocus autocomplete="off" maxlength="25" required onblur="validateAllLetter('firstname')">
		
				<label>Surname</label>
				<input type="text" placeholder="*Surname"id="lastname" name="lastname" autocomplete="off" required autocomplete="off" maxlength="25" onblur="validateAllLetter('lastname')">
		
				<label>E-mail</label>
				<input type="email" placeholder="*E-mail"id="email" name="email" autocomplete="off" required onblur="validateEmail(this)" maxlength="25">

				<label>Telephone number</label>
				<input type="tel" placeholder="*Example: 0187 459638" id="telephone" name="telephone" autocomplete="off" required onblur="validateAllnumeric('telephone')" maxlength="10">

				<input type="radio" id="female" name="gender" value="female" checked="checked">Ms./Mrs.
				<input type="radio" id="male" name="gender" value="male">Mr.<br><br>

				<label>Address</label>
				<input type="text" placeholder="*Address" id="address" name="address" autocomplete="off" required onblur="validateAddress(this)" maxlength="25">
		
				<label>City</label>
				<input type="text" placeholder="*City" id="city" name="city"  autocomplete="off" required onblur="validateAllLetter('city')">

				<label>Zip code</label>
				<input type="text" placeholder="*Zipcode" id="zipcode" name="zipcode"  autocomplete="off" required onblur="validateAllnumeric('zipcode')" maxlength="5">
				
				<label>Country</label>
				<select id="country" name="country">
					<option value="italy">Italy</option>
				</select>

			<h2>Billing informations</h2>

				<input type="radio" id="paypal" name="payment" value="paypal" checked="checked">Pay pal
				<input type="radio" id="creditCard" name="payment" value="creditCard">Credit card<br><br>

				<label>Name on card</label>
				<input type="text" class="" id="nameOnCard" name="nameOnCard" autocomplete="off" required onblur="validateAllLetter('nameOnCard')" maxlength="25">
		
				<label>Type</label>
				<select id="type" name="type">
					<option value="visa">Visa</option>
					<option value="americanExpress">American Express</option>
					<option value="masterCard">Master Card</option>
					<option value="maestro">Maestro</option>
				</select>

				<label>Number</label>
				<input type="text" id="number" name="number" autocomplete="off" required maxlength="16" onblur="validateAllnumeric('number')">

		<label>Expiration date</label>
			    <select id="year" name="year">
					<option value="2030">2030</option>
					<option value="2029">2029</option>
					<option value="2028">2028</option>
					<option value="2027">2027</option>
					<option value="2026">2026</option>
					<option value="2025">2025</option>
					<option value="2024">2024</option>
					<option value="2023">2023</option>
					<option value="2022">2022</option>
					<option value="2021">2021</option>
					<option value="2020">2020</option>
					<option value="2019">2019</option>
					<option value="2018">2018</option>
					<option value="2017">2017</option>
			     </select>
				<select id="month" name="month">
			        <option value="01">January</option>
			        <option value="02">February</option>
			        <option value="03">March</option>
			        <option value="04">April</option>
			        <option value="05">May</option>
			        <option value="06">June</option>
			        <option value="07">July</option>
			        <option value="08">August</option>
			        <option value="09">September</option>
			        <option value="10">October</option>
			        <option value="11">November</option>
			        <option value="12">December</option>
			     </select> <br><br>

				<label>Security code</label>
				<input type="text" id="securityCode" name="securityCode" autocomplete="off" required onblur="validateAllnumeric('securityCode')" maxlength="3">

				<button type="submit" class="button">Continue</button>
			</div>
		</form><br>
	</body>
</html>