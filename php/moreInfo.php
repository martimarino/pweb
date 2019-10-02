<?php
	require_once __DIR__ . "/config.php";
    include DIR_UTIL . "utility.php";

?>
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name = "author" content = "Martina Marino">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Supernova">
	    <link rel="stylesheet" href="../css/profile.css" type="text/css" media="screen"> 
	    <link rel="stylesheet" href="../css/home_menu.css" type="text/css" media="screen">
	    <link rel="stylesheet" href="../css/header.css" type="text/css" media="screen"> 
	    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <title>Method of payment</title>
  	</head>
	<?php
			include"./layout/top_bar.php";
  			include DIR_LAYOUT . "home_menu.php";

	?>
<!--
	<script type="text/javascript">
		document.getElementById("methods_of_payment_link").setAttribute("class", "highlighted_text");
	</script>   -->

		<section id="content">
			<h1 id="page_title">Payment methods</h1>

				<p><b>CREDIT CARDS</b></p>
				<ul id="credit_cards">
					<li id="visa"></li>
					<li id="master_card"></li>
					<li id="american_express"></li>
				</ul>
				<p>We accept Visa, Mastercard, American Express, Discover, and JCB. Note, cards issued by local banks which do not carry one of these logos will not be accepted by our global processing service, in which case we recommend PayPal as an alternative.</p>
				
				<p><b>PAYPAL</b></p>
				<ul id="credit_cards">
					<li id="paypal"></li>
				</ul>
				<p id="findAnchor">Use any payment method on the growing list of ways to fund a PayPal account in your country. Once you have funded your PayPal account, you can use our single-click PayPal express feature to speed through checkout.</p>

			<h1 id="page_title" name="whereToFindUs">Where to find us</h1>

				<p><b>MODENA</b></p>
				<p><a href="https://www.google.com/maps/place/Centro+Commerciale+La+Rotonda/@44.622051,10.9247249,17z/data=!3m1!4b1!4m5!3m4!1s0x477fe5f41fa04555:0x28dc9d6cdca67564!8m2!3d44.622051!4d10.9269136">Centro Commerciale la Rotonda</a></p>
				<p>phone +39 059 395560</p>
				<p>Opening time: </p>
				<p>MON-SAT</p>
				<p>08.30 - 21.00</p>
				<p>SUNDAY</p>
				<p>09.00 - 20.00</p>

				<br>

				<p><b>MASSA</b></p>
				<p><a href="https://www.google.com/maps/place/Centro+Commerciale+MareMonti/@44.0234128,10.106934,17z/data=!3m1!4b1!4m5!3m4!1s0x12d508b2d378967b:0x9abfd092b6947e2!8m2!3d44.0234128!4d10.1091227">Centro Commerciale MareMonti - 54100 Massa (MS)<a></p>
				<p>phone +39 0585.793399</p>
				<p>Opening time: </p>
				<p>SUN-MON</p>
				<p>08.30 - 21.00</p>

				<br>

				<p><b>SARZANA</b></p>
				<p><a href="https://www.google.com/maps/place/Centroluna/@44.1178259,9.9449655,17z/data=!3m1!4b1!4m5!3m4!1s0x12d51cd555376e59:0xd2e90a45776151!8m2!3d44.1178259!4d9.9471542">Centro Commerciale Centroluna - 19038 Sarzana (SP)</a></p>
				<p>phone +39 0187 603040</p>
				<p>Opening time: </p>
				<p>SUN-MON</p>
				<p>09.30 - 21.00</p>

				<br>

				<p><b>LA SPEZIA VIA PRIONE</b></p>
				<p><a href="https://www.google.com/maps/place/Via+del+Prione,+98,+19121+La+Spezia+SP/@44.1047326,9.8187536,17z/data=!3m1!4b1!4m5!3m4!1s0x12d4fc999f06324b:0xb18f849ca56e2230!8m2!3d44.1047326!4d9.8209423">Via Del Prione 98 - 19124 La Spezia (SP)</a></p>
				<p>phone +39 0187.20702</p>
				<p>Opening time: </p>
				<p>MON-FRI</p>
				<p>09.00 - 20.00</p>
				<p>SATURDAY AND SUNDAY</p>
				<p>09.30 - 20.30</p>

				<br>

				<p><b>LA SPEZIA VIA VENETO</b></p>
				<p><a href="https://www.google.com/maps/place/Via+Vittorio+Veneto,+35,+19124+La+Spezia+SP/@44.1077465,9.8253246,17z/data=!3m1!4b1!4m5!3m4!1s0x12d4fc96214eaf41:0x393144a78b68f8bc!8m2!3d44.1077465!4d9.8275133">Via Vittorio Veneto 35 - 19124 La Spezia (SP)</a></p>
				<p>tel +39 0187.29655</p>
				<p>Opening time: </p>
				<p>MON-FRI</p>
				<p>09.00 - 20.00</p>
				<p>SATURDAY AND SUNDAY</p>
				<p>09.30 - 20.30</p>


			<h1 id="page_title" name="contacts">Contacts</h1><br>

				<p id="contactAnchor"><b>PHONE</b></p>
				<p>Phone: +39 0186 45 75 63 (IN ENGLISH & ITALIAN)</p>
				<p><b>EMAIL</b></p>
				<p>Email us anytime and we will get back to you within 24-48 hours</p>
				<p><a href = "mailto: support@supernova.com">support@supernova.com</a></p>

		</section>

	</body>
</html>