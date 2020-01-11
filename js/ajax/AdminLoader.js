function AdminLoader(){}

//*****************************			VARIABLES		************************************

AdminLoader.DEFAULT_METHOD = "GET";
AdminLoader.ASYNC_TYPE = true;
AdminLoader.SUCCESS_RESPONSE = "0";
AdminLoader.URL_REQUEST = "./ajax/adminLoader.php";
AdminLoader.ORDER_GARMENT_ID_REQUEST = "./ajax/orderGarmentIdLoader.php"
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

AdminLoader.showOrderGarmentId = 
	function(selectId, orderId){
		var queryString = "?orderId=" + orderId;
		var url = AdminLoader.ORDER_GARMENT_ID_REQUEST + queryString;
		var responseFunction = AdminLoader.onOrderGarmentIdAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
	}

AdminLoader.onOrderGarmentIdAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			AdminDashboard.fillOrderGarmentId(response.data);
		}
	}

AdminLoader.showActualValue = 
	function(table, field, value, fieldToFind, label, panel)
	{  console.log("TABLE = " + table + " FIELD= " + field + " VALUE = " + value + " FIELD TO FIND= " + fieldToFind + " LABEL = " + label + " PANEL = " + panel);
		var queryString = "?table=" + table +
							"&field=" + field +
							"&value=" + value +
							"&fieldToFind=" + fieldToFind +
							"&label=" + label;  
		var url = AdminLoader.ACTUAL_VALUE_REQUEST + queryString;
		var responseFunction = AdminLoader.onActualValueAjaxResponse;
		AjaxManager.performAdminAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction, label, panel);
	}

AdminLoader.onActualValueAjaxResponse = 
	function(response, label, panel){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			AdminDashboard.fillActualValue(response.data, label, panel);
		}
	}

/* ------------------------------------------------------------------------------------------------ */

AdminLoader.deleteGarment = 
	function(garmentId){
		var queryString = "?garmentId=" + garmentId;
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