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