/**
 * 
 */
getCurrentPosition();
//getArret();

function callbackSuccess(position) {
    lattitude = position.coords.latitude;
    longitude = position.coords.longitude;
	
    console.log('latitude : '+position.coords.latitude);
	console.log('longitude : '+position.coords.longitude);
	
//	var url = 'http://dotaspirit.com/tan/getArrets.php?lattitude='+lattitude+'&longitude='+longitude;
	var url = 'getArrets.php?lattitude='+lattitude+'&longitude='+longitude;

	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange=function() {
	    if (xhr.readyState==4 && xhr.status==200) {
			console.log(xhr);
	      document.getElementById("alerteGPS").style.display = "none";
	      document.getElementById("arretGeo").innerHTML=xhr.responseText;
	    }else if (xhr.readyState < 4) {
	    	console.log('recherche en cours');
	    	document.getElementById("alerteGPS").style.display = "block";
	    }
	  }
	
	
	xhr.open("GET", url, true);
	xhr.send();

	console.log(xhr.status);
	console.log(xhr.statusText);
}

function getTempsAttente(element) {
	codeLieu = element.getAttribute('codeLieu');
	ligne = element.getAttribute('ligne');
//	var url = 'http://dotaspirit.com/tan/getTempsAttente.php'
	var url = 'getTempsAttente.php'
	
	url = url+'?codeLieu='+codeLieu;
	
	if (ligne) {
		url = url+'&ligne='+ligne;	
	}
	
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange=function() {
	    if (xhr.readyState==4 && xhr.status==200) {
	    	console.log(xhr);
	    	document.getElementById("alerteHoraires").style.display = "none";
	    	document.getElementById("tempsAttente").innerHTML=xhr.responseText;
	    	refreshPage();
	    } else if (xhr.readyState < 4) {
	    	console.log('recherche en cours');
	    	document.getElementById("alerteHoraires").style.display = "block";
	    	document.getElementById("alerteHoraires").scrollIntoView();
	    }
	  }
	
	xhr.open("GET", url, true);
	xhr.send();

	console.log(xhr.status);
	console.log(xhr.statusText);
}

function refreshPage() {
//	var url = 'http://dotaspirit.com/tan/getFavoris.php'
	var url = 'getFavoris.php'
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange=function() {
	    if (xhr.readyState==4 && xhr.status==200) {
	    	document.getElementById("arretFav").innerHTML=xhr.responseText;
	    }
	  }
	
	xhr.open("GET", url, true);
	xhr.send();
}

function callbackError(error) {
	switch(error.code){
	    case error.PERMISSION_DENIED:
	        alert("L'utilisateur n'a pas autorisé l'accès à sa position");
	        break;     
	      case error.POSITION_UNAVAILABLE:
	        alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
	        break;
	      case error.TIMEOUT:
	        alert("Le service n'a pas répondu à temps");
	        break;
	}
}

function getCurrentPosition() {
	
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition( callbackSuccess, callbackError );
	} else {
		alert('Impossible d\'acceder a la gégeolocalisation');
	}
	
}

function getArret(lattitude, longitude) {
//	var url = "https://open.tan.fr/ewp/arrets.json/47,2342539/-1,5903104";
}
