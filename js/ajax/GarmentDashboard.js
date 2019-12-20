function GarmentDashboard(){}

GarmentDashboard.DEFAULT_MODEL_URL = '../immagini/place_holder.jpg';

GarmentDashboard.removeContent = 
	function(){
		var dashboardElement = document.getElementById("garmentDashboard");

		if (dashboardElement === null)
			return;
		
		var firstChild = dashboardElement.firstChild;
		if (firstChild !== null)
			dashboardElement.removeChild(firstChild);
	}

GarmentDashboard.setEmptyDashboard = 
	function(){
		GarmentDashboard.removeContent();
		var warningDivElem = document.createElement("div");
		warningDivElem.setAttribute("class", "warning");
		var warningSpanElem = document.createElement("span");
		warningSpanElem.textContent = "There are no garments to load!";
		var dashboardElement = document.getElementById("garmentDashboard");
		warningDivElem.appendChild(warningSpanElem);
		dashboardElement.appendChild(warningDivElem);
	}
	
GarmentDashboard.addMoreData =
	function(data){
		var dashboardElement = document.getElementById("garmentDashboard");
		if (dashboardElement === null || data === null || data.length <= 0)
			return;
			
		// Get the garment list element (tag '<ul></ul>')	
		var garmentListElem = document.getElementById("modelGarmentList");
		if (garmentListElem === null){
			garmentListElem = GarmentDashboard.createGarmentListElement();
			dashboardElement.appendChild(garmentListElem);
		}
		
		// Create new garment item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var garmentItemElem = GarmentDashboard.createGarmentItemElement(data[i]);
			garmentListElem.appendChild(garmentItemElem);
		}		
		
	}

GarmentDashboard.refreshData =
	function(data){
		GarmentDashboard.removeContent();
		
		// Create new garment lists (tag <ul></ul>)
		var newGarmentListElem = GarmentDashboard.createGarmentListElement();
		
		// Create new garment item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var garmentItemElem = GarmentDashboard.createGarmentItemElement(data[i]);
			newGarmentListElem.appendChild(garmentItemElem);
		}		

		document.getElementById("garmentDashboard").appendChild(newGarmentListElem);

	}
	
GarmentDashboard.createGarmentListElement = 
	function(){
		var garmentListElem = document.createElement("ul");
		garmentListElem.setAttribute("id", "modelGarmentList");
		garmentListElem.setAttribute("class", "model_garments_list");
		
		return garmentListElem;
	}

GarmentDashboard.createGarmentItemElement = 	
	function(currentData){
		var garmentItemLi = document.createElement("li");
		garmentItemLi.setAttribute("id", "garment_item_" + currentData.garment.garmentId);
		garmentItemLi.setAttribute("class", "model_garment_item_wrapper");
		
		garmentItemLi.appendChild(GarmentDashboard.createNavBarElement(currentData));
		garmentItemLi.appendChild(GarmentDashboard.createModelElement(currentData));
		garmentItemLi.appendChild(GarmentDashboard.createDetailGarmentElement(currentData));
		
		return garmentItemLi; 
	}

GarmentDashboard.createNavBarElement =
	function(currentData){
		var navBarElem = document.createElement("nav");
		navBarElem.setAttribute("id", "user_garment_nav_bar_" + currentData.garment.garmentId);
		navBarElem.setAttribute("class", "user_nav_bar");
		
		// Create desired div elem (tag <div></div>)
		var desiredItemElem = document.createElement("div");
		desiredItemElem.setAttribute("id", "desiredItem_" + currentData.garment.garmentId);
		desiredItemElem.setAttribute("class", "nav_garment_item desired_img_" + currentData.userGarmentStat.desired);
		desiredItemElem.setAttribute("onClick", "UserGarmentNavBarEventHandler.onDesiredEvent(" + currentData.garment.garmentId + "); UserGarmentNavBarEventHandler.onBadgeNumber()");
	
		// Create like div elem (tag <div></div>)
		var likeItemElem = document.createElement("div");
		likeItemElem.setAttribute("id", "likeItem_" + currentData.garment.garmentId);
		likeItemElem.setAttribute("class", "nav_garment_item like_img_" + currentData.userGarmentStat.liked);
		likeItemElem.setAttribute("onClick", "UserGarmentNavBarEventHandler.onLikeEvent(" + currentData.garment.garmentId + ")");
		
		// Create dislike div elem (tag <div></div>)
		var dislikeItemElem = document.createElement("div");
		dislikeItemElem.setAttribute("id", "dislikeItem_" + currentData.garment.garmentId);
		dislikeItemElem.setAttribute("class", "nav_garment_item dislike_img_" + currentData.userGarmentStat.disliked);
		dislikeItemElem.setAttribute("onClick", "UserGarmentNavBarEventHandler.onDislikeEvent(" + currentData.garment.garmentId + ")");
		
		// Create like count div elem (tag <div></div>)
		var likeCountItemElem = document.createElement("div");
		likeCountItemElem.setAttribute("id", "likeCountItem_" + currentData.garment.garmentId);
		likeCountItemElem.setAttribute("class", "nav_garment_item stats_user_garment");
		likeCountItemElem.textContent = "(" + currentData.userGarmentStat.likedCount + ")";
		
		// Create dislike count div elem (tag <div></div>)
		var dislikeCountItemElem = document.createElement("div");
		dislikeCountItemElem.setAttribute("id", "dislikeCountItem_" + currentData.garment.garmentId);
		dislikeCountItemElem.setAttribute("class", "nav_garment_item stats_user_garment");
		dislikeCountItemElem.textContent = "(" + currentData.userGarmentStat.dislikedCount + ")";

		// Append all the div element to the nav bar
		navBarElem.appendChild(desiredItemElem);
		navBarElem.appendChild(likeItemElem);
		navBarElem.appendChild(likeCountItemElem);
		navBarElem.appendChild(dislikeItemElem);
		navBarElem.appendChild(dislikeCountItemElem);
		
		return navBarElem;
	}

GarmentDashboard.createModelElement =
	function(currentData){
		// Create div wrapper
		var modelDivElem = document.createElement("div");
		modelDivElem.setAttribute("class", "model_garment_item");
		
		// Create model link
		var modelLinkElem = document.createElement("a");
		modelLinkElem.setAttribute("href", "./detailedGarment.php?garmentId=" + currentData.garment.garmentId);
		
		// Create img
		var modelImgElem = new Image();
		modelImgElem.alt = "model";
		modelImgElem.src = "../" + currentData.garment.img;
		if (currentData.garment.img === "N/A")
			modelImgElem.src = GarmentDashboard.DEFAULT_MODEL_URL;
		if (currentData.garment.totalInStock == 0)  //se è finito in ogni taglia
		{
			modelImgElem.style.opacity = '0.4';
			var soldOut = document.createElement("p");
			soldOut.setAttribute("id", "sold_out");
			soldOut.textContent = "SOLD OUT";
			modelDivElem.appendChild(soldOut);
		}
				
		modelLinkElem.appendChild(modelImgElem);
		modelDivElem.appendChild(modelLinkElem);
		
		return modelDivElem;
	}
			
GarmentDashboard.createDetailGarmentElement =
	function(currentData){
		// Create div wrapper
		var detailGarmentDivElem = document.createElement("div");
		detailGarmentDivElem.setAttribute("class", "detail_garment_item");
		
		// Create model link (tag <a></a>)
		var detailGarmentLinkElem = document.createElement("a");
		detailGarmentLinkElem.setAttribute("href", "./detailedGarment.php?garmentId=" + currentData.garment.garmentId);
		detailGarmentLinkElem.textContent = currentData.garment.model;
		
		// Create price paragraph (tag <p></p>)
		var detailGarmentDirectorPElem = document.createElement("p");
		detailGarmentDirectorPElem.textContent = currentData.garment.price + " €";
		
		detailGarmentDivElem.appendChild(detailGarmentLinkElem);
		detailGarmentDivElem.appendChild(detailGarmentDirectorPElem);
		
		return detailGarmentDivElem;	
	}

GarmentDashboard.updateGarmentNavBar = 
	function(data){
		if (document.getElementById("user_garment_nav_bar_" + data.garment.garmentId) === null)
			return;
	
		var itemNavBar;
		// desired item
		itemNavBar = document.getElementById("desiredItem_" + data.garment.garmentId);
		itemNavBar.setAttribute("class", "nav_garment_item desired_img_" + data.userGarmentStat.desired);
		// like item
		itemNavBar = document.getElementById("likeItem_" + data.garment.garmentId);
		itemNavBar.setAttribute("class", "nav_garment_item like_img_" + data.userGarmentStat.liked);
		itemNavBar = document.getElementById("likeCountItem_" + data.garment.garmentId);
		itemNavBar.textContent = "(" + data.userGarmentStat.likedCount + ")";
		//dislike item
		itemNavBar = document.getElementById("dislikeItem_" + data.garment.garmentId);	
		itemNavBar.setAttribute("class", "nav_garment_item dislike_img_" + data.userGarmentStat.disliked);
		itemNavBar = document.getElementById("dislikeCountItem_" + data.garment.garmentId);
		itemNavBar.textContent = "(" + data.userGarmentStat.dislikedCount + ")";

		//remove node from wishlist
		var flag =  getComplementaryFlag(document.getElementById("desiredItem_" + data.garment.garmentId));
		var url = window.location.pathname;
		if(flag == 1 && url == "/Supernova/php/wishList.php")
		{
			var element = document.getElementById("garment_item_" + data.garment.garmentId);
			element.remove();
		}

		//remove node from cart
		if(flag == 1 && url == "/Supernova/php/cart.php")
		{
			element = document.getElementById("garment_item_" + data.garment.garmentId);
			element.remove();
		}

	}

GarmentDashboard.updateBadgeNumber =
	function(data){

		var heartElement = document.getElementById("wishlistBadge");

		if(heartElement != null)	//se c'è il badge lo aggiorno
		{

			//reload wishlist number
			newWishlistBadge = document.createElement("li");
			newWishlistBadge.setAttribute("id", "wishlistBadge");
			newWishlistBadge.setAttribute("class", "badge");
			newWishlistBadge.textContent = data.wishlist;
			parentNode = document.getElementById("right-list");
			parentNode.replaceChild(newWishlistBadge, document.getElementById("wishlistBadge"));

			if(data.wishlist == 0){		//se il valore è 0 rimuovo il badge
				var heartElement = document.getElementById("wishlistBadge");
				heartElement.parentNode.removeChild(heartElement);
			}
		}
		else  		//se il badge non c'è
		{
			if(data.wishlist > 0)	//se il valore è > 0
			{
				newWishlistBadge = document.createElement("li");
				newWishlistBadge.setAttribute("id", "wishlistBadge");
				newWishlistBadge.setAttribute("class", "badge");
				newWishlistBadge.textContent = data.wishlist;
				beforeNode = document.getElementById("login");
				parentNode = document.getElementById("right-list");
				parentNode.insertBefore(newWishlistBadge, beforeNode);
			}
		}

		var cartElement = document.getElementById("cartBadge");

		if(cartElement != null)		//come sopra
		{

			//reload cart number
			newCartBadge = document.createElement("li");
			newCartBadge.setAttribute("id", "cartBadge");
			newCartBadge.setAttribute("class", "badge");
			newCartBadge.textContent = data.cart;
			parentNode = document.getElementById("right-list");
			parentNode.replaceChild(newCartBadge, document.getElementById("cartBadge"));

			if(data.cart == null)
			{
				var cartElement = document.getElementById("cartBadge");
				cartElement.parentNode.removeChild(cartElement);
			}
		}

		else  		//se il badge non c'è
		{
			if(data.cart != null)	//se il valore non è null
			{
				newCartBadge = document.createElement("li");
				newCartBadge.setAttribute("id", "cartBadge");
				newCartBadge.setAttribute("class", "badge");
				newCartBadge.textContent = data.cart;
				parentNode = document.getElementById("right-list");
				parentNode.appendChild(newCartBadge);
			} 

		}


	}
	
GarmentDashboard.updateNavigationPage = 
	function(currentPage, noMoreDataExist){
		// update the number of the page
		var currentPageElems = document.getElementsByClassName("currentPage");
		for (var i = 0; i < currentPageElems.length; i++)
			currentPageElems[i].textContent = "Page " + currentPage;
		
		var previousElems = document.getElementsByClassName("previous");
		for (var i = 0; i < previousElems.length; i++){
			if (currentPage === 1) // Disable the previous event
				previousElems[i].disabled = true;
			else // Enable the previous event
				previousElems[i].disabled = false;
			
		}
		
		var nextElems = document.getElementsByClassName("next");
		for (var i = 0; i < nextElems.length; i++){
			if (noMoreDataExist) // Disable the next event
				nextElems[i].disabled = true;
			else // Enable the previous event
				nextElems[i].disabled = false;
			
		}

	}

GarmentDashboard.fillSizesOptions = 
	function(currentData){

		var dropDown = document.getElementsByTagName("select")[0];
		for (var i = 0; i < currentData.length; i++){
			var node = document.createElement("option");
			if(currentData[i].quantity > 0)
				node.setAttribute("class", "sizes_option");
			else
				node.setAttribute("class", "finished_sizes_option");
			node.setAttribute("value", currentData[i].sizeLetter);
			node.textContent = currentData[i].sizeLetter;

			dropDown.appendChild(node);
		}

	}

GarmentDashboard.updateCartPage = 
	function(currentData){  
		if((currentData.quantity === currentData.stockQuantity) || (currentData.stockQuantity === "0")) {
			document.getElementById("add_to_cart").disabled = true;
			document.getElementById("add_to_cart").style.cursor = "auto";
			var newChild = document.createElement("p");
			newChild.setAttribute("id", "no_more_available");
			newChild.textContent = "No longer available in stock";
			var parent = document.getElementById("main");
			parent.appendChild(newChild);
		}
	}