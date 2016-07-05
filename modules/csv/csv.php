<?php

/* 
 * Ce fichier sert à générer des fichiers CSV.
 */

//Code de l'événement.
$code_evenement = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRING);
//Langue de l'internaute
$langue = filter_input(INPUT_GET, "lang", FILTER_SANITIZE_STRING);

// Inclusion du fichier pour l'accès à la base de données.
require_once '../bdd/connect.php';
// Inclusion du fichier pour la langue
$fichier_langue = "../../languages/lang_".$langue.".php";
require_once  $fichier_langue;


//Requête SQL.
if (!empty($code_evenement)){
    
    //Nom du fichier.
    //$nom_csv = "test";
    
    //Requête SQl pour récupérer les coordonnées GPS de l'événement.
    $sql_csv = "SELECT * FROM `wigowiz_participants` "
            . "JOIN `wigowiz_relations` "
            . "ON `wigowiz_participants`.`id_participant` = `wigowiz_relations`.`id_participant` "
            . "JOIN `wigowiz_evenements` "
            . "ON `wigowiz_evenements`.`id_evenement` = `wigowiz_relations`.`id_evenement` "
            . "WHERE `wigowiz_evenements`.`code` = :code";
    //Tableau des variables pour les requêtes SQL.
    $array_variables = [
        ":code" => $code_evenement
    ];
    
    //Exécution de la requête.
    try {
        $resultat_csv = $dbh->prepare($sql_csv);
        $resultat_csv -> execute($array_variables);
        $donnees = $resultat_csv -> fetchAll();
        
        //Nom du fichier.
        $nom_csv = $donnees['0']['titre'];
        
        //Tableau pour le fichier CSV.
        $csv = NULL;
        //Ligne pour les entêtes de colonne.
        $ligne_entête = $LANG_csv_ligne_entête;
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
                    . "\",\"".$row['distance']
                    . "\"\n";
            $csv .= $line;

        }

        
    } catch (Exception $ex) {
        echo "erreur";
    }

} else {
    echo "echec";
}

/*
 * En-tête du fichier.
 */

//Type Mine
header('Content-type: text/csv');
//On force le téléchargement et on donne un nom explicite au fichier.
header("Content-disposition: attachment;filename=\"".$nom_csv.".csv\"");
//On empêche la mise en cache, les données seront donc mises à jour à chaque téléchargement.
header("Cache-Control: no-cache");
//Taille du fichier.
//header("Content-Length: ".filesize($csv));

echo $csv;
