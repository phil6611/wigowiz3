<?php

//Démarrage d'une session.
session_start();

//test de la langue.
if (isset($_SESSION['langue'])){
    
} else {
    $_SESSION['langue'] = "fr";
}

//Récupération de la variable $_GET
$action = filter_input(INPUT_GET, "a", FILTER_SANITIZE_STRING);


//Inclusion du fichier pour les différentes fonction.
include_once './modules/configuration/configuration.php';
include_once './modules/email/email.php';
include_once './modules/fonctions/fonctions.php';
//Inclusion du fichier pour les textes.
include_once './languages/lang_'.$_SESSION['langue'].'.php';
//Inclusion du fichier pour la connexion à la base de données.
include_once './modules/bdd/connect.php';
//Inclusion des fichiers contenant les différentes classes.
include_once './classes/classes.php';
require_once './modules/message/classes_message.php';
//Inclusion du fichier pour la connexion au compte personnel.
include_once './modules/login/login.php';
/*
//Inclusion du fichier pour le moteur de recherche.
require_once './modules/recherche/recherche.php';
*/
//Test des cookies pour les sessions.
$cookie_token = filter_input(INPUT_COOKIE, "token", FILTER_SANITIZE_STRING);
if (!is_null($cookie_token) && is_null($action)){
    //Inclusion du fichier contenant la classe pour les cookies.
    require_once './modules/cookies/cookies.php';
    $cookies = new cookies();
    //Test du cookie.
    $cookie_test = $cookies->test_cookie($cookie_token, $dbh);
    
    if ($cookie_test["valid"] == "1"){
        $cookie_id = $cookie_test["id"];
        //La page "compte" doit être afficher.
        $action = "compte";
        //Le menu de déconnexion doi être afficher.
        $login = $deconnexion;
        $_SESSION["compte"]["id_participant"] = $cookie_id;
        //On met à jour le token de connexion.
        $cookie_update = $cookies->update_cookie($_SESSION["compte"]["id_participant"], $dbh);
        //On crée une cookie permettant de se connecter. Il est valable 30 jours.
        $cookie_create = $cookies->create_cookie($_SESSION["compte"]["id_participant"], $dbh);

    }
    

} else {
    //echo "pas cookie";
}



//Instanciation de l'objet pour le moteur de templates.
$moteur = new moteur_template();
//Instanciation de l'objet pour la validation des formulaires.
$form_valid = new formulaire();


//Les fonctions JavaScript à insérer dans le tag body.
if ( $action == 'liens' ||$action == 'ajuster_evenement' || $action == 'compte'){
    //$body = "onLoad=\"load();\" onUnload=\"GUnload();\"";
    $body = NULL;
} else {
    $body = NULL;
}

//Le menu pour la section "compte".
//Inclusion de la barre de menu.
if (isset($_SESSION["compte"]["id_participant"])){
    $menu_compte_code = file_get_contents("./template/menu_compte.php");
    //Récupération du nombre de message non lu.
    $messagerie = new classes_message;
    $message_non_lu = $messagerie->non_lu($_SESSION["compte"]["id_participant"], $dbh);
    if (empty($message_non_lu)){
        $message_non_lu_html = NULL;
    } else {
        $message_non_lu_html = "<span id=\"message_non_lu\">".$message_non_lu."</span>";
    }
    
    //Tableau des textes à parser.
    $texte_tableau_menu = [
        "{SITE_nom_site}" => $SITE_nom_site,
        "{LANG_mon_compte}" => $LANG_mon_compte,
        "{LANG_vos_evenements}" => $LANG_vos_evenements,
        "{LANG_texte_bouton_entrer}" => $LANG_texte_bouton_entrer,
        "{LANG_infos_personnelles}" => $LANG_infos_personnelles,
        "{LANG_modifier_position_perso}" => $LANG_modifier_position_perso,
        "{LANG_supprimer_compte}" => $LANG_supprimer_compte,
        "{LANG_menu_message}" => $LANG_menu_message,
        "{non_lu}" => $message_non_lu_html
    ];
    $menu_compte = $moteur->menu_compte($texte_tableau_menu, $menu_compte_code);
} else {
    $menu_compte = NULL;
}

//Tableau pour l'inclusion des fichiers
$inclusion_page = [
    "default"   => "./modules/default/default.php",
    "carte"     => "./modules/carte/carte.php",
    "creer"     => "./modules/creer_evenement/creer.php",
    "liens_evenement"   => "./modules/creer_evenement/liens.php",
    "contact"   => "./modules/contact/contact.php",
    "conditions_utilisation" => "./modules/conditions_d_utilisation/conditions_d_utilisation.php",
    "faq"       => "./modules/faq/faq.php",
    "emissions_co2" => "./modules/co2/emissions_co2.php",
    "bannieres" => "./modules/bannieres/bannieres.php",
    "compte"    => "./modules/compte/compte.php",
    "ajuster_evenement" => "./modules/creer_evenement/ajuster_evenement.php",
    "deconnexion" => "./modules/login/deconnexion.php",
    "participer"  => "./modules/participer/participer.php",
    "message"   => "./modules/message/message.php",
    "evenement" => "./modules/creer_evenement/evenement.php",
    "liens"     => "./modules/liens/liens.php"
];

//Inclusion des fichiers pour les pages.
if(array_key_exists($action, $inclusion_page)){
    $inclusion = $inclusion_page[$action];        
} else {
    $inclusion = $inclusion_page["default"];
}
include_once $inclusion;

/*
//Inclusion du gabarit
include_once "./template/template.php";


//Cette variable contient la zone où est affichée soit le formulaire de connexion soit le bouton de déconnexion.
echo $login;
//Cette variable sert pour le menu utilisateur lorsque celui-ci est connecté.
echo $menu_compte;
//Cette variable contient le contenu de la page.
echo $html;

include_once './modules/footer/footer.php';
*/

/*
 * Cette partie concerne la création du code HTML.
 */
$template_vide = "./template/template.php";
$html_template = file_get_contents($template_vide);
//Tableau des textes à parser.
$template_texte = [
    "{langue}" => $_SESSION['langue'],
    "{LANG_meta_description}" => $LANG_meta_description,
    "{LANG_meta_mots}" => $LANG_meta_mots,
    "{LANG_meta_title}" => $LANG_meta_title,
    "{body}" => $body,
    "{LANG_noscript}" => $LANG_noscript,
    "{LANG_baseline}" => $LANG_baseline,
    "{login}" => $login,
    "{menu_compte}" => $menu_compte,
    "{html}" => $html,
    "{LANG_contact}" => $LANG_contact,
    "{LANG_FAQ}" => $LANG_FAQ,
    "{LANG_conditions_utilisation}" => $LANG_conditions_utilisation,
    "{LANG_emissions_co2}" => $LANG_emissions_co2,
    "{LANG_bannieres}" => $LANG_bannieres,
    "{LANG_liens}" => $LANG_liens
];

$html_final = $moteur->remplace($template_texte, $html_template);

echo $html_final;