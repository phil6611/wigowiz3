<?php
    
    /* 
     * Ce fichier est utilisé pour couper une session.
     */

    //Début de la session.
    session_start();
    
    //Inclusion du fichier pour la connexion à la base de données.
include_once '../bdd/connect.php';
    
    //On détruit le cookie.
    unset ($cookie_token);
    require_once '../cookies/cookies.php';
    $cookies = new cookies();
    //On met à jour le token de connexion.
    $cookie_update = $cookies->update_cookie($_SESSION["compte"]["id_participant"], $dbh);
    //On crée un cookie "antidaté"
    $destroy_cookie = $cookies -> destroy_cookie($_SESSION["compte"]["id_participant"]);
    
    
    //On détruit toutes les variables de session.
    session_unset();
    //On détruit la session.
    session_destroy();
    
    //Redirection vers la page d'accueil.
    header("Location:../../index.php");
    
    //Texte à afficher en cas de dysfonctionnement.
    echo $LANG_texte_deconnexion;
?>