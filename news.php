<?php 
	session_start ();
	require_once('config/config.php');
	require_once('config/pdo.php');
	require_once('config/util.php');
	$req = $bdd->query('SELECT * FROM news WHERE id='.$_GET['id']);
	$new=$req->fetch(PDO::FETCH_ASSOC);

	$news_title     = (isset($_POST['title']))     ? Rec($_POST['title'])     : '';
	$news_content     = (isset($_POST['content']))     ? Rec($_POST['content'])     : '';
	if(isset($_FILES['image'])) $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
	else $extension_upload = '';
	$err_title=0;
	$err_content=0;
	$err_image=0;
	$err_extension=0;
	$err_size=0;
	$edit=0;

	if(isset($_POST['news-edit'])){
		if($news_title != $new['title']){
			if($news_title!=""){
				$req=$bdd->prepare("UPDATE news SET title=? WHERE id=?");
				$req->execute(array($news_title,$new['id']));
			}
			else{
				$err_title=1;
			}
		}
		if($news_content!= $new['content']){
			if($news_content!=""){
				$req=$bdd->prepare("UPDATE news SET content=? WHERE id=?");
				$req->execute(array($news_content,$new['id']));
			}
			else{
				$err_content=1;
			}
		}
		echo '<body onLoad="alert(\'Actualité bien éditée.\')">';
		echo '<meta http-equiv="refresh" content="0;URL=actualite-'. $new["id"] .'">';
	}
?>

<!DOCTYPE html>
<html>
<html xmlns:og="http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="language" content="fr" />
	<title>JEMA - Junior Etude Montpellier Agro - <?php echo $new['title'];?></title>
	<meta property="og:title" content="<?php echo $new['title'];?>" />
	<meta property="og:description" content="<?php echo strip_tags(substr($new['content'], 0, 300).'...');?>" />
	<meta property="og:type" content="article" />
	<meta property="og:site_name" content="https://www.jema-supagro.fr/" />
	<meta property="og:url" content="https://www.jema-supagro.fr/actualite-<?php echo $new['id'];?>" />
	<meta property="og:image" content="https://www.jema-supagro.fr/media/images/upload/<?php echo $new['image'];?>" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/navbar.css">
	<link rel="stylesheet" href="assets/css/footer.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
	<script src="assets/js/main.js"></script>
</head>

<body>

	<div class="container-fluid">

		<?php include_once('templates/navbar.php'); ?>

		<section class="news-template">
			<?php 
        	if(isset($_GET['action'])){
        		if($_GET['action']=="edit"){
        			if(isset($_SESSION['login'])){
            ?>
					<div class="news-edit">
						<form method="post" action="news.php?action=edit&id=<?php echo $new['id']; ?>" enctype="multipart/form-data">
							<img class="image news-header-image" src="media/images/upload/<?php echo $new['image']; ?>" alt="Aperçu de l'image" />
							<input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'actualité" value="<?php echo $new['title']; ?>" tabindex="12" />

							<textarea id="editor" name="content" class="editor form-control" rows="4"><?php echo stripslashes($new['content']); ?></textarea>

							<script>
								CKEDITOR.replace( 'editor' );
								CKEDITOR.add();
							</script>

							<ul class="actions">
								<li>
									<a class="button-2" href="actualite-<?php echo $new["id"]; ?>"><span class="glyphicon glyphicon-arrow-left"></span> Retour à l'actualité</a>
								</li>
								<li>
									<button class="button-2" name="news-edit" type="submit">Publier</button>
								</li>
				    		</ul>
				    	</form>

			            <?php 
        			}
        			else{
						echo '<body onLoad="alert(\'Vous devez être connecté pour effectuer cette action\')">';
        			}
        		?></div>
			<?php }
			}
			else{ 
			?>
			<div class="news-content">

				<section class="fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			      	<div class="image-container">
			      		<img class="image" src="media/images/upload/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
			      	</div>
				</section>
	            
				<a href="" data-toggle="modal" data-target="#image-modal" class="image-container"><img class="image news-header-image" src="media/images/upload/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>"></a>
				<h2><?php echo $new['title'];?></h2>
				<h3><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></h3>
				<?php echo $new['content'];?>
			</div>
			<ul class="actions">
				<li>
					<a class="button-2" href="etudiant#news"><span class="glyphicon glyphicon-arrow-left"></span> Retour aux actualités</a>
				</li>
				<?php if(isset($_SESSION['login'])){
				?>
					<li>
						<a class="button-2" onclick="javascript:if(!confirm('Confirmer la suppression ?')){return false;}" href="etudiant-suppression-<?php echo $new['id']; ?>"><span class="glyphicon glyphicon-trash"></span></a>
					</li>
					<li>
						<a class="button-2" href="actualite-<?php echo $new['id']; ?>-edition"><span class="glyphicon glyphicon-pencil"></span></a>
					</li>
				<?php
					}
				?>
    		</ul>
			<?php
				}
			?>
		</section>

		<?php include_once('templates/footer.php'); ?>

	</div>

</body>
</html>