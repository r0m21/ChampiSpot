let $map = document.querySelector('map');
class LeafletMap{
    load(element){
        L.map(element);
    }
}
const initMap = function(){
    let map = new LeafletMap();
    map.load($map);
}
if($map !== null){
    initMap();
}
let mymap = L.map('mapid').setView([47.3, 5.05], 13);
L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>', 
    maxZoom: 18,
}).addTo(mymap);

/* Cette fonction détecte la latitude et la longitude onclick sur la map   */   

/* mymap.on('click', function(e) {
    alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
}); */

var markericon = L.icon({
    iconUrl: '../img/marqueur.svg',
    iconSize:     [38, 38], // size of the icon
    iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

/**
 * Function onMapClick
 * 
 * @param event onclick
 * @return svg icon for longitude and latitude
 */ 
function onMapClick(e) {
    var lat = (e.latlng.lat);
    var lng = (e.latlng.lng);
    var marker = L.marker([lat,lng], {icon: markericon}).addTo(mymap);
}

mymap.on('click', onMapClick);

/**
 * Function getLocation()
 *  
 * Fonction qui sert à géolocaliser les utilisateurs en arrivant sur le site ( avec le accord par une popup )
 * 
 * @return Geolocalisation de l'utilisateur 
 */
window.onload = function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(maPosition);
    } else { 
        console.log("Geolocation is not supported by this browser.");
    }
}

/**
 * Function maPosition()
 * 
 * Fonction de callback en cas de succès
 * @param {*} position 
 * @type number
 * @return longitude et latitude de l'utilisateur
 */

function maPosition(position) {
 
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    console.log(lat,lng);

}

// Fonction de callback en cas d’erreur
function erreurPosition(error) {
    var info = "Erreur lors de la géolocalisation : ";
    switch(error.code) {
    case error.TIMEOUT:
    	info += "Timeout !";
    break;
    case error.PERMISSION_DENIED:
	info += "Vous n’avez pas donné la permission";
    break;
    case error.POSITION_UNAVAILABLE:
    	info += "La position n’a pu être déterminée";
    break;
    case error.UNKNOWN_ERROR:
    	info += "Erreur inconnue";
    break;
    }
    document.getElementById("infoposition").innerHTML = info;
}