<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="../../css/header.css">
<script src="https://kit.fontawesome.com/33e6d2f05c.js" crossorigin="anonymous"></script>

<header>
	<nav class="header-nav">
		<ul>
			<li class="current"><a href="index.php"><img src="../../img/logo.png" alt="logo_du_site" width="175px"></a></li>
			<div class="search-container">
				<form class="search-form" method="get">
					<input type="text" name="query" placeholder="Rechercher sur LeNil.com">
					<button type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
				</form>
			</div>
			<?php
			if(!isset($_SESSION["UTILISATEUR"]["TypeCompte"])) echo "<li class='style'><a href='about.php' class='lien'>A propos</a></li>";
			else if ($_SESSION["UTILISATEUR"]["TypeCompte"] == "vendeur") echo "<li class='style'><a href='Vendeur.php' class='lien'>Gérer Produit</a></li>";
			else echo "<li class='style'><a href='profil.php' class='lien'>Profil</a></li>";

			if (!isset($_SESSION["UTILISATEUR"])) echo "<li class='style'><a href='login.php' class='lien'>Se Connecter</a></li>";
			else echo "<li class='style'><a href='../Contrôleur/process_logout.php' class='lien'>Se Déconnecter</a></li>";
			if((!isset($_SESSION["UTILISATEUR"])) or ($_SESSION["UTILISATEUR"]["Abonnement"] == "None")){
					echo "<li class='style'><a href='abonnement.php' class='lien'>S'abonner</a></li>";
				} else echo"<li class='style'><a href='../Contrôleur/process_abonnement.php' class='lien'>Se Désabonner</a></li>";
			?>
			<div class="test">
				<li class="style"><a href="panier.php" class="lien">
						<i class="fa-sharp fa-solid fa-cart-shopping"></i> Panier</a></li>
			</div>
		</ul>
		<br>
	</nav>
</header>