
function OrderDashboard(){}


OrderDashboard.removeContent = 
	function(){
		var dashboardElement = document.getElementById("orderDashboard");

		if (dashboardElement === null)
			return;
		
		var firstChild = dashboardElement.firstChild;
		if (firstChild !== null)
			dashboardElement.removeChild(firstChild);
	}


OrderDashboard.setEmptyDashboard = 
	function(){
		OrderDashboard.removeContent();
		var warningDivElem = document.createElement("div");
		warningDivElem.setAttribute("class", "warning");
		var warningSpanElem = document.createElement("span");
		warningSpanElem.textContent = "There are no orders to load!";
		var dashboardElement = document.getElementById("orderDashboard");
		warningDivElem.appendChild(warningSpanElem);
		dashboardElement.appendChild(warningDivElem);
	}
		

OrderDashboard.refreshData =
	function(data){
		OrderDashboard.removeContent();
		
		// Create new order lists (tag <ul></ul>)
		var newOrderListElem = OrderDashboard.createOrderListElement();
		
		// Create new order item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var orderItemElem = OrderDashboard.createOrderItemElement(data[i]);
			newOrderListElem.appendChild(orderItemElem);
		}		
		
		document.getElementById("orderDashboard").appendChild(newOrderListElem);
			
	}


OrderDashboard.addMoreData =
	function(data){
		var dashboardElement = document.getElementById("orderDashboard");
		if (dashboardElement === null || data === null || data.length <= 0)
			return;
			
		// Get the orders list element (tag '<ul></ul>')	
		var orderListElem = document.getElementById("orderList");
		if (orderListElem === null){
			orderListElem = OrderDashboard.createOrderListElement();
			dashboardElement.appendChild(orderListElem);
		}
		
		// Create new garment item (tag '<li></li>')
		for (var i = 0; i < data.length; i++){
			var orderItemElem = OrderDashboard.createOrderItemElement(data[i]);
			orderListElem.appendChild(orderItemElem);
		}		
		
	}


OrderDashboard.createOrderListElement = 
	function(){
		var orderListElem = document.createElement("ul");
		orderListElem.setAttribute("id", "orderList");
		orderListElem.setAttribute("class", "order_list");

		orderListElem.appendChild(OrderDashboard.createTheadOfTheList());
		
		return orderListElem;
	}


OrderDashboard.createTheadOfTheList =
	function(){

		var theadElem = document.createElement("li");
		theadElem.setAttribute("id", "thead");
		theadElem.setAttribute("class", "thead_class");

		var codThead = document.createElement("div");
		codThead.setAttribute("id", "code_thead");
		codThead.setAttribute("class", "thead_class");
		codThead.textContent = "Order number";

		var dateThead = document.createElement("div");
		dateThead.setAttribute("id", "date_thead");
		dateThead.setAttribute("class", "thead_class");
		dateThead.textContent = "Date placed";

		var stateThead = document.createElement("div");
		stateThead.setAttribute("id", "state_thead");
		stateThead.setAttribute("class", "thead_class");
		stateThead.textContent = "Status";

		var totThead = document.createElement("div");
		totThead.setAttribute("id", "tot_thead");
		totThead.setAttribute("class", "thead_class");
		totThead.textContent = "Tot";

		var detailThead = document.createElement("div");
		detailThead.setAttribute("id", "detail_thead");
		detailThead.setAttribute("class", "thead_class");
		detailThead.textContent = "Details";

		theadElem.appendChild(codThead);
		theadElem.appendChild(dateThead);
		theadElem.appendChild(stateThead);
		theadElem.appendChild(totThead);
		theadElem.appendChild(detailThead);

		return theadElem;
	}



OrderDashboard.createOrderItemElement = 	
	function(currentData){
		var orderItemLi = document.createElement("li");
		orderItemLi.setAttribute("id", "order_item_" + currentData.orderId);
		orderItemLi.setAttribute("class", "order_item_wrapper");

		orderItemLi.appendChild(OrderDashboard.createDivElement(currentData));
		
		return orderItemLi; 
	}


OrderDashboard.createDivElement =
	function(currentData){
		// Create div wrapper
		var divElem = document.createElement("div");
		divElem.setAttribute("class", "div_order_item");
		
		//Create id div
		var idElem = document.createElement("div");
		idElem.setAttribute("class", "div_elem");
		idElem.textContent = currentData.orderId;
 
		//Create date div
		var dateElem = document.createElement("div");
		dateElem.setAttribute("class", "div_elem");
		dateElem.textContent = currentData.date;

		//Create state div
		var stateElem = document.createElement("div");
		stateElem.setAttribute("class", "div_elem");
		stateElem.textContent = currentData.state;

		//Create tot div
		var totElem = document.createElement("div");
		totElem.setAttribute("class", "div_elem");
		totElem.textContent = currentData.tot + ",00 €";

		//Create details div
		var detailElem = document.createElement("div");
		detailElem.setAttribute("class", "div_elem");
		detailElem.textContent = "More details";

		var linkElem = document.createElement("a");
		//linkElem.setAttribute("onclick", "showOrderDetails(" + currentData.orderId + ")");
		linkElem.setAttribute("href", "./detailedOrder.php?orderId=" + currentData.orderId);

		linkElem.appendChild(detailElem);	//add link div in the a element
		divElem.appendChild(idElem);
		divElem.appendChild(dateElem);
		divElem.appendChild(stateElem);
		divElem.appendChild(totElem);
		divElem.appendChild(linkElem);
		
		return divElem;
	}

OrderDashboard.fillOrderTable =
	function(currentData){

		for (var i = 0; i < currentData.length; i++){

			var tab = document.getElementsByTagName("table")[0];
			var node = document.createElement("tr");
			node.setAttribute("class", "tr_garment");

			var idField = document.createElement("td");
			idField.textContent = currentData[i].garmentId;

			var quantityField = document.createElement("td");
			quantityField.textContent = currentData[i].quantity;

			var sizeField = document.createElement("td");
			sizeField.textContent = currentData[i].garmentSize;

			var colorField = document.createElement("td");
			colorField.textContent = currentData[i].garmentColor;

			var priceField = document.createElement("td");
			priceField.textContent = currentData[i].price;

			node.appendChild(idField);
			node.appendChild(quantityField);
			node.appendChild(sizeField);
			node.appendChild(colorField);
			node.appendChild(priceField);
			tab.appendChild(node);
		}
	}