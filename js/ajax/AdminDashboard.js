function AdminDashboard(){}


AdminDashboard.removeContent = 
	function(){
		var select = document.getElementById("sizes");

		if (select.hasChildNodes()) {
    		while (select.hasChildNodes()) {
               select.removeChild(select.firstChild);
            }	
    	}
    	console.log(select.childNodes.length);	
	}

AdminDashboard.fillGarmentSizeOptions = 
	function(data){

		AdminDashboard.removeContent();

    	var options = document.getElementById("sizes");

		if (data === null || data.length <= 0)
			return;

    	for (var i = 0; i < data.length; i++){
    		var sizeElem = document.createElement("option");
    		sizeElem.setAttribute("value", data[i].size);
    		sizeElem.textContent = data[i].size;
    		options.appendChild(sizeElem);
    	}
	}

AdminDashboard.fillSizeActualValue = 
	function(data, label){
		var labelToFill = document.getElementById(label);
		labelToFill.textContent = data;
	}

AdminDashboard.clearInsertIntoCatalogFields =
	function(data){
	    var model = document.getElementById("model_input").value = "";
	    var color = document.getElementById("color_input").value = "";
	    var category = document.getElementById("category_input").value = "";
	    var genre = document.getElementById("genre_input").value = "";
	    var collection = document.getElementById("collection_input").value = "";
	    var price = document.getElementById("price_input").value = "";
	    var image = document.getElementById("image_input").value = "";
	    AdminDashboard.reloadPage(data);
}

AdminDashboard.clearModifyGarmentFields =
	function(data){
		var newValue = document.getElementById("new_garment_value").value = "";
		AdminDashboard.reloadPage(data);
	}

AdminDashboard.reloadPage = 
	function(error){
		if(error == null){
			location.href = './admin_profile.php';
		}
		else{
			location.href = error;
		}
	}