<footer class="footer text-center">
	<div class="footer-contact col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<a href="contact.php">Nous contacter</a>
		<p class="adresse">Junior Étude Montpellier Agro, <br>2 place Pierre Viala, <br>34060 Montpellier Cedex 02</p>
		<p class="mail">jema@supagro.fr</p>
		<a href="mentions.php">Mentions légales</a>
		<?php 
			if(isset($_SESSION['login'])){
		?>
		<p><a href="disconnect.php">Déconnexion</a></p>
		<?php
			}
		?>
	</div>
	<div class="footer-navigate col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<a href="plan.php">Plan du site</a>
		<ul>
			<li><a href="index.php">Page d'accueil</a></li>
			<li><a href="student.php">Étudiants</a></li>
			<li><a href="company.php">Professionnels</a></li>
			<li><a href="company.php#about">Qui sommes-nous ?</a></li>
			<li><a href="company.php#skills">Nos compétences</a></li>
			<li><a href="company.php#engagement">Nos engagements</a></li>
			<li><a href="newsletter.php">Newsletter</a></li>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</div>
	<div class="footer-partners col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<a href="partenaires.php">Nos partenaires</a>
		<ul>
			<li><img src="../../media/images/BNP-logo.png" alt="Logo BNP Parisbas"></li>
			<li><img src="../../media/images/AV-logo.png" alt="Logo AgroValo"></li>
			<li><img src="../../media/images/EMA-logo.png" alt="Logo Emagine"></li>
			<li><img src="../../media/images/ALU-logo.png" alt="Logo SupAgro Alumni"></li>
			<li><img src="../../media/images/JE-logo.png" alt="Logo Junior-entreprises"></li>
			<li><img src="../../media/images/EPF-logo.png" alt="Logo EPF Projets"></li>
		</ul>
	</div>
	<div class="footer-reseaux col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<ul>
			<li><img src="../../media/images/fb-icon.png" alt="Icône Facebook"></li>
			<li><img src="../../media/images/tw-icon.png" alt="Icône Twitter"></li>
			<li><img src="../../media/images/lk-icon.png" alt="Icône Linkedin"></li>
			<li><img src="../../media/images/ml-icon.png" alt="Icône Mail"></li>
		</ul>
	</div>
	<div class="footer-copyright col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<p>Copyright © 2018 JEMA – Junior Etude Montpellier Agro Tous droits réservés.</p>
	</div>
</footer>