<?php

/* 
 * Ce fichier sert à afficher une page d'erreur lorsque la date de l'événement est passée.
 */

//Fichier html à inclure si l'internaute n'est pas connecté.
$code_base = "./modules/carte/html_date_passee.php";
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_date_passee}" => $LANG_date_passee
];
