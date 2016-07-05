<?php

/* 
 * Ce fichier sert à générer des fichiers CSV.
 */


// Inclusion du fichier pour l'accès à la base de données.
require_once '../bdd/connect.php';


//Requête SQL.

    
    //Nom du fichier.
    //$nom_csv = "test";
    
    //Requête SQl pour récupérer les coordonnées GPS de l'événement.
    $sql_csv = "SELECT * FROM `wigowiz_participants` ";
    //Tableau des variables pour les requêtes SQL.


    
    //Exécution de la requête.
    try {
        $resultat_csv = $dbh->prepare($sql_csv);
        $resultat_csv -> execute($array_variables);
        $donnees = $resultat_csv -> fetchAll();
        
        //Nom du fichier.
        $nom_csv ="liste";
        
        //Tableau pour le fichier CSV.
        //$csv = [];
        $csv = NULL;
        //Ligne pour les entêtes de colonne.
        $ligne_entête = "\"Nom\","
                . "\"Prenom\","
                . "\"Adresse\","
                . "\"Code Postal\","
                . "\"Ville\","
                . "\"Pays\","
                . "\"Email\","
                . "\"Téléphone\","
                . "\n";
        //array_push($csv, $line_entête);
        $csv .= $ligne_entête;
        
        foreach ($donnees as $row) {
            
            $line = "\"".$row['nom_participant']
                    . "\",\"".$row['prenom_participant']
                    . "\",\"".$row['adresse_participant']
                    . "\",\"=\"".$row['cp_participant']."\"\""
                    . "\",\"".$row['ville_participant']
                    . "\",\"".$row['pays_participant']
                    . "\",\"".$row['email_participant']
                    . "\",\"=\"".$row['tel_participant']."\"\""
                    . "\",\"".$row['latitude']
                    . "\",\"".$row['longitude']
                    . "\"\n";
            $csv .= $line;

        }

        
    } catch (Exception $ex) {
        echo "erreur";
    }



/*
 * En-tête du fichier.
 */

//Type Mine
header('Content-type: text/csv; charset=utf-8');
//On force le téléchargement et on donne un nom explicite au fichier.
header("Content-disposition: attachment;filename=\"".$nom_csv.".csv\"");
//On empêche la mise en cache, les données seront donc mises à jour à chaque téléchargement.
header("Cache-Control: no-cache");
//Taille du fichier.
header("Content-Length: ".filesize($csv));

echo $csv;
