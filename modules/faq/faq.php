<?php

/* 
 * Ce fichier concerne la FAQ.
 */

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/faq/html_faq.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_FAQ}" => $LANG_FAQ,
    "{LANG_faq1}" => $LANG_faq1,
    "{LANG_faq1_texte}" => $LANG_faq1_texte,
    "{LANG_faq2}" => $LANG_faq2,
    "{LANG_faq2_texte}" => $LANG_faq2_texte,
    "{LANG_paypal}" => $LANG_paypal,
    "{LANG_faq3}" => $LANG_faq3,
    "{LANG_faq3_texte}" => $LANG_faq3_texte,
    "{LANG_faq4}" => $LANG_faq4,
    "{LANG_faq4_texte}" => $LANG_faq4_texte,
    "{LANG_faq5}" => $LANG_faq5,
    "{LANG_faq5_texte}" => $LANG_faq5_texte
];

$html = $moteur->remplace($texte_tableau, $html_code);

