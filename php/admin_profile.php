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
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <meta name = "author" content = "Martina Marino">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Supernova">
		<link rel="stylesheet" href="../css/header.css" rel="stylesheet" type="text/css">
		<link href="../css/admin.css" rel="stylesheet" type="text/css">
	    <link rel="icon" rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
	    <script src="./../js/ajax/AdminLoader.js"></script>  
	    <script src="./../js/ajax/AdminDashboard.js"></script>  
	    <script src="./../js/ajax/ajaxManager.js"></script>  
	    <script src="./../js/home.js"></script>
		<title>Supernova-Admin profile</title>
	</head>
	<body <?php if(isset($_GET['errorMessage'])) echo 'onload="AdminEffects()"'; ?>>
		<?php
			include"./layout/top_bar.php";
		?>
		<h2>Admin control panel</h2>
		<div id="profile">
			<button id="logout" onclick="window.location.href='./util/logout.php'">Log Out</button>
		</div>					
				<?php
		            if (isset($_GET['errorMessage'])){
		                echo '<div class="sign_in_error" id="admin_message">';
		                echo '<span><b>' . $_GET['errorMessage'] . '</b></span>';
		                echo '</div>';
		          	}
		        ?>
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
								<div>Insert image: </div>
							</div>
							<form class="input" method="POST" action="ajax/insert_new_garment.php" enctype="multipart/form-data">
								<input id="model_input" class="input_field" name="model_input" required>
								<input id="color_input" class="input_field" name="color_input" required>
								<input type="radio" name="category_input" class="radio_options" value="clothing">clothing &nbsp
								<input type="radio" name="category_input" class="radio_options" value="accessories">accessories<br>
								<input type="radio" name="genre_input" class="radio_options" value="male">Male
								<input type="radio" name="genre_input" class="radio_options" value="female">Female
								<input type="radio" name="genre_input" class="radio_options" value="unisex">Unisex<br>
								<input type="radio" name="collection_input" class="radio_options" value="S/S">S/S
								<input type="radio" name="collection_input" class="radio_options" value="A/W">A/W
								<input id="price_input" class="input_field" name="price_input" required>
								<input type="file" id="image_input" name="image_input">
								<input type="submit" class="button" value="Add">
							</form>
						</div>
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
								<br>
								<div>New value: </div>
							</div>
							<form class="input" id="modify_garment" action="ajax/modify_garment.php" method="post" enctype="multipart/form-data">
								<select class="dropdown" id="ID" name="ID">
									<?php 
										allGarmentsID(); 
									?>
								</select>
				    			<select id="garmentField" name="garmentField" onfocus="AdminLoader.showActualValue('garment', 'garmentId', getSelectedValue('ID'), getSelectedValue('garmentField'), 'garment_actual_value', 'modify_garment')" onchange="AdminLoader.showActualValue('garment', 'garmentId', getSelectedValue('ID'), getSelectedValue('garmentField'), 'garment_actual_value', 'modify_garment')">
					  				<option value="model">model</option>
						 			<option value="color">color</option>
						 			<option value="category">category</option>
						 			<option value="genre">genre</option>
						 			<option value="collection">collection</option>
						 			<option value="discountedPrice">discounted price</option>
						 			<option value="price">price</option>
						 			<option value="img">image</option>
								</select>
								<div class="actual_value" id="garment_actual_value"></div>
								<input id="new_garment_value" name="new_garment_value" class="input_field">
								<input class="button" type="submit" value="Apply">
							</form>
						</div>
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
								<select class="dropdown" id="garmentToDelete">
									<?php 
										allGarmentsID(); 
									?>
								</select>
							</div>
						</div>
						<button class="button" onclick="deleteFromCatalog()">Delete</button>
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
								<input id="new_sale_value" class="input_field">
								<select id="collectionToDiscount">
									<?php 
										allCollections(); 
									?>
								</select>
							</div>
						</div>
						<button class="button" onclick="insertSale()">Add</button>
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
								<div>Select order: </div>
								<div>Select field: </div>
								<div>Select garment: </div>
								<div>Select detail: </div>
								<div id="order_actual_value_label">Actual value: </div>
								<br>
								<div>New value: </div>
							</div>
							<form class="input" method="post" action="ajax/modify_order.php" enctype="multipart/form-data">
								<select id="ordersID" name="ordersID" onfocus="AdminLoader.showOrderGarmentId('select_order_garment_id', getSelectedValue('ordersID'))" onchange="AdminLoader.showOrderGarmentId('select_order_garment_id', getSelectedValue('ordersID'))">
									<?php
										allOrdersID();
									?>
								</select>
				    			<select id="order_select" name="order_select" onfocus="AdminLoader.showActualValue('order', 'codice', getSelectedValue('ordersID'), getSelectedValue('order_select'), 'order_actual_value', 'modify_order')" onchange="AdminLoader.showActualValue('order', 'codice', getSelectedValue('ordersID'), getSelectedValue('order_select'), 'order_actual_value', 'modify_order')">
					  				<option value="email">email</option>
						 			<option value="totale">total</option>
						 			<option value="data">date</option>
						 			<option value="stato">state</option>
						 			<option value="pagamento">payment</option>
						 			<option value="articoli">modify garment details</option>
								</select>
								<select id="select_order_garment_id" name="select_order_garment_id" disabled onfocus="AdminLoader.showActualValue('order_garment', getSelectedValue('ordersID'), getSelectedValue('select_order_garment_id'), getSelectedValue('select_order_garment_field'),'order_actual_value', 'modify_order')" onchange="AdminLoader.showActualValue('order_garment', getSelectedValue('ordersID'), getSelectedValue('select_order_garment_id'), getSelectedValue('select_order_garment_field'),'order_actual_value', 'modify_order')">
									<option value="" disabled selected>Select modify garment details</option>
									
								</select>
								<select id="select_order_garment_field" name="select_order_garment_field" disabled onfocus="AdminLoader.showActualValue('order_garment', getSelectedValue('ordersID'), getSelectedValue('select_order_garment_id'), getSelectedValue('select_order_garment_field'),'order_actual_value', 'modify_order')" onchange="AdminLoader.showActualValue('order_garment', getSelectedValue('ordersID'), getSelectedValue('select_order_garment_id'), getSelectedValue('select_order_garment_field'),'order_actual_value', 'modify_order')">
									<option value="" disabled selected>Select modify garment details</option>
									<option value="quantity">quantity</option>
									<option value="garmentSize">garment size</option>
									<option value="color">color</option>
									<option value="price">price</option>
								</select>
								<div class="actual_value" id="order_actual_value"></div>
								<input id="order_new_value" name="order_new_value" class="input_field">
								<input type="submit" class="button" value="Apply">
							</form>
						</div>
						<!-- <button class="button" onclick="modifyOrder()">Apply</button> -->
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
								<div>Select garment:</div>
								<div>Select size:</div>
								<div>Actual quantity:</div>
								<br>
								<div>Modify quantity;</div>
							</div>
							<div class="input">
								<select id="stockGarmentID" onchange="AdminLoader.showGarmentSize(getSelectedValue('stockGarmentID'))">
									<?php
										allGarmentsID();
									?>
								</select>
								<select id="sizes" onfocus="AdminLoader.showActualValue('stock', 'size', getSelectedValue('sizes'), 'quantity', 'actual_stock_quantity', 'stock')" onchange="AdminLoader.showActualValue('stock', 'size', getSelectedValue('sizes'), 'quantity', 'actual_stock_quantity', 'stock')">
									<option value="" disabled selected>Please select a size</option>
								</select>
								<div class="actual_value" id="actual_stock_quantity"></div>
								<br>
								<input id="quantity" class="input_field">
							</div>
						</div>
						<button class="button" onclick="stock()">Apply</button>
					</div>
				</li>
			</ul>
	</body>
</html>