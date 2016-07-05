<?php
/******************************************************************************/
/*                                                                            */
/*                       __        ____                                       */
/*                 ___  / /  ___  / __/__  __ _____________ ___               */
/*                / _ \/ _ \/ _ \_\ \/ _ \/ // / __/ __/ -_|_-<               */
/*               / .__/_//_/ .__/___/\___/\_,_/_/  \__/\__/___/               */
/*              /_/       /_/                                                 */
/*                                                                            */
/*                                                                            */
/******************************************************************************/
/*                                                                            */
/* Titre          : Distance en mètre entre deux points avec coordonnées...   */
/*                                                                            */
/* URL            : http://www.phpsources.org/scripts459-PHP.htm              */
/* Auteur         : forty                                                     */
/* Date édition   : 25 Sept 2008                                              */
/* Website auteur : http://www.toplien.fr/                                    */
/*                                                                            */
/******************************************************************************/

// renvoi la distance en mètres
function get_distance_m($lat1, $lng1, $lat2, $lng2) {
  $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
  //Conversions des coordonnées des degrés vers les radians.
  $rlo1 = deg2rad($lng1);
  $rla1 = deg2rad($lat1);
  $rlo2 = deg2rad($lng2);
  $rla2 = deg2rad($lat2);
  //calcul de la distance.
  $dlo = ($rlo2 - $rlo1) / 2;
  $dla = ($rla2 - $rla1) / 2;
  $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
  $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
  //Renvoi du résultat.
  return ($earth_radius * $d);
}
/*
echo (round(get_distance_m(48.856667, 2.350987, 45.767299, 4.834329) / 1000, 3))
 . ' km';
 affiche 391.613 km
 */
?>