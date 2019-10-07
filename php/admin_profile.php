<?php
	require_once __DIR__ . "/config.php";
  	session_start();
    include DIR_UTIL . "session.php";
    include DIR_UTIL . "supernovaDbManager.php";
    include DIR_UTIL . "garmentManagerDb.php";
    include "util/utility.php";

    if (!isLogged()){
		    header('Location: ./../index.php');
		    exit;
    }	
?>
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name = "author" content = "Martina Marino">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Supernova">
		<link rel="stylesheet" href="../css/header.css" rel="stylesheet" type="text/css">
		<link href="../css/admin.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script src="./../js/ajax/AdminLoader.js"></script>  
	    <script src="./../js/ajax/AdminDashboard.js"></script>  
	    <script src="./../js/ajax/ajaxManager.js"></script>  
	    <script src="./../js/home.js"></script>
		<title>Supernova-Admin profile</title>
	</head>
	<body onLoad="hideBadges()">
		<?php
			include"./layout/top_bar.php";
		?>
		<h2>Admin control panel</h2>
		<div id="profile">
			<button id="logout" onclick="window.location.href='./util/logout.php'">Log Out</button>
		</div>
			<ul class="admin_list">
				<li>
					<div class="container">
						<div class="head">
							<h3>Insert into catalog</h3>
							<div class="admin-image" id="new-product"></div>
						</div>
						<div class="content">
							<div class="label">
								<div>Model: </div>
								<div>Color: </div>
								<div>Category: </div>
								<div>Genre: </div>
								<div>Collection: </div>
								<div>Price: </div>
								<div>Image: </div>
							</div>
							<div class="input">
								<input id="model_input" required>
								<input id="color_input" required>
								<input id="category_input" required>
								<input id="genre_input" required>
								<input id="collection_input" required>
								<input id="price_input" required>
								<input id="image_input" required>
							</div>
						</div>
						<button class="button">Add</button>
					</div>
				</li>
				<li>
					<div class="container">
						<div class="head">
							<h3>Modify garment</h3>
							<div class="admin-image" id="fashion"></div>
						</div>
						<div class="content">
							<div class="label">
								<div>Select garment : </div>
								<div>Select field: </div>
								<div>Actual value: </div>
								<div>New value: </div>
							</div>
							<div class="input">
								<select class="dropdown" name="ID">
									<?php 
										allGarmentsID(); 
									?>
								</select>
				    			<select name="field">
					  				<option value="model">model</option>
						 			<option value="color">color</option>
						 			<option value="category">category</option>
						 			<option value="genre">genre</option>
						 			<option value="collection">collection</option>
						 			<option value="price">price</option>
						 			<option value="img">image</option>
								</select>
								<input>
								<input>
							</div>
						</div>
						<button class="button">Apply</button>
					</div>
				</li>
				<li>
					<div class="container">
						<div class="head">
							<h3>Delete from catalog</h3>
							<div class="admin-image" id="garbage"></div>
						</div>
						<div class="content">
							<div class="label">
								<div>Select garment to delete: </div>
							</div>
							<div class="input">
								<select class="dropdown" name="ID">
									<?php 
										allGarmentsID(); 
									?>
								</select>
							</div>
						</div>
						<button class="button">Delete</button>
					</div>
				</li>
				<li>
					<div class="container">
						<div class="head">
							<h3>Insert sale</h3>
							<div class="admin-image" id="sale"></div>
						</div>
						<div class="content">
							<div class="label">
								<div>Insert sale percentage: </div>
								<div>Select collection to discount: </div>
							</div>
							<div class="input">
								<input>
								<select name="collection">
									<?php 
										allCollections(); 
									?>
								</select>
							</div>
						</div>
						<button class="button">Add</button>
					</div>
				</li>
				<li>
					<div class="container">
						<div class="head">
							<h3>Modify order</h3>
							<div class="admin-image" id="tracking"></div>
						</div>
						<div class="content">
							<div class="label">
								<div>Select order : </div>
								<div>Select field: </div>
								<div>Actual value: </div>
								<div>New value: </div>
							</div>
							<div class="input">
								<select name="ordersID">
									<?php
										allOrdersID();
									?>
								</select>
				    			<select name="field">
					  				<option value="email">email</option>
						 			<option value="totale">totale</option>
						 			<option value="data">data</option>
						 			<option value="stato">stato</option>
						 			<option value="pagamento">pagamento</option>
								</select>
								<input id="order_new_value">
								<input>
							</div>
						</div>
						<button class="button">Apply</button>
					</div>
				</li>
				<li>
					<div class="container">
						<div class="head">
							<h3>Stock</h3>
							<div class="admin-image" id="warehouse"></div>
						</div>
						<div class="content">
							<div class="label">
								<div>Select garment</div>
								<div>Select size</div>
								<div>Actual quantity</div>
								<div>Modify quantity</div>
							</div>
							<div class="input">
								<select id="stockGarmentID" onchange="AdminLoader.showGarmentSize(getSelectedValue())">
									<option value="" disabled selected>Select a garment</option>
									<?php
										allGarmentsID();
									?>
								</select>
								<select id="sizes">
									<option value="" disabled selected>Please select a size</option>
								</select>
								<input>
							</div>
						</div>
						<button class="button">Apply</button>
					</div>
				</li>
			</ul>
	</body>
</html>