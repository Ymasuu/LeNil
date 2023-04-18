<?php
	//Pour la connection de la bdd
	require_once '..\..\database\config\connection.php';
	require_once '..\..\database\config\database.php';
	session_start();

	// Vérifier si un identifiant de produit est spécifié dans l'URL
	if(isset($_GET['produit_id'])) {
		$produit_id = $_GET['produit_id'];

		// Requête pour récupérer les informations du produit correspondant à l'identifiant spécifié
		$resultat = mysqli_query($conn, "SELECT * FROM ProduitsVendeur WHERE nom='$produit_id'");

		// Vérifier si le produit existe dans la base de données
		if(mysqli_num_rows($resultat) > 0) {
			// Récupérer les informations du produit
			$produit = mysqli_fetch_assoc($resultat);
?>
<!DOCTYPE html>
<html> 
<head>
	<meta cjharset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Casquette</title>
	<link rel="stylesheet" href="../../css/casquette.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
		<hr> <!-- Repère visuel temporaire -->
		<div class="page">
				<div class="image">
					<img src="../../img/<?php echo $produit['NomImage']; ?>" >
				</div>
				<div class="detail">
					<h1><?php echo $produit['nom']; ?></h1>
					 <hr>
					<h2><?php echo $produit['description']; ?></h2>
					<hr>
					<p>Prix : <?php echo $produit['prix']; ?> €</p>
				</div>
				<div class="info">
					<div class="prix"><?php echo $produit['prix']; ?> €</div>
					<div class="stock"><?php if($produit['QuantiteVendeur'] > 0) { echo 'En stock'; } else { echo 'Rupture de stock'; } ?></div>

					<?php
					if(isset($_POST['ajouter_au_panier'])){
						$prix_produit = $produit['prix'];
						$quantite = $_POST['quantite'];
						// Ajouter ici la logique pour ajouter l'article au panier
					}
					?>

					<div class="quantite">
						<label for="qty">Quantité :</label>
						<input type="number" name="quantite" id="qty" min="1" max="100" value="1">
					</div>

					<form method="post" action="panier.php">
						<input type="hidden" name="produit_id" value="<?php echo $produit['nom']; ?>">
						<input type="hidden" name="prix_produit" value="<?php echo $produit['prix']; ?> €">
						<input type="hidden" name="quantite" value="<?php echo $quantite; ?>">
						<input type="submit" name="ajouter_au_panier" value="Ajouter au panier">
                </form>

            </div>
            <?php
            }
            ?>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>
