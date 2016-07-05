<?php

/*
 * Ce fichier sert pour créer les agendas au format ics.
*/
header('Content-Type: text/calendar; charset=utf-8');
//Ne pas effacer la ligne suivante, elle sert pour le débuggage.
//header('Content-Type: text/plain; charset=utf-8');

//Récupération de l'identifiant de l'agenda.
$agenda = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRING);

/*
 * Cette partie concerne la requête SQL.
 */

//Inclusion du fichier pour la connexion à la base de données.
require_once '../bdd/connect.php';

$sql = "SELECT * FROM `".PREFIXE."agenda` "
        . "JOIN `".PREFIXE."relations` "
        . "ON `".PREFIXE."agenda`.`participant_id` = `".PREFIXE."relations`.`id_participant` "
        . "JOIN `".PREFIXE."evenements` "
        . "ON `".PREFIXE."evenements`.`id_evenement` = `".PREFIXE."relations`.`id_evenement` "
        . "JOIN `".PREFIXE."participants`"
        . "ON `".PREFIXE."evenements`.`id_createur` = `".PREFIXE."participants`.`id_participant` "
        . "WHERE `code_agenda` LIKE '".$agenda."' ";

try {
    $resultat = $dbh -> query($sql);
    $resultat_tableau = $resultat -> fetchall(PDO::FETCH_ASSOC);
    
    $texte = NULL;

    foreach ($resultat_tableau as $row) {

        //Gestion du format de la date.
        $array_date = [
            "-" => "",
            ":" => "",
            " " => "T"
            ];
        $date = strtr($row['date_evenement'], $array_date);
        $date_fin = strtr($row['date_fin'], $array_date);

        //Remplacement des entités HTML.
        $description_entite = htmlspecialchars_decode($row['description'], ENT_QUOTES);
        $titre = htmlspecialchars_decode($row['titre'], ENT_QUOTES);
        $lieu = htmlspecialchars_decode($row['adresse'], ENT_QUOTES);
        
        //Gestion de la description.
        $description = preg_replace("/(\r\n|\n|\r)/", "\\n", $description_entite);
        
        //Textes pour chaque événement.
        $texte .= "\nBEGIN:VEVENT"
                . "\nUID:".$row['code'].""
                . "\nDTSTAMP;TZID=Europe/Paris:".$date
                . "\nORGANIZER;CN=".$row['prenom_participant']." ".$row['nom_participant'].":MAILTO:".$row['email_participant']
                . "\nDTSTART;TZID=Europe/Paris:".$date
                . "\nDTEND;TZID=Europe/Paris:".$date_fin
                . "\nLOCATION:".$lieu.", ".$row['cp']." ".$row["ville"]
                . "\nSUMMARY:".$titre
                . "\nDESCRIPTION:".$description
                . " \\nLiens : <a href=\"../index.php?a=carte&include=default&m=".$row['code']."\">".$row['titre']."</a>"
                . "\nEND:VEVENT"
                . "\n";

    }
    
} catch (Exception $ex) {
    echo "\n erreur = ".$ex;
}



/*
 * Cette partie concerne la création du contenu de l'agenda.
 */



?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//wigowiz//NONSGML v1.0//EN

<?php
echo $texte;
?>
    
END:VCALENDAR
