<?php

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
        ":id_evenement" => $id_evenement,
    ];
    //Exécution de la requête.
    try {
        $resultat_evenement = $dbh->prepare($sql_evenement);
        $resultat_evenement -> execute($array_variables);
        $donnees = $resultat_evenement -> fetchAll();
        

        //Contenu du tableau.
        $tableau_geojson = NULL;
        foreach ($donnees as $key) {
            //Données pour le tableay GEOJSON.
            $id = $key['id_participant'];
            $lat = $key['latitude'];
            $lng = $key['longitude'];
            $vehicule = $key['vehicule'];
            //Texte pour le véhicule.
            if ($vehicule == 0){
               $texte_vehicule = "Pas de véhicule ";
            } else  {
                $texte_vehicule = "A un véhicule";
            }
            
            $tableau_geojson .= "\t\t{
                    \"type\": \"Feature\",
                    \"id\": \"node/".$id."\",
                    \"properties\": {
                      \"@id\": \"node/".$id."\",
                      \"vehicule\": \"".$texte_vehicule."\"
                    },
                    \"geometry\": {
                      \"type\": \"Point\",
                      \"coordinates\": [
                        $lng ,
                        $lat
                      ]
                    }
                  },\n\r"; 
        }
        
        
        
    } catch (Exception $ex) {
        echo "échec";
    }
} else {
    
}

?>
var participant = {
  "type": "FeatureCollection",
  "generator": "phpo",
  "copyright": "The data included in this document is from wigiwiz. The data is made available under ODbL.",
  "timestamp": "2014-08-14T16:47:02Z",
  "features": [
  
    <?=$tableau_geojson; ?>
    {
    }
  ]
}