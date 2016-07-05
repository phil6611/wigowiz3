<?php

/*
 * Ce fichier sert à ajuster la géolocalisation d'un événement.
 */

//Récupération de l'identifiant de l'événement.
$id_evenement = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
//On vérifie si le formulaire a été envoyé.
$envoi = filter_input(INPUT_POST, "envoi", FILTER_SANITIZE_STRING);

if($envoi == "TRUE"){

    $latitude_post = filter_input(INPUT_POST, "latitude", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $longitude_post =  filter_input(INPUT_POST, "longitude", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $id_evenement_post = filter_input(INPUT_POST, "id_evenement", FILTER_SANITIZE_NUMBER_INT);

    $sql_ajuster = "UPDATE `".PREFIXE."evenements` SET "
            . "latitude = :latitude, longitude = :longitude "
            . "WHERE id_evenement = :id";

    //Tableau des variables pour les requêtes SQL.
    $array_variables = [
        ":latitude" => $latitude_post,
        ":longitude" => $longitude_post,
        ":id" => $id_evenement
    ];

    //Exécution de la requête.
        try {
            $resultat_ajuster = $dbh->prepare($sql_ajuster);
            $resultat_ajuster -> execute($array_variables);
            header("location:./index.php?a=liens_evenement&id=".$id_evenement_post);
        } catch (Exception $ex) {
            echo "échec";
        }

   
    
} else {
    //Récupération des données sur l'événement.
    $id_sql = $id_evenement;
    //Requête SQL.
    $sql_evenement_ajuster = "SELECT * FROM `".PREFIXE."evenements` WHERE `id_evenement` = :id LIMIT 1";
    //Préparation de la requête
    $resultat_ajuster = $dbh->prepare($sql_evenement_ajuster);
    //Exécution de la requête
    $resultat_ajuster->execute(array(':id'=>$id_sql));
    //Création du tableau associatif.
    $resultat_tableau = $resultat_ajuster->fetchAll();
    //Variables pour remplir le formulaire.
    $latitude = $resultat_tableau[0]['latitude'];
    $longitude = $resultat_tableau[0]['longitude'];
    $point_de_depart = $latitude.",".$longitude;
    $titre_evenement = $resultat_tableau[0]['titre'];
    $date_evenement = $resultat_tableau[0]["date_evenement"];
}


/*
 * Cette partie concerne la création du code HTML.
 */
//Adresse du fichier HTML.
$code_base = "./modules/creer_evenement/html_ajuster_evenement.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{titre_evenement}" => $titre_evenement,
    "{date_evenement}" => $date_evenement,
    "{id_evenement}" => $id_evenement,
    "{latitude}" => $latitude,
    "{longitude}" => $longitude,
    "{LANG_deplacez_marqueur}" => $LANG_deplacez_marqueur,
    "{LANG_creer_evenement_ajuster_enregistrer}" => $LANG_creer_evenement_ajuster_enregistrer,
    "{LANG_creer_evenement_ajuster_annuler}" => $LANG_creer_evenement_ajuster_annuler
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>