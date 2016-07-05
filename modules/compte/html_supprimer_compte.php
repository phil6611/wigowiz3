
            <h1>{LANG_compte_supprimer_titre}</h1>
            
            {LANG_compte_supprimer_texte}
            
            <form action="./index.php?a=compte&section=supprimer_compte" method="POST">
                <div>
                    <div>
                        <label for="supprimer">{LANG_compte_supprimer_label}</label>
                        <input type="checkbox" name="supprimer" id="supprimer" required/>
                        <input type="hidden" name="envoi" value="TRUE" />
                        <input type="hidden" name="id_participant" value="{id}" />
                    </div>
                    <input type="submit" value="{LANG_compte_supprimer_submit}"/>
                </div>
            </form>