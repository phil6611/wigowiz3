<?php

/*
 * Ce fichier est utilisé pour la connexion des utilisateurs.
 * Il permet d'afficher le formulaire de connexion et le menu de déconnexion.
 */


//Récupération de la variable $_POST
$connexion = filter_input(INPUT_POST, "connexion", FILTER_SANITIZE_STRING);

//Gestion du message d'erreur.
$erreur_connexion = $LANG_login_erreur_connexion;

//Inclusion du fichier contenant le code HTML.
//Il contient les variables $form et $deconnexion.
include_once './modules/login/form_connexion.php';

//Vérification de l'inscription à un événement.
if (isset ($_SESSION['inscription'])){
    //si l'internaute se connecte pour s'inscrire à un événement il est redirigé vers la page d'inscription.
    $redirection = "location:./index.php?a=compte&section=inscription";
} else {
    //si la connexion est "standard" alors l'internaute est redirigé vers la page de gestion des comptes.
    $redirection = "location:./index.php?a=compte";
}

//On vérifie si le formulaire a été envoyé.
if ($connexion == TRUE){
    //Validation des données envoyées depuis le formulaire.
    $email_post = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $mdp_post = filter_input(INPUT_POST, "motdepasse", FILTER_SANITIZE_STRING);
    
    //Gestion des données du formulaire.
    if (filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL) && !empty($mdp_post)){
        //Requête SQL.
        $sql_connexion_prepare = "SELECT `id_participant`,COUNT(*) FROM `".PREFIXE."participants` WHERE `email_participant` = :email AND `motdepasse` = :mdp ;";
        $resultat_connexion = $dbh->prepare($sql_connexion_prepare);
        $resultat_connexion->execute(array(':email'=>$email_post, ':mdp' => $mdp_post));
        //On vérifie le nombre de résultat.
        $compte = count($resultat_connexion);

        //Action si le résultat est validé.
        if ($compte == 1){
            
            $donnees = $resultat_connexion->fetchAll();
            $_SESSION["compte"]["id_participant"] = $donnees['0']['id_participant'];
                        
            //Inclusion du fichier contenant la classe pour les cookies.
            require_once './modules/cookies/cookies.php';
            $cookies = new cookies();
            //Mise à jour du token pour le cookie.
            $cookie_update = $cookies->update_cookie($_SESSION["compte"]["id_participant"], $dbh);
            //On crée une cookie permettant de se connecter. Il est valable 30 jours.
            $cookie_create = $cookies->create_cookie($_SESSION["compte"]["id_participant"], $dbh);
            
            $login = $deconnexion;
            header($redirection);
            
        } else {
            $login = $form;
            $login .= $erreur_connexion;
        }
        
    } else {
        //Les données ne sont pas valides.
        $login = $form;
        $login .= $erreur_connexion;
    }

} elseif(isset($_SESSION["compte"]["id_participant"])) {
    $login = $deconnexion;
} else {
    $login = $form;
}

?>