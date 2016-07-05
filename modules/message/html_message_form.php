
            <form action="./index.php?a=message&amp;section=enregistrement" method="post">

                <div>
                    <label for="evenement">{LANG_message_evenement}:</label>
                    <input type="text" name="evenement" id="evenement" value="{evenement}" readonly="readonly" />
                    <input type="hidden" name="id_evenement" id="id_evenement" value="{id_evenement}" />
                </div>

                <div>
                    <label>{LANG_message_destinataire}:</label>
                    <input type="text" name="destinataire" id="destinataire" value="{destinataire}" readonly="readonly"/>
                    <input type="hidden" name="id_destinataire" id="id_destinataire" value="{id_destinataire}" />
                </div>

                <div>
                    <label for="message_expediteur">{LANG_message_texte_message}:</label>
                    <textarea name="message_expediteur" id="message_expediteur" placeholder="{LANG_message_texte_message}" cols="50" rows="20" required></textarea>
                    <input type="hidden" name="id_expediteur" id="id_expediteur" value="{id_expediteur}" />
                </div>

                <div>
                    <input type="submit" name="envoyer" value="{LANG_message_submit}" />
                    <input type="reset" name="annuler" value="{LANG_message_reset}" />
                </div>
            </form>
