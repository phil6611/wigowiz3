<h1>{LANG_login_titre_inscrire}</h1>

<div class="participez">
    <form name="form_connexion" method="post" action="./index.php">
        <input name="email" type="email" class="champFormulaire" id="email4" placeholder="{LANG_adresse_email}" required/>
        <input name="motdepasse" type="password" class="champFormulaire" id="motdepasse" placeholder="{LANG_login_password}" required/>

        <input type="submit" name="Submit" value="{LANG_bouton_connexion}" />
        <input name="connexion" type="hidden" id="connexion" value="TRUE" />
    </form>
</div>

<div class="participez">
    <a href="" title="{LANG_creer_un_compte}" >{LANG_creer_un_compte}</a>
</div>