
function CartDashboard(){}


CartDashboard.removeContent = 
	function(){
		var dashboardElement = document.getElementById("cartDashboard");

		if (dashboardElement === null)
			return;

		while (dashboardElement.firstChild) {
    		dashboardElement.removeChild(dashboardElement.firstChild);
  }
	}


CartDashboard.setEmptyDashboard = 
	function(){
		CartDashboard.removeContent();
		var warningDivElem = document.createElement("div");
		warningDivElem.setAttribute("class", "warning");
		var warningSpanElem = document.createElement("span");
		warningSpanElem.textContent = "There are no items to load!";
		var dashboardElement = document.getElementById("cartDashboard"); 
		warningDivElem.appendChild(warningSpanElem);
		dashboardElement.appendChild(warningDivElem);
	}
		

CartDashboard.refreshData =
	function(data){
		CartDashboard.removeContent();
		
		// Create new cart lists (tag <ul></ul>)
		var newCartListElem = CartDashboard.createCartListElement();
		
		// Create new cart item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var cartItemElem = CartDashboard.createCartItemElement(data[i]);
			newCartListElem.appendChild(cartItemElem);
		}		
		
		document.getElementById("cartDashboard").appendChild(newCartListElem);
		
		var totalPrice = document.createElement("div");
		totalPrice.setAttribute("class", "totalPrice");
		totalPrice.textContent = "Total price: " + data[0].total + " €";
		document.getElementById("cartDashboard").appendChild(totalPrice);
	}

CartDashboard.createCartListElement = 
	function(){
		var cartListElem = document.createElement("ul");
		cartListElem.setAttribute("id", "cartList");
		cartListElem.setAttribute("class", "cart_list");

		cartListElem.appendChild(CartDashboard.createTheadOfTheList());
		
		return cartListElem;
	}


CartDashboard.createTheadOfTheList =
	function(){

		var theadElem = document.createElement("li");
		theadElem.setAttribute("id", "thead");
		theadElem.setAttribute("class", "thead_class");

		var idThead = document.createElement("div");
		idThead.setAttribute("id", "id_thead");
		idThead.setAttribute("class", "thead_class");
		idThead.textContent = "Garment id";

		var sizeThead = document.createElement("div");
		sizeThead.setAttribute("id", "size_thead");
		sizeThead.setAttribute("class", "thead_class");
		sizeThead.textContent = "Size";

		var quantityThead = document.createElement("div");
		quantityThead.setAttribute("id", "quantity_thead");
		quantityThead.setAttribute("class", "thead_class");
		quantityThead.textContent = "Quantity";

		var priceThead = document.createElement("div");
		priceThead.setAttribute("id", "price_thead");
		priceThead.setAttribute("class", "thead_class");
		priceThead.textContent = "Price";

		var detailThead = document.createElement("div");
		detailThead.setAttribute("id", "detail_thead");
		detailThead.setAttribute("class", "thead_class");
		detailThead.textContent = "Details";

		theadElem.appendChild(idThead);
		theadElem.appendChild(sizeThead);
		theadElem.appendChild(quantityThead);
		theadElem.appendChild(priceThead);
		theadElem.appendChild(detailThead);

		return theadElem;
	}

CartDashboard.createCartItemElement = 	
	function(currentData){
		var cartItemLi = document.createElement("li");
		cartItemLi.setAttribute("id", "cart_item_" + currentData.garmentId + "_" + currentData.garmentSize);
		cartItemLi.setAttribute("class", "cart_item_wrapper");

		cartItemLi.appendChild(CartDashboard.createDivElement(currentData));
		
		return cartItemLi; 
	}


CartDashboard.createDivElement =
	function(currentData){
		// Create div wrapper
		var divElem = document.createElement("div");
		divElem.setAttribute("class", "div_cart_item");
		
		//Create id div
		var idElem = document.createElement("div");
		idElem.setAttribute("class", "div_elem");
		idElem.textContent = currentData.garmentId;
 
		//Create size div
		var sizeElem = document.createElement("div");
		sizeElem.setAttribute("class", "div_elem");
		sizeElem.textContent = currentData.garmentSize;

		//Create quantity div
		var quantityElem = document.createElement("div");
		quantityElem.setAttribute("class", "div_elem");
		quantityElem.textContent = currentData.quantity;

		//Create minus div
		var minusImg = document.createElement("img");
		minusImg.setAttribute("alt", "remove_quantity");
		var minusLink = document.createElement("a");
		minusImg.setAttribute("src", "./../immagini/minus.png");
		minusImg.setAttribute("onclick", "GarmentLoader.modifyCart(\'0\',\'" + currentData.garmentId +  "\',\'" + currentData.garmentSize + "\'); UserGarmentNavBarEventHandler.onBadgeNumber()");

		minusLink.appendChild(minusImg);
		quantityElem.insertBefore(minusLink, quantityElem.firstChild);

		//Create plus div
		var plusImg = document.createElement("img");
		plusImg.setAttribute("alt", "add_quantity");
		var plusLink = document.createElement("a");
		plusImg.setAttribute("src", "./../immagini/plus.png"); 
		plusImg.setAttribute("onclick", "GarmentLoader.modifyCart(\'1\',\'" + currentData.garmentId +  "\',\'" + currentData.garmentSize + "\'); UserGarmentNavBarEventHandler.onBadgeNumber()");

		plusLink.appendChild(plusImg);
		quantityElem.appendChild(plusLink);

		//Create price div
		var priceElem = document.createElement("div");
		priceElem.setAttribute("class", "div_elem");
		priceElem.textContent = currentData.price + " €";
		//Create details div
		var detailElem = document.createElement("div");
		detailElem.setAttribute("class", "div_elem");
		detailElem.textContent = "More details";

		var linkElem = document.createElement("a");
		linkElem.setAttribute("href", "./detailedGarment.php?garmentId=" + currentData.garmentId);

		linkElem.appendChild(detailElem);	//add link div in the a element

		divElem.appendChild(idElem);
		divElem.appendChild(sizeElem);
		divElem.appendChild(quantityElem);
		divElem.appendChild(priceElem);
		divElem.appendChild(linkElem);
		
		return divElem;
	}


CartDashboard.fillCartTable =
	function(currentData){

		for (var i = 0; i < currentData.length; i++){

			var tab = document.getElementsByTagName("table")[0];
			var node = document.createElement("tr");
			node.setAttribute("class", "tr_garment");

			var idField = document.createElement("td");
			idField.textContent = currentData[i].garmentId;

			var modelField = document.createElement("td");
			var modelLink = document.createElement("a");
			modelLink.setAttribute("href", "./detailedGarment.php?garmentId=" + currentData[i].garmentId);

			var minusField = document.createElement("td");
			
			var quantityField = document.createElement("td");
			quantityField.textContent = currentData[i].quantity;

			var plusField = document.createElement("td");

			var sizeField = document.createElement("td");
			sizeField.textContent = currentData[i].garmentSize;

			var priceField = document.createElement("td");
			priceField.textContent = currentData[i].price;

			modelField.appendChild(modelLink);

			node.appendChild(idField);
			node.appendChild(sizeField);
			node.appendChild(minusField);
			node.appendChild(quantityField);
			node.appendChild(plusField);
			node.appendChild(priceField);
			node.appendChild(modelField);
			tab.appendChild(node);
		}
	}
