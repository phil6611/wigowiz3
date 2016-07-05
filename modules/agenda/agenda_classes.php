<?php

/*
 * Ce fichier contient les différentes classes liées aux événements.
 */

/**
 * Description of agenda_classes
 *
 * @author Philippe Poisse
 */

class agenda_classes {
    /*
     * Cette classe contient les fonctions pour créer les agendas des utilisateurs.
     */
    
    public function a_venir($id, $dbh){
        //Cette fonction permet de créer l'agenda pour la page d'accueil des comptes utilisateurs.
        
        //Requête SQL
        $sql_agenda = "SELECT * FROM `".PREFIXE."relations` "
                . "JOIN `".PREFIXE."evenements` "
                . "ON `".PREFIXE."relations`.`id_evenement` = `".PREFIXE."evenements`.`id_evenement` "
                . "WHERE `".PREFIXE."relations`.`id_participant` LIKE :id "
                . "AND "
                . " `".PREFIXE."evenements`.`date_evenement` >= DATE(NOW())"
                . "ORDER BY `date_creation` DESC";
        //Tableau des variables pour les requêtes SQL.
        $array_variables_agenda = [
            ":id" => $id
        ];
        //Exécution de la requête.
        $resultat_agenda = $dbh->prepare($sql_agenda);
        $resultat_agenda -> execute($array_variables_agenda);
        //Création du tableau contenant les informations sur les événements.
        $donnees_agenda = $resultat_agenda->fetchAll();
        $compte_agenda = count($donnees_agenda);

        if ($compte_agenda == 0) {
            $resultat = 0;
            return $resultat;
        } else {
            return $donnees_agenda;
        }
    }

    public function agenda_participant ($id, $dbh){
        //Cette fonction sert à récupérer l'URL de l'agenda du participant.
        
        //Requête SQL.
        $sql_url_agenda = "SELECT * FROM `".PREFIXE."agenda` WHERE `participant_id` LIKE :id LIMIT 1";
        //Tableau des variables pour les requêtes SQL.
        $array_variables_url_agenda = [
            ":id" => $id
        ];
        //Exécution de la requête.
        $resultat_url_agenda = $dbh->prepare($sql_url_agenda);
        $resultat_url_agenda -> execute($array_variables_url_agenda);
        //Création du tableau contenant les informations sur les événements.
        $donnees_url_agenda = $resultat_url_agenda->fetchAll();
        //Code de l'agenda.
        $code = $donnees_url_agenda['0']['code_agenda'];
        //Renvoi du code.
        return $code;
    }
}
