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

			/*
			Gli stati di una richiesta possono essere 5
				* 0 - UNINITIALIZED
				* 1 - LOADING
				* 2 - LOADED
				* 3 - INTERACTIVE
				* 4 - COMPLETE
			*/

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

		var url = "./.php/database/login.php";
		var un = document.getElementById("email").value;
		var pw = document.getElementById("password").value;
		var vars = "username=" + un + "&password=" + pw;
		
		AjaxManager.performAjaxRequest("POST", url, true, vars, message);
	}

AjaxManager.prepareLogout =
	function(){

		var url = "../php/database/logout.php";

		AjaxManager.performAjaxRequest("POST", url, true, null, logout);
	}

AjaxManager.username =
	function(){
		var url = "../php/database/verify_username.php";

		var us = document.getElementById("username").value;

		AjaxManager.performAjaxRequest("POST", url, true, "username=" + us, controllaRisposta);
	}


AjaxManager.matchPassword =
	function(){
		
		var url = "../php/database/match_password.php";
		var ps = document.getElementById('password').value;
		var vars = "password=" + ps;

		AjaxManager.performAjaxRequest("POST", url, true, vars, match);
	}


function logout(data){
	if(data){
		location.href = "../index.php"; 
	}
}