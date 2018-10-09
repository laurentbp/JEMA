<?php 
	session_start ();

	/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
	*/

	$login_admin="admin";
	$pswd_admin="admin";

	/*
	 ********************************************************************************************
	 FIN DE LA CONFIGURATION
	 ********************************************************************************************
	*/

	 /*
	* cette fonction sert à nettoyer et enregistrer un texte
	*/
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}

		$text = nl2br($text);
		return $text;
	};

	if(isset($_POST['log'])){
		$login     = (isset($_POST['login']))     ? Rec($_POST['login'])     : '';
		$pswd     = (isset($_POST['password']))     ? Rec($_POST['password'])     : '';
		if($login==$login_admin && $pswd==$pswd_admin){
			$_SESSION['login']=$login;
			echo '<body onLoad="alert(\'Bienvenue, Administrateur !\')">';
		}
		else{
			echo '<body onLoad="alert(\'Identifiants non reconnus...\')">';
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="language" content="fr" />
  <meta name="description" content="" />
  <title>JEMA - Junior Etude Montpellier Agro - Cultivons votre réussite</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="scripts/loader.js"></script>
  <script src="scripts/index.js"></script>
</head>

<body>

	<div class="loader"></div>

	<div class="container-fluid">

		<div class="windows-size-check"></div>

		<nav class="navbar navbar-default navbar-fixed-top">
        	<div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <div class="branding-container"><a id="branding" href="index.php"><img class="logo" src="media/images/nav_branding.png" alt="Logo de la JEMA"><img class="branding" src="media/images/logo.png" alt="Branding de la JEMA"></a></div>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
	            <li class="nav-links nav-main-link nav-main-link-hover"><span class="main-link-background"></span><a href="student/student.php">Étudiants</a></li>
	            <li class="nav-links nav-main-link nav-main-link-hover"><span class="main-link-background"></span><a href="company/company.php">Entreprises</a></li>
	          </ul>
	          	<ul class="nav navbar-nav navbar-right">
					<li id="social-nav">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</li>
					<?php 
						if(isset($_SESSION['login'])){	
					?>
						<li id="disconnect"><a href="disconnect.php">Déconnexion</a></li>
					<?php 
						}
					?>
					<li id="devis"><a class="plaquette" href="company.php#devis">Devis</a></li>
					<li id="plaquette"><a class="plaquette" href="../contact.php">Plaquette</a></li>
				</ul>
	        </div>
		</nav>

		<header>
			<div class="last-news">
				<p><strong>Dernière news (29/04/2018) :</strong> Nouveau site pour la JEMA ! [...] <a href="news.php">Voir plus...</a></p>
			</div>
			<div class="main-title-border">
				<div class="main-title text-center">
					<h1>Cultivons votre réussite</h1>
					<h2>Junior-Étude Montpellier Agro</h2>
					<!--<img src="media/images/logo.png" alt="Logo de la JEMA">-->
				</div>
			</div>
			<div class="header-blank"></div>
		</header>

		<section id="redirect" class="main-content">
			<div class="arrow-bottom">
				<a class="scrollspy" href="index.php#redirect">Faire défiler <span class="glyphicon glyphicon-arrow-down"></span></a>
			</div>
			<div class="text-center student-redirection student-redirection-hover">
				<a href="student.php">
					<div class="left-student">
						<h4>Étudiant</h4>
						<span class="big-glyphicon glyphicon glyphicon-education"></span>
						<p>Vous cherchez à participer à une étude ?</p>
						<p>Vous voulez vous faire un peu d'argent tout en travaillant pour le compte de grandes entreprises ?</p>
						<p>Vous souhaitez intégrer la JEMA en tant que membre actif ?</p>
					</div>
					<div class="right-student">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</div>
				</a>
			</div>
			<div class="text-center company-redirection company-redirection-hover">
				<a href="company.php">
					<div class="left-company">
						<h4>Professionnel</h4>
						<span class="big-glyphicon glyphicon glyphicon-briefcase"></span>
						<p>Vous cherchez une étude dans le domaine de l'agronomie ?</p>
						<p>Vous disposez d'un budget trop serré pour faire appel à un bureau d'étude ?</p>
						<p>Vous souhaitez avoir la garantie d'un résultat professionnel ?</p>
					</div>
					<div class="right-company">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</div>
				</a>
			</div>
			<div id="about" class="rubrique about">
				<div class="about-redirection"><div><a class="redirection scrollspy-minus active" href="index.php#about">Qu'est-ce que la JEMA ?</a></div></div>
				<div class="description">
					<div class="description-container">
						<p>Fondée en 2009, la <span class="big-letter">J</span>unior <span class="big-letter">E</span>tude <span class="big-letter">M</span>ontpellier <span class="big-letter">A</span>gro est une association d'étudiants réalisant des études d'agronomie pour des entreprises.</p>
						<p>Le but initial était de familiariser les étudiants avec le monde de l'entreprise. Depuis, des clients comme l'INRA, Montpellier SupAgro ou le CEMAGREF ont fait appel à nos services.</p>
						<p>Pour poursuivre votre visite, veuillez cliquer sur l'une des deux rubriques <a class="scrollspy" href="index.php#redirect">ci-dessus <span class="glyphicon glyphicon-arrow-up"></span></a> ! Pour plus d'informations sur notre école, veuillez poursuivre <a class="scrollspy" href="index.php#school">ci-dessous <span class="glyphicon glyphicon-arrow-down"></span></a></p>
					</div>
					<img src="media/images/team.jpg" alt="Équipe de la JEMA">
				</div>
			</div>
			<img class="separator" src="media/images/nav_branding.png" alt="Logo de la JEMA">
			<div class="our-school" id="school">
				<img src="media/images/school.jpg" alt="École de Montpellier Supagro">
				<div class="our-school-container">
					<h3>Notre école</h3>
					<p><span class="big-letter">M</span>ontpellier <span class="big-letter">S</span>upAgro est un centre international d’études supérieures en sciences agronomiques, établissement public à caractère scientifique culturel et professionnel (EPSCP).</p>
					<p>Il est sous la tutelle du Ministère de l’agriculture, de l’agroalimentaire, et de la forêt et a la particularité d’être largement ouvert sur la Méditerranée et les pays du Sud.</p>
					<p class="minus-text"><img src="media/images/SUPA-logo.png" alt="Logo de Montpellier Supagro">Pour plus d’informations : <a href="http://www.supagro.fr">http://www.supagro.fr</a></p>
				</div>
			</div>
		</section>

		<div id="admin-container" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Accès aux outils administrateur</h4>
					</div>
					<div class="modal-body">
						<h1>Connexion</h1>
						<form method="post" action="">
							<div class="form-group">
								<input class="form-control" id="login" type="text" name="login" placeholder="Identifiant" tabindex="10"/>
							</div>
							<div class="form-group">
								<input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe" tabindex="11"/>
								<input class="form-control" id="url" type="hidden" name="url" value="student" />
							</div>
							<button class="btn btn-md btn-default submit_form" name="log" type="submit">Se connecter</button>
						</form>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>

		<footer class="footer text-center">
			<div class="footer-contact col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<a href="contact.php">Nous contacter</a>
				<p class="adresse">Junior Étude Montpellier Agro, <br>2 place Pierre Viala, <br>34060 Montpellier Cedex 02</p>
				<p class="mail">jema@supagro.fr</p>
				<img class="footer-school" src="media/images/SUPA-logo.png" alt="Logo de Montpellier Supagro">
				<a href="mentions.php">Mentions légales</a>
				<?php 
					if(!isset($_SESSION['login'])){
				?>
				<p><a data-toggle="modal" data-target="#admin-container" href="#">Administration</a></p>
				<?php
					}
					else{
				?>
				<p><a href="disconnect.php">Déconnexion</a></p>
				<?php
					}
				?>
			</div>
			<div class="footer-navigate col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<a href="plan.php">Plan du site</a>
				<ul>
					<li><a href="index.php">Page d'accueil</a></li>
					<li><a href="student.php">Étudiants</a></li>
					<li><a href="company.php">Professionnels</a></li>
					<li><a href="company.php#about">Qui sommes-nous ?</a></li>
					<li><a href="company.php#skills">Nos compétences</a></li>
					<li><a href="company.php#engagement">Nos engagements</a></li>
					<li><a href="newsletter.php">Newsletter</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
			<div class="footer-partners col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<a href="partenaires.php">Nos partenaires</a>
				<ul class="partners">
					<li><img src="media/images/BNP-logo.png" alt="Logo BNP Parisbas"></li>
					<li><img src="media/images/AV-logo.png" alt="Logo AgroValo"></li>
					<li><img src="media/images/EMA-logo.png" alt="Logo Emagine"></li>
					<li><img src="media/images/ALU-logo.png" alt="Logo SupAgro Alumni"></li>
					<li><img src="media/images/JE-logo.png" alt="Logo Junior-entreprises"></li>
					<li><img src="media/images/EPF-logo.png" alt="Logo EPF Projets"></li>
				</ul>
				<ul class="mobile-partners">
					<li>BNP Paribas</li>
					<li>AgroValo</li>
					<li>Emagine</li>
					<li>SupAgro Alumni</li>
					<li>Junior-Entreprises</li>
					<li>EPF Projets</li>
				</ul>
			</div>
			<div class="footer-reseaux col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<ul>
					<li><img src="media/images/fb-icon.png" alt="Icône Facebook"></li>
					<li><img src="media/images/tw-icon.png" alt="Icône Twitter"></li>
					<li><img src="media/images/lk-icon.png" alt="Icône Linkedin"></li>
					<li><img src="media/images/ml-icon.png" alt="Icône Mail"></li>
				</ul>
			</div>
			<div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p>Copyright © 2018 JEMA – Junior Etude Montpellier Agro Tous droits réservés.</p>
			</div>
		</footer>

	</div>

</body>