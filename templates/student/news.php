<section id="news" class="news">
	<div class="header">
		<h2>Actualités étudiantes</h2>
		<h3>Les dernières actualités de la JEMA</h3>
	</div>
	<div class="page_navigation"> </div>
	<div class="posts">
	<?php 

	$count = $bdd->query("SELECT count(*) as total from news WHERE categorie LIKE '%stu%' OR categorie LIKE '%oth%'");
	$news = $bdd->query("SELECT * FROM news WHERE categorie LIKE '%stu%' OR categorie LIKE '%oth%' ORDER BY id DESC");

	if($count->fetch()['total']>0){
		while ($new = $news->fetch())
		{
		?>
	    	<!--<div class="news-edit">
	    		<form method="post" action="student.php#edit" enctype="multipart/form-data">
		    		<div class="form-group">
			    		<input class="form-control" type="text" id="title" name="title_edit" placeholder="Titre de l'actualité" value="<?php echo $new['title']; ?>" tabindex="12" />
			    	</div>
			    	<div class="image-edit form-group">
							<img class="image-preview" src="../../media/images/<?php echo $new['image']; ?>" alt="Aperçu de l'image" />
							<input type="file" name="image" class="image-news" /><br />
					</div>
			    	<div class="text-edit form-group">
						<textarea id="ed<?php echo $new['id']; ?>" name="content_edit" class="editor form-control" rows="4"><?php echo $new['content']; ?></textarea>
					</div>

					<script>
						CKEDITOR.replace( 'ed<?php echo $new['id']; ?>' );
						CKEDITOR.add();
					</script>
					<input type="hidden" name="id-news" value="<?php echo $new['id']; ?>" />
					<br><button class="btn btn-md btn-default submit_form" name="news-edit" type="submit">Publier</button>
					<div class="news-edit-cancel">Annuler</div>
				</form>
	    	</div>-->

	    	<article class="news-content">
	    		<a href="actualite-<?php echo $new['id']; ?>" class='image-container'>
	    			<img class="image" src="media/images/upload/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
	    		</a>
	    		<h3><?php echo $new['title']; ?></h3>
	    		<h4><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></h4>
	    		<div class="content">
	    			<p><?php echo $new['content'];?></p>
	    			<span class="blankspace"></span>
	    		</div>
				<ul class="actions">
					<li>
						<a href="actualite-<?php echo $new['id']; ?>" class="button-2">Voir plus</a>
					</li>
					<?php if(isset($_SESSION['login'])){
					?>
					<li>
						<a class="button-2" onclick="javascript:if(!confirm('Confirmer la suppression ?')){return false;}" href="etudiant-suppression-<?php echo $new['id']; ?>"><span class="glyphicon glyphicon-trash"></span></a>
					</li>
					<li>
						<a class="button-2 edit" href="actualite-<?php echo $new['id']; ?>-edition"><span class="glyphicon glyphicon-pencil"></span></a>
					</li>
					<?php
						}
					?>
	    		</ul>
	    	</article>
		<?php
		}
	}
	else{
		echo '<p>Aucune actualité pour le moment.</p>';
	}

	$news->closeCursor();
	?>
   	</div>
	
	<div class="page_navigation"> </div>
	<?php 
		if(isset($_SESSION['login'])){
	?>
	<div class="news-publish" id="publish">
		<h3>Publier une actualité</h3>
		<form method="post" action="etudiant#publish" enctype="multipart/form-data">
			<div class="form-group <?php if($err_title==1) echo'has-warning';?>">
				<label for="title">Titre :</label>
				<input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'actualité" value='<?php echo stripslashes($news_title); ?>' tabindex="12" />
				<?php if($err_title==1) echo'<span class="caution">Veuillez remplir ce champ</span>';?>
			</div>
			<div class="form-group">
             <label for="cat">Catégorie de l'actualité :</label><br>
             <select id="cat" name="cat"><?php
		  		echo $category;
			?></select>
           </div>
			<div class="form-group <?php if($err_content==1) echo'has-warning';?>">
				<label for="textarea">Contenu :</label>
				<textarea id="editor" name="content" class="editor form-control" rows="4"><?php echo stripslashes($news_content); ?></textarea>

				<script>
					CKEDITOR.replace( 'editor' );
					CKEDITOR.add();
				</script>

				<?php if($err_content==1) echo'<span class="caution">Veuillez remplir ce champ</span>';?>
			</div>
			<div class="form-group <?php if($err_image==1 || $err_size==1 || $err_extension==1) echo'has-warning';?>">
				<label for="image-news">Image (taille maximale : 5 Mo) :</label><br />
					<img class="image image-preview" src="#" alt="Aperçu de l'image" />
					<input type="file" name="image" id="image-news" class="form-control image-news" /><br />
					<?php 
						if($err_image>0){ 
							echo'<span class="caution">Un problème non spécifié est survenu lors du téléversement de l\'image (error : '; 
							echo codeToMessage($_FILES["image"]["error"]).")</span>";
						} 
						elseif($err_size==1) echo'<span class="caution">L\'image est trop grande.</span>'; 
						elseif($err_extension==1) echo'<span class="caution">L\'extension de l\'image n\'est pas valide (extensions autorisées : JPG, JPEG, GIF et PNG).</span>';
					?>
			</div>
			<br><button class="button-2" name="news" type="submit">Publier</button>
		</form> 
	</div>
	<?php
		}
	?>
</section>