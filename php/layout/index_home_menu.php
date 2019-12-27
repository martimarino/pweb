	

	<?php 
		$igPath = "immagini/instagram.png";
		$fbPath = "immagini/facebook.png";
		$pinPath = "immagini/pinterest.png";
		$catalogPath = "php/catalog.php";
		$findPath = "php/moreInfo.php#findAnchor";
		$contactPath = "php/moreInfo.php#contactAnchor";
		$methodsOfPayment = "php/moreInfo.php";
	?>
		<aside>
			<nav id="menu">
				<ul class ="menu-list">
					<li><a href=<?php echo $catalogPath ?>>Catalog</a></li>
				</ul>
				<ul class ="menu-list">
					<li><a href=<?php echo $methodsOfPayment ?>>Methods of payment</a></li>
					<li><a href=<?php echo $findPath ?>>Find us</a></li>
					<li><a href=<?php echo $contactPath ?>>Contacts</a></li>
				</ul>
				<nav id="social">
					<ul>
						<li id="instagram"><a href="https://www.instagram.com/accounts/login/?hl=it"><img src=<?php echo $igPath ?> alt="ig"></a></li>
						<li id="facebook"><a href="https://it-it.facebook.com/login/"><img src=<?php echo $fbPath ?> alt="fb"></a></li>
						<li id="pinterest"><a href="https://www.pinterest.it/login/"><img src=<?php echo $pinPath ?> alt="pin"></a></li>
					</ul>
				</nav>
			</nav>
		</aside>
