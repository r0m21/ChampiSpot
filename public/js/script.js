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
let mymap = L.map('mapid').setView([51.505, -0.09], 13);
L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>', 
    maxZoom: 18,
}).addTo(mymap);

var marker = L.marker([lat, lon]).addTo(macarte);

L.popup()
    .setLatLng([51.5, -0.09])
    .setContent("I am a standalone popup.")
    .openOn(mymap);