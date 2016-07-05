<?php

/*
 * Ce fichier sert pour la suppression d'un ou plusieurs événements.
 */

//Vérification de l'ouverture de la session.
if(!isset($_SESSION["compte"]["id_participant"])){
    header("location:./index.php");
}


//Suppression des événements.
try {
    $html = "<div id=\"reussite\"><p><strong>Suppression réussie.</strong></p></div>\n\r";
    
	foreach ($_POST as $id_evenement => $valeur) {
            if ($id_evenement != "action" && $id_evenement != "prenom_participant" && $id_evenement != "nom_participant") {
		$sql = "DELETE FROM `".PREFIXE."evenements` WHERE `id_evenement` = $valeur LIMIT 1;";
		$dbh -> exec($sql);
                $html .= "<p>Événement ".$valeur." supprimé</p>\n\r";
            }
	}
	

} catch(PDOException $e) {
	print "<p>Erreur ! :".$e->getMessage()."<br /><p>";
}

//require_once './modules/compte/evenements.php';