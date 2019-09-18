<aside>
	<nav id="content-nav">
		<ul class ="menu-list">
			<li id="first"><b>Welcome
			<?php
				$username = $_SESSION['username'];
				$name = recoverInformations("nome", "user", $username);
				echo $name . "</b></li>";
			?>
		</ul>
		<ul>
			<li><a id="profile_informations_link" href="./profileInformations.php" class="li_link">Profile informations</a></li>
			<li><a id="orders_link" href="./orders.php" class="li_link">Orders</a></li>
			<li><a id="wish_list_link" href="./wishList.php" class="li_link">Whish List</a></li>
			<li><a id="methods_of_payment_link" href="./methodsOfPayment.php" class="li_link">Methods of payments</a></li>
			<li><a id="my_measures_link" href="./myMeasures.php" class="li_link">My measures</a></li>
		</ul>
	</nav>
	<button type="submit" id="logout" onclick="location.href='./util/logout.php';">Log out</button>
</aside>