<?php

/**
 * Description of geojson
 *
 * @author Philippe Poisse
 * @version 1 juillet 2016
 * 
 */


class geojson {
    
    /*
     * Cette section concerne les gabarits pour les fichiers geojson.
     */
    
    var $tableau_geojson = "\t\t{
                        \"type\": \"Feature\",
                        \"id\": \"node/{{id}}\",
                        \"properties\": {
                          \"@id\": \"node/{{id}}\",
                          \"vehicule\": \"{{texte_vehicule}}\"
                        },
                        \"geometry\": {
                          \"type\": \"Point\",
                          \"coordinates\": [
                            {{lng}} ,
                            {{lat}}
                          ]
                        }
                      },\n\r";
    
    
    /*
     * Cette section concerne les méthodes pour générer les listes de participants.
     */
    
    public function liste_participants($id_evenement, $dbh, $error) {
        //Cette méthode sert à générer la liste de tous les participants à un événement.
        
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
            echo $error;
        }
        
        
        
    }
    
    public function liste_voitures($id_evenement, $dbh) {
        //Cette méthode sert à générer la liste des participants ayant une voiture.
    
    }
    
    public function liste_pietons($id_evenement, $dbh) {
        //Cette méthode sert à générer la liste des participants n'ayant pas de voiture.
    }
    
}
