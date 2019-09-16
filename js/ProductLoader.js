function ProductLoader(){}

ProductLoader.DEFAULT_METHOD = "GET";
ProductLoader.ASYNC_TYPE = true;

ProductLoader.PRODUCT_TO_LOAD = 20;
ProductLoader.CURRENT_PAGE_INDEX = 1;

ProductLoader.SUCCESS_RESPONSE = "0";
ProductLoader.NO_MORE_DATA = "-1";

ProductLoader.init = 
	function() {
		ProductLoader.PAGE_INDEX = 1;
	}

ProductLoader.loadProduct = 
	function(searchType)
	{
		var queryString = "?searchType=" + searchType 
							+ "&productToLoad=" + ProductLoader.PRODUCT_TO_LOAD 
							+ "&offset=" + (ProductLoader.CURRENT_PAGE_INDEX-1)*ProductLoader.PRODUCT_TO_LOAD;
		var url = ProductLoader.URL_REQUEST + queryString;
		var responseFunction = ProductLoader.onAjaxResponse;

		AjaxManager.performAjaxRequest(ProductLoader.DEFAULT_METHOD, url, ProductLoader.ASYNC_TYPE, null, responseFunction);
	}

ProductLoader.next = 
	function(searchType){
		ProductLoader.CURRENT_PAGE_INDEX++;
		ProductLoader.loadProduct(searchType);
	}

ProductLoader.previous = 
	function(searchType){
		ProductLoader.CURRENT_PAGE_INDEX--;
		if(ProductLoader.CURRENT_PAGE_INDEX <= 1)
			ProductLoader.CURRENT_PAGE_INDEX = 1;

		ProductLoader.loadProduct(searchType);
	}

ProductLoader.onAjaxResponse = 
	function(response){
		if (response.responseCode === ProductLoader.NO_MORE_DATA 
		 	&&	ProductLoader.CURRENT_PAGE_INDEX === 1){
			
				MovieDashboard.setEmptyDashboard(response.message);
				MovieDashboard.updateNavigationPage(ProductLoader.CURRENT_PAGE_INDEX,	true);
				return;
		}
		
		if (response.responseCode === ProductLoader.SUCCESS_RESPONSE)
			MovieDashboard.refreshData(response.data);
		
		var noMoreDataExist = (response.data === null || response.data.length < MovieLoader.MOVIE_TO_LOAD);
		MovieDashboard.updateNavigationPage(ProductLoader.CURRENT_PAGE_INDEX,	noMoreDataExist);
		
	}