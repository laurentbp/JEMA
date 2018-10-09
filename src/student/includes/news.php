<section>
	<h2>Actualités étudiantes</h2>
	<h3>Les dernières actualités de la JEMA</h3>
	<!--<div class="page_navigation"> </div>-->
	<?php 

	$news = $bdd->query('SELECT * FROM news ORDER BY id DESC');
	$i=0;

	while ($new = $news->fetch())
	{
	?>
		<div class="news">

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
	    		<a href="" class='news-image'>
	    			<img src="../../media/images/<?php echo $new['image']; ?>" alt="Image news - <?php echo $new['title']; ?>">
	    		</a>
	    		<h4><?php echo $new['title']; ?></h4>
	    		<h5><?php echo 'Publié le <span class="big-letter">'.$new['date'].'</span>'; ?></h5>
	    		<div class="b-description_readmore b-description_readmore_ellipsis js-description_readmore">
	    			<?php echo $new['content'];

					if(isset($_SESSION['login'])){
					?>
					<a onclick="javascript:if(!confirm('Confirmer la suppression ?')){return false;}" href="student.php?action=delete&id=<?php echo $new['id']; ?>"><div class="news-button"><span class="glyphicon glyphicon-trash"></span></div></a>
					<div class="news-button edit"><span class="glyphicon glyphicon-pencil"></span></div>
					<?php
						}
					?>
	    		</div>
	    	</article>
	   	</div>
	<?php
	}

	$news->closeCursor();
	?>
	<!--<div class="page_navigation"> </div>-->
	<?php 
		if(isset($_SESSION['login'])){
	?>
	<div class="news-publish" id="publish">
		<h3>Publier une actualité</h3>
		<form method="post" action="student.php#publish" enctype="multipart/form-data">
			<div class="form-group <?php if($err_title==1) echo'has-warning';?>">
				<label for="title">Titre :</label>
				<input class="form-control" type="text" id="title" name="title" placeholder="Titre de l'actualité" value="<?php echo stripslashes($news_title) ?>" tabindex="12" />
				<?php if($err_title==1) echo'<span class="help-block">Veuillez remplir ce champ</span>';?>
			</div>
			<div class="form-group <?php if($err_content==1) echo'has-warning';?>">
				<label for="textarea">Contenu :</label>
				<textarea id="editor" name="content" class="editor form-control" rows="4"><?php echo stripslashes($news_content) ?></textarea>

				<script>
					CKEDITOR.replace( 'editor' );
					CKEDITOR.add();
				</script>

				<?php if($err_content==1) echo'<span class="help-block">Veuillez remplir ce champ</span>';?>
			</div>
			<div class="form-group <?php if($err_image==1 || $err_size==1 || $err_extension==1) echo'has-warning';?>">
				<label for="image-news">Image (taille maximale : 5 Mo) :</label><br />
					<img class="image-preview" src="#" alt="Aperçu de l'image" />
					<input type="file" name="image" id="image-news" class="image-news" /><br />
					<?php if($err_image==1) echo'<span class="help-block">Un problème non spécifié est survenu lors du téléversement de l\'image.</span>'; elseif($err_size==1) echo'<span class="help-block">L\'image est trop grande.</span>'; elseif($err_extension==1) echo'<span class="help-block">L\'extension de l\'image n\'est pas valide (extensions autorisées : JPG, JPEG, GIF et PNG).</span>';?>
			</div>
			<div class="g-recaptcha" data-sitekey="your_site_key"></div>
			<br><button class="btn btn-md btn-default submit_form" name="news" type="submit">Publier</button>
		</form> 
	</div>
	<?php
		}
	?>
</div>