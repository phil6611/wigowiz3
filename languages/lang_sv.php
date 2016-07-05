<?
function datecomplete($lastmodified){
list($date, $time) = explode(" ", $lastmodified);
list($year, $month, $day) = explode("-", $date);
list($hour, $min, $sec) = explode(":", $time);
$months = array("Januari", "Februari", "Mars", "April", "Juni", "Juli",
    "August", "August", "September", "Oktober", "November", "December");
//echo $lastmodified = "le $day ".$months[$month-1]." $year � ${hour}h${min}&nbsp;";
return "den $day ".$months[$month-1]." $year";
}
$LANG_bannieres_titre="Banners";
$LANG_bannieres="L�gg till en l�nk till wigowiz.com p� din webbplats";
$LANG_bannieres_utiliser="Kopiera / klistra in f�ljande kod p� dina sidor :";

$LANG_cacher_mon_adresse="d�lja min adress p� kartan";

// PAYS
$LATITUDE_DEFAULT="59.33318942659219";
$LONGITUDE_DEFAULT="18.08349609375";

// METAS
$LANG_meta_description="Wigowiz : plattform f�r hantering av bilen f�r familjen h�ndelse 
institutionella eller samfundet sport.";
$LANG_meta_title="Wigowiz ! ordna sam�kning f�r ditt evenemang";
$LANG_baseline="Ordna sam�kning f�r ditt evenemang";

$LANG_meta_mots="carpool, vi �ker tillsammans, carpool, sam�kning, ekologiska fotavtryck, evenemang, transporter mild carbon offset";

// CONNEXION
$LANG_bouton_connexion="Logga in";
$LANG_mon_compte="Mitt konto";
$LANG_se_deconnecter="Logout";
$LANG_erreur_identification="Felidentifiering";
$LANG_mot_de_passe_perdu="Gl�mt l�senord ?";
$LANG_creer_un_compte="Skapa ett konto";

// CREER EVENEMENT
$LANG_votre_prenom="Ditt f�rnamn :";
$LANG_pour_utiliser_ce_site="F�r att kunna anv�nda den h�r webbplatsen  :";
$LANG_etape1="Skapa ditt evenemang";
$LANG_etape2="Skicka l�nk till deltagarna";
$LANG_etape3="Uppt�ck ditt kort sam�kning";
$LANG_texte_bouton_entrer="Skapa h�ndelse";
$LANG_titre_etape="Steg 1 / 2: Skapa h�ndelse";
$LANG_titre_evenement="Titel ditt evenemang:";
$LANG_date_evenement="Event date :";
$LANG_jour="Dag";
$LANG_mois="M�nad";
$LANG_janvier="Januari";
$LANG_fevrier="Februari";
$LANG_mars="Mars";
$LANG_avril="April";
$LANG_mai="Kan";
$LANG_juin="Juni";
$LANG_juillet="Juli";
$LANG_aout="August";
$LANG_septembre="September";
$LANG_octobre="Oktober";
$LANG_novembre="November";
$LANG_decembre="December";
$LANG_annee="�r";
$LANG_veuillez_preciser_date="Ange datum";
$LANG_date_deja_passee="Dagen f�r h�ndelsen har g�tt...";
$LANG_description="Beskrivning (frivilligt) :";
$LANG_cocher_alerte_mail="Markera denna box om du vill f� en varning n�r n�gon �r i bilen av ditt evenemang";
$LANG_adresse_evenement="Adress till arenan";
$LANG_cp_evenement="Postnummer f�r handelsplatsidentifieringen";
$LANG_ville_evenement="Stad av h�ndelsen";
$LANG_pays_evenement="L�nder f�r h�ndelsen";
$LANG_enregistrer_changements="Spara �ndringar !";
$LANG_bouton_terminer="M�l !";
$LANG_titre_etape2="Steg 2 / 2: Leta upp din h�ndelse";
$LANG_votre_nom="Ditt namn : ";
$LANG_adresse_email="E-post  :";
$LANG_email_pas_valide="Detta brev �r inte giltigt";
$LANG_bouton_etape_suivante="Forts�tt till n�sta steg ";
$LANG_evenement_non_geolocalise="Adressen till evenemanget kan inte g�olocalis�e. <br> Flytta mark�ren p� kartan till �nskad plats och klicka p� OK. ";
$LANG_evenement_non_geolocalise_info="Flytta mark�ren till �nskad plats och klicka p� OK.";
$LANG_evenement_geolocalise_ok="Placeringen av h�ndelsen har �ndrats";
$LANG_evenement_modifie_ok="Information om evenemanget har �ndrats";
$LANG_modifier_infos="Edit Information";
$LANG_modifier_informations="�ndra information";
$LANG_modifier_position="�ndra position p� kartan";
$LANG_modifier_votre_position="�ndra din plats";
$LANG_modifier_position_marqueur="�ndra position m�rkningsprodukt";
$LANG_lien_pour_participer="L�nk  <strong>delta </strong>";
$LANG_lien_pour_administrer="L�nk <strong>administrera</strong> :";
$LANG_ajouter_favoris="L�gg till denna artikel till dina favoriter";
$LANG_envoyer_le_lien="E-posta den h�r artikeln f�r att alla deltagare";
$LANG_message_automatique="Automatisk meddelande";
$LANG_confirm_annul_alerte="Du beh�ver inte l�ngre ta emot postnotifiering i framtiden poster i sam�kning till detta evenemang. ";
$LANG_suivez_ce_lien="F�lj denna l�nk f�r att hantera h�ndelsen (�ndra, ta bort, etc.).";
$LANG_rappel_des_liens="Recall l�nkar :";
$LANG_important="Viktigt :";
$LANG_enregistrer_url="Spara adressen till sidan innan du l�mnar din webbl�sare. <br> Till exempel kan du l�gga till dina favoriter / bokm�rken.";
$LANG_enregistrer_liens="Spara dessa l�nkar innan du l�mnar webbplatsen. ";
$LANG_ajouter_cette_carte="L�gg detta kort till dina favoriter";

//PARTICIPER
$LANG_votre_adresse_non_localisee="Din adress kunde inte g�olocalis�e. <br> Flytta mark�ren p� kartan, Zomm till din adress p� en plats och klicka p� OK ";
$LANG_votre_adresse_pas_precise="Din adress �r inte tillr�ckligt tydligt, din mark�r ovanp� en redan upptagen.";
$LANG_deplacez_marqueur="Flytta mark�ren p� kartan, klicka p�  Bekr�fta f�r att spara det nya l�get";
$LANG_modifier_vos_coordonnees="�ndra dina uppgifter";
$LANG_nom_pseudo="Ditt namn (eller smeknamn) :";
$LANG_numero_tel="Ditt telefonnummer :";
$LANG_email="E-postadress :";
$LANG_cacher_mon_email="D�lj min email.";
$LANG_cacher_mon_email_suite="De �vriga deltagarna f�r kontakta dig via webbplatsen. <br> Din e-postadress visas inte.";
$LANG_votre_adresse="Avs�ndare :";
$LANG_votre_ville="Din stad : ";
$LANG_votre_pays="Ditt land : ";
$LANG_votre_cp="Ditt postnummer : ";
$LANG_vous_avez_un_vehicule="Du har ett fordon (men kan ocks� vara en person till en annan)";
$LANG_pas_de_vehicule="Du har inte en bil";
$LANG_possede_vehicule="Egna fordon (men f�r passageraren p� en annan)";
$LANG_ne_possede_vehicule="Har du inget fordon";
$LANG_plus_serons="Ju fler vi �r ben�gna att delta, desto st�rre minskning av v�rt ekologiska fotavtryck. ";
$LANG_pas_de_participants="Det finns f�r n�rvarande inga deltagare";


$LANG_commentaire_participant="Kommentera (det kommer att visas bredvid dina uppgifter) :";
$LANG_seuls_les_visiteurs="Endast de bes�kare som har f�tt l�nken f�r att delta i detta evenemang kommer att ha tillg�ng till din information";
$LANG_vous_etes_ajoute="Du �r l�ggas !";
$LANG_en_participant="Genom att delta i carpool godk�nner du Anv�ndarvillkor utlisation Site wigowiz.com";
$LANG_vos_infos="Skriv in dina uppgifter";
$LANG_envoyer_message="Skicka ett meddelande";
$LANG_votre_message="Ditt meddelande :";
$LANG_envoyer_message_contact="Skicka meddelande !";
$LANG_donnes_ajoutees="Dina uppgifter har lagts till kartan !";


//COMMUNS
$LANG_bouton_envoyer="Skicka";
$LANG_bouton_enregistrer="Spara !";
$LANG_bouton_annuler="Avbryt";
$LANG_veuillez_saisir_ce_champ="Fyll i detta omr�de";
$LANG_veuillez_points="Veuillez remplir ce champ...";
$LANG_veuillez_points_suite="... eller att";
$LANG_rester_identifie="Stanna inloggad f�r ett par dagar";
$LANG_participant="deltagare";
$LANG_participants="deltagarna";


//DON
$LANG_merci="Tack !";
$LANG_confirm_don="Din g�va har registrerats. <br> <br> Tack f�r ert st�d !";

//FAQ
$LANG_faq1="Vad kan den h�r webbplatsen tj�nar?";
$LANG_faq1_texte="Denna webbplats anv�nds f�r att organisera sam�kning f�r evenemang: br�llop, aff�rsm�ten, f�renings-m�ten, utbildning, sport t�vlingar <br> ... Tanken att f�dde den h�r webbplatsen �r att ge en enkel och effektiv, utan krusiduller. Tv� klick f�r att skapa en h�ndelse. Tv� klick f�r att delta i sam�kning till en h�ndelse. <br> opretenti�st, wigowiz.com hj�lper dig att minska de milj�m�ssiga kostnaderna f�r ditt evenemang. ";
$LANG_faq2="Hur mycket �r den h�r platsen? ";
$LANG_faq2_texte="Anv�nda wigowiz. Com �r gratis. Om du vill st�dja detta projekt kan du donera f�r att fr�mja dess utveckling och dess upphovsman. ";

//TEMOIGANGES
$LANG_temoignages="Testimonials";
$LANG_temoignages_texte="Hur du anv�nder denna webbplats? Har du minskat antalet bilar reser till ditt evenemang? Om du vill skicka oss dina vittnesb�rd, tack f�r att du anv�nder kontaktformul�ret. ";
$LANG_ecrivez_nous="Kontakta oss";


//CONTACT
$LANG_votre_email="Din e-post :";
$LANG_verifier_email="Tack f�r att verifiera e-post innan";
$LANG_veuiller_saisir_message="Ange ett meddelande";
$LANG_votre_message_envoye="Ditt meddelande har skickats !";
$LANG_retour_accueil="Tillbaka till Hem";

//CONDITION D'UTILISATION
$LANG_responsabilite="Disclaimer";
$LANG_responsabilite_texte="<p> Anv�ndare av denna webbplats fungerar som deras enda och hela ansvaret f�r att organisera sina resor carpool. </ P> wigowiz.com Webbplatsen �r en tj�nst fr�n formell relation. Under inga omst�ndigheter ansvaret kommer att uppst� vid genomf�randet av en resa som g�rs efter en formell kontakt genom den. </ P> ";
$LANG_traitement_donnees="Behandling av personuppgifter";
$LANG_donnes_personnelles_texte="<p> enlighet med lag nr 78-17 av den 6 januari 1978 har du r�tt att f� tillg�ng till och korrekta personuppgifter om dig, genom att kontakta den webbansvariga f�r webbplatsen . </ p> I vilket fall som helst kommer det att ske p� annat s�tt anv�nda dina personliga uppgifter som de �r avsedda, n�mligen drift av webbplats och visa mark�rer p� karta i en h�ndelse. </ P> Vi kommer inte att s�lja, l�na, hyra ut eller s�lja till en tredje part dina personuppgifter oavsett anv�ndningsomr�de. </ P> Vi f�rbeh�ller oss r�tten att meddela dig via e-post n�r lanseringen av nya funktioner p� webbplatsen. </ P>";
//PIED
$LANG_contact="Kontakt";
$LANG_temoignages="Testimonials";
$LANG_FAQ="FAQ";
$LANG_conditions_utilisation="Terms of Use";

//COMPTE
$LANG_mon_compte="Mitt konto";
$LANG_vos_evenements="Dina evenemang";
$LANG_infos_personnelles="Din personliga information";
$LANG_mes_evenements="Min Evenemang";
$LANG_acceder_compte="G� till mitt konto";
$LANG_compte_motdepasse="L�senord";
$LANG_un_compte_permet="Ett konto kan du : ";
$LANG_compte1="direkt tillg�ng till h�ndelser som du deltar i, eller som du har skapat fler m�ste komma ih�g webbadresserna kort. ";
$LANG_compte2="�ndra din adress, din position, antalet platser i din bil om det beh�vs";
$LANG_compte3="du prenumerera p� nyhetsbrevet som skall h�llas informerade om f�rb�ttringar och nya funktioner som kommer snart.";
$LANG_compte_deja_inscrit="Den h�r e-postadressen �r redan registrerad.";
$LANG_erreur_mail="Fel i e-postadress.";
$LANG_choisissez_motdepasse="V�lj ett l�senord : ";
$LANG_saisir_motdepasse="V�nligen ange ett l�senord";
$LANG_confirmer="... bekr�fta";
$LANG_motsdepasse_diffrents="L�senorden matchar inte";
$LANG_infos_modifiees="Din personliga information har �ndrats";
$LANG_modifier_position_perso="�ndra din plats";
$LANG_position_modifiee="Din position har �ndrats";
$LANG_motdepasse_perdu="Password Recovery";
$LANG_renvoi_motdepasse="Skicka mitt l�senord";
$LANG_email_inconnu="Den h�r e-postadressen �r ok�nd";
$LANG_motdepasse_renvoye="Ditt l�senord m�ste skickas med post";
$LANG_rappel_motdepasse="H�mta L�senord";
$LANG_lien_de_participation="Deltagande L�nk : ";
$LANG_lien_de_administration="L�nk Administration : ";
$LANG_supprimer_cet_evenement="Ta bort den h�r h�ndelsen";

$LANG_deplace_marqueur="Flytta mark�ren";
$LANG_derniere_etape="Sista etappen :";
$LANG_identifier_les_marqueurs="Identifiera mark�rer p� din resa";
$LANG_contactez_les_participants="Eller kontakta de ber�rda deltagarna";
$LANG_organisez_votre_venue="Ordna alla dina plats";
$LANG_email_protege="Email skyddas";
$LANG_message_defaut="Hej, jag skulle carpool med dig";

//MAILS
$LANG_mail_alerte="Ing�r i ny bil ditt evenemang";
$LANG_mail_alerte_contenu="Hej, En ny post har noterats f�r bilen ditt evenemang";
$LANG_mail_alerte_contenu2="\nOm du vill se karta �ver carpool ditt evenemang, klicka h�r :\nhttp://www.wigowiz.com/admin_carte.php?m=".$_SESSION['evenement']['code_admin']."\n\n\n----\nOm du inte vill ta emot postnotifiering f�r detta evenemang, klicka h�r :\nhttp://www.wigowiz.com/admin_carte.php?a=annule_alerte&m=".$_SESSION['evenement']['code_admin']."";
$LANG_vous_avez_un_message="Du har ett budskap";
$LANG_evenement_cree_par="Event skapas av ";

$LANG_ne_plus_participer="Avbryta mitt deltagande i detta evenemang";
$LANG_je_participe="Jag deltar i sam�kning till detta evenemang";





$LANG_paypal="<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6186005'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/fr_FR/i/scr/pixel.gif' width='1' height='1'>
</form>";

?>