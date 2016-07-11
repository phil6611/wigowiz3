<?php

/*
 * Ce fichier contient les différents classes utilisées par Wigowiz.
 */

/*
 * Description of classes
 *
 * @author Philippe Poisse
 */


/*
 * Cette  classes sert pour la validation des formulaires.
 */
class formulaire {

    function empty_input ($input_data, $texte){
        //Cette fonction sert à afficher un message si un champ est vide.
        if(isset($input_data) && $input_data == ''){
            $erreur = "<span class=\"rouge\">".$texte."</span>";
        } else {
            $erreur = NULL;
        }
        
        return $erreur;
    }
    
    function valid_email ($input_data, $texte, $texte2){
        //Cette fonction sert à afficher un message si le champ email est vide ou si l'email est invalide.
        if(isset($input_data) && $input_data == ''){
            $erreur = "<span class=\"rouge\">".$texte."</span>";
        } elseif (!filter_var($input_data, FILTER_VALIDATE_EMAIL)){
            $erreur = "<span class=\"rouge\">".$texte2."</span>";
        } else {
            $erreur = NULL;
        }
        
        return $erreur;
    }
    
    function valid_password ($mdp1, $mdp2, $texte){
        //Cette fonction sert à valider le mot de passe lors de la création d'un nouveau compte.
        if ($mdp1 != $mdp2 && !empty($mdp1) ){
            $erreur = "<span class=\"rouge\">".$texte."</span>";
        } else {
            $erreur = NULL;
        }
        
        return $erreur;
    }
    
    
}


/*
 * Cette classe sert de moteur de templates
 */

class moteur_template {
    
    function remplace($texte_tableau, $html) {
        //Cette fonction sert pour remplacer les textes.
        foreach ($texte_tableau as $key => $value) {
            $html = str_replace($key, $value, $html);
        }
        return $html;
    }
    
    function menu_compte ($texte_tableau, $menu_html) {
        //Cette fonction sert pour le menu de la section "compte".
        $html = self::remplace($texte_tableau, $menu_html);
        return $html;
    }
    
}

/*
 * Cette classe sert pour geocoder les adresses.
 * Ça a été piqué à cette adresse : http://erlycoder.com/45/php-server-side-geocoding-with-google-maps-api-v3
 */

class geocode {
    
    
    /*
     * Cette section concerne Google Maps
     */
    /*
    static private $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=";
    
    static public function getLocation($address){
        $url = self::$url.urlencode($address);
       
        $resp_json = self::curl_file_get_contents($url);
        $resp = json_decode($resp_json, true);

        if($resp['status'] === 'OK'){
            return $resp['results'][0]['geometry']['location'];
        }else{
            return false;
        }
    }


    static private function curl_file_get_contents($URL){
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
    }
    */
    /*
     * Cette section concerne Nominatim
     */
    public function geocode_nominatim($adresse) {
        //Cette méthode permet d'obtenir les coordonnées GPS d'un lieu à partir de son adresse postale via Nominatim.
        //http://talks.php.net/show/osm-lonestar12/11
        
        //URL de Nominatim.
        $baseUrl = 'http://nominatim.openstreetmap.org/search?format=json&limit=1&q=';
        //Encodage de l'adresse pour la passer dans l'URL.
        $name_encode = urlencode( $adresse );
        //Correction d'un disfonctionnement avec les apostrophes.
        $name = str_replace("%26%2339%3B", "'", $name_encode);
        //Récupération de la requête au format json.
        $request = $baseUrl."".$name;
        //$data = file_get_contents( "{$baseUrl}&q={$name}" );
        $data = file_get_contents($request);
        //Décodage du tableau JSON
        $json = json_decode( $data );
        //Renvoi du tableau JSON
        return $json;

    }
}


/*
 * Cette classe sert pour l'inscription aux événements.
 */

class evenement {
    
    public function verif_inscription($participant, $evenement, $dbh){
        //cette fonction sert à vérifier si l'internaute est inscrit à l'événement.
        
        //Tableau des variables.
        $array_variables = [
            ":participant" => $participant,
            ":evenement" => $evenement
        ];
        //Requête SQL.
        $sql_verif_prepare = "SELECT count(*) AS 'compte' FROM `".PREFIXE."relations` WHERE `id_participant` LIKE :participant AND `id_evenement` LIKE :evenement";
        //préparation de la requête.
        $resultat_verif = $dbh->prepare($sql_verif_prepare);
        //Exécution de la requête et renvoi du résultat.
        try {
            $resultat_verif->execute($array_variables);
            $donnees = $resultat_verif-> fetchAll();
            $compte = $donnees[0]['compte'];
            
        } catch (Exception $ex) {
            //echo $ex;
            //En cas de problème on considère que l'internaute est déjà inscrit.
            $compte = 1;
        }
        
        //renvoie du résultat de la fonction.
        return $compte;
    }

}

/*
 * Cette classe sert pour les calculs de distance.
 */

class distance {
    
    public function distance_lineaire($id_evenement, $id_utilisateur, $dbh) {
        //cette fonction calcule la distance linéaire entre deux points à partir des coordonnées gps.
        
        //Coordonnées de l'événement.
        $coordonnees_evenement = self::coordonnees_evenement($id_evenement, $dbh);
        $lat_evenement = $coordonnees_evenement['0']['latitude'];
        $long_evenement = $coordonnees_evenement['0']['longitude'];
        
        //Coordonnées de l'utilisateur.
        $coordonnees_utilisateur = self::coordonnees_utilisateur($id_utilisateur, $dbh);
        $lat_utilisateur = $coordonnees_utilisateur['0']['latitude'];
        $long_utilisateur = $coordonnees_utilisateur['0']['longitude'];

        // Terre = sphère de 6378km de rayon
        $earth_radius = 6378137;
        //Conversions des coordonnées des degrés vers les radians.
        $rlo1 = deg2rad($long_evenement);
        $rla1 = deg2rad($lat_evenement);
        $rlo2 = deg2rad($long_utilisateur);
        $rla2 = deg2rad($lat_utilisateur);
        //calcul de la distance.
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        //Résultat en mètre.
        $distance_metre = ($earth_radius * $d);
        //Distance en kilomètre.
        $distance = $distance_metre / 1000;
        
        //renvoi du résultat.
        return $distance;

    }

    static private function coordonnees_evenement($id_evenement, $dbh){
        //Cette fonctionne retourne les coordonnées d'un événenement.
        
        //Tableau des variables.
        $array_variables = [
            ":id" => $id_evenement
        ];
        //Requête SQL.
        $sql_coordonnees_evenement_prepare = "SELECT `latitude`,`longitude` FROM `".PREFIXE."evenements` WHERE `id_evenement` LIKE :id";
        //préparation de la requête.
        $resultat_coordonnees_evenement = $dbh->prepare($sql_coordonnees_evenement_prepare);
        //Exécution de la requête et renvoi du résultat.
        try {
            $resultat_coordonnees_evenement->execute($array_variables);
            $coordonnees = $resultat_coordonnees_evenement-> fetchAll();
            
        } catch (Exception $ex) {
            //echo $ex;
            $coordonnees = [
                "latitude" => "0",
                "longitude" => "0"
            ];
        }
        
        //renvoie du résultat de la fonction.
        return $coordonnees;
    }
    
    static private function coordonnees_utilisateur($id_utilisateur, $dbh){
        //Cette fonction retourne les coordonnées d'un utilisateur.
        
        //Tableau des variables.
        $array_variables = [
            ":id" => $id_utilisateur
        ];
        //Requête SQL.
        $sql_coordonnees_utilisateur_prepare = "SELECT `latitude`,`longitude` FROM `".PREFIXE."participants` WHERE `id_participant` LIKE :id";
        //préparation de la requête.
        $resultat_coordonnees_utilisateur = $dbh->prepare($sql_coordonnees_utilisateur_prepare);
        //Exécution de la requête et renvoi du résultat.
        try {
            $resultat_coordonnees_utilisateur->execute($array_variables);
            $coordonnees = $resultat_coordonnees_utilisateur-> fetchAll();
            
        } catch (Exception $ex) {
            //echo $ex;
            //En cas de problème on considère que l'internaute est déjà inscrit.
            $coordonnees = [
                "latitude" => "0",
                "longitude" => "0"
            ];
        }
        
        //renvoie du résultat de la fonction.
        return $coordonnees;
    }
}

/*
 * Cette classe sert pour la gestion des emails
 */

class email {
    
    public function send_email($tableau_email) {
        //Cette méthode sert à envoyer un email.
        
        //Liste des variables pour envoyer l'email.
        $expediteur = $tableau_email['expediteur'];
        $destinataire = $tableau_email['destinataire'];
        $sujet = $tableau_email['sujet'];
        $message = $tableau_email['message'];
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
        
        // En-têtes additionnels
        $headers .= 'From: '.$expediteur . "\r\n";
        $headers .= "Reply-To: ".$expediteur."\r\n";


        //Envoie de l'email.
        mail($destinataire, $sujet, $message, $headers);
    }
    
}