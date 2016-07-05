<?php

/* 
 * Ce script sert pour ajuster la position d'un utilisateur.
 */
//Récupération des coordonnées GPS.
$latitude = filter_input(INPUT_GET, "latitude", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$longitude = filter_input(INPUT_GET, "longitude", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$point_de_depart = $latitude.", ".$longitude;

?>
// In the following example, markers appear when the user clicks on the map.
// The markers are stored in an array.
// The user can then click an option to hide, show or delete the markers.
var map;
var markers = [];

function initialize() {
    
  var myLatLng = new google.maps.LatLng(<?=$point_de_depart; ?>);
  var mapOptions = {
    zoom: 15,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.ROAD
  };
  map = new google.maps.Map(document.getElementById('map'),
      mapOptions);

  // This event listener will call addMarker() when the map is clicked.
  google.maps.event.addListener(map, 'click', function(event) {
      deleteMarkers();
      addMarker(event.latLng);
      form(event.latLng);
  });

  // Adds a marker at the center of the map.
  addMarker(myLatLng);
}

// Add a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}

//Modification du formulaire.
function form(latlng){
    var latitude = latlng.lat();
    var longitude = latlng.lng();
    document.formulaire.latitude.value= latitude;
    document.formulaire.longitude.value= longitude;
}

google.maps.event.addDomListener(window, 'load', initialize);