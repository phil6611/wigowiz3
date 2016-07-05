<?php

/* 
 * Ce fichier concerne les conditions d'utilisations.
 */

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/conditions_d_utilisation/html_conditions_d_utilisation.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_conditions_utilisation}" => $LANG_conditions_utilisation,
    "{LANG_responsabilite}" => $LANG_responsabilite,
    "{LANG_responsabilite_texte}" => $LANG_responsabilite_texte,
    "{LANG_traitement_donnees}" => $LANG_traitement_donnees,
    "{LANG_donnes_personnelles_texte}" => $LANG_donnes_personnelles_texte,
    "{LANG_affichage_donnes}" => $LANG_affichage_donnes,
    "{LANG_affichage_donnes_suite}" => $LANG_affichage_donnes_suite,
    "{LANG_conservations}" => $LANG_conservations,
    "{LANG_conservations_suite}" => $LANG_conservations_suite,
    "{LANG_obligations}" => $LANG_obligations,
    "{LANG_obligations_suite}" => $LANG_obligations_suite
];

$html = $moteur->remplace($texte_tableau, $html_code);

