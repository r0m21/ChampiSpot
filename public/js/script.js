let $map = document.querySelector('#map');
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

L.popup()
    .setLatLng([51.5, -0.09])
    .setContent("I am a standalone popup.")
    .openOn(mymap);


/* Cette fonction détecte la latitude et la longitude onclick sur la map   */   
/* mymap.on('click', function(e) {
    alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
}); */

var popup = L.popup({
    autoClose: false,
    closeOnEscapeKey: false,
    closeOnClick: false,
    className: 'marker',
});

var markericon = L.icon({
    iconUrl: '../img/marqueur.svg',


    iconSize:     [38, 38], // size of the icon
    iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
    
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});


function onMapClick(e) {
    var lat = (e.latlng.lat);
    var lng = (e.latlng.lng);
    var marker = L.marker([lat,lng], {icon: markericon}); /* .addTo(mymap); */
    marker.setLatLng([lat, lng]).addTo(mymap);

}

mymap.on('click', onMapClick);



window.onload = function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        console.log("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
   console.log("Latitude: " + position.coords.latitude + 
    "Longitude: " + position.coords.longitude);
}