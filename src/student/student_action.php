<?php

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
	/****************SUPPRESSION DE NEWS******************/
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

elseif(isset($_POST['news'])){
	/****************POST DE NEWS******************/
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
	/****************EDIT DE NEWS******************/
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