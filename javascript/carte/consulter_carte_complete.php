<?php
session_start();
//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:../index.php");
}

//Inclusion des fichiers pour la base de données
require_once '../../modules/bdd/connect.php';
//Récupération de l'identifiant de l'événement.
$id_evenement = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_evenement)){
    //Requête SQl pour récupérer les coordonnées GPS de l'événement.
    $sql_evenement = "SELECT `latitude`,`longitude`,`titre` FROM `".PREFIXE."evenements` WHERE `id_evenement` LIKE :id_evenement LIMIT 1";
    //Tableau des variables pour les requêtes SQL.
    $array_variables = [
        ":id_evenement" => $id_evenement,
    ];
    //Exécution de la requête.
    try {
        $resultat_evenement = $dbh->prepare($sql_evenement);
        $resultat_evenement -> execute($array_variables);
        $donnees = $resultat_evenement -> fetchAll();
        $lat = $donnees[0]['latitude'];
        $lng = $donnees[0]['longitude'];
        $titre = $donnees[0]['titre'];
        //Centre de la carte.
        $center = $lat.",".$lng;
    } catch (Exception $ex) {
        echo "échec";
    }
} else {
    
}

?>

/*
* Variables globales.
*/

var id_evenement = <?php echo $id_evenement; ?>;

/*
 * Fonctions spécifiques
 */
//Fonctions pour les popup.
function participantInfo (feature, layer){
var identifiant = feature.id;
var id_destinataire = identifiant.replace("node/", "");
var lien_message = "<a href=\"./index.php?a=message&amp;section=form&amp;id_evenement=" + id_evenement +"&amp;id_destinataire=" + id_destinataire +"\">Envoyer un message.</a>";
                               
layer.bindPopup("<p>" + feature.properties.nom + "<br />" + feature.properties.vehicule + "<br />" + feature.properties.adresse + "<br />" + feature.properties.email +"<br />" + lien_message +"</p>");
    };

/*
 * Gestion des données. a href./index.php?a message&AMP;section form&AMP;id_evenement &AMP;id_destinataire
 */
//Récupếration des données GEOJSON.
var participant_voiture = L.geoJson(participant_voiture_liste,{
	onEachFeature: participantInfo
} );
var participant_pieton = L.geoJson(participant_pieton_liste,{
	onEachFeature: participantInfo
} );
var participant_liste_concat = [participant_voiture_liste, participant_pieton_liste];
var participant_liste = L.geoJson(participant_liste_concat);

/*
* Gestion des icones pour les marqueurs.
*/

var eventIcon = L.icon({
    iconUrl: './image/markers/marker-icon-event.png',
    iconSize:     [25, 41], // size of the icon
    iconAnchor:   [12, 41], // point of the icon which will correspond to marker's location
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

/*
 * Création de la carte
 */

//Fond de carte Mapbox
var mapbox = L.tileLayer('http://{s}.tiles.mapbox.com/v3/phil6611.ikebkh58/{z}/{x}/{y}.png', {
                attribution: 'Carte des événements Wigowiz &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>'
            });

//Création de la carte.
var map = L.map('map', {
    center: new L.LatLng(<?=$center; ?>),
    zoom: 10,
    maxZoom: 18,
    layers: [mapbox, participant_voiture, participant_pieton]
});

//Marqueur indiquant l'évenement.
var marker = L.marker([<?=$center; ?>], {icon: eventIcon}).addTo(map);
marker.bindPopup("<p><?php echo $titre; ?></p>", { offset: [0, -10] });

/*
* Limite de la carte
*

map.fitBounds(participant_liste.getBounds());
*/
/*
 * Création des contrôles.
 */

//Contrôles pour les fonds de cartes.
var baseMap = {
    "Rendu Mapbox" : mapbox
};

//Contrôles pour les layers contenant les données.
var overlaysMaps = {
    "Événement" : marker,
    "Participants avec voiture" : participant_voiture,
    "Participants sans voiture" : participant_pieton
};

L.control.layers(baseMap, overlaysMaps,{ collapsed: false }).addTo(map);
L.control.scale({imperial: false}).addTo(map);