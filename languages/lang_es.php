<?

function datecomplete($lastmodified){
list($date, $time) = explode(" ", $lastmodified);
list($year, $month, $day) = explode("-", $date);
list($hour, $min, $sec) = explode(":", $time);
$months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//echo $lastmodified = "le $day ".$months[$month-1]." $year � ${hour}h${min}&nbsp;";
return "el $day ".$months[$month-1]." $year";
} 

$LANG_bannieres_titre="Banners";
$LANG_bannieres="A�adir un enlace a wigowiz.com en su sitio web";
$LANG_bannieres_utiliser="Copie / pegue el siguiente c�digo en sus p�ginas :";

$LANG_cacher_mon_adresse="ocultar mi direcci�n en el mapa";

// PAYS
$LATITUDE_DEFAULT="39.80853604144591";
$LONGITUDE_DEFAULT="-3.8232421875";


// METAS
$LANG_meta_description="Wigowiz : plataforma para la gesti�n de eventos de coches familiares, institucionales, deportivos o asociaciones.";
$LANG_meta_title="Wigowiz ! Compartir coche para organizar tu eventos";
$LANG_baseline="Compartir coche para organizar tu eventos";

$LANG_meta_mots="Compartir coche, huella ecol�gica, evento, transporte suave, compensaci�n de carbono, wigowiz, compartir coche, coche, desarollo sostenible";

// CONNEXION
$LANG_bouton_connexion="Inicio de sesi�n";
$LANG_mon_compte="Mi Cuenta";
$LANG_se_deconnecter="Cerrar sesi�n";
$LANG_erreur_identification="Error de identificaci�n";
$LANG_mot_de_passe_perdu="Recuperar contrase�a?";
$LANG_creer_un_compte="Crear una cuenta";

// CREER EVENEMENT
$LANG_votre_prenom="Tu nombre :";
$LANG_pour_utiliser_ce_site="Para utilizar esta web :";
$LANG_etape1="Crea tu evento";
$LANG_etape2="Enviar enlace a los participantes";
$LANG_etape3="Descubra tu tarjeta para compartir coche";
$LANG_texte_bouton_entrer="Crea un evento";
$LANG_titre_etape="Paso 1 / 2: Crea un evento";
$LANG_titre_evenement="T�tulo de tu evento:  ";
$LANG_date_evenement="Fecha del evento :";
$LANG_jour="D�a";
$LANG_mois="Mes";
$LANG_janvier="Enero";
$LANG_fevrier="Febrero";
$LANG_mars="Marzo";
$LANG_avril="Abril";
$LANG_mai="Mayo";
$LANG_juin="Junio";
$LANG_juillet="Julio";
$LANG_aout="Agosto";
$LANG_septembre="Septiembre";
$LANG_octobre="Octubre";
$LANG_novembre="Noviembre";
$LANG_decembre="Diciembre";
$LANG_annee="A�o";
$LANG_veuillez_preciser_date="Por favor, especifique la fecha";
$LANG_date_deja_passee="La fecha del evento ha pasado...";
$LANG_description="Descripci�n (Opcional) :";
$LANG_cocher_alerte_mail="marca esta casilla si desea recibir una alerta cuando alguien est� en el coche de su evento.";
$LANG_adresse_evenement="Direcci�n del lugar del evento";
$LANG_cp_evenement="C�digo postal del lugar del evento";
$LANG_ville_evenement="Ciudad del lugar del evento";
$LANG_pays_evenement="Pa�s del lugar del evento";
$LANG_enregistrer_changements="Guardar cambios !";
$LANG_bouton_terminer="Finalizar !";
$LANG_titre_etape2="Paso 2 / 2: Localizar su evento";
$LANG_votre_nom="Tu apellido : ";
$LANG_adresse_email="E.mail  :";
$LANG_email_pas_valide="este e.mail no es correcto";
$LANG_bouton_etape_suivante="Pasar al paso siguiente ";
$LANG_evenement_non_geolocalise="La direcci�n del evento no ha podido ser localizado�.. mueva el marcador sobre el mapa, y haz un clic sobre aceptar. ";
$LANG_evenement_non_geolocalise_info="Mueva el marcador a la ubicaci�n deseada y haz clic en Aceptar.";
$LANG_evenement_geolocalise_ok="la posici�n del evento ha sido cambiado";
$LANG_evenement_modifie_ok="las informaciones del evento han sido cambiadas";
$LANG_modifier_infos="modificar leas informaciones";
$LANG_modifier_informations="modificar leas informaciones";
$LANG_modifier_position="modificar la ubicaci�n sobre el mapa";
$LANG_modifier_votre_position="modificar la ubicaci�n";
$LANG_modifier_position_marqueur="modificar la ubicaci�n del marcador";
$LANG_lien_pour_participer="Enlace para <strong> participar </strong>";
$LANG_lien_pour_administrer="Enlace para <strong>administrar</strong> :";
$LANG_ajouter_favoris="A�adir este enlace a tus favoritos";
$LANG_envoyer_le_lien="Enviar este enlace a todos los participantes";
$LANG_message_automatique="Mensaje autom�tico";
$LANG_confirm_annul_alerte="no recibiras m�s mensajes de alerta en caso de nuevas inscripciones en este evento. ";
$LANG_suivez_ce_lien="Siga este enlace para gestionar el evento (cambiar, suprimir..etc)";
$LANG_rappel_des_liens="recordar los enlaces :";
$LANG_important="Importante :";
$LANG_enregistrer_url="Por favor, guarda la direcci�n URL de esta p�gina antes de salir del navegador. <br> Por ejemplo, la puedes a�adir a tus favoritos / bookmarks.";
$LANG_enregistrer_liens="Guardar estos enlaces antes de salir de esta p�gina. ";
$LANG_ajouter_cette_carte="este mapa en tus favoritos";

//PARTICIPER 
$LANG_votre_adresse_non_localisee="Tu direcci�n no ha podido ser localizada. <br> Mueva el marcador sobre el mapa, Zooma hasta tu direcci�n para localizarla, y haz un clic sobre Aceptar. ";
$LANG_votre_adresse_pas_precise="Tu direcci�n no es suficientemente definida, tu marcador esta sobre una zona ya ocupada.";
$LANG_deplacez_marqueur="Mueva el marcador sobre el mapa y haz un clic sobre Aceptar para guardar la nueva posici�n";
$LANG_modifier_vos_coordonnees="Modificar tus datos";
$LANG_nom_pseudo="Tu nombre(o seudo) :";
$LANG_numero_tel="Tu n�mero de tel�fono :";
$LANG_email="Direcci�n de correo electr�nico :"; 
$LANG_cacher_mon_email="ocultar mi direcci�n de correo electr�nico.";
$LANG_cacher_mon_email_suite="Los demas participantes pueden ponerse en contacto contigo a trav�s de la web. <br> tu direcci�n de correo electr�nico no se mostrar�.";
$LANG_votre_adresse="tu direcci�n :";
$LANG_votre_ville="Tu ciudad : ";
$LANG_votre_pays="tu ald su : ";
$LANG_votre_cp="tu ald su : ";
$LANG_vous_avez_un_vehicule="tu tienes un veh�culo (pero tambi�n tu puedes ser pasajero en otro)";
$LANG_pas_de_vehicule="Tu no tienes coche";
$LANG_possede_vehicule="Veh�culo propio (pero tambi�n puede ser un pasajero en otro)"; 
$LANG_ne_possede_vehicule="no dispongo de un veh�culo";
$LANG_plus_serons="Cuanto m�s participemos, mayor ser� la reducci�n de nuestra huella ecol�gica. ";
$LANG_pas_de_participants="no hay todav�a personas interesadas";
$LANG_commentaire_participant="Comentario (aparecer� junto a tus datos) :";
$LANG_seuls_les_visiteurs="S�lo los visitantes que han recibido el enlace para participar a este evento tendr�n acceso a tus informaciones";
$LANG_vous_etes_ajoute="has sido a�adido !";
$LANG_en_participant="participar en este compartir de coche implica que tu eres de acuerdo con los t�rminos de utlizaci�n de la web wigowiz.com";
$LANG_vos_infos="tus informaciones";
$LANG_envoyer_message="Enviar un mensaje a";
$LANG_votre_message="Tu mensaje :";
$LANG_envoyer_message_contact="Enviar el mensaje !";
$LANG_donnes_ajoutees="Tus datos han sido a�adido al mapa !";

//COMMUNS
$LANG_bouton_envoyer="Enviar";
$LANG_bouton_enregistrer="Salvar !";
$LANG_bouton_annuler="Cancelar";
$LANG_veuillez_saisir_ce_champ="Por favor, completa este campo";
$LANG_veuillez_points="Por favor, rellena este campo...";
$LANG_veuillez_points_suite="... o bien este, por favor";
$LANG_rester_identifie="mantenerme identificado algunos d�as";
$LANG_participant="participante";
$LANG_participants="participantes"; 
 

//DON
$LANG_merci="Gracias !";
$LANG_confirm_don="tu participaci�n ha sido tomada en cuenta. <br> Gracias por tu apoyo !";

//FAQ
$LANG_faq1="�para que sirve esta web";
$LANG_faq1_texte="Esta web sirve para organizar el compartir de coche para tus eventos: bodas, reuniones de negocios, o de asociaciones, formaci�n, competiciones deportivas <br> ... La idea que di� origen a esta web es ofrecer un servicio sencillo y eficaz, sin superfluo. Dos clics para crear un evento. Dos clics son suficientes para participar a un evento para compartir coche. <br> sin pretensiones, wigowiz.com te ayuda a reducir el coste ambiental de tus eventos. "; 
$LANG_faq2="�Cu�nto cuesta la utilizaci�n de este sitio ?";
$LANG_faq2_texte="Utilizar wigowiz.com es gratuito. Si tu deseas apoyar este proyecto, puedes enviar un donativo para ayudar a fomentar el desarrollo de esta web, y animar a su creador. "; 

//TEMOIGANGES
$LANG_temoignages="Testimonios";
$LANG_temoignages_texte="�C�mo utilisas esta web? �Se ha reducido el n�mero de coches que van a viajar a tu evento? Para enviar tu testimonio, por favor utiliza el formulario de contacto. ";
$LANG_ecrivez_nous="Escribanos"; 
 

//CONTACT
$LANG_votre_email="tu correo electr�nico :";
$LANG_verifier_email="Por favor, averigua tu direcci�n electr�nica";
$LANG_veuiller_saisir_message="Por favor, introduzca un mensaje";
$LANG_votre_message_envoye="Tu mensaje ha sido enviado !";
$LANG_retour_accueil="Volver a la p�gina principal"; 

//CONDITION D'UTILISATION

$LANG_responsabilite="Descargo de responsabilidad";
$LANG_responsabilite_texte="<p>Los usuarios de esta web actuan bajo su �nica y entera responsabilidad para organizar sus viajes compartiando coches. </p><p> la web wigowiz.com no ofrece m�s que un servicio de puesta en relaci�n. La responsabilidad de la web wigowiz.com no podr� ser en ning�n caso retenida con respecto a la realizaci�n de un viaje hecho a trav�s de ella. </p> "; 
$LANG_traitement_donnees="Tratamiento de datos personales";
$LANG_donnes_personnelles_texte="<p>De conformidad con la ley n � 78-17 del 6 de enero de 1978, usted tiene el derecho de acceso y rectificaci�n de los datos personales que le conciernen, poni�ndose en contacto con el webmaster del sitio. </p><p> En ning�n caso se proceder� a otro uso de sus datos personales a los que se destinan, a saber, el funcionamiento de la web y mostrar los marcadores en el mapa de un evento. </p><p> Nos comprometemos a no vender, prestar, alquilar o vender a terceros sus datos personales para cualquier uso. </p><p> Nos reservamos el derecho de notificarle por correo electr�nico el lanzamiento de nuevas funcionalidades en nuestra web</p>"; 

//PIED
$LANG_contact="Contacto";
$LANG_temoignages="Testimonios";
$LANG_FAQ="Preguntas m�s frecuentes";
$LANG_conditions_utilisation="T�rminos de Uso"; 

//COMPTE
$LANG_mon_compte="Mi Cuenta";
$LANG_vos_evenements="Tus eventos";
$LANG_infos_personnelles="Tus datos personales";
$LANG_mes_evenements="Mis eventos";
$LANG_acceder_compte="Ir a mi cuenta";
$LANG_compte_motdepasse="Contrase�a";
$LANG_un_compte_permet="Una cuenta permite : ";
$LANG_compte1="acceso directo a los acontecimientos en los que tu participas, o que has creado. No hay m�s necesidad de recordar las URL de los mapas. "; 
$LANG_compte2="cambiar tu direcci�n, tu posici�n, el n�mero de plazas de tu veh�culo si fuera necesario"; 
$LANG_compte3="suscribirte a la newsletter para quedar informado de las mejoras y nuevas caracter�sticas de la web que vendr�n pronto."; 
$LANG_compte_deja_inscrit="Esta direcci�n de correo electr�nico ya est� registrada.";
$LANG_erreur_mail="Error en la direcci�n de correo electr�nico.";
$LANG_choisissez_motdepasse="Elija una contrase�a: ";
$LANG_saisir_motdepasse="Por favor, introduzca una contrase�a";
$LANG_confirmer="... confirmar";
$LANG_motsdepasse_diffrents="Las contrase�as no coinciden";
$LANG_infos_modifiees="tus informaciones personales se han modificado ";
$LANG_modifier_position_perso="Cambiar su ubicaci�n";
$LANG_position_modifiee="Su ubicacci�n ha sido modificada"; 
$LANG_motdepasse_perdu="recuperaci�n de la contrase�a";
$LANG_renvoi_motdepasse="Recibir mi contrase�a";
$LANG_email_inconnu="Esta direcci�n de correo electr�nico es desconocida";
$LANG_motdepasse_renvoye="Tu contrase�a te ha sido enviada por correo electronico";
$LANG_rappel_motdepasse="Recordatorio de Contrase�a"; 
$LANG_lien_de_participation="enlace de participaci�n : ";
$LANG_lien_de_administration="enlace de administraci�n : ";
$LANG_supprimer_cet_evenement="Eliminar este evento"; 
$LANG_deplace_marqueur="Mover el marcador";
$LANG_derniere_etape="Etapa final :";
$LANG_identifier_les_marqueurs="Identificar los marcadores de su viaje";
$LANG_contactez_les_participants="Contactar el o los participantes"; 
$LANG_organisez_votre_venue="Organice tu viaje juntos"; 
$LANG_email_protege="E-mail protegido";
$LANG_message_defaut="hola! Me gustaria mucho compartir coche contigo";

//MAILS
$LANG_mail_alerte="nueva persona inscrita en el compartir coche de su evento"; 
$LANG_mail_alerte_contenu="hola, una nueva persona se ha inscrito para el compartir coche de su evento, haz un clic aqu�";
$LANG_mail_alerte_contenu2="\nPara ver el mapa del compartir coche de su evento, haz un clic aqu� :\nhttp://www.wigowiz.com/admin_carte.php?m=".$_SESSION['evenement']['code_admin']."\n\n\n----\nSi no deseas recibir mensajes de alerta para este evento, haz un clic aqu� :\nhttp://www.wigowiz.com/admin_carte.php?a=annule_alerte&m=".$_SESSION['evenement']['code_admin'].""; 
$LANG_vous_avez_un_message="Usted tienes un mensaje";
$LANG_evenement_cree_par="Evento creado por ";
$LANG_ne_plus_participer="Cancelar mi participaci�n en este evento";
$LANG_je_participe="participo en el compartir de coche de este evento";
 
 
 
 


$LANG_paypal="<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6185839'>
<input type='image' src='https://www.paypal.com/es_ES/ES/i/btn/btn_donate_SM.gif' border='0' name='submit' alt='PayPal. La forma r�pida y segura de pagar en Internet.'>
<img alt='' border='0' src='https://www.paypal.com/fr_FR/i/scr/pixel.gif' width='1' height='1'>
</form>";
?> 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
