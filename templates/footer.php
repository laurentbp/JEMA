<footer class="footer">
	<div>
		<h3><a href="contact">Nous contacter</a></h3>
		<h4>Adresse</h4>
		<p>Junior Étude Montpellier Agro, <br>2 place Pierre Viala, <br>34060 Montpellier Cedex 02</p>
		<img class="suplogo" src="media/images/logos/SUPA-logo.png" alt="Logo de Montpellier Supagro">
		<h4>Mail</h4>
		<p>jema@supagro.fr</p>
		<h4><a href="" data-toggle="modal" data-target="#mentions-modal">Mentions légales</a></h4>
		<?php
			if(isset($_SESSION['login'])){
		?>
		<h4><a href="deconnexion">Déconnexion</a></h4>
		<?php
			}
		?>
	</div>
	<div>
		<h3>Plan du site</h3>
		<ul>
			<li>
				<h4><a href="accueil">Page d'accueil</a></h4>
				<ul>
					<li><a href="accueil#about">Qui sommes-nous ?</a></li>
					<li><a href="accueil#school">Notre école</a></li>
					<li><a href="accueil#CNJE">La CNJE</a></li>
				</ul>
			</li>
			<li>
				<h4><a href="etudiant">Section étudiante</a></h4>
				<ul>
					<li><a href="etudiant#faq">Participer à une étude</a></li>
					<li><a href="etudiant#member">Devenir membre actif</a></li>
					<li><a href="etudiant#news">Actualités étudiantes</a></li>
				</ul>
			</li>
			<li>
				<h4><a href="company.php">Section professionnelle</a></h4>
				<ul>
					<li><a href="company.php#skills">Nos compétences</a></li>
					<li><a href="company.php#engagement">Nos engagements</a></li>
					<li><a href="company.php#news">Actualités professionnelles</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="partners">
		<h3>Nos partenaires</h3>
		<div>
			<img src="media/images/logos/partners/BNP-logo.png" alt="Logo BNP Parisbas">
			<img src="media/images/logos/partners/ALTEN-logo.png" alt="Logo Alten">
			<img src="media/images/logos/partners/ENGIE-logo.png" alt="Logo Engie">
			<img src="media/images/logos/partners/EY-logo.png" alt="Logo EY">
			<img src="media/images/logos/partners/SG-logo.png" alt="Logo Saint-Gobain">
			<img src="media/images/logos/SUPA-logo.png" alt="Logo de Montpellier Supagro">
		</div>
	</div>
	<div class="reseaux">
		<ul class="actions">
			<li>
				<a href="https://www.facebook.com/JEMontpellierAgro/" onclick="window.open(this.href); return false;" class="button-2"><i class="fa fa-facebook-f"></i></a>
			</li>
			<li>
				<a href="https://fr.linkedin.com/company/jema-junior-%C3%A9tude-montpellier-supagro" onclick="window.open(this.href); return false;" class="button-2"><i class="fa fa-linkedin"></i></a>
			</li>
			<li>
				<a href="https://twitter.com/jemamontpellier?lang=fr" onclick="window.open(this.href); return false;" class="button-2"><i class="fa fa-twitter"></i></a>
			</li>
			<li>
				<a href="contact" onclick="window.open(this.href); return false;" class="button-2"><i class="fa fa-envelope"></i></a>
			</li>
		</ul>
	</div>
	<div class="copyright">
		<p>Copyright © 2018 JEMA – Junior Etude Montpellier Agro Tous droits réservés.</p>
	</div>
</footer>

<section class="modal fade" id="mentions-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel">Mentions légales</h2>
      </div>
      <div class="modal-body">
        <h3>Éditeur du site</h3>
        <p>Nom : Blanc-Pattin Laurent</p>
        <p>Mail : l.blancpattin@gmail.com</p>
        <h3>Propriétaire du site</h3>
        <p>Nom : JEMA (Junior Etude Montpellier Agro)</p>
        <p>Adresse : 50 rue croix de las Cazes, 34000 Montpellier</p>
        <p>Mail : jema@supagro.fr</p>
        <p>Présidente et directrice de publication : Mélissa Hoffmann-Bernard (melissa.bernard@supagro.fr)</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</section><!-- /.modal -->