function AjaxManager(){}

//Funzione per la gestione asincrona AJAX
AjaxManager.performAjaxRequest = 
	function(metodo, url, asincrona, dati, funzioneRisposta){

		var xmlHttp = null; //Inizializzo l'oggetto xmlHttp

		// qui valutiamo la tipologia di browser utilizzato per selezionare la tipologia di oggetto da creare.
		// Se sono in un browser Mozilla/Safari, utilizzo l'oggetto XMLHttpRequest per lo scambio di dati tra browser e server.
		if (window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}

		// Se sono in un Browser di Microsoft (IE), utilizzo Microsoft.XMLHTTP
		//che rappresenta la classe di riferimento per questo browser
		else if (window.ActiveXObject) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		if (xmlHttp === null)
		{
			window.alert("Il tuo browser non supporta AJAX!");
			return;
		}


		//Apro il canale di connessione per regolare il tipo di richiesta.
		//Passo come parametri il tipo di richiesta, url e se è o meno un operazione asincrona.
		xmlHttp.open(metodo, url, asincrona); 
		//setto l'header dell'oggetto
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.onreadystatechange = function (){

			/*Gli stai di una richiesta possono essere 5
				* 0 - UNINITIALIZED
				* 1 - LOADING
				* 2 - LOADED
				* 3 - INTERACTIVE
				* 4 - COMPLETE*/
			if (xmlHttp.readyState == 4){ //Se lo stato è completo
				var risposta = xmlHttp.responseText;
				//Aggiorno la pagina con la risposta restituita dalla precendete richiesta dal web server.
				//Quando la richiesta è terminata il responso della richiesta è disponibie come responseText.	
				funzioneRisposta(risposta);
			}
		}

		/* Passo alla richiesta i valori del form in modo da generare l'output desiderato*/
		//dati == null serve GET
		//dati == "stringa" serve post
		xmlHttp.send(dati);
}

AjaxManager.login =
	function(){

		var url = "../php/utility/login.php";
		var un = document.getElementById("username").value;
		var pw = document.getElementById("password").value;
		var vars = "username=" + un + "&password=" + pw;
		
		AjaxManager.performAjaxRequest("POST", url, true, vars, message);
	}

AjaxManager.prepareLogout =
	function(){

		var url = "../php/utility/logout.php";

		AjaxManager.performAjaxRequest("POST", url, true, null, logout);
	}

AjaxManager.username =
	function(){
		var url = "../php/utility/verify_username.php";

		var us = document.getElementById("username").value;

		AjaxManager.performAjaxRequest("POST", url, true, "username=" + us, controllaRisposta);
	}


AjaxManager.salvaSchema =
	function(){
		
		var url = "../php/utility/save_schema.php";
		var id = document.getElementById("idSchema").firstChild.textContent;
		var colonne = document.getElementById("num_colonne").value;
		var righe = document.getElementById("num_righe").value;
		var vars = "id=" + id + "&righe=" + righe + "&colonne=" + colonne;
		AjaxManager.performAjaxRequest("POST", url, true, vars, coordinates);
	}

AjaxManager.saveCoordinates = 
	function(){
		var url = "../php/utility/save_beach_map.php";
		var elements = document.getElementById("wrapper_beach_umbrella").childNodes;
		var end;
		var colonne = document.getElementById("num_colonne").value;
		var righe = document.getElementById("num_righe").value;
		var id = parseInt(document.getElementById("idSchema").firstChild.textContent);
		var h = 1;

		for(var i = 0; i < righe; i++){
			for (var j = 0; j < colonne; j++){
				var val = null;
				end = false;
				var type = 0;

				if(elements[i].childNodes[j].firstChild.tagName == "IMG"){
					type = parseInt(elements[i].childNodes[j].firstChild.alt);
					if(type == 3){
						val = h;
						h++;
					}
					else{
						val = null;
					}
				}

				if((j+(i*colonne)) == righe*colonne - 1){
					end = true;
				}

				var vars = "id=" + id + "&pos=" + (j+(i*colonne)) + "&type=" + type + "&end=" + end + "&h=" + val;
				AjaxManager.performAjaxRequest("POST", url, true, vars, actionTest);
			}
		}
	}


AjaxManager.deleteSchema =
	function(num){
		var url = "../php/utility/delete_schema.php";
		
		AjaxManager.performAjaxRequest("POST", url, true, "id=" + num , actionTest);

	}

AjaxManager.beachMap =
	function(num, ev){
		var url = "../php/utility/show_beach_map.php";

		
		ev.target.textContent = "Nascondi";
		ev.target.setAttribute("class", "hideButton");
		ev.target.setAttribute("onclick", "hideBeachMap(this ," + num +");");

		//disabilito bottoni******************************************************************
		for (var i = 0; i < document.getElementsByClassName("showButton").length; i++) {
			document.getElementsByClassName("showButton")[i].setAttribute("disabled", "");
		}

		for (var i = 0; i < document.getElementsByClassName("createButton").length; i++) {
			document.getElementsByClassName("createButton")[i].setAttribute("disabled", "");
		}
		//***********************************************************************************
		
		AjaxManager.performAjaxRequest("POST", url, true, "id=" + num, showBeachMap);		
	}

AjaxManager.showBooking =
	function(pos){

		var url = "../php/utility/show_booking.php";
		AjaxManager.performAjaxRequest("POST", url, true, "pos=" + pos, showBooking);		
	}

AjaxManager.showRequests =
	function(pos){

		var url = "../php/utility/show_requests.php";
		AjaxManager.performAjaxRequest("POST", url, true, "pos=" + pos, showRequests);		
	}


AjaxManager.showUserBooking =
	function(pos){

		var url = "../php/utility/show_user_booking.php";
		AjaxManager.performAjaxRequest("POST", url, true, "pos=" + pos, showUserBooking);		
	}

AjaxManager.showUserBeachMap =
	function(){

		var url = "../php/utility/show_user_beach_map.php";
		var arr = document.getElementById("inizio").value;
		var par = document.getElementById("fine").value;
		var vars = "arr=" + arr + "&par=" + par;
		AjaxManager.performAjaxRequest("POST", url, true, vars, showUserBeachMap);	
	}

AjaxManager.activeSchema =
	function(num){
		var url = "../php/utility/active_schema.php";
		AjaxManager.performAjaxRequest("POST", url, true, "num="+num, activeSchema);

	}


AjaxManager.showRates =
	function(){
		var url = "../php/utility/show_rates.php";
		AjaxManager.performAjaxRequest("GET", url, true, null, showRates);
	}

AjaxManager.deleteRates =
	function(id){
		var url = "../php/utility/delete_rates.php";
		AjaxManager.performAjaxRequest("POST", url, true, "id="+id, deleteRates);
	} 

AjaxManager.calculatePrice =
	function(){
		var url = "../php/utility/calculate_price.php";
		AjaxManager.performAjaxRequest("GET", url, true, null, calculatePrice);
	} 


AjaxManager.showSingleDayBooking =
	function(){

		var url = "../php/utility/show_single_day_booking.php";
		var d = document.getElementById("dataPrenotazione").value;

		if(document.getElementById("showBookingDiv")){
			document.getElementById("showBookingDiv").remove();
		}
		if(document.getElementById("erroreFormato")){
			document.getElementById("erroreFormato").remove();
		}

		if(validateData(d)){
			
			var errore = document.createElement("p");
			errore.setAttribute("id", "erroreFormato");
			var textErrore = document.createTextNode("Formato data non valido");
			errore.appendChild(textErrore);
			document.getElementById('showBooking').appendChild(errore);
			
			return;
		}

		AjaxManager.performAjaxRequest("POST", url, true, "date="+d, showSingleDayBooking);

	}

AjaxManager.matchPassword =
	function(){
		
		var url = "../php/utility/match_password.php";
		var ps = document.getElementById('password').value;
		var vars = "password=" + ps;

		AjaxManager.performAjaxRequest("POST", url, true, vars, match);
	}


function logout(data){
	if(data){
		location.href = "../index.php"; 
	}
}