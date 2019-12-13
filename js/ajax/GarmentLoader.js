function GarmentLoader(){}

//*****************************			VARIABLES		************************************

GarmentLoader.DEFAULT_METHOD = "GET";
GarmentLoader.URL_REQUEST = "./ajax/garmentLoader.php";
GarmentLoader.SEARCH_REQUEST = "./ajax/searchLoader.php";
GarmentLoader.ORDER_REQUEST = "./ajax/orderLoader.php";
GarmentLoader.CART_REQUEST = "./ajax/cartLoader.php";
GarmentLoader.DETAILED_ORDER_REQUEST = "./ajax/orderGarmentLoader.php";
GarmentLoader.GARMENT_SIZES_REQUEST = "./ajax/sizesGarmentLoader.php";
GarmentLoader.ASYNC_TYPE = true;

GarmentLoader.GARMENT_TO_LOAD = 20;
GarmentLoader.CURRENT_PAGE_INDEX = 1;

GarmentLoader.SUCCESS_RESPONSE = "0";
GarmentLoader.NO_MORE_DATA = "-1";

GarmentLoader.LATEST_GARMENTS_SEARCH = 0;
GarmentLoader.ALL_GARMENTS_SEARCH = 1;
GarmentLoader.WISHLIST_SEARCH = 2;
GarmentLoader.IN_CART_GARMENTS_SEARCH = 3;


//******************************		FUNCTIONS		**************************************

GarmentLoader.init = 
	function() {
		GarmentLoader.PAGE_INDEX = 1;
	}

GarmentLoader.loadGarment = 
	function(searchType)
	{
		var queryString = "?searchType=" + searchType 
							+ "&garmentToLoad=" + GarmentLoader.GARMENT_TO_LOAD 
							+ "&offset=" + (GarmentLoader.CURRENT_PAGE_INDEX-1)*GarmentLoader.GARMENT_TO_LOAD;
							
		var url = GarmentLoader.URL_REQUEST + queryString;
		var responseFunction = GarmentLoader.onAjaxResponse;
		AjaxManager.performAjaxRequest(GarmentLoader.DEFAULT_METHOD, url, GarmentLoader.ASYNC_TYPE, null, responseFunction);
	}

GarmentLoader.next = 
	function(searchType){
		GarmentLoader.CURRENT_PAGE_INDEX++;
		GarmentLoader.loadGarment(searchType);
	}

GarmentLoader.previous = 
	function(searchType){
		GarmentLoader.CURRENT_PAGE_INDEX--;
		if(GarmentLoader.CURRENT_PAGE_INDEX <= 1)
			GarmentLoader.CURRENT_PAGE_INDEX = 1;

		GarmentLoader.loadGarment(searchType);
	}

GarmentLoader.onAjaxResponse = 
	function(response){
		if (response.responseCode === GarmentLoader.NO_MORE_DATA 
		 	&&	GarmentLoader.CURRENT_PAGE_INDEX === 1){
			
				GarmentDashboard.setEmptyDashboard(response.message);
				GarmentDashboard.updateNavigationPage(GarmentLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === GarmentLoader.SUCCESS_RESPONSE){
			GarmentDashboard.refreshData(response.data);
		}
		
		var noMoreDataExist = (response.data === null || response.data.length < GarmentLoader.GARMENT_TO_LOAD);
		GarmentDashboard.updateNavigationPage(GarmentLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
	}

GarmentLoader.search =
	function(pattern){
		if (pattern === null || pattern.length === 0){
			GarmentDashboard.removeContent();
			return;	
		}
			
		var queryString = "?pattern=" + pattern;
		var url = GarmentLoader.SEARCH_REQUEST + queryString;
		var responseFunction = GarmentLoader.onAjaxResponse;

		AjaxManager.performAjaxRequest(GarmentLoader.DEFAULT_METHOD, 
										url, GarmentLoader.ASYNC_TYPE, 
										null, responseFunction);
	}

GarmentLoader.loadCart = 
	function(){
		var url = GarmentLoader.CART_REQUEST;
		var responseFunction = GarmentLoader.onCartAjaxResponse;
		AjaxManager.performAjaxRequest(GarmentLoader.DEFAULT_METHOD, url, GarmentLoader.ASYNC_TYPE, null, responseFunction);
	}

GarmentLoader.onCartAjaxResponse = 
	function(response){
		if (response.responseCode === GarmentLoader.SUCCESS_RESPONSE){
			CartDashboard.refreshData(response.data);
		}
	}

GarmentLoader.loadOrder = 
	function()
	{
		var url = GarmentLoader.ORDER_REQUEST;
		var responseFunction = GarmentLoader.onOrderAjaxResponse;
		AjaxManager.performAjaxRequest(GarmentLoader.DEFAULT_METHOD, url, GarmentLoader.ASYNC_TYPE, null, responseFunction);
	}

GarmentLoader.onOrderAjaxResponse =
	function(response){
		if (response.responseCode === GarmentLoader.SUCCESS_RESPONSE){
			OrderDashboard.refreshData(response.data);
		}
	}

GarmentLoader.loadOrderItems =
	function(orderId){
		if (orderId === null || orderId.length === 0){
			OrderDashboard.removeContent();
			return;	
		}
			
		var queryString = "?orderId=" + orderId;
		var url = GarmentLoader.DETAILED_ORDER_REQUEST + queryString;
		var responseFunction = GarmentLoader.onOrderItemsAjaxResponse;

		AjaxManager.performAjaxRequest(GarmentLoader.DEFAULT_METHOD, 
										url, GarmentLoader.ASYNC_TYPE, 
										null, responseFunction);
	}

GarmentLoader.onOrderItemsAjaxResponse =
	function(response){
		if (response.responseCode === GarmentLoader.SUCCESS_RESPONSE){
			OrderDashboard.fillOrderTable(response.data);
		}
	}

GarmentLoader.loadGarmentSizes = 
	function(garmentId){
		if(garmentId == null || garmentId.length === 0){
			return;
		}
		var queryString = "?garmentId=" + garmentId;
		var url = GarmentLoader.GARMENT_SIZES_REQUEST + queryString;  
		var responseFunction = GarmentLoader.onGarmentSizesAjaxResponse;
		AjaxManager.performAjaxRequest(GarmentLoader.DEFAULT_METHOD, url, GarmentLoader.ASYNC_TYPE, null, responseFunction);		
	}

GarmentLoader.onGarmentSizesAjaxResponse =
	function(response){
		if (response.responseCode === GarmentLoader.SUCCESS_RESPONSE){
			GarmentDashboard.fillSizesOptions(response.data); 
		}
	}
