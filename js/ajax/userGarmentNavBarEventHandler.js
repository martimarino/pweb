function UserGarmentNavBarEventHandler(){}

UserGarmentNavBarEventHandler.DEFAULT_METHOD = "GET";
UserGarmentNavBarEventHandler.URL_REQUEST = "./ajax/userGarmentInteraction.php";
UserGarmentNavBarEventHandler.BADGE_REQUEST = "./ajax/badgeLoader.php";
UserGarmentNavBarEventHandler.ADD_TO_CART_REQUEST = "./ajax/addToCart.php";
UserGarmentNavBarEventHandler.ASYNC_TYPE = true;

UserGarmentNavBarEventHandler.SUCCESS_RESPONSE = "0";

UserGarmentNavBarEventHandler.onDesiredEvent = 
	function(garmentId) {
		var flag =  getComplementaryFlag(document.getElementById("desiredItem_" + garmentId));
		var queryString = "?garmentId=" + garmentId + "&desired=" + flag;
		var url = UserGarmentNavBarEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserGarmentNavBarEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

UserGarmentNavBarEventHandler.onCartEvent = 
	function(garmentId){
		var garmentSize = getSelectedSize(garmentId);
		var queryString = "?garmentId=" + garmentId + "&garmentSize=" + garmentSize;
		var url = UserGarmentNavBarEventHandler.ADD_TO_CART_REQUEST + queryString;
		var responseFunction = UserGarmentNavBarEventHandler.onAddToCartAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

UserGarmentNavBarEventHandler.onAddToCartAjaxResponse = 
	function(response){
		if (response.responseCode === UserGarmentNavBarEventHandler.SUCCESS_RESPONSE){  
			GarmentDashboard.updateCartPage(response.data);
		}
	}
	
UserGarmentNavBarEventHandler.onBadgeNumber = 
	function(){
		var url = UserGarmentNavBarEventHandler.BADGE_REQUEST;
		var responseFunction = UserGarmentNavBarEventHandler.onBadgeAjaxResponse;
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

UserGarmentNavBarEventHandler.onBadgeAjaxResponse = 
	function(response){
		if(response.responseCode === UserGarmentNavBarEventHandler.SUCCESS_RESPONSE){
			GarmentDashboard.updateBadgeNumber(response.data);
		}
	}

UserGarmentNavBarEventHandler.onAjaxResponse = 
	function(response){
		if (response.responseCode === UserGarmentNavBarEventHandler.SUCCESS_RESPONSE){
			GarmentDashboard.updateGarmentNavBar(response.data);
		}
	}

function getComplementaryFlag(item){
	var classAttribute = item.getAttribute("class"); // item.className;
	var currentFlag = parseInt(classAttribute.charAt(classAttribute.length-1)); // parseInt(classAttribute.slice(-1));
	return (currentFlag+1)%2;
}

function getSelectedSize(garmentId){
	var elem = document.getElementById("size_options");
	var size = elem.options[elem.selectedIndex].value;
	return size; 
}