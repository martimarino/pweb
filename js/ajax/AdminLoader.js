function AdminLoader(){}

//*****************************			VARIABLES		************************************

AdminLoader.DEFAULT_METHOD = "GET";
AdminLoader.ASYNC_TYPE = true;
AdminLoader.SUCCESS_RESPONSE = "0";
AdminLoader.SIZE_REQUEST = "./ajax/adminLoader.php";

//*****************************			FUNCTIONS		************************************

AdminLoader.showGarmentSize = 
	function(value)
	{
		var queryString = "?selectedValue=" + value;
		var url = AdminLoader.SIZE_REQUEST + queryString;
		var responseFunction = AdminLoader.onAjaxResponse;
		AjaxManager.performAjaxRequest(AdminLoader.DEFAULT_METHOD, url, AdminLoader.ASYNC_TYPE, null, responseFunction);
	}


AdminLoader.onAjaxResponse = 
	function(response){
		if (response.responseCode === AdminLoader.SUCCESS_RESPONSE){
			console.log(response.data);
			AdminDashboard.fillGarmentSizeOptions(response.data);
		}
	}