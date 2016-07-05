<?php

/* 
 * Ce fichier sert à désinscrire un internaute d'un événement.
 */

//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:../index.php");
}

//Vérification de l'origine de la demande de désinscription.
$desinscription = filter_input(INPUT_POST, "desinscrire", FILTER_SANITIZE_STRING);

if ($desinscription == TRUE){
    //Désincription multiple depuis le gestionnaire d'événements.
    foreach ($_POST as $id_relation => $valeur) {
        if ($id_relation != "action" && $id_relation != "prenom_participant" && $id_relation!= "nom_participant" && $id_relation!= "desinscrire") {
		$sql = "DELETE FROM `".PREFIXE."relations` WHERE `id_relation` = $valeur LIMIT 1;";
		$dbh -> exec($sql);
                $html .= "<p>Désinscription effectuée</p>\n\r";
        }
    }
    
    //La page vers laquelle l'internaute est redirigée.
    $redirection = "location:./index.php?a=compte&section=evenements";

} else {
    //Désincription à un seul événement depuis une carte.
    
    //récupération de l'identifiant de l'événement.
    $id_evenement = $_SESSION['evenement']['id_evenement'];
    //récupération de l'identifiant de l'internaute.
    $id_participant = $_SESSION['compte']['id_participant'];
    
    //récupération du code passé dans l'URL, au cas ou le mécanisme de session ne marcherait pas.
    $code_evenement = filter_input(INPUT_GET, "evenement", FILTER_SANITIZE_STRING);
    //Si le mécanisme de session a échoué on change variable pour l'identifiant de l'évenement.
    if ($id_evenement === NULL){
        $id_evenement = $code_evenement;
    }
    
    //Tableau des variables pour la requête SQL.
    $array_variables = [
        ":id_evenement" => $id_evenement,
        ":id_participant" => $id_participant,
    ];
    
    $sql = "DELETE FROM `".PREFIXE."relations` WHERE `id_evenement` = ".$id_evenement." AND `id_participant` = ".$id_participant." LIMIT 1;";
    $dbh -> exec($sql);
    //La page vers laquelle l'internaute est redirigée.
    $redirection = "location:./index.php?a=carte&include=default&m=".$_SESSION['evenement']['code'];
    
}

header($redirection);