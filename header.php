<!-- Début du header -->
<div id="header">
	<div id="logo">
		<a href="index.php"><img src="images/logo.png" alt="Your-Voc" title="Your-Voc" /></a>
	</div>

	<div id="menu">
		<div id="url">		
		<a href="?page=accueil">Accueil</a>
		<?php if(isset($_SESSION['login'])) { ?>		
		<a href="?page=membre">Espace Membre</a>
		<a href="?page=gerer_listes">Vos listes</a>
		<a href="?page=gerer_public">Toutes les listes</a>
		<a href="?page=contact">Contact</a>
		<a href="?page=deconnexion">Déconnexion</a>
		 <?php } else { ?>
		<a href="?page=gerer_public">Toutes les listes</a>
		<a href="?page=categories">Catégories</a>
		<a href="?page=connexion">Connexion</a>
		<a href="?page=inscription">Inscription</a>
		<a href="?page=contact">Contact</a>
		<?php } ?>
		</div>
	</div>
</div>
<!--Fin du header !-->
<?php
	 // Le mec n'est pas connecté mais les cookies sont là, on y va !
if (!isset($_SESSION['login']) && !empty($_COOKIE['id']) && !empty($_COOKIE['connexion_auto']))
{
	$id_auto = $_COOKIE['id'];
	$requete = mysql_query('SELECT * FROM membre WHERE id="'.$id_auto.'"');
	$infos_utilisateur = mysql_fetch_array($requete);
	
	if (false !== $infos_utilisateur)
	{
		$navigateur = (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$hash = sha1('yes'.$infos_utilisateur['login'].'set'.$infos_utilisateur['pass_md5'].'treb'.$navigateur.'crac');
		
		if ($_COOKIE['connexion_auto'] == $hash)
		{
			// On enregistre les informations dans la session
			$_SESSION['login'] = $infos_utilisateur['login'];
		}
	}
}
?>