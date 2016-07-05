<?php

if(!isset($_SESSION['compte']['id_participant'])){
    unset($_SESSION['compte']);
}

//On compte le nombre d'événements créés
$res_sql = "SELECT id_evenement FROM  `".PREFIXE."evenements` ";
//Résultat de la requête.
$resultat = $dbh->query($res_sql);
$resultat_res = $resultat -> fetchall(PDO::FETCH_ASSOC);
$nbr_evenement = count($resultat_res);
/*

/*
 * Cette partie concerne la création du code HTML.
 */
$code_base = "./modules/default/html_default.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{site_nom}" => $SITE_nom_site,
    "{lang_etape1}" => $LANG_etape1,
    "{lang_etape2}" => $LANG_etape2,
    "{lang_etape3}" => $LANG_etape3,
    "{langue}" => $_SESSION['langue'],
    "{lang_texte_bouton_entrer}" => $LANG_texte_bouton_entrer,
    "{nbr_evenement}" => $nbr_evenement,
    "{LANG_nbr_evenement}" => $LANG_nbr_evenement,
    "{langue_phrase_accueil}" => $LANG_phrase_accueil
];

$html = $moteur->remplace($texte_tableau, $html_code);

?>	