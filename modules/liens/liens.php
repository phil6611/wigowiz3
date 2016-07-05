<?php

/*
 * Ce fichier sert pour afficher la page "Liens".
 */

//Adresse du fichier HTML.
$code_base = "./modules/liens/html_liens.php";
$html_code = file_get_contents($code_base);

//Tableau des textes à parser.
$texte_tableau = [
    "{titre}" => $LANG_liens_titre
 ];

//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>