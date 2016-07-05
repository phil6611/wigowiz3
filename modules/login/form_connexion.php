<?php

/* 
 * Ce fichier contient le formulaire de connexion et le bouton de déconnexion.
 */

//Le formulaire de connexion.
$form =  "\n\t\t\t<div id=\"form_connexion\">
                <form name=\"form_connexion\" method=\"post\" action=\"./index.php\">

                    <input name=\"email\" type=\"email\" class=\"champFormulaire\" id=\"email4\" placeholder=\"".$LANG_adresse_email."\" required/>
                    <input name=\"motdepasse\" type=\"password\" class=\"champFormulaire\" id=\"motdepasse\" placeholder=\"".$LANG_login_password."\" required/>

                    <input type=\"submit\" name=\"Submit\" value=\"".$LANG_bouton_connexion."\" />
                    <input name=\"connexion\" type=\"hidden\" id=\"connexion\" value=\"TRUE\" />
                 </form>\n
                <p><a href=\"./index.php?a=compte&amp;section=creer\" title=\"".$LANG_creer_un_compte."\">".$LANG_creer_un_compte."</a></p>\n
                </div>";

//Le bouton de déconnexion.
$deconnexion = "<div id=\"bouton_deconnexion\">
            <p><a title=\"".$LANG_se_deconnecter."\" href=\"./modules/login/deconnexion.php\">".$LANG_deconnexion."</a></p>
        </div>";

?>
