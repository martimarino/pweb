<header>
	<form id="search">
		<input type="text" id="search-input" placeholder="Search.." onkeyup="GarmentLoader.search(this.value)">
		<img src="../immagini/search.png" alt="search">
	</form>
	<nav id="right-icons">
		<ul id="right-list">
			<li id="favourites"><a href= "./wishList.php"><img src="../immagini/heart.png" alt="favourites"></a></li>
			<li onclick="location.href='../php/loginPage.php';"><img src='../immagini/login.png' alt="login"></li>
			<li id="cart" onclick="location.href='../php/cart.php';"><img src="../immagini/cart.png" alt="cart"></a></li> 
		</ul>
	</nav>
	<h1>
		<a id="titolo" href="../index.php"> Supernova </a>
	</h1>
</header>