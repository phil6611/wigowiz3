<?php

/* 
 * Ce fichier contient les fonctions pour l'envoi d'emails.
 */

function send_email($tableau_email){
    
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