<aside id="aside_menu">
	<nav id="content-nav">
		<p id="first"><b>Welcome
			<?php
				$username = $_SESSION['username'];
				$name = recoverInformations("nome", "user", $username);
				echo $name . "</b></li>";
			?>
		</p>
		<ul>
			<li><a id="catalog_link" href="./catalog.php" class="li_link">Go to catalog</a></li>
			<li><a id="profile_informations_link" href="./profileInformations.php" class="li_link">Profile informations</a></li>
			<li><a id="orders_link" href="./orders.php" class="li_link">Orders</a></li>
			<li><a id="wish_list_link" href="./wishList.php" class="li_link">Whish List</a></li>
			<li><a id="my_measures_link" href="./myMeasures.php" class="li_link">How to choose the size</a></li>
		</ul>
	</nav>
	<button type="submit" id="logout" onclick="location.href='./util/logout.php';">Log out</button>
</aside>