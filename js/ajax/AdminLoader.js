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
							console.log(queryString);
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

/* ------------------------------------------------------------------------------------------------ */

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
		console.log("QUERY = " + queryString);
		console.log("URL = " + url);
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
	}

AdminLoader.onInsertAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			//AdminDashboard.clearInsertIntoCatalogFields(response.data);
					console.log("RESPONSE:DATE = " + response.data);
		AdminDashboard.reloadPage(response.data);
		}
	}

AdminLoader.modifyGarmentProperty = 
	function(garmentId, field, newValue){
		var queryString = "?garmentId=" + garmentId +
							"&field=" + field + 
							"&newValue=" + newValue;
		var url = "../php/ajax/modify_garment.php" + queryString;
		var responseFunction = AdminLoader.onModifyGarmentAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);		
	}

AdminLoader.onModifyGarmentAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			AdminDashboard.clearModifyGarmentFields(response.data);
		}		
	}

AdminLoader.deleteGarment = 
	function(garmentId){
		var queryString = "?garmentId=" + garmentId; console.log(queryString);
		var url = "../php/ajax/delete_garment.php" + queryString;
		var responseFunction = AdminLoader.onReloadAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);		
	}

AdminLoader.onReloadAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			AdminDashboard.reloadPage(response.data);
		}		
	}

AdminLoader.insertNewSale =
	function(percentage, collection){
		var queryString = "?percentage=" + percentage +
							"&collection=" + collection;
		var url = "../php/ajax/insert_sale.php" + queryString;
		var responseFunction = AdminLoader.onReloadAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);		
	}

AdminLoader.modifyOrderField =
	function(orderId, field, value){
		var queryString = "?orderId=" + orderId +
							"&field=" + field +
							"&value=" + value;
		var url = "../php/ajax/modify_order.php" + queryString;
		var responseFunction = AdminLoader.onReloadAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
}

AdminLoader.modifyQuantity = 
	function(garmentId, size, quantity){
		var queryString = "?garmentId=" + garmentId +
							"&size=" + size +
							"&quantity=" + quantity;
		var url = "../php/ajax/modify_stock.php" + queryString;
		var responseFunction = AdminLoader.onReloadAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
	}