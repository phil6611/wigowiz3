<?php
session_start();
$cache = "nocache";
session_cache_limiter($cache);

//Page "action" pour le formulaire.
$page = $_SERVER['PHP_SELF'];


if (isset ($_POST['soumis'])) {

	$nom = $_POST['nom'];
	$mdp = $_POST['mdp'];
	//cryptage du mot de passe
	$mdp_crypt = crypt($mdp, '$6$rounds=5000$usesomesillystringforsalt$');

	if (!$nom | !$mdp) {
		$message = '<p id="erreur">Identifiants de connexion invalides<p>';
	} else {

		$message = "";

		//Inclusion du fichier de configurration pour la connexion à la Base de Données.
		include_once("./commun/connect.php");

		//Préparation requête SQL.
		$sql_prepare = "SELECT *
		FROM `".PREFIXE."utilisateurs`
		WHERE `login_utilisateurs` LIKE ?" ;
		$sql = $dbh->prepare($sql_prepare);
	
		//Exécution de la requête.
		try {
			$sql->execute(array($nom));
			$resultat = $sql->fetchall(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			//die ("Erreur ! :".$e->getMessage());
			die ("<p>Connexion à la base de données impossible!</p>");
		}

		//Vérification des résultats.
		$compte = count($resultat);

		if ($compte != "1") {
			$message = '<p id="erreur">Identifiants de connexion invalides<p>';
		} elseif ($nom != $resultat['0']['nom_utilisateurs'] && $mdp_crypt != $resultat['0']['mdp_utilisateurs']) {
			$message = '<p id="erreur">Identifiants de connexion invalides test<p>';
		} else {
			$civilite = $resultat['0']['prenom_utilisateurs']." ".$resultat['0']['nom_utilisateurs'];
                        $niveau_securite = $resultat['0']['securite_id'];
			$_SESSION['nom'] = $nom;
			$_SESSION['pass'] = $mdp;
			$_SESSION['civilite'] = $civilite;
                        $_SESSION['securite'] = $niveau_securite;
			$message = '<script language="javascript">document.location.href="./modules/index.php?page=contenu"</script>';
			header("Location:./modules/index.php?page=contenu");
		}

	}
} else {
	$message = "";
}

?>
<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />

		<title>Bienvenue dans les pages d'administration</title>

		<link href="./styles/administration.css" rel="stylesheet" type="text/css" media="screen"/>

	</head>

	<body id="index">

		<div id="filigrane"></div>


		<form action="<?php echo $page; ?>" method="post" >

				<?php echo $message; ?>
				
			<input type="hidden" name="soumis" value="TRUE" />

				<div>
					<label for="nom">Votre nom de connexion : &nbsp;</label>
					<input id="nom" name="nom" type="text"/>
				</div>

				<div>
					<label for="mdp">Votre mot de passe : &nbsp;</label>
					<input id="mdp" name="mdp" type="password" />
				</div>

				<input id="bouton" type="submit" value="Se connecter"/>

		</form>



	</body>

</html>