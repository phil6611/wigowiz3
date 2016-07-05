<?php

//Récupération de la variable $_POST
$envoi= filter_input(INPUT_POST, "envoi", FILTER_SANITIZE_STRING);

//variables pour remplir le formulaire
$nom = NULL;
$email = NULL;
$message_textarea = NULL;
//variables pour la validation du formulaire.
$nom_valid = NULL;
$email_valid = NULL;
$message_valid = NULL;

//Code HTML à afficher.
$html_code_form = "./modules/contact/form_contact.php";
$html_code_merci = "./modules/contact/merci_contact.php";


if($envoi == "ok"){
    
    //Validation des données envoyées depuis le formulaire.
    $nom_post = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
    $email_post = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $message_post = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
    $combien_post = filter_input(INPUT_POST, "combien", FILTER_SANITIZE_NUMBER_INT);
    
    //Données pour réécrire dans le formulaire.
    $nom = $nom_post;
    $email = $email_post;
    $message_textarea = $message_post;
    
    //Données pour la requête sql et l'email.
    $nom_sql = $dbh->quote($nom_post);
    $email_sql = $dbh->quote($email_post);
    $message_sql = $dbh->quote($message_post);    
		
    if(filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL) && !empty($nom_post) && !empty($message_post) && $combien_post == 8){

        //Enregistrement du message dans la base de données.
        $sql_message = "insert into ".PREFIXE."contacts (nom,email,message,date,ip) values (".$nom_sql.",".$email_sql.",".$message_sql.",NOW(),'".$_SERVER['REMOTE_ADDR']."')";
        //exécution de la requête.
        try {
            $dbh -> exec($sql_message);
        } catch(PDOException $e) {
                print "<p>Erreur ! :".$e->getMessage()."<br /><p>";
        }

        //Le message pour l'envoi de l'email
        $message='Bonjour, nouveau message depuis wigowiz : <br /><br />'
                            . 'Nom : '.$nom.'<br />'
                            . 'Email : <a href="mailto:'.$email.'">'
                            . ''.$email.'</a>'
                            . '<br />'.nl2br($message_textarea).''; 
        /*Entête de l'email.
        $entete = "From:".$nom."<".$email.">\n";
	$entete .='Content-type: text/plain; charset="utf-8"'."\n";
        $entete .= "Reply-To: ".email."\r\n";
        */
        //Tableau pour l'email.
        $tableau_email = [
            "expediteur" => $email,
            "destinataire" => "philippe.poisse@addicterra.fr",
            "sujet" => "Contact - wigowiz",
            "message" => $message 
        ];
        //Envoie de l'email.
        //mail("philippe.poisse@addicterra.fr","Contact - wigowiz",$message,$entete);
        send_email($tableau_email);
        //Fichier html
        $html_code = file_get_contents($html_code_merci);
        
    } else {
        
        //variables pour la validation du formulaire.
        $nom_valid = $form_valid->empty_input($nom_post, $LANG_veuillez_saisir_ce_champ);
        $email_valid = $form_valid->valid_email($email_post, $LANG_veuillez_saisir_ce_champ, $LANG_verifier_email);
        $message_valid = $form_valid->empty_input($message_post, $LANG_veuillez_saisir_ce_champ);
        //Fichier html
        $html_code = file_get_contents($html_code_form);

    }
		
} else {
    //Si aucun message n'a été envoyé on affiche le formulaire de contact.
    //Fichier html.
    $html_code = file_get_contents($html_code_form);

}

//Tableau des textes à parser.
$texte_tableau = [
    "{langue_contact}" => $LANG_contact,
    "{langue_votre_nom}" => $LANG_votre_nom,
    "{langue_votre_email}" => $LANG_votre_email,
    "{langue_votre_message}" => $LANG_votre_message,
    "{langue_envoyer_message_contact}" => $LANG_envoyer_message_contact,
    "{nom}" => $nom,
    "{email}" => $email,
    "{message_textarea}" => $message_textarea,
    "{nom_valid}" => $nom_valid,
    "{email_valid}" => $email_valid,
    "{message_valid}" => $message_valid,
    "{LANG_contact_antispam}" => $LANG_contact_antispam,
    "{LANG_contact_merci_message}" => $LANG_contact_merci_message,
    "{langue_votre_message_envoye}" => $LANG_votre_message_envoye,
    "{langue_retour_accueil}" => $LANG_retour_accueil
];
//Remplacement des tags dans le code html.
$html = $moteur->remplace($texte_tableau, $html_code);

?>