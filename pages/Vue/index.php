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
			</div>
			<div class = "box">
                <?php
                    // Requête pour récupérer les informations de chaque produit
                    $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur");

                    //Parcours des résultats avec une boucle while
                    while ($produit = mysqli_fetch_assoc($resultat)) {
                ?>
                <button class="article" onclick="window.location.href='pageProduit.php'">
                    <img src="../../img/<?php echo $produit['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                    <div>
                        <h5><?php echo $produit['nom']; ?></h5>
                        <p><?php echo $produit['minidescription']; ?></p>
                        <p>Prix : <?php echo $produit['prix']; ?> €</p>
                    </div>
                </button>
                <?php
                }
                // Fermeture de la connexion à la base de données
                mysqli_close($conn);
                ?>
            </div>
		</div>
		<form action="Vendeur.php">
			<input type="submit" value="Gérer Produit">
		</form>
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>
