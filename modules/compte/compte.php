<?php

/*
 * Cette partie concerne les variables pour le contenu de la page compte.
 */
/*

/*
 * Cette partie concerne l'inclusion des fichiers pour les micro-applications.
 */

//Récupération de la variable $_GET pour connaitre le fichier à inclure.
$section = filter_input(INPUT_GET, "section", FILTER_SANITIZE_STRING);

//Tableau pour l'inclusion des fichiers
$inclusion_compte = [
    "default"   => "./modules/compte/compte_default.php",
    //Modules pour la connexion.
    "connexion" => "./modules/login/connexion.php",
    //Modules pour la création d'un compte.
    "creer"     => "./modules/compte/creer.php",
    "ajuster"   => "./modules/compte/ajuster.php",
    //Modules pour la gestion d'un compte.
    "infos"     => "./modules/compte/infos.php",
    "supprimer_compte" => "./modules/compte/supprimer_compte.php",
    //Modules pour la création d'un événement.
    "evenements" => "./modules/compte/evenements.php",
    "supprimer_evenement" => "./modules/creer_evenement/supprimer_evenement.php",
    //Modules pour la participation à un événement.
    "inscription"   => "./modules/inscription_evenement/inscription.php",
    "participer"    => "./modules/inscription_evenement/participer.php",
    "desinscription"    => "./modules/inscription_evenement/desinscription.php"
];

//Inclusion des fichiers
if(array_key_exists($section, $inclusion_compte)){
        $inclusion = $inclusion_compte[$section];        
    } else {
        $inclusion = $inclusion_compte["default"];
    }
include_once $inclusion;