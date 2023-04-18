<?php
	//Pour la connection de la bdd
	require_once '..\..\database\config\connection.php';
	require_once '..\..\database\config\database.php';
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
		<?php
			if(isset($_SESSION["UTILISATEUR"])){
				echo " <h2 style=display:inline;> Bienvenue " . $_SESSION["UTILISATEUR"]["nom"] . " " . $_SESSION["UTILISATEUR"]["prenom"] . "</h4>";
			} 
			if(isset($_SESSION["merci"]))echo "<center><b>".$_SESSION["merci"]."</b></center>"; unset($_SESSION["merci"]);
		?>
		<div class = "global">
			<div class = "gauche">
				<h1>Filtres</h1>
				<form action="" method="post">
					<label><input type="checkbox" name="informatique" value="informatique"> Informatique</label>
					<br>
					<label><input type="checkbox" name="enfant" value="enfant"> Jeux pour enfant</label>
					<br>
					<label><input type="checkbox" name="vetement" value="vetement"> Vêtement</label>
					<br>
					<input type="submit" value="Envoyer">
				</form>
			</div>
			<div class="box">
				<?php
				// Requête pour récupérer les informations de chaque produit
				$resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur");

				//Parcours des résultats avec une boucle while
				while ($produit = mysqli_fetch_assoc($resultat)) {
					?>
					<form action="pageProduit.php" method="post">
						<div class="article">
							<button type="submit" style="background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;">
								<img src="../../img/<?php echo $produit['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
								<div>
									<h5><?php echo $produit['nom']; ?></h5>
									<p><?php echo $produit['minidescription']; ?></p>
									<p>Prix : <?php echo $produit['prix']; ?> €</p>
								</div>
							</button>
							<input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
						</div>
					</form>
					<?php
				}
				// Fermeture de la connexion à la base de données
				mysqli_close($conn);
				?>
			</div>
		</div>
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>
