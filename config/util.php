<?php
$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
/*
* cette fonction sert à nettoyer et enregistrer un texte
*/
function Rec($text)
{
	$text = strip_tags($text,'<a><p><strong><i><ul><li><ol><img><blockquote><em><s><img><div><span>');

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

function codeToMessage($code) 
	{ 
	    switch ($code) { 
	        case UPLOAD_ERR_INI_SIZE: 
	            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
	            break; 
	        case UPLOAD_ERR_FORM_SIZE: 
	            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
	            break; 
	        case UPLOAD_ERR_PARTIAL: 
	            $message = "The uploaded file was only partially uploaded"; 
	            break; 
	        case UPLOAD_ERR_NO_FILE: 
	            $message = "No file was uploaded"; 
	            break; 
	        case UPLOAD_ERR_NO_TMP_DIR: 
	            $message = "Missing a temporary folder"; 
	            break; 
	        case UPLOAD_ERR_CANT_WRITE: 
	            $message = "Failed to write file to disk"; 
	            break; 
	        case UPLOAD_ERR_EXTENSION: 
	            $message = "File upload stopped by extension"; 
	            break; 

	        default: 
	            $message = "Unknown upload error"; 
	            break; 
	    } 
	    return $message; 
	} 