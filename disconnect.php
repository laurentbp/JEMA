<?php
	// On démarre la session
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
 	// On détruit les variables de notre session
	$_SESSION = array();
 	// On détruit notre session
	session_destroy ();
 	echo '<body onLoad="alert(\'Vous êtes bien déconnecté\')">';
	echo '<meta http-equiv="refresh" content="0; URL=index.php">'
 ?> 