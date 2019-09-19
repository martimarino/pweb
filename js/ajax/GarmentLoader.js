function GarmentLoader(){}

//*****************************			VARIABLES		************************************

GarmentLoader.DEFAULT_METHOD = "GET";
GarmentLoader.URL_REQUEST = "./ajax/garmentLoader.php";
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
		console.log("QS: " + queryString);
		var url = GarmentLoader.URL_REQUEST + queryString;
		console.log("URL: " + url);
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
			console.log("REPONSE = " + response.message);
				GarmentDashboard.updateNavigationPage(GarmentLoader.CURRENT_PAGE_INDEX,	true);
				console.log("primo if: ");
				return;
		}
		
		if (response.responseCode === GarmentLoader.SUCCESS_RESPONSE){
			GarmentDashboard.refreshData(response.data);
			console.log("OK");
		}
		
		var noMoreDataExist = (response.data === null || response.data.length < GarmentLoader.GARMENT_TO_LOAD);
		GarmentDashboard.updateNavigationPage(GarmentLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		console.log("STAMPA: " + noMoreDataExist);
	}