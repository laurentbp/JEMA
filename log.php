<?php 

	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	require_once('config/config.php');
	require_once('config/util.php');

	if(isset($_POST['log'])){
		$login     = (isset($_POST['login']))     ? Rec($_POST['login'])     : '';
		$pswd     = (isset($_POST['password']))     ? Rec($_POST['password'])     : '';
		if($login==$login_admin && $pswd==$pswd_admin){
			$_SESSION['login']=$login;
			echo '<body onLoad="alert(\'Bienvenue, Administrateur !\')">';
			echo '<meta http-equiv="refresh" content="0;URL=accueil">';
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
	<title>JEMA - Junior Etude Montpellier Agro - Administration</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/student.css">
</head>

<body>

	<section>
		<h2>Connexion</h2>
		<form method="post" action="#">
			<div class="form-group">
				<input class="form-control" id="login" type="text" name="login" placeholder="Identifiant" tabindex="10"/>
			</div>
			<div class="form-group">
				<input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe" tabindex="11"/>
				<input class="form-control" id="url" type="hidden" name="url" value="student" />
			</div>
			<ul class="actions">
				<li>
					<button class="btn btn-md btn-default button" name="log" type="submit">Se connecter</button>
				</li>
				<li>
					<a href="index.php" class="button">Retour au site</a>
				</li>
			</ul>
		</form>
	</section>

</body>

</html>