<?php

/* 
 * 
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

/*
 * on utilise l'objet $messagerie créé dans le fichier index.php à la racine du site.
 */


/*
 * Récupération de la liste des message.
 */
//Message reçus.
$tableau_message_recus = $messagerie->liste_message($_SESSION["compte"]["id_participant"], $dbh, 0);
//Message émis.
$tableau_message_emis = $messagerie->liste_message($_SESSION["compte"]["id_participant"], $dbh, 1);

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/message/html_message_default.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_message_titre}" => $LANG_message_titre,
    "{LANG_message_message_recu}" => $LANG_message_message_recu,
    "{LANG_message_date}" => $LANG_message_date,
    "{LANG_message_expediteur}" => $LANG_message_expediteur,
    "{LANG_message_sujet}" => $LANG_message_sujet,
    "{LANG_message_etat}" => $LANG_message_etat,
    "{LANG_message_destinaire}" => $LANG_message_destinaire,
    "{LANG_message_datatable_empty}" => $LANG_message_datatable_empty,
    "{LANG_message_datatable_info}" => $LANG_message_datatable_info,
    "{LANG_message_datatable_infoEmpty}" => $LANG_message_datatable_infoEmpty,
    "{LANG_message_datatable_infoFiltered}" => $LANG_message_datatable_infoFiltered,
    "{LANG_message_datatable_thousands}" => $LANG_message_datatable_thousands,
    "{LANG_message_datatable_lengthMenu}" => $LANG_message_datatable_lengthMenu,
    "{LANG_message_datatable_loadingRecords}" => $LANG_message_datatable_loadingRecords,
    "{LANG_message_datatable_processing}" => $LANG_message_datatable_processing,
    "{LANG_message_datatable_search}" => $LANG_message_datatable_search,
    "{LANG_message_datatable_searchPlaceholder_recu}" => $LANG_message_datatable_searchPlaceholder_recu,
    "{LANG_message_datatable_searchPlaceholder_emis}" => $LANG_message_datatable_searchPlaceholder_emis,
    "{LANG_message_datatable_zeroRecords}" => $LANG_message_datatable_zeroRecords,
    "{LANG_message_datatable_first}" => $LANG_message_datatable_first,
    "{LANG_message_datatable_last}" => $LANG_message_datatable_last,
    "{LANG_message_datatable_next}" => $LANG_message_datatable_next,
    "{LANG_message_datatable_previous}" => $LANG_message_datatable_previous,
    "{LANG_message_datatable_sortAscending}" => $LANG_message_datatable_sortAscending,
    "{LANG_message_datatable_sortDescending}" => $LANG_message_datatable_sortDescending,
    "{tableau_message_reçu}" => $tableau_message_recus,
    "{tableau_message_emis}" => $tableau_message_emis
];

$html = $moteur->remplace($texte_tableau, $html_code);