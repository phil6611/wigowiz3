<?php

/**
 * Description of class_evenement
 *
 * @author Philippe Poisse
 * janvier 2015
 */
class class_evenement {
    
    function modif_evenement($code_evenement, $dbh) {
        //Cette fonction sert à récupérer les données d'un événement pour pouvoir le modifier.
        
        //requête sql.
        $sql_modif_prepare = "SELECT * FROM `".PREFIXE."evenements` WHERE `code_admin` LIKE :code";
        //Préparation de la requête.
        $resultat_modif = $dbh -> prepare($sql_modif_prepare);

        try {
            //Exécution de la requête
            $resultat_modif -> execute(array(':code'=>$code_evenement));
            //Tableau des données.
            $tableau_donnees_evenement = $resultat_modif->fetchall();
        } catch (Exception $ex) {
            return $ex;
        }
        return $tableau_donnees_evenement;
    }
    
    function participation_modif ($id_evenement,$id_participant, $dbh){
        //Cette fonction sert à vérifier si l'administration d'un évenement participe au covoiturage.
        
        //Requête SQL.
        $sql_participation_modif = "SELECT COUNT(*) AS `compte` FROM `".PREFIXE."relations` "
                . "WHERE `id_evenement` LIKE :id_evenement AND `id_participant` LIKE :id_participant";
        //Préparation de la requête.
        $resultat_participation_modif = $dbh -> prepare($sql_participation_modif);
        //Tableau des variables pour la requête.
        $array = [
            ":id_evenement" => $id_evenement,
            ":id_participant" => $id_participant
        ];
        
        try {
            //Exécution de la requête
            $resultat_participation_modif -> execute($array);
            //Tableau des données.
            $tableau_donnees_participation = $resultat_participation_modif->fetchall();
            //Variable à retourner.
            $participation = $tableau_donnees_participation['0']['compte'];
        } catch (Exception $ex) {
            return $ex;
        }
        
        return $participation;
    }
    
    function nombre_participants ($id_evenement, $dbh){
        //Cette fonction sert à comptabiliser le nombre de participants à un événement.
        
        //Requête SQL.
        $sql_participation = "SELECT COUNT(*) AS `nombre` FROM `".PREFIXE."relations` "
                . "WHERE `id_evenement` LIKE :id_evenement;";
        //Préparation de la requête.
        $resultat_participation = $dbh -> prepare($sql_participation);
        //Tableau des variables pour la requête.
        $array = [
            ":id_evenement" => $id_evenement
        ];
        
        try {
            //Exécution de la requête
            $resultat_participation -> execute($array);
            //Tableau des données.
            $tableau_donnees_participation = $resultat_participation->fetchall();
            //Variable à retourner.
            $participation = $tableau_donnees_participation['0']['nombre'];
        } catch (Exception $ex) {
            return $ex;
        }
        
        return $participation;
        
    }

}
