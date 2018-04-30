<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="language" content="fr" />
  <meta name="description" content="" />
  <title>JEMA - Junior-Entreprise Montpellier supAgro</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="scripts/index.js"></script>
</head>

<body>

	<div class="container-fluid">

		<nav class="navbar navbar-default navbar-fixed-top">
        	<div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
	            <li class="nav-links nav-secondary-link"><span class="secondary-link-background"></span><a href="student.php#faq">Participer à une étude</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a href="student.php">Étudiants</a></li>
	            <li class="branding-container"><a id="branding" href="index.php"><img src="media/images/nav_branding.png" alt="Branding de la JEMA"></a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a href="company.php">Entreprises</a></li>
	            <li class="nav-links nav-secondary-link"><span class="secondary-link-background"></span><a href="company.php#devis">Demander un devis</a></li>
	          </ul>
	        </div>
	        <a class="contact" href="contact.php">Contact</a>
		</nav>

		<header>
			<div class="last-news">
				<p><strong>Dernière news (29/04/2018) :</strong> Nouveau site pour la JEMA ! [...] <a href="news.php">Voir plus...</a></p>
			</div>
			<div class="main-title-border">
				<div class="main-title text-center">
					<h1>Jema</h1>
					<h2>Cultivons votre réussite</h2>
				</div>
			</div>
			<div  id="about" class="arrow-bottom">
				<a class="scrollspy" href="index.php#about"><span class="glyphicon glyphicon-arrow-down"></span></a>
			</div>
		</header>

		<div class="main-content text-center">
			<div class="rubrique about">
				<h2>Êtes-vous...</h2>
				<div class="student-redirection col-lg-6 col-md-6 col-sm-6">
					<h4>...Un étudiant ?</h4>
					<span class="glyphicon glyphicon-education"></span>
					<p>Vous cherchez à participer à une étude ? Vous voulez vous faire un peu d'argent tout en travaillant pour le compte de grandes entreprises ? Vous souhaitez intégrer la JEMA en tant que membre actif ?</p>
					<p>Alors <a href="student.php">cliquez ici !</a></p>
				</div>
				<div class="company-redirection col-lg-6 col-md-6 col-sm-6">
					<h4>...Une entreprise ?</h4>
					<span class="glyphicon glyphicon-briefcase"></span>
					<p>Vous cherchez à participer à une étude ? Vous voulez vous faire un peu d'argent tout en travaillant pour le compte de grandes entreprises ? Vous souhaitez intégrer la JEMA en tant que membre actif ?</p>
					<p>Alors <a href="company.php">cliquez ici !</a></p>
				</div>
			</div>
		</div>

		<footer>
		</footer>

	</div>

</body>