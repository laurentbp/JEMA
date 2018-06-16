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
		$text = strip_tags($text,'<a><strong><i>');

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
	$news_title_edit     = (isset($_POST['title_edit']))     ? Rec($_POST['title_edit'])     : '';
	$news_content_edit     = (isset($_POST['content_edit']))     ? Rec($_POST['content_edit'])     : '';
	if(isset($_FILES['image'])) $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
	else $extension_upload = '';
	$err_title=0;
	$err_content=0;
	$err_image=0;
	$err_extension=0;
	$err_size=0;
	$edit=0;
	            	
	if(isset($_GET['action'])){
		if($_GET['action']=="delete"){
			if(isset($_SESSION['login'])){
				$req = $bdd->query('SELECT * FROM news WHERE id='.$_GET['id']);
				$new=$req->fetch(PDO::FETCH_ASSOC);
				$bdd->query('DELETE FROM news WHERE id='.$new['id']);
				echo '<body onLoad="alert(\'Actualité bien supprimée.\')">';
				echo '<meta http-equiv="refresh" content="0;URL=student.php#news">';
			}
			else{
				echo '<body onLoad="alert(\'Vous devez être connecté pour effectuer cette action\')">';
			}
		}
	}

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
				echo '<meta http-equiv="refresh" content="0;URL=student.php#publish">';
			}
			else{
				echo '<body onLoad="alert(\'Erreur dans le téléversement du fichier, veuillez réessayer svp\')">';
				echo '<meta http-equiv="refresh" content="0;URL=student.php#news">';
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
	elseif(isset($_POST['news-edit'])){
		$req = $bdd->query('SELECT * FROM news WHERE id='.$_POST['id-news']);
		$new_ref=$req->fetch(PDO::FETCH_ASSOC);
		
		if($_FILES['image']['error'] <= 0 && in_array($extension_upload,$extensions_valides) && $_FILES['image']['size']<=5242880){
			$image_name="upload/".md5(uniqid(rand(), true));
			$image_path="media/images/".$image_name;
			if($new_ref['image']!=$image_name){
				if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
					$req1=$bdd->prepare("UPDATE news SET image=? WHERE id=?");
					$req1->execute(array($image_name,$new_ref['id']));
					$edit=1;
				}
				else{
					echo '<body onLoad="alert(\'Erreur dans le téléversement du fichier, veuillez réessayer svp\')">';
					echo '<meta http-equiv="refresh" content="0;URL=student.php#news">';
				}
			}
		}
		if($news_title_edit!="" && $new_ref['title']!=$news_title_edit){
			$req2=$bdd->prepare("UPDATE news SET title=? WHERE id=?");
			$req2->execute(array($news_title_edit,$new_ref['id']));
			$edit=1;
		}
		if($news_content_edit!="" && $new_ref['content']!=$news_content_edit){
			$req3=$bdd->prepare("UPDATE news SET content=? WHERE id=?");
			$req3->execute(array($news_content_edit,$new_ref['id']));
			$edit=1;
		}
		if($edit==1){
			echo '<body onLoad="alert(\'Actualité bien éditée.\')">';
			echo '<meta http-equiv="refresh" content="0;URL=student.php#news">';
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
	<title>JEMA - Junior Etude Montpellier Agro - Étudiants</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles/student.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/basic/ckeditor.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="scripts/student.js"></script>
	<script src="scripts/pagination.js"></script>
</head>

<body>

	<div class="windows-size-check"></div>

	<!--  MODAL WINDOWS -->
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

	<div class="anchor-top"><a href="#">Retour en haut</a></div>

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
	          <div class="branding-container"><a id="branding" href="#"><img src="media/images/nav_branding.png" alt="Branding de la JEMA"></a></div>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#about">Qui sommes-nous ?</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#faq">Participer à une étude</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#member">Devenir membre actif</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#news">Actualités</a></li>
	            <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#contact">Contact</a></li>
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	          	<li id="social-nav">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</li>
	            <li class=""><a id="back" class="" href="index.php">Retour à l'accueil</a></li>
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
			<?php 
				$req = $bdd->query('SELECT * FROM news WHERE id=(SELECT MAX(id) FROM news)');
				$last_new=$req->fetch(PDO::FETCH_ASSOC);
			?>
			<div class="last-news text-center">
				<p><strong>Dernière actualité (<?php echo $last_new['date']; ?>) :</strong> <?php echo $last_new['title']; ?> [...] <a href="student.php#news" class="scrollspy">Voir plus...</a></p>
			</div>
			<div class="main-title text-center">
				<h1>Section étudiants et adhérents</h1>
				<h2>Voir la vidéo de présentation <span class="glyphicon glyphicon-arrow-right"></span></h2>
				<div class="arrow-bottom">
					<a class="scrollspy" href="index.php#about">Faire défiler <span class="glyphicon glyphicon-arrow-down"></span></a>
				</div>
			</div>
			<div class="video-container">
				<iframe src="https://www.youtube.com/embed/G5LKjCbbOig?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
						<div class="team-pictures-container">
							<h4><span class="glyphicon glyphicon-user"></span><div class="team-picture-text">Bureau</div></h4>
							<h4><span class="glyphicon glyphicon-user"></span><div class="team-picture-text">Trésorerie</div></h4>
							<h4><span class="glyphicon glyphicon-user"></span><div class="team-picture-text">Communication</div></h4>
							<h4><span class="glyphicon glyphicon-user"></span><div class="team-picture-text">Qualité</div></h4>
							<h4><span class="glyphicon glyphicon-user"></span><div class="team-picture-text">Développement commercial</div></h4>
						</div>
						<div class="team-description">
							<span class="team-marker">Bureau</span>
							<h3>Le bureau</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						</div>
						<div class="team-description">
							<span class="team-marker">Trésorerie</span>
							<h3>La trésorerie</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						</div>
						<div class="team-description">
							<span class="team-marker">Communication</span>
							<h3>Le pôle communication</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						</div>
						<div class="team-description">
							<span class="team-marker">Qualité</span>
							<h3>Le pôle qualité</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						</div>
						<div class="team-description">
							<span class="team-marker">Développement commercial</span>
							<h3>Le développement commercial</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
						</div>
						<div class="active-team-description default-team-description team-description">
							<p>Elle est composée de 23 élèves ingénieurs de Montpellier SupAgro et est renouvelée annuellement suite à une formation de 4 mois auprès de l’équipe précédente.</p>
							<p>Motivés et dynamiques, les membres de la JEMA s’investissent pour que l’association ne cesse de progresser. Ils sont à votre service pour vous fournir les meilleures prestations.</p>
							<p><span class="glyphicon glyphicon-arrow-left"></span>Pour plus d'informations sur les différents pôles de la JEMA, cliquez sur les images à gauche.</p>
						</div>
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
							<p class="active-description">La JEMA a été fondée en 2009 à l’initiative d’Audrey Tardieu, étudiante de Montpellier SupAgro, qui avait pour projet de créer une structure professionnelle gérée par des étudiants de l’école, à l’image d’une Junior-Entreprise. Son but était de permettre aux élèves de se familiariser avec le monde de l’entreprise dès leur intégration dans l’école.</p>
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
				<div class="mot-container-title col-lg-4 col-md-3 col-sm-3 col-xs-12">
					<h2><span class="big-letter">L</span>e mot de la présidente</h2>
					<h3>Mélissa Hoffmann-Bernard</h3> 
					<div class="mot-picture"><span class="glyphicon glyphicon-user"></span></div>
				</div>
				<div class="col-lg-8 mot col-md-9 col-sm-9 col-xs-12">
					<img src="media/images/left-quote.png" class="left-quote" alt="Quote"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat. Quisque nec metus non magna pulvinar porta sit amet quis turpis. Integer id tincidunt tellus, eu tincidunt tortor. Integer vel turpis non augue pulvinar aliquam. Nullam vulputate nisi vel ipsum consequat, vel tempor tellus pellentesque. Nulla et commodo augue. Quisque auctor ullamcorper euismod. Pellentesque pulvinar viverra purus ac sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum non nibh ac tortor semper iaculis.</p><img src="media/images/right-quote.png" class="right-quote" alt="Quote"></span>
				</div>
			</div>
			<div id="faq" class="rubrique faq-container">
				<h2>FAQ</h2>
				<h3>Comment participer à une étude ?</h3>
				<h4><span class="big-letter">Q1</span> - Comment faire ma demande pour participer à une étude ? <span class="glyphicon glyphicon-triangle-bottom"></span></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat.</p>
				<h4><span class="big-letter">Q2</span> - Comment connaître les études en cours et les places disponibles ? <span class="glyphicon glyphicon-triangle-bottom"></span></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat.</p>
				<h4><span class="big-letter">Q3</span> - Une fois ma demande acceptée, que dois-je faire ? <span class="glyphicon glyphicon-triangle-bottom"></span></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat.</p>
				<h4><span class="big-letter">Q4</span> - Quelles missions peuvent m'être confiées ? <span class="glyphicon glyphicon-triangle-bottom"></span></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat.</p>
				<h4><span class="big-letter">Q5</span> - Suis-je rémunéré en participant à une étude ? <span class="glyphicon glyphicon-triangle-bottom"></span></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat.</p>
				<h4><span class="big-letter">Q6</span> - Que se passe-t-il si je ne réalise pas les missions demandées ou si le résultat n'est pas à la hauteur des attentes ? <span class="glyphicon glyphicon-triangle-bottom"></span></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui. Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo. Suspendisse aliquet quis ipsum sed placerat.</p>
			</div>
			<div id="member" class="rubrique member-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2><span class="big-letter">V</span>ivez l'aventure de l'intérieur</h2>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 member">
					<h3>Devenez membre actif !</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas congue mi in dolor consequat consequat. Aenean ac nisi a ipsum pellentesque sagittis et non dui.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
					<p>Nullam volutpat non lorem id fermentum. Nulla vel mattis lorem. Cras placerat purus at odio blandit gravida. Integer interdum tempor risus vel commodo.</p>
				</div>
			</div>
			<div id="news" class="rubrique news-container">
				<h2>Actualités étudiantes</h2>
				<h3>Les dernières actualités de la JEMA</h3>
				<div class="page_navigation"> </div>
				<?php 

				$news = $bdd->query('SELECT * FROM news ORDER BY id DESC');
				$i=0;

				while ($new = $news->fetch())
				{
				?>
					<div class="news">

				    	<div class="news-edit">
				    		<form method="post" action="student.php#edit" enctype="multipart/form-data">
					    		<div class="form-group">
						    		<input class="form-control" type="text" id="title" name="title_edit" placeholder="Titre de l'actualité" value="<?php echo $new['title']; ?>" tabindex="12" />
						    	</div>
						    	<div class="image-edit form-group">
		  							<img class="image-preview" src="media/images/<?php echo $new['image']; ?>" alt="Aperçu de l'image" />
		 							<input type="file" name="image" class="image-news" /><br />
								</div>
						    	<div class="text-edit form-group">
									<textarea id="ed<?php echo $new['id']; ?>" name="content_edit" class="editor form-control" rows="4"><?php echo $new['content']; ?></textarea>
								</div>

								<script>
									CKEDITOR.replace( 'ed<?php echo $new['id']; ?>' );
									CKEDITOR.add();
								</script>
								<input type="hidden" name="id-news" value="<?php echo $new['id']; ?>" />
								<br><button class="btn btn-md btn-default submit_form" name="news-edit" type="submit">Publier</button>
								<div class="news-edit-cancel">Annuler</div>
							</form>

				    	</div>

				    	<div class="news-content">
			    			<h4><?php echo $new['title']; ?><span class="news-date"><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></span></h4>
			    			<div class="b-description_readmore b-description_readmore_ellipsis js-description_readmore">
						    	<div class="news-img">
						    		<img src="media/images/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
						    	</div>
						    	<?php echo $new['content'];

								if(isset($_SESSION['login'])){
								?>
								<a onclick="javascript:if(!confirm('Confirmer la suppression ?')){return false;}" href="student.php?action=delete&id=<?php echo $new['id']; ?>"><div class="news-button"><span class="glyphicon glyphicon-trash"></span></div></a>
								<div class="news-button edit"><span class="glyphicon glyphicon-pencil"></span></div>
								<?php
									}
								?>
				    		</div>
				    	</div>
				   	</div>
				<?php
				}

				$news->closeCursor();
				?>
				<div class="page_navigation"> </div>
				<?php 
					if(isset($_SESSION['login'])){
				?>
				<div class="news-publish" id="publish">
					<h3>Publier une actualité</h3>
					<form method="post" action="student.php#publish" enctype="multipart/form-data">
						<div class="form-group <?php if($err_title==1) echo'has-warning';?>">
							<label for="title">Titre :</label>
							<input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'actualité" value="<?php echo stripslashes($news_title) ?>" tabindex="12" />
							<?php if($err_title==1) echo'<span class="help-block">Veuillez remplir ce champ</span>';?>
						</div>
						<div class="form-group <?php if($err_content==1) echo'has-warning';?>">
							<label for="textarea">Contenu :</label>
							<textarea id="editor" name="content" class="editor form-control" rows="4"><?php echo stripslashes($news_content) ?></textarea>

							<script>
								CKEDITOR.replace( 'editor' );
								CKEDITOR.add();
							</script>

							<?php if($err_content==1) echo'<span class="help-block">Veuillez remplir ce champ</span>';?>
						</div>
						<div class="form-group <?php if($err_image==1 || $err_size==1 || $err_extension==1) echo'has-warning';?>">
							<label for="image-news">Image (taille maximale : 5 Mo) :</label><br />
  							<img class="image-preview" src="#" alt="Aperçu de l'image" />
 							<input type="file" name="image" id="image-news" class="image-news" /><br />
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
				      <form method="post" action="student.php#contact">
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