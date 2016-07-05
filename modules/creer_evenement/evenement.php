<?php

/* 
 * Ce fichier sert à gérer le module "evenement".
 */

//Récupération de la variable $_GET pour connaitre le fichier à inclure.
$section = filter_input(INPUT_GET, "section", FILTER_SANITIZE_STRING);

//Tableau pour l'inclusion des fichiers
$inclusion_evenement = [
    "default"   =>  "./modules/creer_evenement/modif_evenement.php",
    "liste"     =>  "./modules/creer_evenement/liste.php",
    "modif"     =>  "./modules/creer_evenement/modif_evenement.php",
    "modif_enregistrement" =>   "./modules/creer_evenement/modif_enregistrement.php"
];

//Inclusion des fichiers
if(array_key_exists($section, $inclusion_evenement)){
    $inclusion = $inclusion_evenement[$section];
} else {
    $inclusion = $inclusion_evenement["default"];
}


/*
 * Inclusion des fichiers contenant les classes.
 */
require_once './modules/creer_evenement/class_evenement.php';
include_once $inclusion;