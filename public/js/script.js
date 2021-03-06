var screenWidth = $(document).width();

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


if(window.location.href.indexOf("ajout") > -1 || window.location.href.indexOf("profil") > -1  || window.location.href.indexOf("search") > -1 || window.location.href == "http://localhost:8000/" ) {
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

    if(screenWidth < 600 ) {
        mymap.locate({setView: true, watch: true, maxZoom: 13});
    var newMarker;  
    function onLocationFound(e) {
  
    var lat = (e.latlng.lat);
    var lng = (e.latlng.lng);
    
    var latitude = document.getElementById('form_SPO_longitude');
    var longitude = document.getElementById('form_SPO_latitude');

    latitude.setAttribute('value', lat);
    longitude.setAttribute('value', lng);
    if (newMarker) {
        newMarker
        .setLatLng([lat, lng])
        .setIcon(markericon)
        ;
    } else {
        newMarker = L.marker([lat, lng])
        .addTo(mymap);
    }
    return false;
    }
    mymap.on('locationfound', onLocationFound);

    function onLocationError(e) {
        alert(e.message);
    }    
    mymap.on('locationerror', onLocationError);

    }
    

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



    if (screenWidth > 600){
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
    }
    
    $(function($){

        if(window.location.href.indexOf("/") > -1){
            $('.modal').modal();       
        }
    })

        var marker;
        var spotslnglat = document.querySelectorAll('.lnglat');

    for (i=0; i<spotslnglat.length; i++){
        var lat = spotslnglat[i].getAttribute('data-lat');
        var long = spotslnglat[i].getAttribute('data-long');
        var photo = spotslnglat[i].getAttribute('data-img');
        var id = spotslnglat[i].getAttribute('data-id');
        if(window.location.href.indexOf("search") > -1 ){
            if (photo !='uploads/photos/d41d8cd98f00b204e9800998ecf8427e.png'){
                var popupContent = "<div class=''><a id='trigger-modal' class='modal-trigger no-padding' href='#info-modal-spot" + id + "'><img class='responsive-img' src='" + photo + "'><h5 class='fs-20 color-1 raleway fw-300'>Informations</h5></a></div>";
            }
            else{
                var popupContent = "<div class=''><a id='trigger-modal' class='modal-trigger no-padding' href='#info-modal-spot" + id + "'><img class='responsive-img' src='../img/champi-nf.png'><h5 class='fs-20 color-1 raleway fw-300'>Informations</h5></a></div>";
    
            }
        }
        else{
            if (photo !='uploads/photos/d41d8cd98f00b204e9800998ecf8427e.png'){
                var popupContent = "<div class=''><a id='trigger-modal' class='modal-trigger no-padding' href='#info-modal-spot" + id + "'><img class='responsive-img' src='" + photo + "'><h5 class='fs-20 color-1 raleway fw-300'>Informations</h5></a></div>";
            }
            else{
                var popupContent = "<div class=''><a id='trigger-modal' class='modal-trigger no-padding' href='#info-modal-spot" + id + "'><img class='responsive-img' src='./img/champi-nf.png'><h5 class='fs-20 color-1 raleway fw-300'>Informations</h5></a></div>";
    
            }
        }
        

        marker = new L.marker([long, lat])
                .setIcon(markericon)
                .bindPopup(popupContent)
                .addTo(mymap);
    }
}
// Fonction pour la prise de photo

// Grab elements, create settings, etc.
if (screenWidth < 600){
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
                canvas.classList.remove("d-none");
                canvas.classList.add("d-block");
                context.drawImage(video, 0, 0, 250, 180);
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('form_SPO_photo').value = dataURL;
            });  
            }
    }
}


// Ajout dynamique du nom de fichier à la place d'un texte.

if(window.location.href.indexOf("inscription") > -1){
    var fileInput  = document.querySelector( ".input-file" ),
        button     = document.querySelector( ".input-file-trigger" ),
        the_return = document.querySelector(".file-return");
    
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
}

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
  });

  // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
  // var collapsibleElem = document.querySelector('.collapsible');
  // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

  // Or with jQuery

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });

var ctx = document.getElementById("myChart");
var doughnutData = document.getElementById('accessibilite').value;
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            label: '',
            data: [doughnutData, 5-doughnutData],
            backgroundColor: [
              'rgb(244, 120, 58)',
              'rgb(255,255,255)'
          

          ],
          borderColor: [
            'rgb(244, 120, 58)',
            'rgb(255,255,255)'

            ],
            borderWidth: 1
        }]
    },options : {
        cutoutPercentage: 80,
    }
       
});



  
   
     
    
      
     

    