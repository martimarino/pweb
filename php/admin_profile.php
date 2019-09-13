<?php
	session_start();
    include "./util/session.php";

    if (!isLogged()){
		    header('Location: ./../index.php');
		    exit;
    }	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Il tuo profilo</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="profile">
		<b id="welcome">Welcome : <i><?php echo $_SESSION['username']; ?></i></b>
		<b id="logout"><a href="./util/logout.php">Log Out</a></b>
		</div>
	</body>
</html>