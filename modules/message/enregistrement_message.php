<?php

/* 
 * Ce fichier sert pour l'enregistrement des messages.
 */

//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    //header("location:../index.php");
}

//Récupération des données du formulaires.
$id_evenement =  filter_input(INPUT_POST, "id_evenement", FILTER_SANITIZE_NUMBER_INT);
$id_destinataire = filter_input(INPUT_POST, "id_destinataire", FILTER_SANITIZE_NUMBER_INT);
$id_expediteur = filter_input(INPUT_POST, "id_expediteur", FILTER_SANITIZE_NUMBER_INT);
$message_expediteur = filter_input(INPUT_POST, "message_expediteur", FILTER_SANITIZE_SPECIAL_CHARS);

//Date du message, elle sera calculer par le serveur de base de données.
$date_message = "NOW()";

//Tableau contenant les variables pour la requête SQL.
$array_message = [
    ":id_message" => "NULL",
    ":id_evenement" => $id_evenement,
    ":id_destinataire" => $id_destinataire,
    ":id_expediteur" => $id_expediteur,
    ":message_expediteur" => $message_expediteur,
    ":etat_message" => "0"
];

//Instanciation de la classe pour l'enregistrement du message.
$message_enregistrement = new classes_message;

//Enregistrement
$enregistre = $message_enregistrement->ecrire_message($array_message, $dbh);

if ($enregistre == TRUE){
    //header("location:./index.php?a=carte&include=default&m=".$_SESSION['evenement']['code']);
} else {
    echo $enregistre;
}