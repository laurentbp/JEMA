<?php

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