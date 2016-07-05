<?php

/*
 * Ce fichier sert pour l'inscription à un événement.
 */

//On vérifie si la connexion est établie.
if(!isset($_SESSION['compte']['id_participant'])){
    //Renvoi vers la page d'accueil.
    //header("location:../index.php");
}


//On vérifie si la demande d'inscription est faite.
$demande_inscription = filter_input(INPUT_GET, "inscription", FILTER_SANITIZE_STRING);
if (isset($_SESSION['inscription']) || $demande_inscription == TRUE){
    $inscription = TRUE;
} else {
    $inscription = FALSE;
}


//On vérifie si la demande d'inscription est faite. Si oui on inscrit l'internaute.
if ($inscription === TRUE){

    
    
    //récupération de l'identifiant de l'événement.
    $id_evenement = $_SESSION['evenement']['id_evenement'];
    //récupération de l'identifiant de l'internaute.
    $id_internaute = $_SESSION['compte']['id_participant'];
    //récupération de la variable pour l'envoi d'alerte par email.
    $envoi_alerte = $_SESSION['evenement']['envoi_alerte'];
    //récupération de l'adresse email pour l'alerte.
    $email_alerte = $_SESSION['evenement']['email'];

    //récupération du code passé dans l'URL, au cas ou le mécanisme de session ne marcherait pas.
    $code_evenement = filter_input(INPUT_GET, "evenement", FILTER_SANITIZE_STRING);
    //Si le mécanisme de session a échoué on change variable pour l'identifiant de l'évenement.
    if ($id_evenement === NULL){
        $id_evenement = $code_evenement;
    }
    
    /*
     * On teste si l'internaute est inscrit à l'événement.
     */

    $verif = new evenement();
    $compte_inscription = $verif->verif_inscription($id_internaute, $id_evenement,$dbh);

    if ($compte_inscription == 0) {
        //On inscrit l'internaute à l'événement.
        
        //Calcul de la distance entre le domicile et l'événement.
        $distance = new distance();
        $distance_utilisateur = $distance->distance_lineaire($id_evenement, $id_internaute, $dbh);
        
        //Tableau des variables pour la requête SQL.
        $array_variables = [
            ":id_relation"  => NULL,
            ":id_evenement" => $id_evenement,
            ":id_participant" => $id_internaute,
            ":distance" => $distance_utilisateur,
            ":commentaires" => " "
        ];

        //Création de la requête SQL.
        $sql_inscription_prepare = "INSERT INTO `".PREFIXE."relations`(`id_relation`, `id_evenement`, `id_participant`,`distance`, `commentaire`) "
                . "VALUES (:id_relation,:id_evenement,:id_participant,:distance,:commentaires)";
        //Exécution de la requête.
        $resultat_inscription = $dbh->prepare($sql_inscription_prepare);

        try {
            $resultat_inscription -> execute($array_variables);
            //Suppression de la variable qui permet l'inscription
            unset($_SESSION['inscription']);
            
            //Envoi de l'alerte par email.
            if ($envoi_alerte == 1) {
                $tableau_email = [
                    "expediteur" => "Wigowiz - AddicTerra <wigowiz@addicterra.fr>",
                    "destinataire" => $email_alerte,
                    "sujet" => $LANG_mail_alerte,
                    "message" => $LANG_mail_alerte_contenu 
                ];
                send_email($tableau_email);
            }
            
            //Redirection vers la page permettant d'afficher la carte une fois inscrit.
            header("location:./index.php?a=carte&include=default&m=".$_SESSION['evenement']['code']);
            //echo "inscrit";
        } catch (Exception $ex) {
            echo "échec <br />";
            echo $ex;
        }

    } else {
        header("location:./index.php?a=carte&include=default&m=".$_SESSION['evenement']['code']);
    }

} else {
    header("location:./index.php?a=carte&include=default&m=".$_SESSION['evenement']['code']);
}
