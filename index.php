<?php 
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	require_once('config/config.php');
	require_once('config/pdo.php');
	require_once('config/util.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="language" content="fr" />
	<meta name="description" content="Vous êtes professionnel ou étudiant ? Découvrez la Junior Etude Montpellier Agro" />
	<title>JEMA - Junior Etude Montpellier Agro - Cultivons votre réussite</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/navbar.css">
	<link rel="stylesheet" href="assets/css/footer.css">
	<link rel="stylesheet" href="assets/css/index.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.parallax-1.1.3.js"></script>
	<script type="text/javascript" src="assets/js/loader.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script type="text/javascript" src="assets/js/index.js"></script>
</head>

<body>

	<div class="loader"></div>
	<div class="anchor-top"><a class="scrollspy" href="#top">Retour en haut</a></div>

	<div id="top" class="container-fluid">

		<nav class="navbar navbar-default navbar-fixed-top">
        	<div class="navbar-header">
				<button type="button" class="navbar-toggle">
					<span class="lines"></span>
				</button>
	        </div>
			<div class="collapse-cache"></div>
	        <div class="collapse navbar-collapse">
				<div class="branding-container"><a href="accueil"><img src="media/images/nav_branding.png" alt="Logo de la JEMA"></a></div>
				<ul class="nav navbar-nav">
					<li class="menu-title"><a>Menu</a></li>
					<li class="main-link">
						<a>Vous êtes... <span class="glyphicon glyphicon-menu-down"></span></a>
						<ul>
							<li><a href="etudiant">Étudiant</a></li>
							<li><a href="company.php">Professionnel</a></li>
						</ul>
					</li>
					<li id="devis"><a href="company.php#devis">Demander un devis</a></li>
					<li id="plaquette"><a href="media/images/plaquette.png" onclick="window.open(this.href); return false;"><span>Notre plaquette</span><span>Plaquette</span></a></li>
				</ul>
	        </div>
		</nav>

		<div class="social-nav">
			<a href="https://www.facebook.com/JEMontpellierAgro/" onclick="window.open(this.href); return false;"></a>
			<a href="https://twitter.com/jemamontpellier?lang=fr" onclick="window.open(this.href); return false;"></a>
			<a href="https://fr.linkedin.com/company/jema-junior-%C3%A9tude-montpellier-supagro" onclick="window.open(this.href); return false;"></a>
			<a href="contact" onclick="window.open(this.href); return false;"></a>
		</div>

		<header class="header">
			<!--<div class="last-news">
				<p><strong>Dernière news (29/04/2018) :</strong> Nouveau site pour la JEMA ! [...] <a href="news.php">Voir plus...</a></p>
			</div>-->
			<div class="main-title text-center">
				<h1>Cultivons votre réussite</h1>
				<h2>Junior-Étude Montpellier Agro</h2>
				<a href="#about" class="scrollspy"></a>
			</div>
		</header>

		<div class="main-content">
			<?php 
				$req = $bdd->query('SELECT * FROM news WHERE id=(SELECT MAX(id) FROM news)');
				$last_new=$req->fetch(PDO::FETCH_ASSOC);
			?>
			<!--<div class="last-news text-center">
				<p><strong>Dernière actualité (<?php echo $last_new['date']; ?>) :</strong> <?php echo $last_new['title']; ?> [...] <a href="student.php#news" class="scrollspy">Voir plus...</a></p>
			</div>-->
			<section id="about" class="about">
				<div class="content">
					<div class="header">
						<h2>Bienvenue sur le site de la JEMA</h2>
					</div>
					<h3>Mais tout d'abord, qu'est-ce que la JEMA ?</h3>
					<p>La JEMA (Junior Etude Montpellier Agro) est la Junior-Entreprise de Montpellier Supagro. Elle  a été fondée en 2009 à l’initiative d’Audrey Tardieu, étudiante de Montpellier Supagro, qui avait pour projet de créer une structure professionnelle gérée par des étudiants de l’école, à l’image d’une Junior-Entreprise. Son but était de permettre aux élèves de se familiariser avec le monde de l’entreprise dès leur intégration dans l’école.</p>

					<h3>Et depuis ?</h3>
					<p>Depuis 2009, la JEMA ne cesse de s’améliorer en s’appuyant sur des partenaires de confiance comme AgroValo Méditerranée et Montpellier SupAgro Alumni. Ces derniers contribuent vivement à l’amélioration du fonctionnement de la JEMA par leurs conseils et leur implication. Aujourd’hui la JEMA compte une vingtaine de membres actifs et plus de 350 adhérents.</p>
					<ul class="actions">
						<li>
							<a href="#school" class="scrollspy button-2">En savoir plus sur notre école</a>
							<a href="#CNJE" class="scrollspy button-2">En savoir plus sur les JE</a>
						</li>
					</ul>
				</div>
			</section>
			<div class="redirection">
				<article class="student">
					<a href="etudiant">
						<h2>Vous êtes étudiant ?</h2>
						<div class="content">
							<span class="big-glyphicon glyphicon glyphicon-education"></span>
							<p>Vous cherchez à participer à une étude ?</p>
							<p>Vous voulez avoir une première expérience dans le milieu professionnel et valorisable sur votre CV, tout en étant rémunéré ?</p>
							<p>Vous souhaitez intégrer la JEMA en tant que membre actif ?</p>
							<p class="redirect-button">Découvrez notre section étudiante !<span class="big-glyphicon glyphicon glyphicon-arrow-right"></span></p>
						</div>
					</a>
				</article>
				<article class="company">
					<a href="company.php">
						<h2>Vous êtes un professionnel ?</h2>
						<div class="content">
							<span class="big-glyphicon glyphicon glyphicon-briefcase"></span>
							<p>Vous souhaitez réaliser un projet dans le domaine de l’agriculture, l’agroalimentaire ou de l’environnement ?</p>
							<p>Vous voulez faire appel à des étudiants dynamiques et motivés ?</p>
							<p>Vous souhaitez avoir la garantie d'un résultat professionnel ?</p>
							<p class="redirect-button">Découvrez notre section professionnelle !<span class="big-glyphicon glyphicon glyphicon-arrow-right"></span></p>
						</div>
					</a>
				</article>
			</div>
			<section id="school" class="about school">
				<div class="content">
					<div class="header">
						<h2>Notre école</h2>
					</div>
					<h3>Montpellier SupAgro en quelques mots</h3>
					<p>Montpellier SupAgro est une école d’ingénieur en agronomie intégrée à l'INRA, reconnue comme pôle scientifique mondial de premier plan en agriculture, alimentation et environnement. Largement ouvert sur la Méditerranée et les pays du Sud, l’école s’inscrit dans une longue tradition d’ouverture à l’international.</p>
					<span class="image-container">
						<img class="image" src="media/images/school.jpg" alt="Montpellier Supagro">
					</span>
					<p>Attachée à assurer un continuum entre formation, recherche et innovation, Montpellier SupAgro bénéficie de l'expérience et des compétences des enseignants-chercheurs et de la communauté scientifique afin de s’adapter à l'évolution des connaissances et des métiers.</p>
					<ul class="actions">
						<li>
							<a href="https://www.montpellier-supagro.fr/" class="button-2" onclick="window.open(this.href); return false;">Accéder au site de l'école</a>
						</li>
					</ul>
				</div>
			</section>
			<section id="school" class="school-numbers">
				<div class="header">
					<h2>Montpellier SupAgro en quelques chiffres</h2>
				</div>
				<div class="numbers">
					<div><span class="count">3</span><h3>Unités mixtes technologiques</h3></div>
					<div><span class="count">22</span><h3>Unités mixtes de recherche</h3></div>
					<div><span class="count">80</span><h3>Enseignants chercheurs</h3></div>
					<div><span class="count">1650</span><h3>Étudiants en formation diplômante</h3></div>
				</div>
			</section>
			<section id="CNJE" class="about cnje">
				<div class="content">
					<div class="header">
						<h2>Le concept Junior-Entreprise</h2>
					</div>
					<h3>Qu'est-ce que la CNJE ?</h3>
					<div class="image-container">
						<img class="image" src="media/images/logos/JE-logo.png" alt="Logo Junior-Entreprise">
					</div>
					<p>La Confédération Nationale des Junior-Entreprises (CNJE) est une association régie par la loi du 1er juillet 1901 et le décret du 16 août 1901. La CNJE a plusieurs vocations :</p>
				</div>
				<div class="features">
					<article>
						<span class="icon fa-line-chart"></span>
						<div class="content">
							<h3>Développer</h3>
							<p>Développer le mouvement des Junior-Entreprises, notamment par l’accueil de nouvelles associations, la communication dans les établissements d’enseignement supérieur et hors de nos frontières.</p>
						</div>
					</article>
					<article>
						<span class="icon fa-book"></span>
						<div class="content">
							<h3>Former</h3>
							<p>Former et accompagner les Junior-Entreprises afin d’assurer à leurs clients un bon niveau de qualité, notamment par l’audit des prestations, la réalisation et la mise en application de la Charte de Déontologie du mouvement, la mise à disposition d’outils et de sessions de formation.</p>
						</div>
					</article>
					<article>
						<span class="icon fa-thumbs-up"></span>
						<div class="content">
							<h3>Promouvoir</h3>
							<p>Promouvoir le concept et la marque Junior-Entreprise, le profil de Junior-Entrepreneur et l’esprit d’entreprendre.</p>
						</div>
					</article>
					<article>
						<span class="icon fa-rss"></span>
						<div class="content">
							<h3>Diffuser</h3>
							<p>Organiser et diffuser les partages de savoirs et retours d’expérience, d’animer et fédérer l’ensemble des membres actifs et associés, notamment autour d’événements régionaux comme nationaux.</p>
						</div>
					</article>
					<article>
						<span class="icon fa-group"></span>
						<div class="content">
							<h3>Mettre en avant ses valeurs</h3>
							<p>Assurer que l’esprit d’entreprise partagé et véhiculé par les membres actifs et associés est le moteur d’un engagement individuel et d’un sens des responsabilités collectif.</p>
						</div>
					</article>
				</div>
				<ul class="actions">
					<li>
						<a href="http://junior-entreprises.com/" class="button-2" onclick="window.open(this.href); return false;">En savoir plus sur la CNJE</a>
					</li>
				</ul>
			</section>
		</div>

		<?php include_once('templates/footer.php'); ?>

	</div>

</body>
</html>