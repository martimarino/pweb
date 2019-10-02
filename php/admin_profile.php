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
		<link href="../css/header.css" rel="stylesheet" type="text/css">
		<link href="../css/admin.css" rel="stylesheet" type="text/css">
	    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script src="./../js/home.js"></script>  
		<title>Supernova-Admin profile</title>
	</head>
	<body onLoad="hideBadges()">
		<?php
			include"./layout/top_bar.php";
		?>
		<div id="profile">
			<b id="welcome">Welcome : <i><?php echo $_SESSION['username']; ?></i></b>
			<b id="logout"><a href="./util/logout.php">Log Out</a></b>
		</div>
			<ul class="admin_list">
				<li>
					<div class="container">
						<h3>Insert into catalog</h3>
					</div>
				</li>
				<li>
					<div class="container">
						<h3>Modify garment</h3>
					</div>
				</li>
				<li>
					<div class="container">
						<h3>Delete from catalog</h3>
					</div>
				</li>
				<li>
					<div class="container">
						<h3>Insert sale</h3>
					</div>
				</li>
				<li>
					<div class="container">
						<h3>Modify order</h3>
					</div>
				</li>
				<li>
					<div class="container">
					</div>
				</li>
			</ul>
	</body>
</html>