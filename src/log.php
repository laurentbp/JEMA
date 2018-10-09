<?php 

require_once('/config/config.php');
require_once('/config/util.php');

if(isset($_POST['log'])){
	$login     = (isset($_POST['login']))     ? Rec($_POST['login'])     : '';
	$pswd     = (isset($_POST['password']))     ? Rec($_POST['password'])     : '';
	if($login==$login_admin && $pswd==$pswd_admin){
		$_SESSION['login']=$login;
		echo '<body onLoad="alert(\'Bienvenue, Administrateur !\')">';
		header('Location: index.php');
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
	<title>JEMA - Junior Etude Montpellier Agro - Administration</title>
</head>

<body>

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
	</form>';

</body>

</html>