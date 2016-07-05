<?php

/*
 * Ce fichier sert pour la gestion de la liste des évenements d'un utilisateur.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

/*
 * Création de la liste des événements créés par l'internaute.
 */

//Instanciation de l'objet pour afficher le nombre de participant.
$evenement_obj = new class_evenement();

//Requête SQL
$sql_evenement_creer = "SELECT * FROM `".PREFIXE."evenements` WHERE `id_createur` LIKE :id ORDER BY `date_creation` DESC";
//Tableau des variables pour les requêtes SQL.
$array_variables = [
    ":id" => $_SESSION["compte"]["id_participant"]
];
//Exécution de la requête.
$resultat_creer = $dbh->prepare($sql_evenement_creer);
$resultat_creer -> execute($array_variables);
//Création du tableau contenant les informatiosn sur les événements.
$donnees_evenement_creer = $resultat_creer->fetchAll();
$compte_creer = count($donnees_evenement_creer);

if ($compte_creer == 0){
    $evenements_creer = NULL;
} else {
    $evenements_creer = NULL;
    //Création de la liste des événements créés.
    foreach ($donnees_evenement_creer as $row){
        //Nombre de particpants à l'événement.
        $nbr_participant = $evenement_obj ->nombre_participants($row['id_evenement'], $dbh);
        
        $evenements_creer .= "            \n\r<tr class=\"liste_evenement\">
                <td class=\"detail_evenement\">
                    <input type=\"checkbox\" value=\"".$row['id_evenement']."\" name=\"evenement_".$row['id_evenement']."\" />
                </td>
                <td class=\"detail_evenement\">
                    <a href=\"./index.php?a=evenement&section=modif&amp;id=".$row['code_admin']."\" title=\"modifier l'événement\">Modifier</a>
                </td>
                <td class=\"titre_evenement\">
                    <a href=\"../index.php?a=carte&include=default&m=".$row['code']."\">".$row['titre']."</a>
                </td>
                <td class=\"titre_evenement\">
                    ".$nbr_participant."
                </td>
                <td class=\"detail_evenement\">
                    ".$row['date_evenement']."
                </td>
                <td class=\"stat_evenement\">
                    <a href=\"./modules/csv/csv.php?code=".$row['code']."&lang=".$_SESSION["langue"]."\" />Format CSV</a>
                </td>
                <td class=\"info_evenement\">
                    ".$row['description']."
                </td>
            </tr>";
    }

}

/*
 * Création de la liste des événements auxquels l'internaute participe ou a participé.
 */

//Requête SQL
$sql_evenement_participer = "SELECT * FROM `".PREFIXE."relations` "
        . "JOIN `".PREFIXE."evenements` "
        . "ON `".PREFIXE."relations`.`id_evenement` = `".PREFIXE."evenements`.`id_evenement` "
        . "WHERE `".PREFIXE."relations`.`id_participant` LIKE :id "
        . "ORDER BY `date_creation` DESC";
//Tableau des variables pour les requêtes SQL.
$array_variables_participer = [
    ":id" => $_SESSION["compte"]["id_participant"]
];
//Exécution de la requête.
$resultat_participer = $dbh->prepare($sql_evenement_participer);
$resultat_participer -> execute($array_variables_participer);
//Création du tableau contenant les informatiosn sur les événements.
$donnees_evenement_participer = $resultat_participer->fetchAll();
$compte_participer = count($donnees_evenement_participer);
        
if ($compte_participer == 0){
    $evenements_participer = NULL;
} else {
    $evenements_participer = NULL;
    //Création de la liste des événements auxquels l'internaute est inscrit.
    foreach ($donnees_evenement_participer as $row){
        $evenements_participer .= "            \n\r<tr class=\"liste_evenement\">
                <td class=\"detail_evenement\">
                    <input type=\"checkbox\" value=\"".$row['id_relation']."\" name=\"evenement_".$row['id_relation']."\" />
                </td>
                <td class=\"titre_evenement\">
                    <a href=\"../index.php?a=carte&include=default&m=".$row['code']."\">".$row['titre']."</a>
                </td>
                <td class=\"detail_evenement\">
                    ".$row['date_evenement']."
                </td>
                <td class=\"info_evenement\">
                    ".$row['description']."
                </td>
            </tr>\n\r";
    }

}


/*
 * Cette partie concerne la créatino du code html à afficher.
 */

//Adresse du fichier HTML.
$code_base = "./modules/creer_evenement/html_evenements.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_mes_evenements}" => $LANG_mes_evenements,
    "{evenements_creer}" => $evenements_creer,
    "{evenements_participer}" => $evenements_participer,
    "{{LANG_liste_evenement_bouton_desinscrire_label}}" => $LANG_liste_evenement_bouton_desinscrire_label,
    "{{LANG_liste_evenement_bouton_desinscrire}}" => $LANG_liste_evenement_bouton_desinscrire,
    "{{LANG_liste_evenement_participer}}" => $LANG_liste_evenement_participer,
    "{{LANG_liste_evenement_se_desinscrire}}" => $LANG_liste_evenement_se_desinscrire,
    "{{LANG_liste_evenement_titre}}" => $LANG_liste_evenement_titre,
    "{{LANG_liste_evenement_date}}" => $LANG_liste_evenement_date,
    "{{LANG_liste_evenement_description}}" => $LANG_liste_evenement_description,
    "{{LANG_liste_evenement_creer}}" => $LANG_liste_evenement_creer,
    "{{LANG_liste_evenement_bouton_supprimer_label}}" => $LANG_liste_evenement_bouton_supprimer_label,
    "{{LANG_liste_evenement_bouton_supprimer}}" => $LANG_liste_evenement_bouton_supprimer,
    "{{LANG_liste_evenement_supprimer}}" => $LANG_liste_evenement_supprimer,
    "{{LANG_liste_evenement_modifier}}" => $LANG_liste_evenement_modifier,
    "{{LANG_liste_evenement_nbr_participant}}" => $LANG_liste_evenement_nbr_participant,
    "{{LANG_liste_evenement_statistiques}}" => $LANG_liste_evenement_statistiques
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);