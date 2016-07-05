<?php

/**
 * Description of password_class
 * Version 1 : 6 avril 2015
 * @author Philippe Poisse
 */

class password_class {
    /*
     * Cette classe sert pour la récupération des mots de passe utilisateurs
     */
    
    public function crea_token() {
        //Cette fonction sert à créer le token pour sécuriser la connexion.
        
        //Création du token.
        $token = uniqid();
        
        //Renvoi du token.
        return $token;
    }
    
    public function email ($token) {
        
    }
    
}
