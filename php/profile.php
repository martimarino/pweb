<?php
	include "./database/session.php";
	include "./datebase/connection.php";
	session_start();
    if(isset($_SESSION['username']))
    {
		if($_SESSION['username'] == 'admin')
		{
			header("Location: ../index.php");
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Your Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="profile">
		<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
		<b id="logout"><a href="logout.php">Log Out</a></b>
		</div>
	</body>
</html>