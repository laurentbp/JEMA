<?php 
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	require_once('config/config.php');
	require_once('config/pdo.php');
	require_once('config/util.php');

	$news_title     = (isset($_POST['title']))     ? Rec($_POST['title'])     : '';
	$news_content     = (isset($_POST['content']))     ? Rec($_POST['content'])     : '';
	$news_category     = (isset($_POST['cat']))     ? Rec($_POST['cat'])     : '';
	if(isset($_FILES['image'])) $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
	else $extension_upload = '';
	$err_title=0;
	$err_content=0;
	$err_image=0;
	$err_extension=0;
	$err_size=0;
	$edit=0;
	$statut_select = '<option value="Professionnel" selected>Professionnel</option>
				  		<option value="Etudiant">Étudiant</option>
				  		<option value="Autre">Autre</option>';
	$category = '<option value="pro" selected>Professionnelle</option>
				  		<option value="stu">Étudiante</option>
				  		<option value="oth">Autre</option>';

	if(isset($_GET['action'])){
	/****************SUPPRESSION DE NEWS******************/
		if($_GET['action']=="delete"){
			if(isset($_SESSION['login'])){
				$req = $bdd->query('SELECT * FROM news WHERE id='.$_GET['id']);
				$new=$req->fetch(PDO::FETCH_ASSOC);
				if(unlink ('media/images/upload/'.$new['image'])){
					$bdd->query('DELETE FROM news WHERE id='.$new['id']);
					echo '<body onLoad="alert(\'Actualité bien supprimée.\')">';
					echo '<meta http-equiv="refresh" content="0;URL=professionnel#news">';
				}
				else{
					echo '<body onLoad="alert(\'Un problème est survenu lors de la suppression.\')">';
					echo '<meta http-equiv="refresh" content="0;URL=professionnel#news">';
				}
			}
			else{
				echo '<body onLoad="alert(\'Vous devez être connecté pour effectuer cette action.\')">';
				echo '<meta http-equiv="refresh" content="0;URL=professionnel#news">';
			}
		}
	}

	if(isset($_POST['news'])){
	/****************POST DE NEWS******************/
		if($news_title!="" && $news_content!="" && $_FILES['image']['error'] === UPLOAD_ERR_OK && in_array($extension_upload,$extensions_valides) && $_FILES['image']['size']<=5242880){
			$image_name=md5(uniqid(rand(), true)).".jpg";
			$image_path="media/images/upload/".$image_name;
			if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){
				$req=$bdd->prepare("INSERT INTO news VALUES (?,?,?,CURRENT_TIMESTAMP,?,?)");
				$req->execute(array(NULL,$news_title,$news_content,$image_name,$news_category));
				echo '<body onLoad="alert(\'Actualité bien publiée.\')">';
				echo '<meta http-equiv="refresh" content="0;URL=professionnel#news">';
			}
		}
		else{
			if($news_title == '') $err_title=1;
			if($news_content == '') $err_content=1;
			if($_FILES['image']['error'] != UPLOAD_ERR_OK) $err_image=1;
			if(!in_array($extension_upload,$extensions_valides)) $err_extension=1;
			if($_FILES['image']['size']>5242880) $err_size=1;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="language" content="fr" />
	<meta name="description" content="Vous souhaitez réaliser un projet dans le domaine de l’agriculture, l’agroalimentaire ou de l’environnement ? Découvrez la Junior Etude Montpellier Agro" />
	<title>JEMA - Junior Etude Montpellier Agro - Professionnel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/navbar.css">
	<link rel="stylesheet" href="assets/css/footer.css">
	<link rel="stylesheet" href="assets/css/company.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="assets/js/loader.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/company.js"></script>
	<script src="assets/js/pagination.js"></script>
</head>

<body>

	<div class="loader"></div>

	<div class="anchor-top"><a class="scrollspy" href="#top">Retour en haut</a></div>

	<div id="top" class="container-fluid">

		<?php include_once('templates/company/company-navbar.php'); ?>
		<?php include_once('templates/company/header.php'); ?>

		<div class="main-content">

				<?php include_once('templates/company/about.html'); ?>
				<?php include_once('templates/numbers.html'); ?>
				<?php include_once('templates/edito.html'); ?>
				<?php include_once('templates/company/skills.html'); ?>
				<?php include_once('templates/company/undertaking.html'); ?>
				<?php require_once('templates/company/news.php'); ?>
				<?php require_once('templates/company/devis.php'); ?>
				<?php include_once('templates/contact.php'); ?>
				
		</div>

		<?php include_once('templates/footer.php'); ?>

	</div>

</body>
</html>