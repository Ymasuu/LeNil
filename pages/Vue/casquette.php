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
				<img src="../../img/casquette.jpg" >
			</div>
			<div class="detail">
				<h1>Casquette</h1>
				<hr>
				<h2>Accessoire de mode</h2>
				<hr>
				<p>Prix : 10.50€</p>
			</div>
			<div class="info">
				<div class="prix">10.50€</div>
				<div class="stock">En stock</div>

				<?php
				if(isset($_POST['ajouter_au_panier'])){
					$produit_id = 'Casquette';
					$prix_produit = '10.50€';
					$quantite = $_POST['quantite'];
					// Ajouter ici la logique pour ajouter l'article au panier
				}
				?>

				<div class="quantite">
					<label for="qty">Quantité :</label>
					<input type="number" name="quantite" id="qty" min="1" max="100" value="1">
				</div>

				<form method="post" action="panier.php">
					<input type="hidden" name="produit_id" value="Casquette">
					<input type="hidden" name="prix_produit" value="10.50€">
					<input type="hidden" name="quantite" value="<?php echo $quantite; ?>">
					<input type="submit" name="ajouter_au_panier" value="Ajouter au panier">
				</form>

			</div>
		</div>
		

		<hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>