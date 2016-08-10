<?php

/*
 * Ce fichier est utilisé pour la création d'un nouveau compte.
 */


/*
 * Cette partie sert pour vérifier l'envoi ou non du formulaire. 
 */

//Récupération de la variable $_POST
$envoi = filter_input(INPUT_POST, "envoi", FILTER_SANITIZE_STRING);
//récuparation de l'information sur le type d'action, il s'agit soit d'une création d'un compte soit d'une modification.
$modification = filter_input(INPUT_POST, "modification", FILTER_SANITIZE_STRING);

/*
 * Cette partie concerne la création d'un nouveau compte dans la base de données.
 */

if($envoi == "TRUE"){
    
    //Validation des données envoyées depuis le formulaire.
    $prenom_post = filter_input(INPUT_POST, "prenom_participant", FILTER_SANITIZE_STRING);
    $nom_post = filter_input(INPUT_POST, "nom_participant", FILTER_SANITIZE_STRING);
    $adresse_post = filter_input(INPUT_POST, "adresse_participant", FILTER_SANITIZE_STRING);
    $cp_post = filter_input(INPUT_POST, "cp_participant", FILTER_SANITIZE_STRING);
    $ville_post = filter_input(INPUT_POST, "ville_participant", FILTER_SANITIZE_STRING);
    $pays_post = filter_input(INPUT_POST, "pays_participant", FILTER_SANITIZE_STRING);
    $tel_post = filter_input(INPUT_POST, "tel_participant", FILTER_SANITIZE_STRING);
    $email_post = filter_input(INPUT_POST, "email_participant", FILTER_SANITIZE_EMAIL);
    $cacher_email_post = filter_input(INPUT_POST, "cacher_email", FILTER_SANITIZE_NUMBER_INT);
    $cacher_adresse_post = filter_input(INPUT_POST, "cacher_adresse", FILTER_SANITIZE_NUMBER_INT);
    $vehicule_post = filter_input(INPUT_POST, "vehicule", FILTER_SANITIZE_NUMBER_INT);
    $commentaire_post = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
    $mdp1_post = filter_input(INPUT_POST, "motdepasse1_participant", FILTER_SANITIZE_STRING);
    $mdp2_post = filter_input(INPUT_POST, "motdepasse2_participant", FILTER_SANITIZE_STRING);

    //Données pour réécrire dans le formulaire.
    $prenom = $prenom_post;
    $nom = $nom_post;
    $tel = $tel_post;
    $email = $email_post;
    $adresse = $adresse_post;
    $cp = $cp_post;
    $ville = $ville_post;
    $pays = $pays_post;
    $cacher_email = $cacher_email_post;
    $cacher_adresse = $cacher_adresse_post;
    $vehicule = $vehicule_post;
    $commentaire = $commentaire_post;

    //Données pour la requête sql.
    $prenom_sql = $prenom_post;
    $nom_sql = $nom_post;
    $tel_sql = $tel_post;
    $email_sql = $email_post;
    $adresse_sql = $adresse_post;
    $cp_sql = $cp_post;
    $ville_sql = $ville_post;
    $pays_sql = $pays_post;
    $vehicule_sql = $vehicule_post;
    $commentaire_sql = $commentaire_post;
    $mdp_sql = $mdp1_post;
    
    //Variables pour les boutons "cacher email" et "cacher adresse".
    if (empty($cacher_email_post)){
        $cacher_email_sql = 0;
    } else {
        $cacher_email_sql = $cacher_email_post;
    }
    if (empty($cacher_adresse_post)){
        $cacher_adresse_sql = 0;
    } else {
        $cacher_adresse_sql = $cacher_adresse_post;
    }
    
    
    //Vérification du mot de passe.
    if ($mdp1_post === $mdp2_post && !empty($mdp1_post) && !empty($mdp2_post) ){
        $valid_mdp = TRUE;
    } else {
        $valid_mdp = FALSE;
    }

    //Gestion des données du formulaire.
    if(filter_input(INPUT_POST,'email_participant', FILTER_VALIDATE_EMAIL) && $valid_mdp == TRUE && !empty($nom_post) && !empty($prenom_post) && !empty($adresse_post) && !empty($cp_post) && !empty($ville_post) && !empty($email_post) && !empty($tel_post)){
        
        //Création de l'objet pour geocoder l'adresse
        $geocoder = new geocode();
        //On géocode l'adresse.
        $adresse_gps = $adresse_sql.",".$cp_sql.",".$ville_sql.",".$pays_sql;

        //Localisation GPS à l'aide de Nominatim
        $loc = $geocoder -> geocode_nominatim($adresse_gps);
        if (empty($loc) ){
            $longitude = 1;
            $latitude = 42;
        } else {
            $longitude = $loc[0]->{'lon'};
            $latitude = $loc[0]->{'lat'};
        }
        
        //requête sql et écriture dans la base de données.
        $_SESSION['compte']['latitude'] = $latitude;
        $_SESSION['compte']['longitude'] = $longitude;
        $latitude_sql = $latitude;
        $longitude_sql = $longitude;
        $ip_sql = $_SERVER["REMOTE_ADDR"];

        //Tableau des variables pour les requêtes SQL.
        $array_variables = [
            ":id" => NULL,
            ":prenom" => $prenom_sql,
            ":nom" => $nom_sql,
            ":adresse" => $adresse_sql,
            ":cp" => $cp_sql,
            ":ville" => $ville_sql,
            ":pays" => $pays_sql,
            ":email" => $email_sql,
            ":token" => "UUID()",
            ":tel" => $tel_sql,
            ":vehicule" => $vehicule_sql,
            ":commentaire" => $commentaire_sql,
            ":cacher_email" => $cacher_email_sql,
            ":cacher_adresse" => $cacher_adresse_sql,
            ":mdp" => $mdp_sql,
            ":latitude" => $latitude_sql,
            ":longitude" => $longitude_sql,
            ":ip" => $ip_sql
        ];

	//Création de la requête SQL.
        if ($modification == "creation"){
            
            $sql_creer_prepare = "INSERT INTO `".PREFIXE."participants` "
                . "(id_participant, prenom_participant, nom_participant, adresse_participant, cp_participant, ville_participant, pays_participant, email_participant, token_participant, tel_participant, vehicule,commentaire, cacher_email, cacher_adresse, motdepasse, date, latitude, longitude, ip) "
                . "VALUES (:id, :prenom, :nom,:adresse, :cp, :ville, :pays, :email, :token, :tel, :vehicule, :commentaire, :cacher_email, :cacher_adresse, :mdp, "
                . "NOW(), :latitude, :longitude, :ip); "
                . "INSERT INTO `".PREFIXE."agenda`(`id_agenda`, `participant_id`, `code_agenda`) "
                . "VALUES (NULL,LAST_INSERT_ID(),UUID());";

            //Exécution de la requête.
            $resultat_compte = $dbh->prepare($sql_creer_prepare);
            
        } elseif ($modification == "update"){
            
            $sql_modification_prepare = "UPDATE `".PREFIXE."participants` SET"
                    . " `id_participant`= :id,`nom_participant`= :nom,`prenom_participant`= :prenom,`adresse_participant`= :adresse,`cp_participant`= :cp,"
                    . "`ville_participant`= :ville,`pays_participant`= :pays,`email_participant`= :email,`cacher_email`= :cacher_email,"
                    . "`cacher_adresse`= :cacher_adresse,`tel_participant`= :tel,`vehicule`= :vehicule,"
                    . "`commentaire`= :commentaire,`motdepasse`= :mdp,`ip`= :ip "
                    . "WHERE `id_participant` LIKE :id LIMIT 1";
            //Rajout de l'identifiant dans le tableau.
            $array_variables[":id"] = $_SESSION["compte"]["id_participant"];
            //Suppression des coordonnées GPS.
            unset($array_variables[':latitude']);
            unset($array_variables[':longitude']);
            $resultat_compte = $dbh->prepare($sql_modification_prepare);
        }
        
        //Exécution de la requête.
        try {
            $resultat_compte -> execute($array_variables);
            //Récupération de l'identifiant de l'utilisateur.
            if ($modification == "creation"){
                $id_utilisateur =  $dbh->lastInsertId() ;
            } else {
                $id_utilisateur = $_SESSION["compte"]["id_participant"];
            }
            
            
            //Création du tableau pour les informations utilisateurs une fois connecté.
            $_SESSION["compte"] = [
                "id_participant" => $id_utilisateur,
                "prenom_participant" => $prenom,
                "nom_participant" => $nom,
                "tel_participant" => $tel,
                "email_participant" => $email,
                "adresse_participant" => $adresse,
                "cp_participant" => $cp,
                "ville_participant" => $ville,
                "cacher_email" => $cacher_email,
                "cacher_adresse" => $cacher_adresse,
                "vehicule" => $vehicule,
                "commentaire" => $commentaire
            ];

            //Envoi d'un email pour informer de l'inscription sur wigowiz.
            $tableau_email = [
                "expediteur" => "Wigowiz - AddicTerra <wigowiz@addicterra.fr>\n\r Bcc: contact@addicterra.fr",
                "destinataire" => $email,
                "sujet" => $LANG_mail_inscription_sujet,
                "message" => $LANG_mail_inscription_message
            ];
            if ($modification == "creation") {
                $email = new email();
                $email -> send_email($tableau_email);
            }
            
            //Redirection une fois le compte crée ou mis à jour.
            header("location:./index.php?a=compte&section=ajuster");
            
        } catch (Exception $ex) {
            echo $ex;
        }



    } else {
        /*
         * Cette partie est utilisée si le formulaire n'est pas validé.
         */
        
        //variables pour la validation du formulaire.
        $prenom_valid = $form_valid->empty_input($prenom_post, $LANG_veuillez_saisir_ce_champ);
        $nom_valid = $form_valid->empty_input($nom_post, $LANG_veuillez_saisir_ce_champ);
        $email_valid = $form_valid->valid_email($email_post, $LANG_veuillez_saisir_ce_champ, $LANG_verifier_email);
        $adresse_valid = $form_valid->empty_input($adresse_post, $LANG_veuillez_saisir_ce_champ);
        $cp_valid = $form_valid->empty_input($nom_post, $LANG_veuillez_saisir_ce_champ);
        $ville_valid = $form_valid->empty_input($ville_post, $LANG_veuillez_saisir_ce_champ);
        $tel_valid = $form_valid->empty_input($tel_post, $LANG_veuillez_saisir_ce_champ);
        $mdp1_valid = $form_valid->empty_input($mdp1_post, $LANG_veuillez_saisir_ce_champ);
        $mdp_test = $form_valid->valid_password($mdp1_post, $mdp2_post, $LANG_motsdepasse_diffrents);
        
        //Variables pour le pays d'origine.
        if (isset($pays_post)) {
            $pays = $pays_post;
        } else {
            $pays = NULL;
        }

        //Variable pour contrôler les boutons du formulaire.
        if ($cacher_email == 1){
            $bouton_cacher_email = "checked";
        } else {
            $bouton_cacher_email = NULL;
        }

        if ($cacher_adresse == 1){
            $bouton_cacher_adresse = "checked";
        } else {
            $bouton_cacher_adresse = NULL;
        }

        if ($vehicule == 1) {
            $avoir_vehicule = "checked";
            $pas_vehicule = NULL;
        } elseif ($vehicule == 0) {
            $avoir_vehicule = NULL;
            $pas_vehicule = "checked";
        } else {
            $avoir_vehicule = NULL;
            $pas_vehicule = NULL;
        }
        
    }


} else {
    /*
     * Cette partie est utilisée si le formulaire n'est pas envoyé.
     */
    
    //Données pour réécrire dans le formulaire.
    $prenom = NULL;
    $nom = NULL;
    $tel = NULL;
    $email = NULL;
    $adresse = NULL;
    $cp = NULL;
    $ville = NULL;
    $pays = NULL;
    $cacher_email = NULL;
    $cacher_adresse = NULL;
    $vehicule = NULL;
    $commentaire = NULL;
    
    //variables pour la validation du formulaire.
    $prenom_valid = NULL;
    $nom_valid = NULL;
    $email_valid = NULL;
    $adresse_valid = NULL;
    $cp_valid = NULL;
    $ville_valid = NULL;
    $tel_valid = NULL;
    $mdp1_valid = NULL;
    $mdp_test = NULL;

    //Variable pour le pays.
    $pays = "default";
    //Variables pour compléter le formulaire.
    $bouton_cacher_email = NULL;
    $bouton_cacher_adresse = NULL;
    $pas_vehicule = NULL;
    $avoir_vehicule = NULL;

}

/*
 * Cette partie sert pour le tableau des pays
 */
include_once './modules/pays/pays.php';

/*
 * Cette partie concerne la création du code HTML.
 */
//Adresse du fichier HTML.
$code_base = "./modules/compte/html_form_creer.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{titre}" => $LANG_creer_un_compte,
    "{texte}" => $LANG_un_compte_permet_de,
    "{LANG_compte_creer_civilite}" => $LANG_compte_creer_civilite,
    "{LANG_compte_creer_coordonnees}" => $LANG_compte_creer_coordonnees,
    "{LANG_compte_creer_securite}" => $LANG_compte_creer_securite,
    "{LANG_compte_creer_infos_utiles}" => $LANG_compte_creer_infos_utiles,
    "{LANG_votre_prenom}" => $LANG_votre_prenom,
    "{LANG_votre_nom}" => $LANG_votre_nom,
    "{LANG_numero_tel}" => $LANG_numero_tel,
    "{LANG_adresse_email}" => $LANG_adresse_email,
    "{bouton_cacher_email}" => $bouton_cacher_email,
    "{LANG_cacher_mon_email}" => $LANG_cacher_mon_email,
    "{LANG_cacher_mon_email_suite}" => $LANG_cacher_mon_email_suite,
    "{LANG_choisissez_motdepasse}" => $LANG_choisissez_motdepasse,
    "{LANG_confirmer}" => $LANG_confirmer,
    "{LANG_votre_adresse}" => $LANG_votre_adresse,
    "{LANG_votre_cp}" => $LANG_votre_cp,
    "{LANG_votre_ville}" => $LANG_votre_ville,
    "{LANG_votre_pays}" => $LANG_votre_pays,
    "{bouton_cacher_adresse}" => $bouton_cacher_adresse ,
    "{LANG_cacher_mon_adresse}" => $LANG_cacher_mon_adresse,
    "{LANG_vous_avez_un_vehicule}" => $LANG_vous_avez_un_vehicule,
    "{LANG_pas_de_vehicule}" => $LANG_pas_de_vehicule,
    "{LANG_commentaire_participant}" => $LANG_commentaire_participant,
    "{LANG_bouton_terminer}" => $LANG_bouton_terminer,
    "{LANG_bouton_annuler}" => $LANG_bouton_annuler,
    "{prenom}" => $prenom,
    "{prenom_valid}" => $prenom_valid,
    "{nom}" => $nom ,
    "{nom_valid}" => $nom_valid,
    "{tel}" => $tel,
    "{tel_valid}" => $tel_valid,
    "{email}" => $email,
    "{email_valid}" => $email_valid,
    "{mdp1_valid}" => $mdp1_valid,
    "{mdp_test}" => $mdp_test,
    "{adresse}" => $adresse,
    "{adresse_valid}" => $adresse_valid,
    "{cp}" => $cp,
    "{cp_valid}" => $cp_valid,
    "{ville}" => $ville,
    "{ville_valid}" => $ville_valid,
    "{avoir_vehicule}" => $avoir_vehicule,
    "{pas_vehicule}" => $pas_vehicule,
    "{commentaire}" => $commentaire,
    "{LANG_compte_creer_pays_defaut}" => $LANG_compte_creer_pays_defaut,
    "{pays_liste}" => $pays_liste,
    "{modification}" => "creation",
    "{{LANG_latitude}}" => $LANG_latitude,
    "{{LANG_longitude}}" => $LANG_longitude
];

//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>