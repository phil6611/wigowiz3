<?php

/**
 * Description of cookies
 *
 * @author Philippe Poisse
 * Version 1 juillet 2015
 */

class cookies {
    
    public function test_cookie ($cookie, $dbh) {
        //Cette méthode sert à tester la validité d'un cookie.
        
        //Requête SQL
        $sql = "SELECT `id_participant`,COUNT(*) AS `compte` "
                . "FROM `".PREFIXE."participants` "
                . "WHERE `token_participant` = :token ";
        
        //Préparation de la requête.
        $sql_prepare = $dbh->prepare($sql);
        
        //Tableau pour la requête.
        $array = [
            ":token" => $cookie
        ];
        
        //Exécution de la requête.
        try {
            $sql_prepare -> execute($array); 
            //Tableau associatif pour les données.
            $tableau_donnees = $sql_prepare -> fetchAll();
            
            //Tableau pour la sortie.
            $compte = $tableau_donnees['0']['compte'];
            if ($compte == 1){
                $id = $tableau_donnees['0']['id_participant'];
                
                $output = [
                    "id" => $id,
                    "valid" => "1"
                ];
            } else {
                //Tableau retourné en cas d'erreur.
                $output = [
                    "valid" => "0"
                ];
            }
            
        } catch (Exception $ex) {
            //Tableau retourné en cas d'erreur.
            $output = [
                "exception" => $ex,
                "valid" => "0"
            ];
            
        }

        return $output;
 
    }
    
    public function create_cookie($id, $dbh) {
        //Cette méthode sert à créer un cookie.
        
        //Requête SQL.
        $sql = "SELECT `token_participant`, COUNT(*) AS `compte` "
                . "FROM `".PREFIXE."participants` WHERE `id_participant` = :id";
        
        //Préparation de la requête.
        $sql_prepare = $dbh->prepare($sql);
        
        //Tableau pour la requête.
        $array = [
            ":id" => $id
        ];
        
        //Exécution de la requête.
        try {
            $sql_prepare -> execute($array); 
            //Tableau associatif pour les données.
            $tableau_donnees = $sql_prepare -> fetchAll();
            
            //Tableau pour la sortie.
            $compte = $tableau_donnees['0']['compte'];
            if ($compte == 1){
                //récupération du token.
                $token = $tableau_donnees['0']['token_participant'];
                //Création du cookie. Il est valable trente jours.
                setcookie('token', $token, time() + 30*24*3600, null, null, false, true);
                
                $output = [
                    "valid" => "1"
                ];
            }
            
        } catch (Exception $ex) {
            //Tableau retourné en cas d'erreur.
            $output = [
                "exception" => $ex,
                "valid" => "0"
            ];
            
        }

        return $output;
    }
    
    public function update_cookie($id, $dbh) {
        //Cette méthode sert à mettre à jour un cookie.
        
        //Requête SQL.
        $sql = "UPDATE `".PREFIXE."participants` "
                . "SET "
                . "`token_participant`= UUID() "
                . "WHERE `id_participant` = :id LIMIT 1";
        
        //Préparation de la requête.
        $sql_prepare = $dbh->prepare($sql);
        
        //Tableau pour la requête.
        $array = [
            ":id" => $id
        ];
        
        //Exécution de la requête.
        try {
            $sql_prepare -> execute($array); 
            //Tableau pour la sortie.
            $output = [
                "valid" => "1"
            ];
            
        } catch (Exception $ex) {
            //Tableau retourné en cas d'erreur.
            $output = [
                "exception" => $ex,
                "valid" => "0"
            ];
            
        }
        
        return $output;
    }
    
    public function destroy_cookie() {
        //Cette méthode sert à détruire un cookie.
        
        //Création d'un nouveau token. Avec ce token le cookie ne peut pas ressuir le test pour la connexion.
        $token = "666";
        //Création d'un cookie dont la date de validité est dans le passé. Il devrait être effacé par le navigateur.
        setcookie('token', $token, time() - 30*24*3600, null, null, false, true);
    }

    
}
