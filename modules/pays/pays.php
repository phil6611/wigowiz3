<?php

/* 
 * Ce fichier contient le tableau pour la liste des pays utilisée dans les différents formulaires.
 */

//Tri du tableau par ordre alphabétique.
asort($LANG_array_countries, SORT_LOCALE_STRING );

//Vérification de la sélection d'un pays.
if(array_key_exists($pays, $LANG_array_countries)){
   $default_liste = NULL; 
} else {
    $default_liste = "selected";
}

//Premier ligne du champs "select" dans le formulaire.
$pays_liste = "<option ".$default_liste." disabled=\"disabled\">".$LANG_compte_creer_pays_defaut."</option>\n\r";


//Création de la liste de sélection
foreach ($LANG_array_countries as $key => $value) {
    
    if ($key == $pays){
        $selected_pays = "selected";
    } else {
        $selected_pays = NULL;
    }
    
    $pays_liste .= "\t\t\t\t<option value=\"".$key."\" ".$selected_pays.">".$value."</option>\n\r";
    
}
