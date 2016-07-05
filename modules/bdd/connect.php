<?php

	//Constante pour les préfixes de la base de données.
	define ("PREFIXE", "wigowiz_");


	//variables de connexion
	$user = 'root';
	$pass = '';
	//Après "host=" il faut mettre les informations concernant le serveur.
	//Après "dbname=" il faut mettre le nom de la base de données.
	//Ces informations sont fournies par l'hébergeur.
	//Exemple : 'mysql:host=mysql5-12.pro;dbname=accessibilite';
	$dsn = 'mysql:host=localhost;dbname=wigowiz3';
	

	//connexion à la base de données
	try {
		$dbh = new PDO($dsn, $user, $pass);
	} catch (PDOException $e) {
		die ("Erreur ! :".$e->getMessage());
	}

	//conversion en utf-8
	$caractere = "SET NAMES utf8";
	$jeucaracteres = $dbh->query($caractere);

	//gestion des erreurs
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

?>