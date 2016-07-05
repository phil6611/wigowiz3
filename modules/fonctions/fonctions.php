<?php
/*
// changement de langue
if(isset($_GET['change_lang'])){
$_SESSION['langue']=$_GET['change_lang'];
?>
<script language="JavaScript">history.back();</script>
<?php
}

if(!isset($_SESSION['langue'])){
	$Langue = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$Langue = strtolower(substr(chop($Langue[0]),0,2));
	if(file_exists("config/lang_".$Langue.".php"))
		{
		$_SESSION['langue']=$Langue;
		}else{
		$_SESSION['langue']='fr';
		}
}

$SITE_nom_site = "http://wigowiz.addicterra.fr";
$SITE_cle_API = "ABQIAAAAMvNbLLvoGhzqOREPiPsaHxRxYxYX5YKmJq66ZdUYu_avBVBsOBS3zH1XkWTVJthv87PH5nLg0BzMyg";


   function email_ok ($email) { 
   $Syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#' ; 
   if(preg_match($Syntaxe,$email)) 
   { return true; } else { return false; }
    }


   function email_exist ($email) { 
mysql_connect('','','');
mysql_select_db('');
  $cherche=mysql_query("select email_participant from participants where email_participant='$email' and motdepasse!=''");
	if(mysql_num_rows($cherche)>0)   { return true; } else { return false; }
mysql_close();

  }

function format_tel($tel)
{
	if($_SESSION['langue']=='fr'){
	$tel = ereg_replace("[^0-9]","",$tel);
	$tel = wordwrap ($tel, 2, ' ', 1);
	}
return $tel;
}

function nom_complet($participant){
	$part=mysql_query("select id_participant, prenom_participant,nom_participant from participants where id_participant='".$participant."'");
	$lepart=mysql_fetch_array($part);
	return $lepart['prenom_participant']." ".$lepart['nom_participant'];
}

function nom_evenement($evenement){
	$part=mysql_query("select id_evenement, titre, code from evenements where id_evenement='".$evenement."'");
	$lepart=mysql_fetch_array($part);
	return "<a href='carte.php?m=".$lepart['code']."'>".$lepart['titre']."</a>";
}


function supprime_accents($string){
	return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}


$entete="Content-Type:text/html;charset=iso-8859-1\n";
$entete.="Content-Transfer-Encoding: 8bit\n";
$entete .= "From: Wigowiz<philippe@philippe-poisse.eu>".chr(10); 	
$entete .= "X-Sender: <philippe@philippe-poisse.eu>".chr(10);
$entete .= "X-Mailer: PHP".chr(10);
$entete .= "X-Priority: 3".chr(10);
$entete .= "Return-Path: <philippe@philippe-poisse.eu>".chr(10);
$entete .= "Reply-To: contact@wigowiz.com\r\n";

$entete_texte="Content-Type:text/plain;charset=iso-8859-1\n";
$entete_texte.="Content-Transfer-Encoding: 8bit\n";
$entete_texte .= "From: Wigowiz<contact@wigowiz.com>".chr(10); 	
$entete_texte .= "X-Sender: <contact@wigowiz.com>".chr(10);
$entete_texte .= "X-Mailer: PHP".chr(10);
$entete_texte .= "X-Priority: 3".chr(10);
$entete_texte .= "Return-Path: <contact@wigowiz.com>".chr(10);
$entete_texte .= "Reply-To: contact@wigowiz.com\r\n";


//Gestion des message d'erreur pour le fichier de  langue
if (!isset($_SESSION['evenement'])){
    $_SESSION['evenement']['titre'] = NULL;
    $_SESSION['evenement']['date_evenement'] = NULL;
    $_SESSION['evenement']['code_admin'] = NULL;
    $_SESSION['evenement']['code'] = NULL;
    $_SESSION['evenement']['prenom'] = NULL;
    $_SESSION['evenement']['nom'] = NULL;
}

if (!isset($_POST['prenom_participant']) || !isset($_POST['nom_participant'])){
    $_POST['prenom_participant'] = NULL;
    $_POST['nom_participant'] = NULL;
}
?>
*/