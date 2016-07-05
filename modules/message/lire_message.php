<?php

/* 
 * Ce fichier sert pour afficher un message.
 */

//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:../index.php");
}

//Récupération des variables pour compléter le formulaire.
$id_message = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

//Récupération du contenu du message.
$array_sql =[
  ":id" => $id_message  
];
$contenu_message = $messagerie->lire_message($array_sql, $dbh);
//Nom de l'expéditeur.
$nom_expediteur = $contenu_message['0']['prenom_participant']." ".$contenu_message['0']['nom_participant'];

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/message/html_message_lire.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_message_titre}" => $LANG_message_titre,
    "{LANG_message_lire_expediteur}" => $LANG_message_lire_expediteur,
    "{LANG_message_lire_date}" => $LANG_message_lire_date,
    "{LANG_message_lire_evenement}" => $LANG_message_lire_evenement,
    "{expediteur}" => $nom_expediteur,
    "{evenement}" => $contenu_message['0']['titre'],
    "{date}" => $contenu_message['0']['date_message'],
    "{message}" => $contenu_message['0']['message_expediteur']
];

$html = $moteur->remplace($texte_tableau, $html_code);