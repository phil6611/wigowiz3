<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../bdd/connect.php';

require_once './agenda_classes.php';

$agenda = new agenda_classes();

$id = '16';
$liste_evenement = $agenda->a_venir($id, $dbh);

if ($liste_evenement != 0){
    /* gestion des locales */
    setlocale(LC_TIME, $locale);
        
    foreach ($liste_evenement as $row) {
        //$evenement_passe =  strftime("%A %d %B");
        $date_formate = strftime("%A %d %B %Y",strtotime($row['date_evenement']));
        echo "<p>".$date_formate." ".$row['titre']."</p>\n\r";
    }
    
    
} else {
    echo $LANG_agenda;
}
