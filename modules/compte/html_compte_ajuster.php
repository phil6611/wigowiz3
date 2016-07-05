
    <h1>{LANG_modifier_votre_position}</h1>

    <div>
        <p>
        {LANG_deplacez_marqueur}
        </p>
     </div>
    <form name="formulaire" method="post" action="./index.php?a=compte&amp;section=ajuster">
        <label for="latitude">{LANG_compte_ajuster_latitude}</label>
        <input name="latitude" type="text"  id="latitude" value="{latitude}"  readonly="readonly">
        <label for="logitude">{LANG_compte_ajuster_longitude}</label>
        <input name="longitude" type="text"  id="longitude" value="{longitude}"  readonly="readonly">
        <input name="envoi" type="hidden" id="envoi4" value="TRUE">

        <div>
            <input id="ajuster" class="bouton" type="submit" value="{LANG_compte_ajuster_bouton}" />
        </div>

    </form>


     
    <div id="map"></div>
    
    <script type='text/javascript' src="./javascript/carte/ajuster.php?latitude={latitude}&amp;longitude={longitude}"></script>
