<nav class="navbar navbar-default navbar-fixed-top">
	<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="branding-container"><a id="branding" href="#"><img src="../../media/images/nav_branding.png" alt="Branding de la JEMA"></a></div>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#about">Qui sommes-nous ?</a></li>
        <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#faq">Participer à une étude</a></li>
        <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#member">Devenir membre actif</a></li>
        <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#news">Actualités</a></li>
        <li class="nav-links nav-main-link"><span class="main-link-background"></span><a class="scrollspy" href="student.php#contact">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li id="social-nav">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</li>
        <li class=""><a id="back" class="" href="index.php">Retour à l'accueil</a></li>
        <?php 
        	if(isset($_SESSION['login'])){	
        ?>
    		<li class=""><a href="disconnect.php">Déconnexion</a></li>
        <?php 
        	}
        ?>
        </ul>
    </div>
</nav>