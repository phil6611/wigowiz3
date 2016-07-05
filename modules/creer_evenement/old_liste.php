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
    $evenements_creer = "\n\r"
            . "        <form action=\"./index.php?a=compte&section=supprimer_evenement\" method=\"post\">

            <h2>".$LANG_liste_evenement_creer."</h2>

            <div class=\"liste_evenement\">
                <div class=\"detail_evenement\">
                    ".$LANG_liste_evenement_supprimer."
                </div>
                <div class=\"detail_evenement\">
                    ".$LANG_liste_evenement_modifier."
                </div>
                <div class=\"titre_evenement\">
                    ".$LANG_liste_evenement_titre."
                </div>
                <div class=\"titre_evenement\">
                    ".$LANG_liste_evenement_nbr_participant."
                </div>
                <div class=\"detail_evenement\">
                    ".$LANG_liste_evenement_date."
                </div>
                <div class=\"stat_evenement\">
                    ".$LANG_liste_evenement_statistiques."
                </div>
                <div class=\"info_evenement\">
                    ".$LANG_liste_evenement_description."
                </div>
            </div>\n\r";
    //Création de la liste des événements créés.
    foreach ($donnees_evenement_creer as $row){
        //Nombre de particpants à l'événement.
        $nbr_participant = $evenement_obj ->nombre_participants($row['id_evenement'], $dbh);
        
        $evenements_creer .= "            <div class=\"liste_evenement\">
                <div class=\"detail_evenement\">
                    <input type=\"checkbox\" value=\"".$row['id_evenement']."\" name=\"evenement_".$row['id_evenement']."\" />
                </div>
                <div class=\"detail_evenement\">
                    <a href=\"./index.php?a=evenement&section=modif&amp;id=".$row['code_admin']."\" title=\"modifier l'événement\">Modifier</a>
                </div>
                <div class=\"titre_evenement\">
                    <a href=\"../index.php?a=carte&include=default&m=".$row['code']."\">".$row['titre']."</a>
                </div>
                <div class=\"titre_evenement\">
                    ".$nbr_participant."
                </div>
                <div class=\"detail_evenement\">
                    ".$row['date_evenement']."
                </div>
                <div class=\"stat_evenement\">
                    <a href=\"./modules/csv/csv.php?code=".$row['code']."&lang=".$_SESSION["langue"]."\" />Format CSV</a>
                </div>
                <div class=\"info_evenement\">
                    ".$row['description']."
                </div>
            </div>";
    }

    $evenements_creer .= "            <div>
                <label for=\"supprimer\">".$LANG_liste_evenement_bouton_supprimer_label."</label>
                <input type=\"submit\" value=\"".$LANG_liste_evenement_bouton_supprimer."\" id=\"supprimer\" />
            </div>
            </form>";
}

/*
 * Création de la liste des événements auquel l'internaute participe ou a participé.
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
    $evenements_participer = "\n\r"
            . "        <form action=\"./index.php?a=compte&section=desinscription\" method=\"post\">
            
            <h2>".$LANG_liste_evenement_participer."</h2>
            
            <div class=\"liste_evenement\">
                <div class=\"detail_evenement\">
                    ".$LANG_liste_evenement_se_desinscrire."
                </div>
                <div class=\"titre_evenement\">
                    ".$LANG_liste_evenement_titre."
                </div>
                <div class=\"detail_evenement\">
                    ".$LANG_liste_evenement_date."
                </div>
                <div class=\"info_evenement\">
                    ".$LANG_liste_evenement_description."
                </div>
            </div>\n\r";
    //Création de la liste des événements créés.
    foreach ($donnees_evenement_participer as $row){
        $evenements_participer .= "            \n\r<div class=\"liste_evenement\">
                <div class=\"detail_evenement\">
                    <input type=\"checkbox\" value=\"".$row['id_relation']."\" name=\"evenement_".$row['id_relation']."\" />
                </div>
                <div class=\"titre_evenement\">
                    <a href=\"../index.php?a=carte&include=default&m=".$row['code']."\">".$row['titre']."</a>
                </div>
                <div class=\"detail_evenement\">
                    ".$row['date_evenement']."
                </div>
                <div class=\"info_evenement\">
                    ".$row['description']."
                </div>
            </div>\n\r";
    }
    $evenements_participer .= "            <div>
                <label for=\"supprimer\">".$LANG_liste_evenement_bouton_desinscrire_label."</label>
                <input type=\"submit\" value=\"".$LANG_liste_evenement_bouton_desinscrire."\" id=\"supprimer\" />
                <input type=\"hidden\" name=\"desinscrire\" value=\"TRUE\" />
            </div>
            </form>";
}

//Adresse du fichier HTML.
$code_base = "./modules/creer_evenement/html_evenements.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{LANG_mes_evenements}" => $LANG_mes_evenements,
    "{evenements_creer}" => $evenements_creer,
    "{evenements_participer}" => $evenements_participer
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

