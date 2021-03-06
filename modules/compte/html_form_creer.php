
<h1>{titre}</h1>
{texte}

<form name="formulaire" action="./index.php?a=compte&amp;&section=creer" method="post" autocomplete="off" id="creationCompte">

    <div id="map"></div>

    <fieldset>
        <legend>{LANG_compte_creer_civilite}</legend>
        <div>
            <label for="prenom_participant">{LANG_votre_prenom}&#8239:</label>
            <input name="prenom_participant" type="text" class="champFormulaire" id="prenom_participant" tabindex="1" value="{prenom}" size="40" placeholder="{LANG_votre_prenom}" required>
            {prenom_valid}
        </div>

        <div>
            <label for="nom_participant">{LANG_votre_nom}&#8239:</label>
            <input name="nom_participant" type="text" class="champFormulaire" id="nom_participant" tabindex="2" value="{nom}" size="40" placeholder="{LANG_votre_nom}" required>
            {nom_valid}
        </div>

        <div>
            <label for="email_participant">{LANG_adresse_email}&#8239:</label>
            <input name="email_participant" type="email" class="champFormulaire" id="email_participant"  tabindex="4" value="{email}" size="40" placeholder="{LANG_adresse_email}" required>
            {email_valid}
        </div>
        
        <div>
            <label for="lat">{{LANG_latitude}}</label>
            <input type="text" class="champFormulaire" name="lat" id="lat" required />
            <label for="lng">{{LANG_longitude}}</label>
            <input type="text" class="champFormulaire" name="lng" id="lng" required />
        </div>
        
        
    </fieldset>

    <fieldset>
        <legend>{LANG_compte_creer_securite}</legend>
        <div>
            <input name="cacher_email" type="checkbox" id="cacher_email" tabindex="9" value="1" {bouton_cacher_email}>
            <label for="cacher_email">{LANG_cacher_mon_email}</label>
            <p class="information_input">{LANG_cacher_mon_email_suite}</p>
        </div>

        <div>
            <input name="cacher_adresse" type="checkbox" id="cacher_adresse" tabindex="10" value="1" {bouton_cacher_adresse}>
            <label for="cacher_adresse">{LANG_cacher_mon_adresse}</label>
        </div>

        <div>
            <label for="motdepasse1_participant">{LANG_choisissez_motdepasse}&#8239:</label>
            <input name="motdepasse1_participant" type="password" tabindex="11" class="champFormulaire" id="motdepasse1_participant"  size="40" placeholder="{LANG_choisissez_motdepasse}" required>
            {mdp1_valid}
        </div>

        <div>
            <label for="motdepasse2_participant">{LANG_confirmer}&#8239:</label>
            <input name="motdepasse2_participant" type="password" tabindex="12"  class="champFormulaire" id="email_participant23" size="40" placeholder="{LANG_confirmer}" required>
            {mdp_test}
        </div>
        
    </fieldset>

    <fieldset>
        <legend>{LANG_compte_creer_infos_utiles}</legend>
        <div>
            <input name="vehicule" id='vehicule' type="radio" tabindex="13" value="1"  {avoir_vehicule}>
            <label for="vehicule">{LANG_vous_avez_un_vehicule}</label>
        </div>
        <div>
            <input type="radio" name="vehicule"  id="no_vehicule" value="0"  tabindex="14"  {pas_vehicule}>
            <label for="no_vehicule">{LANG_pas_de_vehicule}</label>
        </div>

        <div>
            <label for="">{LANG_commentaire_participant}&#8239:</label>
            <input name="commentaire" type="text" class="champFormulaire" id="commentaire"  tabindex="15" value="{commentaire}" size="50" maxlength="250" placeholder="{LANG_commentaire_participant}">
        </div>
    </fieldset>

    <div class="bouton_form">
        <input type="submit" tabindex="16"  name="Submit23" value="{LANG_bouton_terminer}">
        <input type="reset" value="{LANG_bouton_annuler}" tabindex="17" /> 
        <input name="envoi" type="hidden" id="envoi3" value="TRUE">
        <input name="modification" type="hidden" id="envoi5" value="{modification}"/>
    </div>

</form>

<script type='text/javascript' src="./javascript/carte/creation.js"></script>