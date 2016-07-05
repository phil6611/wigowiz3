        <h1>{LANG_inscription_titre}</h1>
        
        <div class="cadre_inscription">
            <h2>{LANG_inscription_pas_inscrit}</h2>
            
            <p>{LANG_inscription_texte_creation_compte}</p>
            
            <p><a href="./index.php?a=compte&section=creer" title="{LANG_creer_un_compte}">{LANG_creer_un_compte}</a></p>
            
        </div>
        
        <div class="cadre_inscription">
            
            <h2>{LANG_inscription_deja_inscrit}</h2>
            
            <form name="form_connexion_inscription" method="post" action="./index.php">

                    <input name="email" type="email" class="champFormulaire" id="email4" placeholder="{LANG_adresse_email}" required/>
                    <input name="motdepasse" type="password" class="champFormulaire" id="motdepasse" placeholder="{LANG_login_password}" required/>

                    <input type="submit" name="Submit" value="{LANG_bouton_connexion}" />
                    <input name="connexion" type="hidden" id="connexion" value="TRUE" />
            </form>
            
        </div>

