<?php
//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:./index.php");
}

//Création du code pour le cadre "agenda".
require_once './modules/agenda/agenda_classes.php';

$agenda = new agenda_classes();



$id = $_SESSION['compte']['id_participant'];

//Création du lien vers l'agenda du participant.
$code = $agenda->agenda_participant($id, $dbh);
$url_agenda = $SITE_nom_site."/modules/agenda/ics.php?code=".$code;
$text_url_agenda = str_replace("%url_agenda%",$url_agenda, $LANG_synchronisation_agenda);

//Création de la liste des événements.
$liste_evenement = $agenda->a_venir($id, $dbh);

if ($liste_evenement != 0){
    /* gestion des locales */
    setlocale(LC_TIME, $locale);
    //Variable pour l'agenda.
    $agenda = NULL;
    foreach ($liste_evenement as $row) {
        $date_formate = strftime("%A %d %B %Y",strtotime($row['date_evenement']));
        $agenda .= "<p>".$date_formate." ".$row['titre']."</p>\n\r";
    }

} else {
    $agenda = $LANG_aucun_evenement;
}

//Création du code pour le cadre "message".
if (empty($message_non_lu)){
    $cadre_message_html = $LANG_compte_aucun_message;
} else {
    //On vérifie le nombre de message pour mettre le texte au pluriel ou au singulier.
    if ($message_non_lu == 1){
        $nouveau_message_texte = $LANG_compte_un_message;
    } else {
        $nouveau_message_texte = $LANG_compte_plusieurs_messages;
    }
    $cadre_message_html = $LANG_compte_cadre_message." ".$message_non_lu." ".$nouveau_message_texte;
}

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/compte/html_compte_default.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_mon_compte}" => $LANG_mon_compte,
    "{SITE_nom_site}" => $SITE_nom_site,
    "{LANG_compte_titre_agenda}" => $LANG_compte_titre_agenda,
    "{LANG_vos_evenements}" => $LANG_vos_evenements,
    "{LANG_texte_bouton_entrer}" => $LANG_texte_bouton_entrer,
    "{LANG_infos_personnelles}" => $LANG_infos_personnelles,
    "{LANG_modifier_position_perso}" => $LANG_modifier_position_perso,
    "{text_url_agenda}" => $text_url_agenda,
    "{agenda}" => $agenda,
    "{LANG_compte_titre_message}" => $LANG_compte_titre_message,
    "{nbr_message}" => $cadre_message_html
];

$html = $moteur->remplace($texte_tableau, $html_code);

?>