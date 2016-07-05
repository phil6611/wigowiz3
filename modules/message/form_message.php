<?php

/* 
 * Ce fichier sert à générer le formulaire pour envoyer un message.
 */

//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:../index.php");
}

//Récupération des variables pour compléter le formulaire.
$id_destinataire = filter_input(INPUT_GET, "id_destinataire", FILTER_VALIDATE_INT);
$id_evenement = filter_input(INPUT_GET, "id_evenement", FILTER_VALIDATE_INT);
$id_expediteur = $_SESSION['compte']['id_participant'];


//Récupération des informations pour compléter le formulaire.
$array_sql = [
    ":id_evenement" => $id_evenement,
    ":id_destinataire" => $id_destinataire
];
$tableau_form = $messagerie->form_message($array_sql, $dbh);

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/message/html_message_form.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_message_evenement}" => $LANG_message_evenement,
    "{LANG_message_destinataire}" => $LANG_message_destinataire,
    "{LANG_message_texte_message}" => $LANG_message_texte_message,
    "{LANG_message_submit}" => $LANG_message_submit,
    "{LANG_message_reset}" => $LANG_message_reset,
    "{id_destinataire}" => $id_destinataire,
    "{id_evenement}" => $id_evenement,
    "{evenement}" => $tableau_form['0']['titre'],
    "{destinataire}" => $tableau_form['0']['nom_destinataire'],
    "{id_expediteur}" => $id_expediteur
];

$html = $moteur->remplace($texte_tableau, $html_code);