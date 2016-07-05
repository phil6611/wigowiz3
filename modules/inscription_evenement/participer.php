<?php

/*
 * Ce fichier sert à afficher les formulaires de connexions pour s'inscrire à un événements.
 */

/*
 * Création de la variable de session qui permet l'inscription
 */
$_SESSION['inscription'] = TRUE;

/*
 * Cette partie concerne la création du code HTML.
 */

//Fichier html à inclure si l'internaute n'est pas connecté.
$code_base = "./modules/inscription_evenement/html_participer.php";
$html_code = file_get_contents($code_base);

//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_inscription_titre}" => $LANG_inscription_titre,
    "{LANG_inscription_pas_inscrit}" => $LANG_inscription_pas_inscrit,
    "{LANG_creer_un_compte}" => $LANG_creer_un_compte,
    "{LANG_inscription_texte_creation_compte}" => $LANG_inscription_texte_creation_compte,
    "{LANG_inscription_deja_inscrit}" => $LANG_inscription_deja_inscrit,
    "{LANG_adresse_email}" => $LANG_adresse_email,
    "{LANG_login_password}" => $LANG_login_password,
    "{LANG_bouton_connexion}" => $LANG_bouton_connexion
];

//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);


