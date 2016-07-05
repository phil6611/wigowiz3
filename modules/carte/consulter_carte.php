<?php

//Vérification de la connexion de l'internaute.

if(isset($_SESSION["compte"]["id_participant"])){

    //On vérifie si l'internaute est inscrit
    $verif = new evenement();
    $compte_inscription = $verif->verif_inscription($_SESSION['compte']['id_participant'], $id_evenement,$dbh);

    //Texte à afficher si l'internaute est inscrit à l'événement.
    if ($compte_inscription == 0){
        //On affiche le texte pour pouvoir s'inscrire.
        $texte_inscription = "<a href=\"./index.php?a=compte&section=inscription&inscription=TRUE&evenement=".$id_evenement."\" title=\"".$LANG_carte_participer_placeholder."\" class=\"bouton\">".$LANG_carte_participer."</a>";
    } else {
        $texte_inscription = "<a href=\"./index.php?a=compte&section=desinscription&evenement=".$id_evenement."\" title=\"".$LANG_carte_desinscrire_placeholder."\" class=\"bouton\">".$LANG_carte_desinscrire."</a>";
    }

    $texte_tableau = [
        "{titre}" => $LANG_meta_title,
        "{titre_evenement}" => $_SESSION['evenement']['titre'],
        "{langue}" => $_SESSION['langue'],
        "{alerte}" => $alerte,
        "{LANG_carte_titre_evenement}" => $LANG_carte_titre_evenement,
        "{LANG_carte_date_evenement}" => $LANG_carte_date_evenement,
        "{LANG_carte_cree_par}" => $LANG_carte_cree_par,
        "{createur_evenement}" => $_SESSION['evenement']['createur'],
        "{date_evenement}" => $date_complete,
        "{id_evenement}" => $id_evenement,
        "{description}" => nl2br($_SESSION['evenement']['description']),
        "{texte_inscription}" => $texte_inscription,
        "{type}" => "complete"
    ];


} else {
    //Fichier html à inclure si l'internaute n'est pas connecté.
    //$code_base = "./modules/carte/html_consulter_carte_simple.php";

    $texte_inscription = "<a href=\"./index.php?a=compte&section=participer\" title=\"".$LANG_carte_participer_placeholder."\" class=\"bouton\">".$LANG_carte_participer."</a>";
            
    //Création de la variable de session pour mémoriser l'évenement.
    $_SESSION['evenement']['code'] = $code;
    //Tableau des textes à parser.
    $texte_tableau = [
        "{titre}" => $LANG_meta_title,
        "{titre_evenement}" => $_SESSION['evenement']['titre'],
        "{langue}" => $_SESSION['langue'],
        "{alerte}" => $alerte,
        "{LANG_carte_titre_evenement}" => $LANG_carte_titre_evenement,
        "{LANG_carte_date_evenement}" => $LANG_carte_date_evenement,
        "{LANG_carte_cree_par}" => $LANG_carte_cree_par,
        "{createur_evenement}" => $_SESSION['evenement']['createur'],
        "{date_evenement}" => $date_formate,
        "{description}" => nl2br($_SESSION['evenement']['description']),
        "{id_evenement}" => $id_evenement,
        "{texte_inscription}" => $texte_inscription,
        "{type}" => "simple"
    ];
}


?>