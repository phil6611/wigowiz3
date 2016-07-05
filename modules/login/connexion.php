<?php

/* 
 * Ce fichier sert pour la page de connexion notamment pour permettre l'inscription à un événement.
 */

//Adresse du fichier HTML.
$code_base = "./modules/login/html_connexion.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_login_titre_inscrire}" => $LANG_login_titre_inscrire,
    "{LANG_adresse_email}" => $LANG_adresse_email,
    "{LANG_bouton_connexion}" => $LANG_bouton_connexion,
    "{LANG_login_password}" => $LANG_login_password,
    "{LANG_creer_un_compte}" => $LANG_creer_un_compte
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);