<?php 
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	require_once('config/config.php');
	require_once('config/pdo.php');
	require_once('config/util.php');

  $statut_select = '<option value="pro">Professionnel</option>
              <option value="stu">Étudiant</option>
              <option value="autre">Autre</option>';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="language" content="fr" />
  <title>JEMA - Junior Etude Montpellier Agro - Contact</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/navbar.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.parallax-1.1.3.js"></script>
  <script type="text/javascript" src="assets/js/loader.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/main.js"></script>
</head>

<body>

	<div class="loader"></div>

	<div class="container-fluid">

		<?php include_once('templates/navbar.php'); ?>

		<?php include_once('templates/contact.php'); ?>

		<?php include_once('templates/footer.php'); ?>

	</div>

</body>
</html>