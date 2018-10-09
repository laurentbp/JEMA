<?php 
	session_start ();
	require_once('../../config/config.php');
	require_once('../../config/pdo.php');
	require_once('../../config/util.php');
	require_once('student_action.php');
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
	<link rel="stylesheet" href="../../assets/css/student.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../../assets/js/loader.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/basic/ckeditor.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="../../assets/js/student.js"></script>
	<script src="../../assets/js/pagination.js"></script>
</head>

<body>

	<div class="loader"></div>

	<div class="anchor-top"><a href="#">Retour en haut</a></div>

	<div class="container-fluid">

  	  <div class="nav-indicator-background"></div>
  	  <div class="nav-indicator"></div>

		<?php include_once('includes/navbar.php'); ?>
		<?php include_once('includes/header.php'); ?>

		<section class="main-content">

			<?php include_once('includes/about.html'); ?>
			<?php include_once('includes/numbers.html'); ?>
			<?php include_once('includes/edito.html'); ?>
			<?php include_once('includes/faq.html'); ?>
			<?php include_once('includes/member.html'); ?>
			<?php include_once('includes/news.php'); ?>
			<?php include_once('../includes/contact.php'); ?>
			
		</section>

		<?php include_once('../includes/footer.php'); ?>

	</div>
</body>