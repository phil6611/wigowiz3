
        <h1>{langue_contact}</h1>
        
        <form name="form2" method="post" action="./index.php?a=contact">
            
            <div>
                <label for="nom3">{langue_votre_nom}</label>
                <input name="nom" id="nom" type="text" class="champFormulaire" id="nom3" value="{nom}" placeholder="{langue_votre_nom}" size="70" required>
                {nom_valid}
            </div>

            <div>
                <label for="email">{langue_votre_email}</label>
                <input name="email" id="email" type="email" class="champFormulaire" id="email" value="{email}" placeholder="{langue_votre_email}" size="70" >
                {email_valid}
            </div>

            <div>
                <label for="message">{langue_votre_message}</label>
<textarea name="message" id="message" cols="70" rows="15" class="champFormulaire" id="textarea">{message_textarea}</textarea>
                {message_valid}
            </div>

            <div>
                <label>{LANG_contact_antispam}</label>
                <input name="combien" type="number" class="champFormulaire" id="nom" size="10" required/> 
            </div>

            <div>
                <input type="submit" name="Submit" value="{langue_envoyer_message_contact}">
                <input name="envoi" type="hidden" id="envoi" value="ok">
            </div>
        
      </form>
