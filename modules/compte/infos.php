<?php

/* 
 * Ce fichier est utilisé pour modifier les informations personnelles.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

/*
 * Cette partie concerne la récupération des données utilisateurs.
 */

//Requête sql.
$sql_infos_prepare = "SELECT * FROM `".PREFIXE."participants` WHERE `id_participant` LIKE :id LIMIT 1";
//Préparation de la requête
$resultat_connexion = $dbh->prepare($sql_infos_prepare);
//Exécution de la requête
$resultat_connexion->execute(array(':id'=>$_SESSION["compte"]["id_participant"]));
//Création du tableau associatif.
$resultat_tableau = $resultat_connexion->fetchAll();
//Variables pour remplir le formulaire.
$prenom = $resultat_tableau[0]['prenom_participant'];
$nom = $resultat_tableau[0]['nom_participant'];
$email = $resultat_tableau[0]['email_participant'];
$tel = $resultat_tableau[0]['tel_participant'];
$adresse = $resultat_tableau[0]['adresse_participant'];
$cp = $resultat_tableau[0]['cp_participant'];
$ville = $resultat_tableau[0]['ville_participant'];
$pays = $resultat_tableau[0]['pays_participant'];
$bouton_email = $resultat_tableau[0]['cacher_email'];
$bouton_adresse = $resultat_tableau[0]['cacher_adresse'];
$vehicule = $resultat_tableau[0]['vehicule'];
$commentaire = $resultat_tableau[0]['commentaire'];

//Variables pour le véhicule.
if ($vehicule == 1){
    $avoir_vehicule = "checked";
    $pas_vehicule = NULL;
} elseif ($vehicule == 0){
    $avoir_vehicule = NULL;
    $pas_vehicule = "checked";
} else {
    $avoir_vehicule = NULL;
    $pas_vehicule = NULL;
}
//Variables pour les boutons cacher_email et cacher_adresse
if ($bouton_email == 0){
    $bouton_cacher_email = NULL;
} elseif ($bouton_email == 1) {
    $bouton_cacher_email = "checked";
}
if ($bouton_adresse == 0){
    $bouton_cacher_adresse = NULL;
} elseif ($bouton_adresse == 1) {
    $bouton_cacher_adresse= "checked";
}
//Variables pour la validation du formulaire.
$prenom_valid = NULL;
$nom_valid = NULL;
$email_valid = NULL;
$adresse_valid = NULL;
$cp_valid = NULL;
$ville_valid = NULL;
$tel_valid = NULL;
$mdp1_valid = NULL;
$mdp_test = NULL;

/*
 * Cette partie concerne le tableau pour les pays.
 */
include_once './modules/pays/pays.php';

/*
 * Cette partie concerne la création du code HTML.
 */

//Adresse du fichier HTML.
$code_base = "./modules/compte/html_form_creer.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{titre}" => $LANG_infos_personnelles,
    "{texte}" => NULL,
    "{LANG_compte_creer_civilite}" => $LANG_compte_creer_civilite,
    "{LANG_compte_creer_coordonnees}" => $LANG_compte_creer_coordonnees,
    "{LANG_compte_creer_securite}" => $LANG_compte_creer_securite,
    "{LANG_compte_creer_infos_utiles}" => $LANG_compte_creer_infos_utiles,
    "{LANG_votre_prenom}" => $LANG_votre_prenom,
    "{LANG_votre_nom}" => $LANG_votre_nom,
    "{LANG_numero_tel}" => $LANG_numero_tel,
    "{LANG_adresse_email}" => $LANG_adresse_email,
    "{bouton_cacher_email}" => $bouton_cacher_email,
    "{LANG_cacher_mon_email}" => $LANG_cacher_mon_email,
    "{LANG_cacher_mon_email_suite}" => $LANG_cacher_mon_email_suite,
    "{LANG_choisissez_motdepasse}" => $LANG_choisissez_motdepasse,
    "{LANG_confirmer}" => $LANG_confirmer,
    "{LANG_votre_adresse}" => $LANG_votre_adresse,
    "{LANG_votre_cp}" => $LANG_votre_cp,
    "{LANG_votre_ville}" => $LANG_votre_ville,
    "{LANG_votre_pays}" => $LANG_votre_pays,
    "{bouton_cacher_adresse}" => $bouton_cacher_adresse ,
    "{LANG_cacher_mon_adresse}" => $LANG_cacher_mon_adresse,
    "{LANG_vous_avez_un_vehicule}" => $LANG_vous_avez_un_vehicule,
    "{LANG_pas_de_vehicule}" => $LANG_pas_de_vehicule,
    "{LANG_commentaire_participant}" => $LANG_commentaire_participant,
    "{LANG_bouton_terminer}" => $LANG_bouton_terminer,
    "{LANG_bouton_annuler}" => $LANG_bouton_annuler,
    "{prenom}" => $prenom,
    "{prenom_valid}" => $prenom_valid,
    "{nom}" => $nom ,
    "{nom_valid}" => $nom_valid,
    "{tel}" => $tel,
    "{tel_valid}" => $tel_valid,
    "{email}" => $email,
    "{email_valid}" => $email_valid,
    "{mdp1_valid}" => $mdp1_valid,
    "{mdp_test}" => $mdp_test,
    "{adresse}" => $adresse,
    "{adresse_valid}" => $adresse_valid,
    "{cp}" => $cp,
    "{cp_valid}" => $cp_valid,
    "{ville}" => $ville,
    "{ville_valid}" => $ville_valid,
    "{avoir_vehicule}" => $avoir_vehicule,
    "{pas_vehicule}" => $pas_vehicule,
    "{commentaire}" => $commentaire,
    "{pays_liste}" => $pays_liste,
    "{modification}" => "update"
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);