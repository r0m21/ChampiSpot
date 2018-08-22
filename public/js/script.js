if(window.location.href.indexOf("ajout") > -1 || window.location.href.indexOf("profil") > -1  || window.location.href.indexOf("search") > -1) {
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

    var markericon = L.icon({
        iconUrl: '../img/marqueur.svg',
        iconSize:     [38, 38], // size of the icon
        iconAnchor:   [19, 38], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    /**
     * Function onMapClick()
     * 
     * @description Envoi une icone SVG à la position cliqué sur la map par l'utilisateur.
     * 
     * @param event onclick
     * @return svg icon for longitude and latitude
     */



    if(window.location.href.indexOf("ajout") > -1) {
        var champiMarker;
        var updateMarker = function(e) {
        var lat = (e.latlng.lat);
        var lng = (e.latlng.lng);

        var latitude = document.getElementById('form_SPO_longitude');
        var longitude = document.getElementById('form_SPO_latitude');

        latitude.setAttribute('value', lat);
        longitude.setAttribute('value', lng);

        if (champiMarker) {
            champiMarker
            .setLatLng([lat, lng])
            .setIcon(markericon)
            ;
        } else {
            champiMarker = L.marker([lat, lng])
            .setIcon(markericon)
            .addTo(mymap);
        }
        return false;
    };
    mymap.on('click', updateMarker);
    }




    /**
     * Function getLocation()
     *  
     * @description Fonction qui sert à géolocaliser les utilisateurs en arrivant
     *              sur le site ( avec le accord par une popup )
     * @return Geolocalisation de l'utilisateur 
     */

    window.onload = function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(maPosition);
        } else { 
            console.log("La géolocation n'est pas supporté par votre navigateur.");
        }
    }
    $(function($){

        if(window.location.href.indexOf("/") > -1){
            $('.modal').modal();       
        }
    })


    /**
     * Function maPosition()
     * 
     * @description Fonction de callback en cas de succès
     * @param {*} position 
     * @type number
     * @return longitude et latitude de l'utilisateur
     */

    function maPosition(position) {
    
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;

        var latitude = document.getElementById('lat');
        var longitude = document.getElementById('lng');

        latitude.setAttribute('data-lat', lat);
        longitude.setAttribute('data-lng', lng);

        console.log(lat,lng);
    }

    /**
     * Function erreurPosition()
     * 
     * @description Détecte si il y a une erreur lors de la géolocalisation avec les différents messages
     *              en fonction du cas d'erreur.
     * 
     * @param {*} error 
     * @return string  Renvoi le message d'erreur
     */
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

        var marker;
        var spotslnglat = document.querySelectorAll('.lnglat');

    for (i=0; i<spotslnglat.length; i++){
        var lat = spotslnglat[i].getAttribute('data-lat');
        var long = spotslnglat[i].getAttribute('data-long');
        var photo = spotslnglat[i].getAttribute('data-img');
        var id = spotslnglat[i].getAttribute('data-id');
        var popupContent = "<div><a id='trigger-modal' class='waves-effect waves-light btn modal-trigger' href='#info-modal-spot" + id + "'>Modal</a></div>";

        marker = new L.marker([long, lat])
                .bindPopup(popupContent)
                .addTo(mymap);
    }
}
// Fonction pour la prise de photo

// Grab elements, create settings, etc.
if(window.location.href.indexOf("ajout") > -1){
    window.onload = function getCamera(){
        var video = document.getElementById('video');
        
        // Get access to the camera!
        if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Not adding `{ audio: true }` since we only want video now
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                video.src = window.URL.createObjectURL(stream);
                video.play();
            });
        }
        // Elements for taking the snapshot
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        
        // Trigger photo take
        document.getElementById("snap").addEventListener("click", function() {
            context.drawImage(video, 0, 0, 320, 240);
            var dataURL = canvas.toDataURL("image/png");
            document.getElementById('form_SPO_photo').value = dataURL;
        });  
        }
}

// Ajout dynamique du nom de fichier à la place d'un texte.

var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
 
// action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});
 
// action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});
 
// affiche un retour visuel dès que input:file change
fileInput.addEventListener( "change", function( event ) {
    str = this.value;
    var res = str.split("\\", 3);

    the_return.innerHTML = res[2];
});