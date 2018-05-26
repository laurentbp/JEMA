<?php 
	session_start ();

	/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
	*/
	// destinataire est votre adresse mail.
	$destinataire = 'jema@supagro.fr';

	// copie ? (envoie une copie au visiteur)
	$copie = 'no';

	$login_admin="admin";
	$pswd_admin="admin";
	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'JPG', 'JPEG', 'GIF', 'PNG');

	/*
	 ********************************************************************************************
	 FIN DE LA CONFIGURATION
	 ********************************************************************************************
	*/

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


   /*
    * Cette fonction sert à vérifier la syntaxe d'un email
    */
   function IsEmail($email)
   {
     $value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
     return (($value === 0) || ($value === false)) ? false : true;
   }

	$news_title     = (isset($_POST['title']))     ? Rec($_POST['title'])     : '';
	$news_content     = (isset($_POST['content']))     ? Rec($_POST['content'])     : '';
	if(isset($_FILES['image'])) $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
	else $extension_upload = '';
	$err_title=0;
	$err_content=0;
	$err_image=0;
	$err_extension=0;
	$err_size=0;

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
	elseif(isset($_POST['news'])){
		if($news_title!="" && $news_content!="" && $_FILES['image']['error'] <= 0 && in_array($extension_upload,$extensions_valides) && $_FILES['image']['size']<=5242880){
			$image_name="upload/".md5(uniqid(rand(), true));
			$image_path="media/images/".$image_name;
			if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
				$req=$bdd->prepare("INSERT INTO news VALUES (?,?,?,CURRENT_TIMESTAMP,?)");
				$req->execute(array(NULL,$news_title,$news_content,$image_name));
			echo '<body onLoad="alert(\'Actualité bien publiée.\')">';
			}
			else{
				echo '<body onLoad="alert(\'Erreur dans le téléversement du fichier, veuillez réessayer svp\')">';
			}
		}
		else
		{
			if($news_title == '') $err_title=1;
			if($news_content == '') $err_content=1;
			if($_FILES['image']['error'] > 0) $err_image=1;
			if(!in_array($extension_upload,$extensions_valides)) $err_extension=1;
			if($_FILES['image']['size']>5242880) $err_size=0;
		};
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="language" content="fr" />
  <meta name="description" content="" />
  <title>JEMA - Junior Etude Montpellier Agro - Entreprises</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles/company.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="scripts/company.js"></script>
  <script src="scripts/pagination.js"></script>
</head>

<body>

	<div class="container-fluid">

  	  <div class="nav-indicator-background"></div>
  	  <div class="nav-indicator"></div>

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
	            <li class="branding-container"><a id="branding" href="index.php"><img src="media/images/nav_branding.png" alt="Branding de la JEMA"></a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="company.php#about">Qui sommes-nous ?</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="company.php#faq">Nos compétences</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="company.php#member">Nos engagements</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="company.php#devis">Demander un devis</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="company.php#news">Actualités</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="company.php#contact">Contact</a></li>
	          </ul>
	            <ul class="nav navbar-nav navbar-right">
		          	<li id="social-nav">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</li>
		            <li class=""><span class="main-link-background"></span><a class="" href="index.php">Retour à l'accueil</a></li>
		            <?php 
		            	if(isset($_SESSION['login'])){	
		            ?>
	            	<li class=""><a href="disconnect.php">Déconnexion</a></li>
		            <?php 
		            	}
		            ?>
	            </ul>
	        </div>
		</nav>

		<header>
			<div class="last-news text-center">
				<p><strong>Dernière actualité (29/04/2018) :</strong> Nouveau site pour la JEMA ! [...] <a href="hidden/news.php">Voir plus...</a></p>
			</div>
			<div class="video-container">
				<iframe width="800" height="450" src="https://www.youtube.com/embed/G5LKjCbbOig?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
			<div class="arrow-bottom">
				<a class="scrollspy" href="index.php#about">Faire défiler <span class="glyphicon glyphicon-arrow-down"></span></a>
			</div>
			<div class="header-blank"></div>
		</header>

		<section class="main-content text-center">
			<div id="about" class="rubrique about-container">
				<div class="about-titles">
					<ul>
						<li><h2 class="team-title"><span class="big-letter">L</span>'équipe</h2></li>
						<li class="active-title"><h2 class="about-title"><span class="big-letter">Q</span>ui sommes-nous ?</h2></li>
						<li><h2 class="history-title"><span class="big-letter">H</span>istorique</h2></li>
					</ul>
				</div>
				<div class="wrapper">
					<div class="team">
						<p>Elle est composée de 23 élèves ingénieurs de Montpellier SupAgro et est renouvelée annuellement suite à une formation de 4 mois auprès de l’équipe précédente.</p>
						<p>Motivés et dynamiques, les membres de la JEMA s’investissent pour que l’association ne cesse de progresser. Ils sont à votre service pour vous fournir les meilleures prestations.</p>
					</div>
					<div class="about-left">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					</div>
					<div class="about-right">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					</div>
					<div class="history">
						<div class="col-lg-5 year">
							<div class="col-lg-6">
								<h3>20</h3>
							</div>
							<div class="col-lg-6">
								<ul>
									<li><h4 class="active-year">09</h4></li>
									<li><h4>15</h4></li>
									<li><h4 class="third">17</h4></li>
									<li><h4 class="fourth">18</h4></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-7 year-description">
							<p class="active-description">La JEMA a été fondée en 2009 à l’initiative d’Audrey Tardieu, étudiante de Montpellier SupAgro, qui avait pour projet de créer une structure professionnelle gérée par des étudiants de l’école, à l’image d’une Junior-Entreprise. Son but était de permettre aux élèves de se familiariser avec le monde de l’entreprise dès leur intégration dans l’école.<br>La première étude, « Etude de positionnement de la production de légumes sous serres à énergie renouvelable en Languedoc-Roussillon » a débuté en décembre 2009, permettant d’embaucher quatre étudiants. Des clients comme l’INRA, Montpellier SupAgro ou le CEMAGREF ont ensuite fait appel à nos services.</p>
							<p>Pépinière Junior-Entreprise au sein de la Confédération Nationale des Junior-Entreprises (CNJE) depuis 2009, la JEMA a obtenu le 25 octobre 2015 le statut de Junior-Entreprise, gage de notre fiabilité et de notre efficacité.</p>
							<p>2017 - 24 membres actifs, 350 adhérents</p>
							<p>2018 - Aujourd'hui</p>
						</div>
					</div>
				</div>
			</div>
			<div class="numbers-container">
				<h2>Quelques chiffres</h2>
				<div class="numbers numbers-adherents"><h3><span class="count">350</span></h3><h4>Adhérents</h4></div>
				<div class="numbers numbers-etudes"><h3><span class="count">9</span></h3><h4>Études en 2014-2015</h4></div>
				<div class="numbers numbers-ca"><h3><span class="count">24402</span> €</h3><h4>Chiffre d'affaires HT en 2015</h4></div>
			</div>
			<div class="rubrique mot-container">
				<div class="col-lg-8 mot">
					<img src="media/images/left-quote.png" class="left-quote" alt="Quote"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat. Quisque nec metus non magna pulvinar porta sit amet quis turpis. Integer id tincidunt tellus, eu tincidunt tortor. Integer vel turpis non augue pulvinar aliquam. Nullam vulputate nisi vel ipsum consequat, vel tempor tellus pellentesque. Nulla et commodo augue. Quisque auctor ullamcorper euismod. Pellentesque pulvinar viverra purus ac sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum non nibh ac tortor semper iaculis.</p><img src="media/images/right-quote.png" class="right-quote" alt="Quote"></span>
				</div>
				<div class="col-lg-4">
					<h2><span class="big-letter">L</span>e mot de la présidente</h2>
					<h3>Mélissa Hoffmann-Bernard</h3> 
				</div>
			</div>
			<div id="faq" class="rubrique skills-container">
				<h2>Nos compétences</h2>
				<h3>Des domaines de compétence variés</h3>
				<div class="skills-container-impair">
					<h4 class="active-skill"><span class="glyphicon glyphicon-thumbs-up"></span><br><div class="skill-text">Communication et marketing</div></h4>
					<h4 class=""><span class="glyphicon glyphicon-glass"></span><br><div class="skill-text">Viticulture et œnologie</div></h4>
					<h4 class=""><span class="glyphicon glyphicon-globe"></span><br><div class="skill-text">Gestion des territoires</div></h4>
					<h4 class="medium-opacity"><span class="glyphicon glyphicon-tree-deciduous"></span><br><div class="skill-text">Gestion du végétal</div></h4>
					<h4 class="low-opacity"><span class="glyphicon glyphicon-apple"></span><br><div class="skill-text">Agroalimentaire</div></h4>
					<h4 class="invisible"><span class="glyphicon glyphicon-piggy-bank"></span><br><div class="skill-text">Élevage</div></h4>
					<h4 class="invisible"><span class="glyphicon glyphicon-certificate"></span><br><div class="skill-text">Agronomie et agroalimentaire au Sud</div></h4>
					<h4 class="invisible"><span class="glyphicon glyphicon-warning-sign"></span><br><div class="skill-text">Gestion des ressources et des risques</div></h4>
				</div>
				
				<h3>Des services adaptés à vos besoins</h3>
				<ul>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Enquête de satisfaction client</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Étude de consommateur ou de marché</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Enquête de lancement de nouveaux produits</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Étude de rentabilité et de faisabilité</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Études bibliographiques</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Conseils en agronomie</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Analyses statistiques</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Business plans</li>
					<li><span class="glyphicon glyphicon-chevron-right"></span> Traductions</li>
				</ul>
				
			</div>
			<div id="member" class="rubrique member-container">
				<div class="member-left col-lg-12">
					<h2><span class="big-letter">N</span>os engagements</h2>
				</div>
				<div class="member-right col-lg-12">
					<h3>Réactivité</h3><p>La JEMA s’engage à vous recontacter sous 8 jours. Son statut d’association lui permet d’être réactive et apporte ainsi rapidement des solutions à la problématique posée.</p>
					<h3>Dynamisme et créativité</h3><p>L’obtention de solutions innovantes dans les domaines agronomiques est optimisée car tous les étudiants embauchés suivent un cursus à Montpellier SupAgro. De plus, leur esprit jeune et créatif, non encore conditionné par la « routine » du monde professionnel est mis en avant.</p>
					<h3>Réseau</h3><p>L’implantation au sein de Montpellier SupAgro apporte trois avantages à la JEMA :</p>
					<p>– L’appui au quotidien des professeurs de Montpellier SupAgro, souvent chercheurs au sein de la fondation Agropolis International, dans la gestion de l’association ou dans l’élaboration de méthodologies d’études particulières</p>
					<p>– La présence d’un vaste vivier d’étudiants à disponibilité. De plus, l’association des Anciens Diplômé soutient notre Junior Etude.</p>
					<p>– L’appartenance à la confédération nationale des juniors entreprises (CNJE), plus grand mouvement étudiant de France, qui nous fait confiance en nous octroyant en novembre 2015 le label « Junior Entreprise ».</p>
					<h3>Professionnalisme</h3>
					<h4>Confidentialité</h4><p>La JEMA s’engage à respecter un niveau de confidentialité à travers une clause signée par tous les chefs de projet et les étudiants embauchés.</p>
					<h4>Transparence</h4><p>Toutes nos études font l’objet d’un contrat, d’un échéancier et d’un suivi hebdomadaire de leur avancée. Un bilan trimestriel est effectué avec notre expert-comptable.</p>
					<h4>Disponibilité</h4><p>La disponibilité des étudiants de la JEMA travaillant sur votre étude est garantie par leur présence sur le campus de Montpellier SupAgro. Ils sont ainsi chaque jour à votre écoute pour répondre à vos questions, en personne ou par entretien téléphonique.</p>
					<h4>Flexibilité, mais respect des délais</h4><p>Nous adaptons au mieux nos méthodologies à vos besoins lors de la phase préparatoire tout en nous engageant à respecter les délais de réalisation de votre étude.</p>
					<h4>Sérieux et rigueur</h4><p>Nos responsables d’études prêtent une attention particulière au recrutement des chefs de projet à travers un entretien d’embauche et leur connaissance des élèves, mais aussi en faisant appel à l’expérience des professeurs.</p>
					<p>De plus, le responsable qualité s’assure du bon déroulement, du sérieux et de la pertinence de l’étude.</p>
					<h4>Prix intéressants</h4><p>Proposant des prix intéressants, nous nous engageons à mobiliser l’ensemble des moyens à notre disposition pour vous fournir des conclusions efficaces et des recommandations respectant les normes de qualité, à haute valeur ajoutée.</p>
					<p>Dans un même temps, une plus-value pédagogique est assurée pour les étudiants recrutés sur leurs domaines de compétences puisque ce travail leur assure la mise en application des connaissances acquises à Montpellier SupAgro et l’apport d’une formation complémentaire dans le cadre de services rendus aux entreprises.</p>
				</div>
			</div>
			<div class="numbers-container trust-container">
				<h2>Ils nous ont fait confiance</h2>
				<div class="trust"><img src="media/images/ALTER-logo.png" alt="Logo Alter'Incub"></div>
				<div class="trust"><img src="media/images/BAYER-logo.png" alt="Logo Bayer"></div>
				<div class="trust"><img src="media/images/ABSO-logo.png" alt="Logo Abso Conseil"></div>
				<div class="trust"><img src="media/images/BAYER-logo.png" alt="Logo Bayer"></div>
				<div class="trust"><img src="media/images/PADFA-logo.png" alt="Logo Padfa"></div>
				<div class="trust"><img src="media/images/SYNG-logo.png" alt="Logo Syngenta"></div>
				<div class="trust"><img src="media/images/NEO-logo.png" alt="Logo Neodis"></div>
				<div class="trust"><img src="media/images/ALU-logo.png" alt="Logo Alumni"></div>
				<div class="trust"><img src="media/images/IRC-logo.png" alt="Logo Supagro IRC"></div>
				<div class="trust"><img src="media/images/INRA-logo.png" alt="Logo INRA"></div>
				<h2>Quelques études</h2>
				<div class="study"><span class="glyphicon glyphicon-ok"></span><p>Standardisation du référencement de 600 vins rosés, analyse des marchés anglais et suédois.</p></div>
				<div class="main-study study"><span class="glyphicon glyphicon-ok"></span><p>Enquête sur les attentes des viticulteurs quant à un stimulateur des défenses naturelles contre le Mildiou.</p></div>
				<div class="study"><span class="glyphicon glyphicon-ok"></span><p>Étude de faisabilité : vente de jus de fruits 100% naturels au Cameroun.</p></div>
			</div>
			<div id="devis" class="rubrique contact-container">
				<h2><span class="big-letter">D</span>emander un devis</h2>
				<h3>Nous traiterons votre demande dans les plus brefs délais</h3>
				<?php

				   // formulaire envoyé, on récupère tous les champs.
				   $nom_devis     = (isset($_POST['nom_devis']))     ? Rec($_POST['nom_devis'])     : '';
				   $entreprise     = (isset($_POST['entreprise']))     ? Rec($_POST['entreprise'])     : '';
				   $email_devis   = (isset($_POST['email_devis']))   ? Rec($_POST['email_devis'])   : '';

				   if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email_devis)) // On filtre les serveurs qui rencontrent des bogues.
				   {
				     $passage_ligne = "\r\n";
				   }
				   else
				   {
				     $passage_ligne = "\n";
				   }

				   $objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
				   $demande_content = (isset($_POST['demande'])) ? Rec($_POST['demande']) : '';
				   $email_confirm = (isset($_POST['email_confirm'])) ? Rec($_POST['email_confirm']) : '';
				   $demande = 'Sender : '.$email_devis.$passage_ligne;
				   $demande .= 'Nom : '.$nom_devis.$passage_ligne;
				   $demande .= 'Entreprise : '.$entreprise.$passage_ligne;
				   $demande .= 'Demande : '.$demande_content.$passage_ligne;

				   $err_nom_devis=0;
				   $err_entreprise=0;
				   $err_email_devis=0;
				   $err_demande=0;
				   $err_email_devis_valide=0;
				   $err_email_devis_confirm = 0;
				   $err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

				   if (isset($_POST['devis']))
				   {
				     // Si toutes les conditions du formulaire sont réunies (variables non vides, email valide et confirmation de l'email valide)...
				     if (($nom_devis != '') && ($entreprise != '') && ($email_devis != '') && ($demande != '') && (IsEmail($email_devis) != false) && ($email_devis === $email_confirm))
				     {
				       // les 4 variables sont remplies, on génère puis envoie le mail
				       $headers  = 'From:'.$nom_devis.' <noreply@laurentblancpattin.com>' . "\r\n";
				       $headers .= 'Reply-To: '.$email_devis. "\r\n" ;
				       //$headers .= 'X-Mailer:PHP/'.phpversion();

				       // Remplacement de certains caractères spéciaux
				       $demande = str_replace("&#039;","'",$demande);
				       $demande = str_replace("&#8217;","'",$demande);
				       $demande = str_replace("&quot;",'"',$demande);
				       $demande = str_replace('&lt;br&gt;','',$demande);
				       $demande = str_replace('&lt;br /&gt;','',$demande);
				       $demande = str_replace("&lt;","&lt;",$demande);
				       $demande = str_replace("&gt;","&gt;",$demande);
				       $demande = str_replace("&amp;","&",$demande);

				       // Envoi du mail
				       if (mail($destinataire, $objet, $demande, $headers)){
							echo '<body onLoad="alert(\'Message bien envoyé\')">';
				       }
				       else{
							echo '<body onLoad="alert(\'Envoi du message échoué, veuillez réessayer svp.\')">';
				       };
				     }
				     else
				     {
				       // toutes les conditions ne sont pas réunies...
				       if($nom_devis == '') $err_nom_devis=1;
				       if($entreprise == '') $err_entreprise=1;
				       if($email_devis == '') $err_email_devis=1;
				       if($demande == '') $err_demande=1;
				       if(IsEmail($email_devis) == false) $err_email_devis_valide=1;
				       if($email_devis!=$email_confirm) $err_email_devis_confirm=1;
				       $err_formulaire=true;
				     };
				   };

				  echo '
				    <div class="contact">
				      <form method="post" action="company.php#devis">
				           <fieldset>';
				             if($err_nom_devis==0){
				               echo '<div class="form-group">
				                 <label for="nom_devis">Nom* :</label>
				                 <input class="form-control" type="text" id="nom_devis" name="nom_devis" placeholder="Votre nom" value="'.stripslashes($nom_devis).'" tabindex="1" />
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-warning">
				                 <label for="nom_devis">Nom* :</label>
				                 <input class="form-control" type="text" id="nom_devis" name="nom_devis" placeholder="Votre nom" value="'.stripslashes($nom_devis).'" tabindex="1" />
				                 <span class="help-block">Veuillez remplir ce champ</span>
				               </div>';
				             };
				             if($err_email_devis==0 && $err_email_devis_valide==0){
				               echo '<div class="form-group">
				                 <label for="email_devis">Adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_devis" name="email_devis" placeholder="Votre adresse mail" value="'.stripslashes($email_devis).'" tabindex="2" />
				               </div>';
				             }
				             elseif($err_email_devis==1){
				               echo '<div class="form-group has-warning">
				                 <label for="email_devis">Adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_devis" name="email_devis" placeholder="Votre adresse mail" value="'.stripslashes($email_devis).'" tabindex="2" />
				                 <span class="help-block">Veuillez remplir ce champ</span>
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-error">
				                 <label for="email_devis">Adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_devis" name="email_devis" placeholder="Votre adresse mail" value="'.stripslashes($email_devis).'" tabindex="2" />
				                 <span class="help-block">L\'adresse doit suivre le format suivant : "email@exemple.com"</span>
				               </div>';
				             };
				             if($err_email_devis_confirm==0){
				               echo '<div class="form-group">
				                 <label for="email_confirm">Confirmez votre adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_confirm" name="email_confirm" placeholder="Confirmez votre adresse mail" value="'.stripslashes($email_confirm).'" tabindex="3" />
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-error">
				                 <label for="email_confirm">Confirmez votre adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_confirm" name="email_confirm" placeholder="Confirmez votre adresse mail" value="'.stripslashes($email_confirm).'" tabindex="3" />
				                 <span class="help-block">Les adresse mail ne correspondent pas</span>
				               </div>';
				             };
				               echo '<div class="form-group">
				                 <label for="objet">Objet de votre demande :</label>
				                 <input class="form-control" type="text" id="objet" name="objet" placeholder="Objet du message" value="'.stripslashes($objet).'" tabindex="4" />
				               </div>';
				             
				             if($err_demande==0){
				               echo '<div class="form-group">
				                 <label for="textarea">Votre demande* :</label>
				                 <textarea id="demande" name="demande" class="form-control" rows="4">'.stripslashes($demande_content).'</textarea>
				                 <p class="help-block">Vous pouvez agrandir cette fenêtre</p>
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-warning">
				                 <label for="textarea">Votre demande* :</label>
				                 <textarea id="demande" name="demande" class="form-control" rows="4">'.stripslashes($message_content).'</textarea>
				                 <span class="help-block">Veuillez remplir ce champ</span>
				                 <p class="help-block">Vous pouvez agrandir cette fenêtre</p>
				               </div>';
				             };
				             ?>
				             <button class="btn btn-md btn-default submit_form" name="devis" type="submit">Envoyer</button>
				           </fieldset>
				         </form>
				    </div>	
			</div>
			<div id="news" class="rubrique news-container">
				<h2>Actualités professionnelles</h2>
				<h3>Les dernières actualités de la JEMA</h3>
				<?php 

				$news = $bdd->query('SELECT * FROM news');
				$i=0;

				while ($new = $news->fetch())
				{
					if($i==0){
				?>
						<div class="col-lg-12 full-news news">
					    	<div class="news-img">
					    		<img src="media/images/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
					    	</div>
					    	<div class="news-content">
					    		<h4><?php echo $new['title']; ?></h4>
					    		<h5><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></h5>
					    		<p class="news-preview"><?php if(strlen($new['content'])<600){ echo $new['content'];}else{ echo substr($new['content'],0,600).'[...]';} ?></p>
					    		<p class="news-fullview"><?php echo $new['content']; ?></p>
					    		<ul>
						    		<?php 
										if(isset($_SESSION['login'])){
									?>
									<li><a href="hidden/news.php?action=delete&id=<?php echo $new['id']; ?>" class="see-more"><span class="glyphicon glyphicon-trash"></span></a></li>
									<li><a href="hidden/news.php?action=modif&id=<?php echo $new['id']; ?>" class="see-more"><span class="glyphicon glyphicon-pencil"></span></a></li>
									<?php
										}
									?>
						    		<li><a href="hidden/news.php?id=<?php echo $new['id']; ?>" class="see-more">Voir plus...</a></li>
								</ul>
					    	</div>
					   	</div>
			   	<?php
					}
					else{
						if(($i%2)==0){
				?>
					<div class="col-lg-6 part-news news">
				<?php
						}
						else{
				?>
				    <div class="col-lg-6 part-news news-margin news">
				<?php
						}
				?>
				    	<div class="news-img">
				    		<img src="media/images/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
				    	</div>
				    	<div class="news-content">
				    		<h4><?php echo $new['title']; ?></h4>
				    		<h5><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></h5>
				    		<p class="news-preview"><?php if(strlen($new['content'])<300){ echo $new['content'];}else{ echo substr($new['content'],0,300).'[...]';} ?></p>
				    		<p class="news-fullview"><?php echo $new['content']; ?></p>
				    		<ul>
					    		<?php 
									if(isset($_SESSION['login'])){
								?>
								<li><a href="hidden/news.php?action=delete&id=<?php echo $new['id']; ?>" class="see-more"><span class="glyphicon glyphicon-trash"></span></a></li>
								<li><a href="hidden/news.php?action=modif&id=<?php echo $new['id']; ?>" class="see-more"><span class="glyphicon glyphicon-pencil"></span></a></li>
								<?php
									}
								?>
					    		<li><a href="hidden/news.php?id=<?php echo $new['id']; ?>" class="see-more">Voir plus...</a></li>
							</ul>
				    	</div>
				   	</div>
				<?php
					}
					$i++;
				}

				$news->closeCursor();
				?>
				<div id="page_navigation"> </div>
				<?php 
					if(isset($_SESSION['login'])){
				?>
				<div class="news-publish" id="publish">
					<h3>Publier une actualité</h3>
					<form method="post" action="company.php#publish" enctype="multipart/form-data">
						<div class="form-group <?php if($err_title==1) echo'has-warning';?>">
							<label for="title">Titre :</label>
							<input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'actualité" value="<?php echo stripslashes($news_title) ?>" tabindex="12" />
							<?php if($err_title==1) echo'<span class="help-block">Veuillez remplir ce champ</span>';?>
						</div>
						<div class="form-group <?php if($err_content==1) echo'has-warning';?>">
							<label for="textarea">Contenu :</label>
							<textarea id="content" name="content" class="form-control" rows="4"><?php echo stripslashes($news_content) ?></textarea>
							<p class="help-block">Vous pouvez agrandir cette fenêtre</p>
							<?php if($err_content==1) echo'<span class="help-block">Veuillez remplir ce champ</span>';?>
						</div>
						<div class="form-group <?php if($err_image==1 || $err_size==1 || $err_extension==1) echo'has-warning';?>">
							<label for="image">Image (taille maximale : 5 Mo) :</label>
 							<input type="file" name="image" id="image" /><br />
 							<?php if($err_image==1) echo'<span class="help-block">Un problème non spécifié est survenu lors du téléversement de l\'image.</span>'; elseif($err_size==1) echo'<span class="help-block">L\'image est trop grande.</span>'; elseif($err_extension==1) echo'<span class="help-block">L\'extension de l\'image n\'est pas valide (extensions autorisées : JPG, JPEG, GIF et PNG).</span>';?>
						</div>
						<div class="g-recaptcha" data-sitekey="your_site_key"></div>
						<br><button class="btn btn-md btn-default submit_form" name="news" type="submit">Publier</button>
					</form> 
				</div>
				<?php
					}
				?>
			</div>
			<div id="contact" class="rubrique contact-container">
				<h2><span class="big-letter">N</span>ous contacter</h2>
				<h3>Une question ? Envoyez-nous un mail !</h3>
				<?php

				   $nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
				   $email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';

				   if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
				   {
				     $passage_ligne = "\r\n";
				   }
				   else
				   {
				     $passage_ligne = "\n";
				   }

				   $objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
				   $message_content = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
				   $email_confirm = (isset($_POST['email_confirm'])) ? Rec($_POST['email_confirm']) : '';
				   $message = 'Sender : '.$email.$passage_ligne;
				   $message .= 'Name : '.$nom.$passage_ligne;
				   $message .= 'Message : '.$message_content.$passage_ligne;

				   $err_nom=0;
				   $err_email=0;
				   $err_message=0;
				   $err_email_valide=0;
				   $err_email_confirm = 0;
				   $err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

				   if (isset($_POST['contact']))
				   {
				     // Si toutes les conditions du formulaire sont réunies (variables non vides, email valide et confirmation de l'email valide)...
				     if (($nom != '') && ($email != '') && ($message != '') && (IsEmail($email) != false) && ($email === $email_confirm))
				     {
				       // les 4 variables sont remplies, on génère puis envoie le mail
				       $headers  = 'From:'.$nom.' <noreply@laurentblancpattin.com>' . "\r\n";
				       $headers .= 'Reply-To: '.$email. "\r\n" ;
				       //$headers .= 'X-Mailer:PHP/'.phpversion();

				       // Remplacement de certains caractères spéciaux
				       $message = str_replace("&#039;","'",$message);
				       $message = str_replace("&#8217;","'",$message);
				       $message = str_replace("&quot;",'"',$message);
				       $message = str_replace('&lt;br&gt;','',$message);
				       $message = str_replace('&lt;br /&gt;','',$message);
				       $message = str_replace("&lt;","&lt;",$message);
				       $message = str_replace("&gt;","&gt;",$message);
				       $message = str_replace("&amp;","&",$message);

				       // Envoi du mail
				       if (mail($destinataire, $objet, $message, $headers)){
							echo '<body onLoad="alert(\'Message bien envoyé\')">';
				       }
				       else{
							echo '<body onLoad="alert(\'Envoi du message échoué, veuillez réessayer svp.\')">';
				       };
				     }
				     else
				     {
				       // toutes les conditions ne sont pas réunies...
				       if($nom == '') $err_nom=1;
				       if($email == '') $err_email=1;
				       if($message == '') $err_message=1;
				       if(IsEmail($email) == false) $err_email_valide=1;
				       if($email!=$email_confirm) $err_email_confirm=1;
				       $err_formulaire=true;
				     };
				   }; // fin du if (!isset($_POST['envoi']))

				  echo '
				    <div class="contact">
				      <form method="post" action="company.php#contact">
				           <fieldset>';
				             if($err_nom==0){
				               echo '<div class="form-group">
				                 <label for="nom">Nom* :</label>
				                 <input class="form-control" type="text" id="nom" name="nom" placeholder="Votre nom" value="'.stripslashes($nom).'" tabindex="1" />
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-warning">
				                 <label for="nom">Nom* :</label>
				                 <input class="form-control" type="text" id="nom" name="nom" placeholder="Votre nom" value="'.stripslashes($nom).'" tabindex="1" />
				                 <span class="help-block">Veuillez remplir ce champ</span>
				               </div>';
				             };
				             if($err_email==0 && $err_email_valide==0){
				               echo '<div class="form-group">
				                 <label for="email">Adresse mail* :</label>
				                 <input class="form-control" type="text" id="email" name="email" placeholder="Votre adresse mail" value="'.stripslashes($email).'" tabindex="2" />
				               </div>';
				             }
				             elseif($err_email==1){
				               echo '<div class="form-group has-warning">
				                 <label for="email">Adresse mail* :</label>
				                 <input class="form-control" type="text" id="email" name="email" placeholder="Votre adresse mail" value="'.stripslashes($email).'" tabindex="2" />
				                 <span class="help-block">Veuillez remplir ce champ</span>
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-error">
				                 <label for="email">Adresse mail* :</label>
				                 <input class="form-control" type="text" id="email" name="email" placeholder="Votre adresse mail" value="'.stripslashes($email).'" tabindex="2" />
				                 <span class="help-block">L\'adresse doit suivre le format suivant : "email@exemple.com"</span>
				               </div>';
				             };
				             if($err_email_confirm==0){
				               echo '<div class="form-group">
				                 <label for="email_confirm">Confirmez votre adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_confirm" name="email_confirm" placeholder="Confirmez votre adresse mail" value="'.stripslashes($email_confirm).'" tabindex="3" />
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-error">
				                 <label for="email_confirm">Confirmez votre adresse mail* :</label>
				                 <input class="form-control" type="text" id="email_confirm" name="email_confirm" placeholder="Confirmez votre adresse mail" value="'.stripslashes($email_confirm).'" tabindex="3" />
				                 <span class="help-block">Les adresse mail ne correspondent pas</span>
				               </div>';
				             };
				               echo '<div class="form-group">
				                 <label for="objet">Objet de votre message :</label>
				                 <input class="form-control" type="text" id="objet" name="objet" placeholder="Objet du message" value="'.stripslashes($objet).'" tabindex="4" />
				               </div>';
				             
				             if($err_message==0){
				               echo '<div class="form-group">
				                 <label for="textarea">Votre message* :</label>
				                 <textarea id="message" name="message" class="form-control" rows="4">'.stripslashes($message_content).'</textarea>
				                 <p class="help-block">Vous pouvez agrandir cette fenêtre</p>
				               </div>';
				             }
				             else{
				               echo '<div class="form-group has-warning">
				                 <label for="textarea">Votre message* :</label>
				                 <textarea id="message" name="message" class="form-control" rows="4">'.stripslashes($message_content).'</textarea>
				                 <span class="help-block">Veuillez remplir ce champ</span>
				                 <p class="help-block">Vous pouvez agrandir cette fenêtre</p>
				               </div>';
				             };
				             ?>
				             <button class="btn btn-md btn-default submit_form" name="contact" type="submit">Envoyer</button>
				           </fieldset>
				         </form>
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
				<ul>
					<li><img src="media/images/BNP-logo.png" alt="Logo BNP Parisbas"></li>
					<li><img src="media/images/AV-logo.png" alt="Logo AgroValo"></li>
					<li><img src="media/images/EMA-logo.png" alt="Logo Emagine"></li>
					<li><img src="media/images/ALU-logo.png" alt="Logo SupAgro Alumni"></li>
					<li><img src="media/images/JE-logo.png" alt="Logo Junior-entreprises"></li>
					<li><img src="media/images/EPF-logo.png" alt="Logo EPF Projets"></li>
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