function UserGarmentNavBarEventHandler(){}

UserGarmentNavBarEventHandler.DEFAULT_METHOD = "GET";
UserGarmentNavBarEventHandler.URL_REQUEST = "./ajax/userGarmentInteraction.php";
UserGarmentNavBarEventHandler.ASYNC_TYPE = true;

UserGarmentNavBarEventHandler.SUCCESS_RESPONSE = "0";

UserGarmentNavBarEventHandler.onDesiredEvent = 
	function(garmentId) {
		var flag =  getComplementaryFlag(document.getElementById("desiredItem_" + garmentId))
		var queryString = "?garmentId=" + garmentId + "&desired=" + flag;
		var url = UserGarmentNavBarEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserGarmentNavBarEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

UserGarmentNavBarEventHandler.onInCartEvent =
	function(garmentId){
		var flag =  getComplementaryFlag(document.getElementById("inCartItem_" + garmentId))
		var queryString = "?garmentId=" + garmentId + "&inCart=" + flag;
		var url = UserGarmentNavBarEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserGarmentNavBarEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

UserGarmentNavBarEventHandler.onLikeEvent = 
	function(garmentId){
		var flag =  getComplementaryFlag(document.getElementById("likeItem_" + garmentId))
		var queryString = "?garmentId=" + garmentId + "&like=" + flag;
		var url = UserGarmentNavBarEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserGarmentNavBarEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}	

UserGarmentNavBarEventHandler.onDislikeEvent = 
	function(garmentId){
		var flag =  getComplementaryFlag(document.getElementById("dislikeItem_" + garmentId))
		var queryString = "?garmentId=" + garmentId + "&dislike=" + flag;
		var url = UserGarmentNavBarEventHandler.URL_REQUEST + queryString;
		var responseFunction = UserGarmentNavBarEventHandler.onAjaxResponse;
	
		AjaxManager.performAjaxRequest(UserGarmentNavBarEventHandler.DEFAULT_METHOD, 
										url, UserGarmentNavBarEventHandler.ASYNC_TYPE, 
										null, responseFunction)
	}

UserGarmentNavBarEventHandler.onAjaxResponse = 
	function(response){
		if (response.responseCode === UserGarmentNavBarEventHandler.SUCCESS_RESPONSE)
			GarmentDashboard.updateGarmentNavBar(response.data);

	}

function getComplementaryFlag(item){
	var classAttribute = item.getAttribute("class"); // item.className;
	var currentFlag = parseInt(classAttribute.charAt(classAttribute.length-1)); // parseInt(classAttribute.slice(-1));
	return (currentFlag+1)%2;
}
