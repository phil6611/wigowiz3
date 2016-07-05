<?php

/*
 * Ce fichier sert pour supprimer un compte.
 */

//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    header("location:./index.php");
}

/*
 * Cette partie sert pour vérifier l'envoi ou non du formulaire. 
 */
//Récupération de la variable $_POST
$envoi = filter_input(INPUT_POST, "envoi", FILTER_SANITIZE_STRING);

/*
 * Cette partie concerne la création d'un nouveau compte dans la base de données.
 */
if($envoi == "TRUE"){
    
    //Récupération de l'indentifiant de l'internaute.
    $id_participant = filter_input(INPUT_POST, "id_participant", FILTER_SANITIZE_NUMBER_INT);
    
    //Création de la requête SQL.
    $sql_suppression = "DELETE FROM `".PREFIXE."participants` WHERE `id_participant` LIKE :id LIMIT 1";
    //Tableau des variables.
    $array_variables[":id"] = $id_participant;
    //Exécution de la requête.
    $resultat_suppression = $dbh->prepare($sql_suppression);
    try {
        $resultat_suppression -> execute($array_variables);
        unset($_SESSION['compte']['id_participant']);
        //Renvoi vers la page d'accueil.
        header("location:./index.php");
    } catch (Exception $ex) {
        echo $ex;
    }
    

} else {

    //Adresse du fichier HTML.
    $code_base = "./modules/compte/html_supprimer_compte.php";
    $html_code = file_get_contents($code_base);
    //Tableau des textes à parser.
    $texte_tableau = [
        "{id}" => $_SESSION['compte']['id_participant'],
        "{LANG_compte_supprimer_titre}" => $LANG_compte_supprimer_titre,
        "{LANG_compte_supprimer_texte}" => $LANG_compte_supprimer_texte,
        "{LANG_compte_supprimer_label}" => $LANG_compte_supprimer_label,
        "{LANG_compte_supprimer_submit}" => $LANG_compte_supprimer_submit
    ];
    //Renvoi du contenu HTML.
    $html = $moteur->remplace($texte_tableau, $html_code);
    
}