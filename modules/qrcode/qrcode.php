<?php

//Inclusion de la bibliothèque pour la qrcode.
require_once ('../vendor/phpqrcode/qrlib.php');

//Récupération de l'identifiant de la carte
$carte = filter_input(INPUT_GET, "carte", FILTER_SANITIZE_STRING);
//Récupération de la taille du qcode.
$size = filter_input(INPUT_GET, "taille", FILTER_SANITIZE_NUMBER_INT);

//Création de l'URL
//$url = $SITE_nom_site."/index.php?a=carte&include=default&m=".$carte;
$url = "http://wigowiz.addicterra.fr/index.php?a=carte&include=default&m=".$carte;
// outputs image directly into browser, as PNG stream
//QRcode::png($url);
QRcode::png($url, $outfile = false, $level = QR_ECLEVEL_H, $size);