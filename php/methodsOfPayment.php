<?php
	require_once __DIR__ . "/config.php";
	session_start();
    include DIR_UTIL . "session.php";
    include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "utility.php";

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
	    <link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 
	    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script src="../js/profile.js"></script>
	    <title>Method of payment</title>
  	</head>
	<?php
  		include"./layout/top_bar.php";
  		$searchType = LATEST_GARMENTS_SEARCH;
  		echo '<body onLoad="GarmentLoader.init(); ';
  		echo 'GarmentLoader.loadGarment(' . $searchType . ')">';

  			include DIR_LAYOUT . "profile_menu.php";

	?>

	<script type="text/javascript">
		document.getElementById("methods_of_payment_link").setAttribute("class", "highlighted_text");
	</script>
	<?php
		echo '<section id="garmentDashboard" class="garment_dashboard"></section>'; // Fill dinamically with Ajax Request 
	?>

		<section id="content">
			<h1 id="personal_informations_title">Payment methods</h1>
			<p>CREDIT CARDS</p>
			<ul id="credit_cards">
				<li id="visa"></li>
				<li id="master_card"></li>
				<li id="american_express"></li>
			</ul>
			<p>We accept Visa, Mastercard, American Express, Discover, and JCB. Note, cards issued by local banks which do not carry one of these logos will not be accepted by our global processing service, in which case we recommend PayPal as an alternative.</p>
			<p>PAYPAL</p>
			<p>Use any payment method on the growing list of ways to fund a PayPal account in your country. Once you have funded your PayPal account, you can use our single-click PayPal express feature to speed through checkout.</p>

		</section>

	</body>
</html>