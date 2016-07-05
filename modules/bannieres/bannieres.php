<?php

/*
 * Ce fichier sert pour afficher la page "bannieres".
 */

//Adresse du fichier HTML.
$code_base = "./modules/bannieres/html_bannieres.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_bannieres}" => $LANG_bannieres,
    "{LANG_bannieres_utiliser}" => $LANG_bannieres_utiliser,
    
    "{LANG_meta_title}" => $LANG_meta_title,
    "{site_url}" => $SITE_nom_site
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>