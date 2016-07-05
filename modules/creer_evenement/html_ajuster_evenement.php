
<h2>{titre_evenement}</h2>

<div>
        <p>
        {LANG_deplacez_marqueur}
        </p>
     </div>

<p valign="top" class="texte">{date_evenement}</p>

<form name="formulaire" method="post" action="./index.php?a=ajuster_evenement&id={id_evenement}">
    <input name="latitude" type="text"  id="latitude3" value="{latitude}" required>
    <input name="longitude" type="text"  id="longitude" value="{longitude}" required>
    <input type="submit" value="{LANG_creer_evenement_ajuster_enregistrer}" />
    <input type="reset" value="{LANG_creer_evenement_ajuster_annuler}" />
    <input name="envoi" type="hidden" id="envoi" value="TRUE">
    <input name="id_evenement" type="hidden" id="id_evenement" value="{id_evenement}" />
</form>

<div id="map"></div>

<script type='text/javascript' src="./javascript/carte/ajuster.php?latitude={latitude}&amp;longitude={longitude}"></script>