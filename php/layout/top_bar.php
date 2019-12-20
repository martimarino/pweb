

<header>
	<?php 
		$file = basename($_SERVER['REQUEST_URI']); 
		if ($file == "catalog.php")
		{
			echo "<form id='search'>
				<input type='text' id='search-input' placeholder='Search..' onkeyup='GarmentLoader.search(this.value)'>
				<img src='../immagini/search.png' alt='search'>
			</form>";
		}
	?>
	<nav id="right-icons">
		<ul id="right-list">
			<li id="favourites"><a href= "./wishList.php"><img src="../immagini/heart.png" alt="favourites"></a></li>
			<?php 
				if((isset($_SESSION['username'])) && ($_SESSION['userId'] != "amministratore"))
				{
					if(setWishlistBadge() > 0)
					{
						echo "<li id='wishlistBadge' class='badge'>";
						echo setWishlistBadge();
						echo "</li>";
					}
				}
			?>
			<li id="login"onclick="location.href='../php/loginPage.php';"><img src='../immagini/login.png' alt="login"></li>
			<li id="cart" onclick="location.href='../php/cart.php';"><img src="../immagini/cart.png" alt="cart"></a></li> 
			
			<?php 
				if((isset($_SESSION['username'])) && ($_SESSION['userId'] != "amministratore"))
				{
					if(setCartBadge())
					{
						echo "<li id='cartBadge' class='badge'>";
						echo setCartBadge();
						echo "</li>";
					}
				}
			?>

		</ul>
	</nav>
	<h1>
		<a id="titolo" href="../index.php"> Supernova </a>
	</h1>
</header>