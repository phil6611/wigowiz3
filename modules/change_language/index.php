<?php

/* 
 * Ce fichier sert pour changer de langue.
 */

//Démarrage d'une session.
session_start();

//Suppression de la variable de session pour la langue.
unset($_SESSION['langue']);

//Récupération de la langue
$langue = filter_input(INPUT_GET, "lang", FILTER_SANITIZE_STRING);

//Page d'origine
//$page = $_SERVER["HTTP_REFERER"];
$page = filter_input(INPUT_SERVER, "HTTP_REFERER", FILTER_VALIDATE_URL);

if (!is_null($langue)) {
    
    $array_language = [
      "fr" => "fr",
      "en" => "en"
    ];
    
    if(array_key_exists($langue, $array_language)){
        $_SESSION['langue'] = $langue;       
    } else {
        $_SESSION['langue'] = "fr";
    }
    
    header("location:".$page);
    
} else {
    //Redirection vers la page d'accueil du site.
    header("location:../index.php");
}