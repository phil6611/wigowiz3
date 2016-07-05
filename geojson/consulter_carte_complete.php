<?php

/* 
 * Ce fichier sert pour créer la liste détaillée des participants à un événements.
 */
session_start();
//On vérifie si la connexion est établie. L'accès n'est pas utilisable si on n'est pas connecté.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:../index.php");
}


//Inclusion des fichiers pour la base de données
require_once '../modules/bdd/connect.php';
//Récupération de l'identifiant de l'événement.
$id_evenement = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id_evenement)){
    //Requête SQl pour récupérer les coordonnées GPS de l'événement.
    $sql_evenement = "SELECT * FROM `".PREFIXE."participants`"
            . "JOIN `".PREFIXE."relations` "
            . "ON `".PREFIXE."participants`.`id_participant` = `".PREFIXE."relations`.`id_participant` "
            . "WHERE`".PREFIXE."relations`.`id_evenement` = :id_evenement";
    //Tableau des variables pour les requêtes SQL.
    $array_variables = [
        ":id_evenement" => $id_evenement
    ];
    //Exécution de la requête.
    try {
        $resultat_evenement = $dbh->prepare($sql_evenement);
        $resultat_evenement -> execute($array_variables);
        $donnees = $resultat_evenement -> fetchAll();
        

        //Contenu des tableaux.
        $tableau_geojson_voiture = NULL;
        $tableau_geojson_pieton = NULL;
        
        foreach ($donnees as $key) {
            //Données pour le tableay GEOJSON.
            $id = $key['id_participant'];
            $nom = $key['prenom_participant']." ".$key['nom_participant'];
            $lat = $key['latitude'];
            $lng = $key['longitude'];
            $vehicule = $key['vehicule'];
            $cacher_email = $key['cacher_email'];
            $cacher_adresse = $key['cacher_adresse'];
            
            //Texte pour le nom.
            $nom = "\n                      \"nom\":\"".$nom."\",";
            //Texte pour les emails.
            if ($cacher_email === "0"){
                $email = "\n                      \"email\":\"".$key['email_participant']."\",";
            } else {
                $email = "\n                      \"email\":\"Cette personne n'a pas laissé d'email, envoyez lui un message.\",";
            }
            //Texte pour les adresses.
            if ($cacher_adresse === "0"){
                $adresse = "\n                      \"adresse\":\"".$key['adresse_participant']." ".$key['cp_participant']." ".$key['ville_participant']."\",";
            } else {
                $adresse = "\n                      \"adresse\":\"Cette personne ne désire pas communiquer son adresse.\",";
            }
            //Texte pour le véhicule.
            if ($vehicule == 0){
               $texte_vehicule = "Pas de véhicule";
               $tableau_geojson_pieton .= "\t\t{
                    \"type\": \"Feature\",
                    \"id\": \"node/".$id."\",
                    \"properties\": {
                      \"@id\": \"node/".$id."\","
			."$nom"
                       ."$email $adresse"."
                      \"vehicule\": \"".$texte_vehicule."\"
                    },
                    \"geometry\": {
                      \"type\": \"Point\",
                      \"coordinates\": [
                        $lng,
                        $lat
                      ]
                    }
                  },\n\r";
            } else  {
                $texte_vehicule = "A un véhicule";
                $tableau_geojson_voiture .= "\t\t{
                    \"type\": \"Feature\",
                    \"id\": \"node/".$id."\",
                    \"properties\": {
                      \"@id\": \"node/".$id."\","
                        ."$email $adresse"."
                      \"vehicule\": \"".$texte_vehicule."\"
                    },
                    \"geometry\": {
                      \"type\": \"Point\",
                      \"coordinates\": [
                        $lng,
                        $lat
                      ]
                    }
                  },\n\r";
            }
        }
        
        
        
    } catch (Exception $ex) {
        echo "échec";
    }
} else {
    
}

?>
var participant_voiture_liste = {
  "type": "FeatureCollection",
  "generator": "phpo",
  "copyright": "The data included in this document is from wigowiz. The data is made available under ODbL.",
  "timestamp": "2014-08-14T16:47:02Z",
  "features": [
  
    <?=$tableau_geojson_voiture; ?>
    {
    }
  ]
};

var participant_pieton_liste = {
  "type": "FeatureCollection",
  "generator": "phpo",
  "copyright": "The data included in this document is from wigowiz. The data is made available under ODbL.",
  "timestamp": "2014-08-14T16:47:02Z",
  "features": [
  
    <?=$tableau_geojson_pieton; ?>
    {
    }
  ]
};