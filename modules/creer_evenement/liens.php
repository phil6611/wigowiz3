<?php
/*
 * Ce fichier sert pour créer les liens.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

//Récupération de l'identifiant de l'événement
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (isset($id)){
    
    $id_evenement = $id;
    //Requête SQL.
    $sql_evenement = "SELECT * FROM `".PREFIXE."evenements` WHERE `id_evenement` LIKE :id";
    $resultat_connexion = $dbh->prepare($sql_evenement);
    $resultat_connexion->execute(array(':id'=>$id_evenement));
    $evenement = $resultat_connexion->fetchAll();
    
    $titre = $evenement[0]['titre'];
    $date = $evenement[0]['date_evenement'];
    /* gestion des locales */
    setlocale(LC_TIME, $locale);
    $date_formate = strftime("%A %d %B %Y",strtotime($evenement[0]['date_evenement']));
    $description = $evenement[0]['description'];
    $nom = NULL;
    $prenom = NULL;
    $code = $evenement[0]['code'];
    $code_admin = $evenement[0]['code_admin'];
    
} else {
    $id_evenement = 0;
}


/*
 * Cette partie concerne la création du code HTML.
 */
//Adresse du fichier HTML.
$code_base = "./modules/creer_evenement/html_liens.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{titre_evenement}" => $titre,
    "{date}" => $date_formate,
    "{description}" => $description,
    "{LANG_evenement_cree_par}" => $LANG_evenement_cree_par,
    "{nom}" => $nom,
    "{prenom}" => $prenom,
    //"{LANG_un_compte_permet_infobulle}" => $LANG_un_compte_permet_infobulle,
    //"{LANG_modifier_position_marqueur}" => $LANG_modifier_position_marqueur,
    "{LANG_lien_pour_participer}" => $LANG_lien_pour_participer,
    "{SITE_nom_site}" => $SITE_nom_site,
    "{code}" => $code,
    "{LANG_creer_evenement_bouton_automatique}" => $LANG_creer_evenement_bouton_automatique,
    "{LANG_creer_evenement_inserer}" => $LANG_creer_evenement_inserer,
    //"{LANG_lien_pour_administrer}" => $LANG_lien_pour_administrer,
    //"{code_admin}" => $code_admin,
    //"{LANG_important}" => $LANG_important,
    //"{LANG_enregistrer_liens}" => $LANG_enregistrer_liens,
    "{LANG_faq2_texte}" => $LANG_faq2_texte,
    //"{paypal}" => $LANG_paypal,
    "{qrcode}" => $code,
    "{LANG_creer_evenement_qrcode_titre}" => $LANG_creer_evenement_qrcode_titre,
    "{LANG_creer_evenement_qrcode_petit}" => $LANG_creer_evenement_qrcode_petit,
    "{LANG_creer_evenement_qrcode_moyen}" => $LANG_creer_evenement_qrcode_moyen,
    "{LANG_creer_evenement_qrcode_grand}" => $LANG_creer_evenement_qrcode_grand
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>