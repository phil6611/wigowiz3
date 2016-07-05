<?php

/*
 * Ce fichier contient les classes nécessaires au fonctionnement de la messagerie.
 */

/**
 * Description of classes_message
 *
 * @author Philippe Poisse
 */
class classes_message {

    public function non_lu($id, $dbh) {
        //Cette fonction compte les messages non lus.
        //Un message est "non lu" si "etat_message" vaut "0".

        //Requête SQL.
        $sql_non_lu_prepare = "SELECT count(*) AS 'compte' FROM `".PREFIXE."messages` WHERE `etat_message` = 0 AND `id_destinataire` = :id";
        //Préparation de la requête.
        $resultat_non_lu = $dbh->prepare($sql_non_lu_prepare);
        //Exécution de la requête
        $resultat_non_lu -> execute(array(':id'=>$id));
        //On vérifie le nombre de résultat.
        $donnees_non_lu = $resultat_non_lu->fetchAll();
        $compte = $donnees_non_lu['0']['compte'];

        //Création du code html à afficher.
        if ($compte == 0){
            $html_message_non_lu = NULL;
        } else {
            $html_message_non_lu = $compte;
        }

        return $html_message_non_lu;

    }

    public function form_message($array, $dbh){
        //Cette fonction permet de remplir le code HTML du formulaire pour envoyer un message.
        
        //Requête SQL.
        $sql_form_prepare = "SELECT `titre`,CONCAT(`prenom_participant`, ' ', `nom_participant`) as `nom_destinataire` "
                . "FROM `".PREFIXE."evenements`, `".PREFIXE."participants` "
                . "WHERE `id_evenement` LIKE :id_evenement "
                . "AND `id_participant` LIKE :id_destinataire";
        //Préparation de le requête.
        $sql_prepare = $dbh->prepare($sql_form_prepare);
        //Exécution de la requête.
        try {
            $sql_prepare -> execute($array);
            //Création du tableau contenant les informations pour le formulaire.
            $tableau_form = $sql_prepare->fetchAll();
        } catch (Exception $ex) {
                $tableau_form = NULL;
                echo $ex;
        }
        
        return $tableau_form;
    }

    public function ecrire_message($array_message, $dbh){
        //Cette fonction sert à enregistrer un message dans la base de données.

        //Requête SQL.
        $sql_ecrire = "INSERT INTO `".PREFIXE."messages` "
                . "(`id_message`, `id_evenement`, `id_destinataire`, `id_expediteur`, `message_expediteur`, `date`, `etat_message`) "
                . "VALUES (:id_message, :id_evenement, :id_destinataire, :id_expediteur, :message_expediteur, NOW(), :etat_message)";
        //Préparation de le requête.
        $sql_prepare = $dbh->prepare($sql_ecrire);
        //Exécution de la requête.
        try {
            $sql_prepare -> execute($array_message);
            $resultat_enregistrement_message = TRUE;
        } catch (Exception $ex) {
            $resultat_enregistrement_message  = FALSE;
            echo $ex;
        }
        
        return $resultat_enregistrement_message;
    }
    
    public function liste_message($id, $dbh, $type_liste){
        //Cette fonction sert à récupérer la liste des messages d'un internaute.
        
        //Vérification du type de liste : 0 pour les messages reçus ; 1 pour les messages émis.
        if ($type_liste == 0){
            
            //Requête SQL.
            $sql_liste = "SELECT * FROM `".PREFIXE."messages` "
                    . "JOIN `".PREFIXE."participants` "
                    . "ON `".PREFIXE."messages`.`id_expediteur` = `".PREFIXE."participants`.`id_participant` "
                    . "JOIN `".PREFIXE."evenements` "
                    . "ON `".PREFIXE."messages`.`id_evenement` = `".PREFIXE."evenements`.`id_evenement` "
                    . "WHERE  `id_destinataire` LIKE :id";
            //Préparation de le requête.
            $sql_prepare = $dbh->prepare($sql_liste);
            $array_message = [
                ":id" => $id
            ];
            //Exécution de la requête.
            try {
                $sql_prepare -> execute($array_message);
                //Création du tableau contenant les informations sur les émessages reçus.
                $donnees_message_recu = $sql_prepare->fetchAll();
                $html_liste_message = self::html_liste_message($donnees_message_recu, 0);
            } catch (Exception $ex) {
                $html_liste_message = $ex;
            }
            
        } elseif ($type_liste == 1) {
            
            //Requête SQL.
            $sql_liste = "SELECT * FROM `".PREFIXE."messages` "
                    . "JOIN `".PREFIXE."participants` "
                    . "ON `".PREFIXE."messages`.`id_destinataire` = `".PREFIXE."participants`.`id_participant` "
                    . "JOIN `".PREFIXE."evenements` "
                    . "ON `".PREFIXE."messages`.`id_evenement` = `".PREFIXE."evenements`.`id_evenement` "
                    . "WHERE  `id_expediteur` LIKE :id";
            //Préparation de le requête.
            $sql_prepare = $dbh->prepare($sql_liste);
            $array_message = [
                ":id" => $id
            ];
            //Exécution de la requête.
            try {
                $sql_prepare -> execute($array_message);
                //Création du tableau contenant les informations sur les émessages reçus.
                $donnees_message_recu = $sql_prepare->fetchAll();
                $html_liste_message = self::html_liste_message($donnees_message_recu, 1);
            } catch (Exception $ex) {
                $html_liste_message = $ex;
            }
            
        } else {
            $html_liste_message = NULL;
        }
        
        
        return $html_liste_message;
        
    }
    
    static private function html_liste_message($array, $liste) {
        //Cette fonction crée les tableaux html pour les listes de messages.
        
        //Vérification du type de tableau : 0 pour les messages reçus ; 1 pour les messages émis. 
        $html = "\n";
        
        if ($liste == 0){
            //On boucle dans le tableau contenant les messages pour créer les lignes du tableau html.
            foreach ($array as $row){
                //Nom du destinataire
                $nom_expediteur = $row['prenom_participant']." ".$row['nom_participant'];
                //Texte pour l'état des messages : 0 pour "non lu" et 1 pour "lu".
                if ($row['etat_message'] == 0){
                    $etat = "non lu";
                } elseif ($row['etat_message'] == 1){
                    $etat = "lu";
                } else {
                    $etat = NULL;
                }
                
                $html .= "\t\t\t\t<tr>\n"
                        . "\t\t\t\t\t<td>".$row['date_message']."</td>\n"
                        . "\t\t\t\t\t<td><a href=\"./index.php?a=message&section=lire&id=".$row['id_message']."\">".$row['titre']."</a></td>\n"
                        . "\t\t\t\t\t<td>".$nom_expediteur."</td>\n"
                        . "\t\t\t\t\t<td>".$etat."</td>\n"
                        . "\t\t\t\t</tr>\n";
            }
        } elseif ($liste == 1){
            //On boucle dans le tableau contenant les messages pour créer les lignes du tableau html.
            foreach ($array as $row){
                //Nom du destinataire
                $nom_destinataire = $row['prenom_participant']." ".$row['nom_participant'];
                $html .= "\t\t\t\t<tr>\n"
                        . "\t\t\t\t\t<td>".$row['date_message']."</td>\n"
                        . "\t\t\t\t\t<td><a href=\"./index.php?a=message&section=lire&id=".$row['id_message']."\">".$row['titre']."</a></td>\n"
                        . "\t\t\t\t\t<td>".$nom_destinataire."</td>\n"
                        . "\t\t\t\t</tr>\n";
            }
        } else {
            $html .= NULL;
        }
        
        
        return $html;
    }

    
    public function lire_message($array, $dbh){
        //Cette fonction permet de lire un message.
        
        //Mise à jour de l'état du message.
        $sql_etat = "UPDATE `".PREFIXE."messages` SET `etat_message`= 1 WHERE `id_message` LIKE :id";
        //Préparation de la requête.
        $sql_etat_prepare = $dbh->prepare($sql_etat);
        //Exécution de la requête.
        try {
            $sql_etat_prepare -> execute($array);
        } catch (Exception $ex) {
                echo $ex;
        }
        
        //Requête SQL.
        $sql_form_prepare = "SELECT * FROM `".PREFIXE."messages` "
                . "JOIN `".PREFIXE."participants` "
                . "ON `".PREFIXE."messages`.`id_expediteur` = `".PREFIXE."participants`.`id_participant`"
                . "JOIN `".PREFIXE."evenements` "
                . "ON `".PREFIXE."messages`.`id_evenement` = `".PREFIXE."evenements`.`id_evenement`"
                . "WHERE `id_message` LIKE :id LIMIT 1";
        //Préparation de le requête.
        $sql_prepare = $dbh->prepare($sql_form_prepare);
        //Exécution de la requête.
        try {
            $sql_prepare -> execute($array);
            //Création du tableau contenant les informations pour le formulaire.
            $tableau_message = $sql_prepare->fetchAll();
        } catch (Exception $ex) {
                $tableau_message = NULL;
                echo $ex;
        }
        
        return $tableau_message;
    }
    
}
