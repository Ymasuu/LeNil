<?php
	session_start();
?>
<!DOCTYPE html>
<html> 
	<head>
		<meta cjharset="utf-8">
		<meta name="viewport">
		<title>Accueil</title>
		<link rel="stylesheet" href="../../css/index.css">
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="icon" type="image/png" href="../../img/logo2.png">
	</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
		<?php if(isset($_SESSION["merci"]))echo "<center><b>".$_SESSION["merci"]."</b></center>"; unset($_SESSION["merci"]);?>
		<div class = "global">

			<div class = "gauche">
				<h1>Filtres</h1>
			</div>
			<div class = "box">
				<button class="article">
					<img src="../../img/casquette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<div>
						<h5>Casquette</h5>
						<p>Accessoire de mode</p>
						<p>Prix : 10.50€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/lunette_soleil.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<div>
						<h5>Lunette de soleil</h5>
						<p>Accessoire de mode</p>
						<p>Prix : 8.99€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/claquette.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Claquette</h5>
						<p>Chaussure d'été</p>
						<p>Prix : 13.50€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/chaussette.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Chaussette</h5>
						<p>Chaussette confortable</p>
						<p>Prix : 9.50€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/tour.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Tour gaming</h5>
						<p>Ordinateur pour gamer</p>
						<p>Prix : 950€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/ecran.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Ecran</h5>
						<p>Ecran haute résolution</p>
						<p>Prix : 179.99€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/ordi_portable.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>PC portable gamer</h5>
						<p>Ordinateur portable pour gamer</p>
						<p>Prix : 1149.99€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/manette.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Manette</h5>
						<p>Manette de jeu</p>
						<p>Prix : 50€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/souris.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Souris</h5>
						<p>Souris de jeu</p>
						<p>Prix : 30€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/clavier.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Clavier</h5>
						<p>Clavier de jeu</p>
						<p>Prix : 50€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/casque.png" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Casque</h5>
						<p>Casque de jeu</p>
						<p>Prix : 45€</p>
					</div>
				</button>
				
				<button class="article">
					<img src="../../img/hdmi.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Câble HDMI</h5>
						<p>Câble de connexion</p>
						<p>Prix : 6.50€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/lego_voiture.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Lego Technic Voiture</h5>
						<p>Lego pour adulte</p>
						<p>Prix : 449.99€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/lego2.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Lego City</h5>
						<p>Lego pour construire votre ville</p>
						<p>Prix : 179.99€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/playmobil.jpg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Playmobil</h5>
						<p>Pour vos enfants</p>
						<p>Prix : 70€</p>
					</div>
				</button>

				<button class="article">
					<img src="../../img/playmobil2.jpeg" style="width: 100px; height: 100px; margin-right: 10px; float:left;">
					<div>
						<h5>Playmobil</h5>
						<p>Pour vos enfants</p>
						<p>Prix : 35€</p>
					</div>
				</button>
				
				<?php
					if(isset($_SESSION["UTILISATEUR"])){
						echo "Vous êtes connecté en tant que " . $_SESSION["UTILISATEUR"]["nom"] . " " . $_SESSION["UTILISATEUR"]["prenom"];
					}
				?>
			</div>
		</div>
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>