function AdminLoader(){}

//*****************************			VARIABLES		************************************

AdminLoader.DEFAULT_METHOD = "GET";
AdminLoader.ASYNC_TYPE = true;
AdminLoader.SUCCESS_RESPONSE = "0";
AdminLoader.URL_REQUEST = "./ajax/adminLoader.php";
AdminLoader.ACTUAL_VALUE_REQUEST = "./ajax/actualValueLoader.php";

//*****************************			FUNCTIONS		************************************

AdminLoader.showGarmentSize = 
	function(value)
	{
		var queryString = "?selectedValue=" + value;
		var url = AdminLoader.URL_REQUEST + queryString;
		var responseFunction = AdminLoader.onSizeAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
	}


AdminLoader.onSizeAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			AdminDashboard.fillGarmentSizeOptions(response.data);
		}
	}

AdminLoader.showActualValue = 
	function(table, field, value, fieldToFind, label)
	{
		var queryString = "?table=" + table +
							"&field=" + field +
							"&value=" + value +
							"&fieldToFind=" + fieldToFind +
							"&label=" + label;
		var url = AdminLoader.ACTUAL_VALUE_REQUEST + queryString;
		var responseFunction = AdminLoader.onActualValueAjaxResponse;
		AjaxManager.performAdminAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction, label);
	}

AdminLoader.onActualValueAjaxResponse = 
	function(response, label){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			AdminDashboard.fillSizeActualValue(response.data, label);
		}
	}

AdminLoader.insertNewGarment =
	function(model, color, category, genre, collection, price, image){
		var queryString = "?model=" + model +
							"&color=" + color +
							"&category=" + category +
							"&genre=" + genre +
							"&collection=" + collection +
							"&price=" + price +
							"&image=" + image;
		var url = "../php/ajax/insert_new_garment.php" + queryString;
		var responseFunction = AdminLoader.onInsertAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
	}

AdminLoader.onInsertAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			clearInsertIntoCatalogFields(response.data);
		}		
	}