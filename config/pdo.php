<?php

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
