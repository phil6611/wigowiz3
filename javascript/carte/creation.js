/* 
 * Ce fichier sert pour les cartes permettant de créer un compte ou un événement
 */

/*
 * Création de la carte
 */

//Fond de carte Mapbox
var mapbox = L.tileLayer('http://{s}.tiles.mapbox.com/v3/phil6611.ikebkh58/{z}/{x}/{y}.png', {
                attribution: 'Carte des événements Wigowiz &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>'
            });

//Création de la carte.
var map = L.map('map', {
    center: new L.LatLng(42, 1),
    zoom: 10,
    maxZoom: 18,
    layers: [mapbox]
});

// création et ajout du LayerGroup
lgMarkers = new L.LayerGroup();
map.addLayer(lgMarkers);

//Fonction pour créer un marqueur.
map.on('click', function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    
    //On vide le layerGroup pour être sûr de n'avoir qu'un seul marqueur.
    lgMarkers.clearLayers();
    //On crée le marqueur et on l'ajoute au layerGroup.    
    var marker = L.marker([lat, lng]).addTo(lgMarkers);
    //On centre la carte sur le marqueur.
    map.setView(new L.LatLng(lat, lng), 15);
    
    //On remplit le formulaire
    document.formulaire.lat.value= lat;
    document.formulaire.lng.value= lng;
    
});