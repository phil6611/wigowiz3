<?php

/*
 * Ce fichier sert pour événement un événement.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}

/*
 * Cette partie sert pour vérifier l'envoi ou non du formulaire. 
 */
//Récupération de la variable $_POST
$envoi = filter_input(INPUT_POST, "envoi", FILTER_SANITIZE_STRING);

if($envoi == 'TRUE'){

    //Validation des données envoyées depuis le formulaire.
    $titre_post = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
    $date_post = filter_input(INPUT_POST, "datepicker", FILTER_SANITIZE_STRING);
    $heure_post = filter_input(INPUT_POST, "timepicker", FILTER_SANITIZE_STRING);
    $date_fin_post = filter_input(INPUT_POST, "datepicker2", FILTER_SANITIZE_STRING);
    $heure_fin_post = filter_input(INPUT_POST, "timepicker2", FILTER_SANITIZE_STRING);
    $description_post = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
    $je_participe_post = filter_input(INPUT_POST, "je_participe", FILTER_SANITIZE_STRING);
    $envoi_alerte_post = filter_input(INPUT_POST, "envoi_alerte", FILTER_SANITIZE_STRING);
    $adresse_post = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_STRING);
    $cp_post = filter_input(INPUT_POST, "cp", FILTER_SANITIZE_STRING);
    $ville_post = filter_input(INPUT_POST, "ville", FILTER_SANITIZE_STRING);
    $pays_post = filter_input(INPUT_POST, "pays", FILTER_SANITIZE_STRING);
    $creation_modif = filter_input(INPUT_POST, "creation", FILTER_SANITIZE_STRING);
    $id_evenement_post = filter_input(INPUT_POST, "id_evenement", FILTER_SANITIZE_STRING);
    
    //Données pour réécrire dans le formulaire.
    $titre = $titre_post;
    $date_evenement = $date_post;
    $heure_evenement = $heure_post;
    $date_fin_evenement = $date_fin_post;
    $heure_fin_evenement = $heure_fin_post;
    $description = $description_post;
    $adresse = $adresse_post;
    $cp = $cp_post;
    $ville = $ville_post;
    $pays = $pays_post;
    $id_evenement = $id_evenement_post;
    
    
    if ($je_participe_post == 1){
        $je_participe_checked = "checked";
    } else {
        $je_participe_checked = NULL;
    }
    if ($envoi_alerte_post == 1){
        $envoi_alerte = "checked";
    } else {
        $envoi_alerte = NULL;
    }
    
    $titre_valid = $form_valid->empty_input($titre_post, $LANG_veuillez_saisir_ce_champ);
    $description_valid = $form_valid->empty_input($description_post, $LANG_veuillez_saisir_ce_champ);
    $adresse_valid = $form_valid->empty_input($adresse_post, $LANG_veuillez_saisir_ce_champ);
    $cp_valid = $form_valid->empty_input($cp_post, $LANG_veuillez_saisir_ce_champ);
    $ville_valid = $form_valid->empty_input($ville_post, $LANG_veuillez_saisir_ce_champ);
    
    //Contrôle des dates : la date de début doit être antérieure à la date de fin
    $date_debut = $date_post." ".$heure_evenement;
    $date_fin = $date_fin_evenement." ".$heure_fin_evenement;
    $d1 = new \DateTime($date_debut);
    $d2 = new \DateTime($date_fin);
    if (empty($date_fin_evenement)){
        $test_date = TRUE;
        $date_valid = NULL;
    } elseif ($d2 > $d1) {
        $test_date = TRUE;
        $date_valid = NULL;
    } elseif ($d1 > $d2) {
        $test_date = FALSE;
        $date_valid = "<script>alert(\"".$LANG_erreur_date."\");</script>";
    }
    
    //Données pour la requête sql.
    $id_evenement_sql = $id_evenement_post;
    $titre_sql = $titre_post;
    $date_sql = $date_post." ".$heure_evenement;
    $date_fin_sql = $date_fin_evenement." ".$heure_fin_evenement;
    $description_sql = $description_post;
    $adresse_sql = $adresse_post;
    $cp_sql = $cp_post;
    $ville_sql = $ville_post;
    $pays_sql = $pays_post;
    //IP de l'utilisateur.
    $ip_sql = $_SERVER["REMOTE_ADDR"];
    
    //Contrôle pour l'envoi d'alerte.
    if (empty($envoi_alerte_post)){
        $envoi_alerte_sql = 0;
    } else {
        $envoi_alerte_sql = $envoi_alerte_post;
    }
    //Contrôle pour la participant.
    if (empty($je_participe_post)){
        $je_participe_sql = 0;
    } else {
        $je_participe_sql = $je_participe_post;
    }

    /*
     * Cette partie concerne le traitement du formulaire.
     */
    if( !empty($titre_sql) && !empty($date_sql) && $test_date == TRUE){
        
        //Création de l'objet pour geocoder l'adresse
        $geocoder = new geocode();
        //On géocode l'adresse.
        $adresse_gps = $adresse_sql.",".$ville_sql.",".$pays_sql;
        /*
         $loc = geocode::getLocation($addresse_gps);
         
        $lat_sql = $loc["lat"];
        $lng_sql = $loc["lng"];
         * *
        */
        //Localisation GPS à l'aide de Nominatim
        $loc = $geocoder->geocode_nominatim($adresse_gps);
        if (empty($loc)){
            $lng_sql = 1;
            $lat_sql = 42;
        } else {
            $lng_sql = $loc[0]->{'lon'};
            $lat_sql = $loc[0]->{'lat'};
        }
        
        //Tableau des variables pour les requêtes SQL.
        $array_variables = [
            ":id_evenement" => $id_evenement_sql,
            ":titre" => $titre_sql,
            ":description" => $description_sql,
            ":adresse" => $adresse_sql,
            ":cp" => $cp_sql,
            ":ville" => $ville_sql,
            ":pays" => $pays_sql,
            ":date_evenement" => $date_sql,
            ":date_fin" => $date_fin_sql,
            ":alerte" => $envoi_alerte_sql,
            ":latitude" => $lat_sql,
            ":longitude" => $lng_sql
        ];
        
        //Création de la requête SQL.
        $sql_evenement_prepare = "UPDATE `".PREFIXE."evenements` "
                . "SET "
                . "`titre`= :titre, "
                . "`description`= :description, "
                . "`adresse`= :adresse, "
                . "`cp`= :cp, "
                . "`ville`= :ville, "
                . "`pays`= :pays, "
                . "`date_evenement`= :date_evenement, "
                . "`date_fin` = :date_fin, "
                . "`latitude`= :latitude, "
                . "`longitude`= :longitude, "
                . "`envoi_alerte`= :alerte "
                . "WHERE `id_evenement` LIKE :id_evenement";
        //Exécution de la requête.
        $resultat_evenement = $dbh->prepare($sql_evenement_prepare);

        try {
            $resultat_evenement -> execute($array_variables);
            
            //Tableau des variables pour le co-voiturage.
            $array_relation = [
                    ":id_evenement" => $id_evenement,
                    ":id_participant" => $_SESSION["compte"]["id_participant"]
            ];
            
            //Si le créateur de l'événement participe au covoiturage on crée une entrée dans la table "relations".
            if ($je_participe_sql == 1){
                //Calcul de la distance entre le domicile et l'événement.
                $distance = new distance();
                $distance_utilisateur = $distance->distance_lineaire($id_evenement, $_SESSION["compte"]["id_participant"], $dbh);
                //Rajout de la distance dans le tableau des variables pour la requête.
                $array_relation[":distance"] = $distance_utilisateur;
                //Requête pour la relation.
                $sql_relation = "REPLACE `".PREFIXE."relations`(`id_relation`, `id_evenement`, `id_participant`,`distance`, `commentaire`)"
                        . " VALUES (NULL,:id_evenement,:id_participant,:distance,' ')";
            } elseif ($je_participe_sql == 0){
                //Suppression d'un éventuel enregistrement pour le covoiturage.
                $sql_relation = "DELETE FROM `".PREFIXE."relations` WHERE `id_evenement` LIKE :id_evenement AND `id_participant` LIKE :id_participant ";
            }

            //Préparation de la requête SQL.
            $resultat_relation = $dbh -> prepare($sql_relation);
            try {
		$resultat_relation -> execute($array_relation);
            } catch (Exception $ex){
		echo $ex;
            }
            

            //Redirection vers la page permettant d'ajuster la géolocalisation de l'événement.
            header("location:./index.php?a=ajuster_evenement&id=".$id_evenement);

        } catch (Exception $ex) {
            echo "échec";
            echo $ex;
        }

        

    }
    
} else {
    /*
     * Si le formulaire n'est pas envoyé.
     */
    $titre = NULL;
    $description = NULL;
    $date_evenement = NULL;
    $heure_evenement = NULL;
    $date_fin_evenement = NULL;
    $heure_fin_evenement = NULL;
    $date_valid = NULL;
    $adresse = NULL;
    $cp = NULL;
    $ville = NULL;
    $je_participe_checked = NULL;
    $envoi_alerte = NULL;
    //variables pour la validation du formulaire.
    $titre_valid = NULL;
    $description_valid = NULL;
    $adresse_valid = NULL;
    $cp_valid = NULL;
    $ville_valid = NULL;
    //Variable pour le pays.
    $pays = "default";
    //Variable pour savoir s'il s'agit d'une création ou d'une modification.
    $type_enregistrement = "creation";

}

/*
 * Cette partie sert pour le tableau des pays
 */
include_once './modules/compte/pays.php';

/*
 * Cette partie concerne la création du code HTML.
 */
//Adresse du fichier HTML.
$code_base = "./modules/creer_evenement/html_creer_evenement.php";
$html_code = file_get_contents($code_base);
//Tableau des textes à parser.
$texte_tableau = [
    "{titre}" => $LANG_titre_etape,
    "{titre_evenement}" => $LANG_titre_evenement,
    "{titre_evenement_texte}" => $titre,
    "{titre_valid}" => $titre_valid,
    "{description}" => $LANG_description,
    "{description_texte}" => $description,
    "{description_valid}" => $description_valid,
    "{date}" => $LANG_date_evenement,
    "{date_evenement}" => $date_evenement,
    "{heure}" => $LANG_heure_evenement,
    "{time_evenement}" => $heure_evenement,
    "{date_fin}" => $LANG_date_fin,
    "{date_fin_evenement}" => $date_fin_evenement,
    "{heure_fin}" => $LANG_heure_fin,
    "{time_fin_evenement}" => $heure_fin_evenement,
    "{date_valid}" => $date_valid,
    "{je_participe}" => $LANG_je_participe,
    "{alerte_mail}" => $LANG_cocher_alerte_mail,
    "{etape_suivante}" => $LANG_bouton_etape_suivante,
    "{LANG_titre_etape2}" => $LANG_bouton_terminer,
    "{LANG_adresse_evenement}" => $LANG_adresse_evenement,
    "{adresse}" => $adresse,
    "{adresse_valid}" => $adresse_valid,
    "{LANG_cp_evenement}" => $LANG_cp_evenement,
    "{cp}" => $cp,
    "{cp_valid}" => $cp_valid,
    "{LANG_ville_evenement}" => $LANG_ville_evenement,
    "{ville}" => $ville,
    "{ville_valid}" => $ville_valid,
    "{LANG_votre_pays}" => $LANG_votre_pays,
    "{default}" => $default,
    "{canada}" => $canada,
    "{deutschland}" => $deutschland,
    "{england}" => $england,
    "{espana}" => $espana,
    "{france}" => $france,
    "{italia}" => $italia,
    "{suisse}" => $suisse,
    "{sverige}" => $sverige,
    "{usa}" => $usa,
    "{je_participe_checked}" => $je_participe_checked,
    "{envoi_alerte}" => $envoi_alerte,
    "{creation}" => "modification",
    "{action}" => "modification",
    "{id_evenement}" =>  "<input name=\"id_evenement\" type=\"hidden\" id=\"id_evenement\" value=\"".$id_evenement."\">",
    "{action}" => "evenement&section=modif_enregistrement"
];
//Renvoi du contenu HTML.
$html = $moteur->remplace($texte_tableau, $html_code);

?>