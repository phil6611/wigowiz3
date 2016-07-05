<?php

/* 
 * Ce fichier sert pour modifier un événement déjà créé.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

//Inclusion du fichier contenant les classes.
require_once './modules/creer_evenement/class_evenement.php';
$modif = new class_evenement;
//Récupération du code de l'évenement.
$code_admin = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
//Code html pour identifier l'événement.
$code_admin_input = "<input name=\"code_admin\" type=\"hidden\" id=\"code_admin\" value=\"".$code_admin."\">";
//récupération des données concernant l'événement.
$evenement_donnees = $modif ->modif_evenement($code_admin, $dbh);

//Vérification de la participation ou non au covoiturage.
$id_evenement = $evenement_donnees['0']['id_evenement'];
$participation = $modif -> participation_modif($id_evenement,$_SESSION['compte']['id_participant'], $dbh);

//Création des boutons "participer au covoiturage" et "alerte email"
if ($participation == 1){
    $je_participe_checked = "checked";
} else {
    $je_participe_checked = NULL;
}
if ($evenement_donnees['0']['envoi_alerte'] == 1){
    $envoi_alerte = "checked";
} else {
    $envoi_alerte = NULL;
}

/*
 * Cette partie concerne la création des différentes dates.
 */
$date_debut = date_create($evenement_donnees['0']['date_evenement']);
$date_debut_evenement = date_format($date_debut, 'Y-m-d');
$heure_debut_evenement = date_format($date_debut, 'H:i');
if (!empty($evenement_donnees['0']['date_fin'])) {
    $date_fin = date_create($evenement_donnees['0']['date_fin']);
    $date_fin_evenement = date_format($date_fin, 'Y-m-d');
    $heure_fin_evenement = date_format($date_fin, 'H:i');
} else {
    $date_fin_evenement = NULL;
    $heure_fin_evenement = NULL;
}


/*
 * Cette partie sert pour le tableau des pays
 */
$pays = $evenement_donnees['0']['pays'];
include_once './modules/pays/pays.php';

/*
 * Cette partie concerne la création du code HTML.
 */
//Adresse du fichier HTML.
$code_base = "./modules/creer_evenement/html_creer_evenement.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{titre}" => $LANG_titre_etape,
    "{titre_evenement}" => $LANG_titre_evenement,
    "{titre_evenement_texte}" => $evenement_donnees['0']['titre'],
    "{titre_valid}" => NULL,
    "{description}" => $LANG_description,
    "{description_texte}" => $evenement_donnees['0']['description'],
    "{description_valid}" => NULL,
    
    "{date}" => $LANG_date_evenement,
    "{date_evenement}" => $date_debut_evenement,
    "{heure}" => $LANG_heure_evenement,
    "{time_evenement}" => $heure_debut_evenement,
    "{date_fin}" => $LANG_date_fin,
    "{date_fin_evenement}" => $date_fin_evenement,
    "{heure_fin}" => $LANG_heure_fin,
    "{time_fin_evenement}" => $heure_fin_evenement,
    "{date_valid}" => NULL,
    
    "{je_participe}" => $LANG_je_participe,
    "{alerte_mail}" => $LANG_cocher_alerte_mail,
    "{etape_suivante}" => $LANG_bouton_etape_suivante,
    "{LANG_titre_etape2}" => $LANG_bouton_terminer,
    "{LANG_adresse_evenement}" => $LANG_adresse_evenement,
    "{adresse}" => $evenement_donnees['0']['adresse'],
    "{adresse_valid}" => NULL,
    "{LANG_cp_evenement}" => $LANG_cp_evenement,
    "{cp}" => $evenement_donnees['0']['cp'],
    "{cp_valid}" => NULL,
    "{LANG_ville_evenement}" => $LANG_ville_evenement,
    "{ville}" => $evenement_donnees['0']['ville'],
    "{ville_valid}" => NULL,
    "{LANG_votre_pays}" => $LANG_votre_pays,
    "{pays_liste}" => $pays_liste,
    "{je_participe_checked}" => $je_participe_checked,
    "{envoi_alerte}" => $envoi_alerte,
    "{creation}" => "modification",
    "{id_evenement}" =>  "<input name=\"id_evenement\" type=\"hidden\" id=\"id_evenement\" value=\"".$evenement_donnees['0']['id_evenement']."\">",
    "{action}" => "evenement&section=modif_enregistrement"
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);