function AdminDashboard(){}


AdminDashboard.removeContent = 
	function(){
		var select = document.getElementById("sizes");

		if (select.hasChildNodes()) {
    		while (select.hasChildNodes()) {
               select.removeChild(select.firstChild);
            }	
    	}	
	}

AdminDashboard.removeOrderGarmentIdContent = 
	function(){
		var select = document.getElementById("select_order_garment_id");

		if(select.hasChildNodes())
			while(select.hasChildNodes())
				select.removeChild(select.firstChild);
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

AdminDashboard.fillOrderGarmentId =
	function(data){

		AdminDashboard.removeOrderGarmentIdContent();

    	var options = document.getElementById("select_order_garment_id");

		if (data === null || data.length <= 0)
			return;

    	for (var i = 0; i < data.length; i++){
    		var idElem = document.createElement("option");
    		idElem.setAttribute("value", data[i]);
    		idElem.textContent = data[i];
    		options.appendChild(idElem);
    	}
	}

AdminDashboard.fillActualValue = 
	function(data, label, panel){
		var labelToFill = document.getElementById(label);
		if(data.startsWith("immagini/")) 
		{
			var arr = data.split("/");
			labelToFill.textContent = arr[2]; // garment##.jpg
		}
		else
			labelToFill.textContent = data;
				
		if(panel == "modify_garment")
		{
			var field = getSelectedValue('garmentField');
			var newValue = document.getElementById("new_garment_value");

			switch(field)
			{
				case 'img':
					upLoad = document.createElement("input");
					upLoad.setAttribute("id", "new_garment_value");
					upLoad.setAttribute("name", "new_garment_value_option");
					upLoad.setAttribute("type", "file");
					newValue.parentNode.replaceChild(upLoad, newValue);
					break;

				case 'category':
					categoryOptions = document.createElement("div");
					categoryOptions.setAttribute("id", "new_garment_value");
					categoryOptionClothing = document.createElement("input");
					categoryOptionClothing.setAttribute("id", "clothing");
					categoryOptionClothing.setAttribute("name", "new_garment_value_option");
					categoryOptionClothing.setAttribute("value", "clothing");
					categoryOptionClothing.setAttribute("type", "radio");
					clothingLabel = document.createElement("label");
					clothingLabel.setAttribute("for", "clothing");
					clothingLabel.textContent = 'clothing';
					categoryOptions.appendChild(categoryOptionClothing);
					categoryOptions.appendChild(clothingLabel);
					categoryOptionAccessories = document.createElement("input");
					categoryOptionAccessories.setAttribute("id", "accessories");
					categoryOptionAccessories.setAttribute("name", "new_garment_value_option");
					categoryOptionAccessories.setAttribute("value", "accessories");
					categoryOptionAccessories.setAttribute("type", "radio");
					accessoriesLabel = document.createElement("label");
					accessoriesLabel.setAttribute("for", "accessories");
					accessoriesLabel.textContent = 'accessories';
					categoryOptions.appendChild(categoryOptionAccessories);
					categoryOptions.appendChild(accessoriesLabel);
					newValue.parentNode.replaceChild(categoryOptions, newValue);
					break;

				case 'genre':
					genreOptions = document.createElement("div");
					genreOptions.setAttribute("id", "new_garment_value");
					genreOptionM = document.createElement("input");
					genreOptionM.setAttribute("id", "M");
					genreOptionM.setAttribute("name", "new_garment_value_option");
					genreOptionM.setAttribute("value", "male");
					genreOptionM.setAttribute("type", "radio");

					labelM = document.createElement("label");
					labelM.setAttribute("for", "M");
					labelM.textContent = 'Male';

					genreOptionF = document.createElement("input");
					genreOptionF.setAttribute("id", "F");
					genreOptionF.setAttribute("name", "new_garment_value_option");
					genreOptionF.setAttribute("value", "female");
					genreOptionF.setAttribute("type", "radio");

					labelF = document.createElement("label");
					labelF.setAttribute("for", "F");
					labelF.textContent = 'Female';

					genreOptionU = document.createElement("input");
					genreOptionU.setAttribute("id", "U");
					genreOptionU.setAttribute("name", "new_garment_value_option");
					genreOptionU.setAttribute("value", "unisex");
					genreOptionU.setAttribute("type", "radio");

					labelU = document.createElement("label");
					labelU.setAttribute("for", "U");
					labelU.textContent = 'Unisex';

					genreOptions.appendChild(genreOptionM);
					genreOptions.appendChild(labelM);
					genreOptions.appendChild(genreOptionF);
					genreOptions.appendChild(labelF);
					genreOptions.appendChild(genreOptionU);
					genreOptions.appendChild(labelU);
					newValue.parentNode.replaceChild(genreOptions, newValue);
					break;

				case 'collection':
					collectionOptions = document.createElement("div");
					collectionOptions.setAttribute("id", "new_garment_value");

					collectionOptionSS = document.createElement("input");
					collectionOptionSS.setAttribute("id", "SS");
					collectionOptionSS.setAttribute("name", "new_garment_value_option");
					collectionOptionSS.setAttribute("value", "S/S");
					collectionOptionSS.setAttribute("type", "radio");

					labelSS = document.createElement("label");
					labelSS.setAttribute("for", "SS");
					labelSS.textContent = 'S/S';

					collectionOptionAW = document.createElement("input");
					collectionOptionAW.setAttribute("id", "AW");
					collectionOptionAW.setAttribute("name", "new_garment_value_option");
					collectionOptionAW.setAttribute("value", "A/W");
					collectionOptionAW.setAttribute("type", "radio");

					labelAW = document.createElement("label");
					labelAW.setAttribute("for", "AW");
					labelAW.textContent = 'A/W';

					collectionOptions.appendChild(collectionOptionSS);
					collectionOptions.appendChild(labelSS);
					collectionOptions.appendChild(collectionOptionAW);
					collectionOptions.appendChild(labelAW);
					newValue.parentNode.replaceChild(collectionOptions, newValue);
					break;

				default:
					inputField = document.createElement("input");
					inputField.setAttribute("id", "new_garment_value");
					inputField.setAttribute("name", "new_garment_value");
					inputField.setAttribute("class", "input_field");
					newValue.parentNode.replaceChild(inputField, newValue);
					break;
			}
		}

		if(panel = "modify_order")
		{
			var field = getSelectedValue('order_select'); 
			var newValue = document.getElementById('order_new_value');

			switch(field)
			{
				case 'articoli':
					document.getElementById('select_order_garment_id').disabled = false;
					document.getElementById('select_order_garment_field').disabled = false;
					break;

				default:
					document.getElementById('select_order_garment_id').disabled = true;
					document.getElementById('select_order_garment_field').disabled = true;
					break;
			}
		}
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

