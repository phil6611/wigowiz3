
        <form name="form1" method="post" action="./index.php?a={action}">

            <fieldset>
                <legend>{titre}</legend>
                {id_evenement}
            <div>
                <label for="titre2">{titre_evenement}:</label>
                <input name="titre" type="text" class="champFormulaire" id="titre2" value="{titre_evenement_texte}" size="70" placeholder="{titre_evenement}" required>
                {titre_valid}
            </div>

            <div>
                <label for="datepicker" class="texte">{date}:</label>
                <input type="text" class="champFormulaire" name="datepicker" id="datepicker" placeholder="{date}" value="{date_evenement}" required/>
            </div>
            
            <div>
                <label for="timepicker" class="texte">{heure}</label>
                <input type="time" class="champFormulaire" name="timepicker" id="timepicker" placeholder="{heure}" value="{time_evenement}" required/>
            </div>
                
            <div>
                <label for="datepicker2" class="texte">{date_fin}</label>
                <input type="text" class="champFormulaire" name="datepicker2" id="datepicker2" placeholder="{date_fin}" value="{date_fin_evenement}" />
            </div>
                
            <div>
                <label for="timepicker2" class="texte">{heure_fin}</label>
                <input type="time" class="champFormulaire" name="timepicker2" id="timepicker2" placeholder="{heure_fin}" value="{time_fin_evenement}" />
            </div>
              <!--  
            <div>
                <label for="image">{image}</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
                <!-- sert pour une éventuelle mise à jour 
                {image_value}
                <input type="file" name="image" id="image" />
            </div>    
                -->
            <div>
                <label  for="textarea" class="texte">{description}:</label>
                <textarea name="description" cols="70" rows="8" class="champFormulaire" id="textarea" placeholder="{description}" required>{description_texte}</textarea>
                {description_valid}
            </div>
  
            </fieldset>


            <fieldset>
                <legend>Informations diverses</legend>
                <div>
                    <input name="je_participe" type="checkbox" id="je_participe" value="1" {je_participe_checked}>
                    <label for="je_participe">{je_participe}</label>
                </div>

                <div>
                    <input name="envoi_alerte" type="checkbox" id="envoi_alerte" value="1" {envoi_alerte}>
                    <label for="envoi_alerte">{alerte_mail}</label>
                </div>
            </fieldset>
            
            <fieldset>
                
                <legend>Adresse</legend>
                
                <div>
                    <label class="texte">{LANG_adresse_evenement}&#8239;:</label>
                    <input name="adresse" type="text" class="champFormulaire" id="adresse" value="{adresse}" size="50" placeholder="{LANG_adresse_evenement}" required>
                    {adresse_valid}
                </div>
                <div>
                    <label class="texte">{LANG_cp_evenement}&#8239;:</label>
                    <input name="cp" type="text" class="champFormulaire" id="cp" value="{cp}" size="50" placeholder="{LANG_cp_evenement}" required>
                    {cp_valid}
                </div>
                <div>
                    <label class="texte">{LANG_ville_evenement}&#8239;:</label>
                    <input name="ville" type="text" class="champFormulaire" id="ville" value="{ville}" size="50" placeholder="{LANG_ville_evenement}" required>
                    {ville_valid}
                </div>

                <div>
                    <label for="pays">{LANG_votre_pays}&#8239;:</label>
                    <select name="pays" id="pays" tabindex="8" required>
                        {pays_liste}
                    </select>
                </div>
                
            </fieldset>
            

            <div>
                <input type="submit" name="Submit" value="{etape_suivante}  &raquo;">
                <input name="envoi" type="hidden" id="envoi" value="TRUE">
                <input name="creation" type="hidden" id="creation" value="{creation}">
            </div>
            
        </form>
{date_valid}

<!-- Fichier JavaScript pour JQuery et JQuery UI -->
            <script src="./javascript/jquery-2.1.1.min.js"></script>
            <script src="./javascript/jquery-ui-1.11.1/jquery-ui.min.js" ></script>
            <script src="./javascript/datepicker_fr.js" type="text/javascript"></script>
            <script src="./javascript/datepicker.js" type="text/javascript"></script>
            <script src="./javascript/jquery.datetimepicker.js" type="text/javascript"></script>