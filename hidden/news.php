<?php 
	session_start ();
	$login_admin="admin";
	$pswd_admin="admin";

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=jema', 'root', '');
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}
	$bdd->exec('SET NAMES utf8');
	$bdd->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$req = $bdd->query('SELECT * FROM news WHERE id='.$_GET['id']);
	$new=$req->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="language" content="fr" />
  <meta name="description" content="" />
  <title>JEMA - Junior Etude Montpellier Agro - <?php echo $new['title'];?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../scripts/index.js"></script>
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
	            <li class="branding-container"><a id="branding" href="../index.php"><img class="logo" src="../media/images/nav_branding.png" alt="Logo de la JEMA"><img class="branding" src="../media/images/logo.png" alt="Branding de la JEMA"></a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a href="student.php">Étudiants</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a href="company.php">Entreprises</a></li>
	          </ul>
	          	<ul class="nav navbar-nav navbar-right">
					<?php 
						if(isset($_SESSION['login'])){	
					?>
						<li id="disconnect"><a href="disconnect.php">Déconnexion</a></li>
					<?php 
						}
					?>
					<li id="plaquette"><a class="plaquette" href="../contact.php">Plaquette</a></li>
				</ul>
	        </div>
		</nav>

		<section class="main-content">
			<div class="news-content">
				<h4><a href="../student.php#news"><span class="glyphicon glyphicon-arrow-left"></span> Retour aux actualités</a></h4>
				<?php 
	            	if(isset($_SESSION['login'])){	
	            ?>
				<a href="news.php?action=delete&id=<?php echo $new['id']; ?>"><span class="glyphicon glyphicon-trash"></span></a><a href="news.php?action=modif&id=<?php echo $new['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a>
	            <?php 
	            	}
	            ?>
	            <?php 
	            	if(isset($_GET['action'])){
	            		if($_GET['action']=="delete"){
	            			if(isset($_SESSION['login'])){

	            ?>
				<div class="has-warning">
					<span class="help-block">Voulez-vous vraiment supprimer l'actualité suivante ? Cette action est définitive.</span>
					<a href="news.php?action=deletedef&id=<?php echo $new['id']; ?>">Confirmer la suppression</a>
				</div>
	            <?php 
	            			}
	            			else{
								echo '<body onLoad="alert(\'Vous devez être connecté pour effectuer cette action\')">';
	            			}
	            		}
	            		elseif($_GET['action']=="deletedef"){
	            			if(isset($_SESSION['login'])){
	            				$bdd->query('DELETE FROM news WHERE id='.$new['id']);
								echo '<body onLoad="alert(\'Actualité bien supprimée.\')">';
								echo '<meta http-equiv="refresh" content="0;URL=../student.php#news">';
	            			}
	            			else{
								echo '<body onLoad="alert(\'Vous devez être connecté pour effectuer cette action\')">';
	            			}
	            		}	
	            	}
	            ?>
				<h1><?php echo $new['title'];?></h1>
				<h5><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></h5>
				<p><?php echo $new['content'];?></p>
				<img src="../media/images/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
			</div>
		</section>

		<footer class="footer text-center">
			<div class="footer-contact col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<a href="contact.php">Nous contacter</a>
				<p class="adresse">Junior Étude Montpellier Agro, <br>2 place Pierre Viala, <br>34060 Montpellier Cedex 02</p>
				<p class="mail">jema@supagro.fr</p>
				<a href="mentions.php">Mentions légales</a>
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
					<li><img src="../media/images/BNP-logo.png" alt="Logo BNP Parisbas"></li>
					<li><img src="../media/images/AV-logo.png" alt="Logo AgroValo"></li>
					<li><img src="../media/images/EMA-logo.png" alt="Logo Emagine"></li>
					<li><img src="../media/images/ALU-logo.png" alt="Logo SupAgro Alumni"></li>
					<li><img src="../media/images/JE-logo.png" alt="Logo Junior-entreprises"></li>
					<li><img src="../media/images/EPF-logo.png" alt="Logo EPF Projets"></li>
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
					<li><img src="../media/images/fb-icon.png" alt="Icône Facebook"></li>
					<li><img src="../media/images/tw-icon.png" alt="Icône Twitter"></li>
					<li><img src="../media/images/lk-icon.png" alt="Icône Linkedin"></li>
					<li><img src="../media/images/ml-icon.png" alt="Icône Mail"></li>
				</ul>
			</div>
			<div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p>Copyright © 2018 JEMA – Junior Etude Montpellier Agro Tous droits réservés.</p>
			</div>
		</footer>

	</div>

</body>