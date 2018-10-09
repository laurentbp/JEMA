<header>
	<?php 
		$req = $bdd->query('SELECT * FROM news WHERE id=(SELECT MAX(id) FROM news)');
		$last_new=$req->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="last-news text-center">
		<p><strong>Dernière actualité (<?php echo $last_new['date']; ?>) :</strong> <?php echo $last_new['title']; ?> [...] <a href="student.php#news" class="scrollspy">Voir plus...</a></p>
	</div>
	<div class="main-title text-center">
		<h1>Section étudiants et adhérents</h1>
		<h2>Voir la vidéo de présentation <span class="glyphicon glyphicon-arrow-right"></span></h2>
		<div class="arrow-bottom">
			<a class="scrollspy" href="index.php#about">Faire défiler <span class="glyphicon glyphicon-arrow-down"></span></a>
		</div>
	</div>
	<div class="video-container">
		<iframe src="https://www.youtube.com/embed/G5LKjCbbOig?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	</div>
	
	<div class="header-blank"></div>
</header>