<?php

/*
 * Ce fichier sert pour afficher la page "émissions CO2".
 */

//Adresse du fichier HTML.
$code_base = "./modules/co2/html_emissions_co2.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_emissions_co2}" => $LANG_emissions_co2,
    "{LANG_emissions_co2_texte}" => $LANG_emissions_co2_texte
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>