//function AjaxManager(){}

//Funzione per la gestione asincrona AJAX
//AjaxManager.performAjaxRequest = 
//	function(metodo, url, asincrona, dati, funzioneRisposta){

//		var xmlHttp = null; //Inizializzo l'oggetto xmlHttp

		// qui valutiamo la tipologia di browser utilizzato per selezionare la tipologia di oggetto da creare.
		// Se sono in un browser Mozilla/Safari, utilizzo l'oggetto XMLHttpRequest per lo scambio di dati tra browser e server.
//		if (window.XMLHttpRequest) {
//			xmlHttp = new XMLHttpRequest();
//		}

		// Se sono in un Browser di Microsoft (IE), utilizzo Microsoft.XMLHTTP
		//che rappresenta la classe di riferimento per questo browser
//		else if (window.ActiveXObject) {
//			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
//		}

//		if (xmlHttp === null)
//		{
//			window.alert("Il tuo browser non supporta AJAX!");
//			return;
//		}


		//Apro il canale di connessione per regolare il tipo di richiesta.
		//Passo come parametri il tipo di richiesta, url e se è o meno un operazione asincrona.
//		xmlHttp.open(metodo, url, asincrona); 
		//setto l'header dell'oggetto
//		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//		xmlHttp.onreadystatechange = function (){

			/*
			Gli stati di una richiesta possono essere 5
				* 0 - UNINITIALIZED
				* 1 - LOADING
				* 2 - LOADED
				* 3 - INTERACTIVE
				* 4 - COMPLETE
			*/   

//			if (xmlHttp.readyState == 4){ //Se lo stato è completo
//				var risposta = xmlHttp.responseText;
				//Aggiorno la pagina con la risposta restituita dalla precendete richiesta dal web server.
				//Quando la richiesta è terminata il responso della richiesta è disponibie come responseText.	
//				funzioneRisposta(risposta);
//			}
//		}    

		/* Passo alla richiesta i valori del form in modo da generare l'output desiderato*/
		//dati == null serve GET
		//dati == "stringa" serve post      
//		xmlHttp.send(dati);
//}


function AjaxManager(){}

AjaxManager.getAjaxObject = 
	function(){
		var xmlHttp = null;
		try { 
			xmlHttp = new XMLHttpRequest(); 
		} catch (e) {
			try { 
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); //IE (recent versions)
			} catch (e) {
				try { 
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); //IE (older versions)
				} catch (e) {
					xmlHttp = null; 
				}
			}
		}
		return xmlHttp;
	}

AjaxManager.performAjaxRequest = 
	function(method, url, isAsync, dataToSend, responseFunction){
		var xmlHttp = AjaxManager.getAjaxObject();
		if (xmlHttp === null){
			window.alert("Your browser does not support AJAX!"); // set error function
			return;
		}
	
		xmlHttp.open(method, url, isAsync); 
		xmlHttp.onreadystatechange = function (){
			if (xmlHttp.readyState == 4){
				console.log(xmlHttp.responseText);
				var data = JSON.parse(xmlHttp.responseText);
				responseFunction(data);
			}
		}
		xmlHttp.send(dataToSend);
}		