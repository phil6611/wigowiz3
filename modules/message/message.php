<?php

/* 
 * Ce fichier sert à gérer le module "message".
 */

//Récupération de la variable $_GET pour connaitre le fichier à inclure.
$section = filter_input(INPUT_GET, "section", FILTER_SANITIZE_STRING);

//Tableau pour l'inclusion des fichiers
$inclusion_message = [
    "default"           =>  "./modules/message/message_default.php",
    "form"              =>  "./modules/message/form_message.php",
    "enregistrement"    =>  "./modules/message/enregistrement_message.php",
    "lire"              =>  "./modules/message/lire_message.php"
];

//Inclusion des fichiers
if(array_key_exists($section, $inclusion_message)){
    $inclusion = $inclusion_message[$section];        
} else {
    $inclusion = $inclusion_message["default"];
}

include_once $inclusion;