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