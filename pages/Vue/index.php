<?php
	session_start();
?>
<!DOCTYPE html>
<html> 
	<head>
		<meta cjharset="utf-8">
		<meta name="viewport">
		<title>Accueil</title>
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="icon" type="image/png" href="../../img/logo2.png">
	</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
		<?php if(isset($_SESSION["merci"]))echo "<center><b>".$_SESSION["merci"]."</b></center>";?>
		<div class = "global">

			<div class = "gauche">
				<h1>Filtres</h1>
			</div>

			<div class = "box">
				<button class ="article">
					<img src="../../img/casquette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 10.50€</p>   
					<h5>Casquette</h5> 
				</button>

				<button class ="article">
					<img src="../../img/lunette_soleil.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 8.99€</p>  
					<h5>Lunette de soleil</h5>
				</button>

				<button class ="article">
					<img src="../../img/claquette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 13.50€</p>
					<h5>Claquette</h5>
				</button>

				<button class ="article">
					<img src="../../img/chaussette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 9.50€</p>
					<h5>Chaussette</h5>
				</button>

				<button class ="article">
					<img src="../../img/tour.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 950€</p>   
					<h5>Tour gaming</h5> 
				</button>

				<button class ="article">
					<img src="../../img/ecran.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 179.99€</p>  
					<h5>Ecran</h5>
				</button>

				<button class ="article">
					<img src="../../img/ordi_portable.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 1149.99€</p>
					<h5>PC portable gamer</h5>
				</button>

				<button class ="article">
					<img src="../../img/manette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 50€</p>
					<h5>Manette</h5>
				</button>

				<button class ="article">
					<img src="../../img/souris.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 30€</p>   
					<h5>Souris</h5> 
				</button>

				<button class ="article">
					<img src="../../img/clavier.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 50€</p>  
					<h5>Clavier</h5>
				</button>

				<button class ="article">
					<img src="../../img/casque.png" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 45€</p>
					<h5>Casque</h5>
				</button>

				<button class ="article">
					<img src="../../img/hdmi.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 6.50€</p>
					<h5>Câble HDMI</h5>
				</button>

				<button class ="article">
					<img src="../../img/lego_voiture.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 449.99€</p>   
					<h5>Lego Technic Voiture</h5> 
				</button>

				<button class ="article">
					<img src="../../img/lego2.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 179.99€</p>  
					<h5>Lego City</h5>
				</button>

				<button class ="article">
					<img src="../../img/playmobil.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 70€</p>
					<h5>Playmobil</h5>
				</button>

				<button class ="article">
					<img src="../../img/playmobil2.jpeg" style="width: 100px; height: 100px; margin-right: 10px;">
					<p>Prix : 35€</p>
					<h5>Playmobil</h5>
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