<?php

/*
 * Ce fichier est utilisé pour modifier les coordonnées GPS d'un utilisateur.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

/*
 * Cette partie sert pour vérifier l'envoi ou non du formulaire. 
 */
//Récupération de la variable $_POST
$envoi = filter_input(INPUT_POST, "envoi", FILTER_SANITIZE_STRING);

//Vérification de l'inscription à un événement.
if (isset ($_SESSION['inscription'])){
    //si l'internaute se connecte pour s'inscrire à un événement il est redirigé vers la page d'inscription.
    $redirection = "location:./index.php?a=compte&section=inscription";
} else {
    //si la connexion est "standard" alors l'internaute est redirigé vers la page de gestion des comptes.
    $redirection = "location:./index.php?a=compte";
}



//On vérifie si une mise à jour est à faire.
if($envoi == 'TRUE'){
    $latitude_post = filter_input(INPUT_POST, "latitude", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $longitude_post =  filter_input(INPUT_POST, "longitude", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $sql_ajuster = "UPDATE `".PREFIXE."participants` SET "
            . "latitude = :latitude, longitude = :longitude "
            . "WHERE id_participant = :id";

    //Tableau des variables pour les requêtes SQL.
    $array_variables = [
        ":latitude" => $latitude_post,
        ":longitude" => $longitude_post,
        ":id" => $_SESSION['compte']['id_participant']
    ];

    //Exécution de la requête.
        try {
            $resultat_ajuster = $dbh->prepare($sql_ajuster);
            $resultat_ajuster -> execute($array_variables);
            $_SESSION['ecran']='position_modifiee';
            header($redirection);
        } catch (Exception $ex) {
            echo "échec";
        }

    //$_SESSION['ecran']='position_modifiee';
    //header("location:./index.php?a=compte&id=".$id_evenement);
}

//Requête sql.
$sql_ajuster_prepare = "SELECT * FROM `".PREFIXE."participants` WHERE `id_participant` LIKE :id LIMIT 1";
//Préparation de la requête
$resultat_ajuster = $dbh->prepare($sql_ajuster_prepare);
//Exécution de la requête
$resultat_ajuster->execute(array(':id'=>$_SESSION["compte"]["id_participant"]));
//Création du tableau associatif.
$resultat_tableau = $resultat_ajuster->fetchAll();
//Variables pour remplir le formulaire.
$latitude = $resultat_tableau[0]['latitude'];
$longitude = $resultat_tableau[0]['longitude'];
$point_de_depart = $latitude.",".$longitude;


//Adresse du fichier HTML.
$code_base = "./modules/compte/html_compte_ajuster.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{latitude}" => $latitude,
    "{longitude}" => $longitude,
    "{point_de_depart}" => $point_de_depart,
    "{LANG_modifier_votre_position}" => $LANG_modifier_votre_position,
    "{LANG_mon_compte}" => $LANG_mon_compte,
    "{_SESSION['langue']}" => $_SESSION['langue'],
    "{LANG_deplacez_marqueur}" => $LANG_deplacez_marqueur,
    "{LANG_compte_ajuster_latitude}" => $LANG_compte_ajuster_latitude,
    "{LANG_compte_ajuster_longitude}" => $LANG_compte_ajuster_longitude,
    "{LANG_compte_ajuster_bouton}" => $LANG_compte_ajuster_bouton
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);