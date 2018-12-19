<?php
	session_start();
	if (!isset($_SESSION['count']))
		//Determine if a variable is set and is not NULL.
		{ echo "<p>You have to login</p>"; }
	else 
		{ $_SESSION['count']++;
		echo "<p>Hi, you have visited this page " . $_SESSION['count'] . " times.</p>";
		echo "<p>
		<a href=\"page.php\">GO</a>, or
		<a href=\"logout.php\">Exit</a>.</p>";}
?>

