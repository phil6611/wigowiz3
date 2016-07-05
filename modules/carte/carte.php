<?php

/*
 * Ce fichier sert pour la gestion des cartes
 */


//Récupération du code de l'événement.
$code = filter_input(INPUT_GET, "m", FILTER_SANITIZE_STRING);
//Récupération de la micro-application.
$action = filter_input(INPUT_GET, "include", FILTER_SANITIZE_STRING);

if (!empty($code)){
    
    //On détruit toutes les variables liées à un événement pour éviter une collision entre deux événements.
    unset($_SESSION['evenement']);
    //Le code de l'événement est passé en tant que variable de session.
    $_SESSION['evenement']['code'] = $code;
    
    
    /*
     * Cette partie concerne les informations sur l'événement.
     */
    //Requête SQL.
    $sql_evenement_prepare = "SELECT * FROM `".PREFIXE."evenements`, `".PREFIXE."participants` "
            . "WHERE `code` = :code "
            . "AND `".PREFIXE."evenements`.`id_createur` = `".PREFIXE."participants`.`id_participant`;";
    $resultat_evenement = $dbh->prepare($sql_evenement_prepare);
    $resultat_evenement -> execute(array(':code' => $code));
    //On récupére l'identifiant de l'événement.
    $donnees = $resultat_evenement->fetchAll();

    //Action si le résultat est validé.
    if (!empty($donnees)){
        $id_evenement = $donnees[0]['id_evenement'];
        $createur = NULL;
        $_SESSION['evenement']['id_evenement'] = $donnees[0]['id_evenement'];
        $_SESSION['evenement']['titre'] = $donnees[0]['titre'];
        $_SESSION['evenement']['date'] = $donnees[0]['date_evenement'];
        $_SESSION['evenement']['date_fin'] = $donnees[0]['date_fin'];
        $_SESSION['evenement']['createur'] = $donnees[0]['prenom_participant']." ".$donnees[0]['nom_participant'];
        $_SESSION['evenement']['description'] = $donnees[0]['description'];
        $_SESSION['evenement']['envoi_alerte'] = $donnees[0]['envoi_alerte'];
        $_SESSION['evenement']['email'] = $donnees[0]['email_participant'];
        //echo "un événement cool!";
        
        
        /*
         * Cette sectino concerne la gestion de la date de l'événement.
         */
        
        
        /* gestion des locales */
        setlocale(LC_TIME, $locale);
        //$evenement_passe =  strftime("%A %d %B");
        $date_base = date_create($donnees[0]['date_evenement']);
        $jour_formate = strftime("%A %d %B %Y",strtotime($donnees[0]['date_evenement']));
        $heure_formate = date_format($date_base, 'H:i');
        $date_formate = $jour_formate." ".$heure_formate;
        
        //Date de fin
        $date_fin_base = date_create($donnees[0]['date_fin']);
        $jour_fin_formate = strftime("%A %d %B %Y",strtotime($donnees[0]['date_fin']));
        $heure_fin_formate = date_format($date_fin_base, 'H:i');
        $date_fin_formate = $jour_fin_formate." ".$heure_fin_formate;
    
        //Date mise en forme pour afficher dans la page.
        if (is_null($date_fin_base)) {
            $date_complete = $date_formate;
        } else {
            $array_texte = ["%debut", "%fin"];
            $array_variables = [$date_formate, $date_fin_formate];
            $date_complete = str_replace($array_texte, $array_variables, $LANG_date_debut);
        }
        
        //Vérification de la date de l'événement pour savoir s'il est passé ou non.
        $date_jour = date("Y-m-d");
        $evenement_passe = strtotime($donnees[0]['date_evenement']) - strtotime($date_jour);

        if ($evenement_passe == 0){
            $alerte = $LANG_carte_alerte_aujourdhui;
        } elseif ($evenement_passe < 0){
            //$alerte = "\n\r<h2>L'événement a déjà eu lieu, les inscriptions sont closes.</h2>";
            $action = "date_passee";
        } else {
            $alerte = NULL;
        }
        
    } else {
        //echo "pas d'évenement";
    }
    
    //Tableau des microapplications.
    $tableau_microapplication = [
        //"complete" => "complete",
        "complete" => "consulter_carte",
        "default" => "consulter_carte",
        "date_passee" => "date_passee"
    ];
    //On vérifie quelle microapplication doit être insérée.
    if (!empty($action)){
        $action_include = $action;
        $code_base = "./modules/carte/html_".$tableau_microapplication[$action].".php";
    } else {
        $action_include = "default";
    }
    //Inclusion de la microapplication
    $inclusion = "./modules/carte/".$tableau_microapplication[$action].'.php';
    include_once $inclusion;
    
} else {
    //Si le code de l'événement n'est pas passé dans l'URL on redirige vers la page d'accueil.
    header("location:./index.php");
}

/*
 * Cette partie concerne la création du code HTML.
 */
$html_code = file_get_contents($code_base);
//Le tableau avec les textes à parser est créé par chaque microapplication.
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>