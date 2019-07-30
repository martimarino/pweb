<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Martina Marino">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Supernova">
		<link rel="stylesheet" href="../css/catalog.css" type="text/css" media="screen">
		<script type="text/javascript" src="../js/home.js"></script>
		<link rel="icon" href="../immagini/supernova.png" sizes="32x32" type="image/png"> 
		<link href="https://fonts.googleapis.com/css?family=Chakra+Petch" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
		<title>Supernova</title>
	</head>
	<body>
		<header>				<!-- barra fissa -->
			<form id="search">
				<input type="text" name="search" placeholder="Search..">
				<img src="../immagini/search.png" alt="search">
			</form>
			<nav id="right-icons">		<!--tre icone in alto a destra-->
				<ul id="right-list">
					<li id="favourites" onclick="Nav('leftSidenav')"><img src="../immagini/heart.png" alt="favourites"></li>
					<li id="login" onclick="fade('element')"><img src="../immagini/login.png" alt="login"></li>
					<li id="cart" onclick="Nav('rightSidenav')"><img src="../immagini/cart.png" alt="cart"></li>
				</ul>
				<div id="element" class="fadeout">	 <!--login a comparsa-->
					<h2>Login</h2>
					<div class="input-box">
						<div class="form-label">E-mail</div>
						<input class="signIn" id="userName" name="userName" type="email" size="15" maxlength="65" placeholder="E-mail">
					</div>
					<div class="input-box">
						<div class="form-label">Password</div>
						<input class="signIn" id="password" name="password" type="password" size="15" maxlength="15" placeholder="Password">
					</div>
					<div class="input-box">
						<a href="registration.php">Do not have an account? Sign in</a>
					</div>
					<img onclick="fade('element')" src="../immagini/ex.png" alt="cross">
				</div>
			</nav>
			<h1>
				<a id="titolo" href="../index.php"> Supernova </a>
			</h1>
		</header>

		<!-- ************************ sidebars ************************* -->

		<div class="side-bar">
			<div id="leftSidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="Nav('leftSidenav')">&times;</a>
			  <a href="#">About</a>
			  <a href="#">Services</a>
			  <a href="#">Clients</a>
			  <a href="#">Contact</a>
			</div>
		</div>
	<!--	<div class="side-bar">
			<div id="rightSidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="Nav('rightSidenav')">&times;</a>
			  <a href="#">1</a>
			  <a href="#">2</a>
			  <a href="#">3</a>
			  <a href="#">4</a>
			</div>
		</div> -->

		<!-- ************************ tabella ************************* -->

		<table id="catalog" style="width:100%">
			<tr>
		    	<td>	
		    		<img src="../immagini/product2.jpg" class="product" alt="product">
		    		<div class="fastSelectors">
		    			<table>
		    				<tr>
		    					<td>
		    						Color
		    						<img class="arrow" src="../immagini/upArrow.png" alt="arrow">
		    					</td>
		    					<td>
		    						Size
		    						<img class="arrow" src="../immagini/upArrow.png" alt="arrow">
		    					</td>
		    					<td class="fav">
		    						Add to favourites
		    					</td>
		    				</tr>
		    			</table>
		    		</div>
		    		<div class="caption">Top elegante a maniche corte brillante</div>
		    		<div class="price">15,99 €</div>
		    	</td>
				<td>
		    		<img src="../immagini/product2.jpg" class="product" alt="product">
		    		<div class="fastSelectors">
		    			<table>
		    				<tr>
		    					<td>
		    						Color
		    						<img class="arrow" src="../immagini/upArrow.png" alt="arrow">
		    					</td>
		    					<td>
		    						Size
		    						<img class="arrow" src="../immagini/upArrow.png" alt="arrow">
		    					</td>
		    					<td class="fav">
		    						Add to favourites
		    					</td>
		    				</tr>
		    			</table>
		    		</div>
		    		<div class="caption">Top elegante a maniche corte brillante</div>
		    		<div class="price">15,99 €</div>
		    	</td>
				<td>
		    		<img src="../immagini/product2.jpg" class="product" alt="product">
		    		<div class="fastSelectors">
		    			<table>
		    				<tr>
		    					<td>
		    						Color
		    						<img class="arrow" src="../immagini/upArrow.png" alt="arrow">
		    					</td>
		    					<td>
		    						Size
		    						<img class="arrow" src="../immagini/upArrow.png" alt="arrow">
		    					</td>
		    					<td class="fav">
		    						Add to favourites
		    					</td>
		    				</tr>
		    			</table>
		    		</div>
		    		<div class="caption">Top elegante a maniche corte brillante</div>
		    		<div class="price">15,99 €</div>
		    	</td>
		  	</tr>
		</table>
	</body>
</html>