<?php
	//Pour la connection de la bdd
	require_once '..\..\database\config\connection.php';
	require_once '..\..\database\config\database.php';
    session_start();
    // Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
    if(!isset($_SESSION['UTILISATEUR'])){
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html> 
<head>
	<meta cjharset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panier</title>
	<link rel="stylesheet" href="../../css/panier.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<?php include '../../templates/header.php'; ?>
		<hr> <!-- Repère visuel temporaire -->
		<div class="wrapper">
			<div class="panier">
				<h1>Panier</h1>
				<div>
					<?php
						if (isset($_POST['ajouter_au_panier'])) {
							// Récupérer les informations du produit envoyées par le formulaire
							$produit_id = $_POST['produit_id'];
							$quantite = $_POST['quantite'];
							$prix_produit = floatval($_POST['prix_produit']);
							
							// Vérifier si le panier existe déjà dans la session
							if (!isset($_SESSION['panier'])) {
								$_SESSION['panier'] = array(); // Si non, créer un tableau vide pour le panier
							}
							
							// Vérifier si le produit est déjà dans le panier
							if (isset($_SESSION['panier'][$produit_id])) {
								// Si oui, mettre à jour la quantité et le prix total du produit dans le panier
								$_SESSION['panier'][$produit_id]['quantite'] += $quantite;
								$_SESSION['panier'][$produit_id]['prix_total'] += floatval($prix_produit) * $quantite;
							} else {
								// Si non, ajouter le produit au panier avec sa quantité et son prix total
								$_SESSION['panier'][$produit_id] = array(
									'quantite' => $quantite,
									'prix_produit' => $prix_produit,
									'prix_total' => floatval($prix_produit) * $quantite
								);
							}
						}

						// Afficher le contenu du panier
						if (isset($_SESSION['panier'])) {
							echo '<table>';
							echo '<tr><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Prix total</th></tr>';
							$total_panier = 0;
							foreach ($_SESSION['panier'] as $produit_id => $produit) {
								echo '<tr>';
								echo '<td>' . $produit_id . '</td>';
								echo '<td>' . $produit['quantite'] . '</td>';
								echo '<td>' . $produit['prix_produit'] . '</td>';
								echo '<td>' . $produit['prix_produit'] * $produit['quantite'] . '</td>';
								echo '</tr>';
								$total_panier += $produit['prix_produit'] * $produit['quantite'];
							}				 
							echo '</table>';
							echo 'Total du panier : ' . $total_panier;
						} else {
							echo 'Votre panier LeNil est vide.';
						}
						
						
						// Donner à l'utilisateur la possibilité de modifier la quantité ou de supprimer des produits du panier
						if (isset($_SESSION['panier'])) {
							echo '<form method="post" action="panier.php">';
							echo '<table>';
							echo '<tr><th>Produit</th><th>Quantité</th><th></th></tr>';
							foreach ($_SESSION['panier'] as $produit_id => $produit) {
								echo '<tr>';
								echo '<td>' . $produit_id . '</td>';
								echo '<td><input type="number" name="quantite[' . $produit_id . ']" value="' . $produit['quantite'] . '"></td>';
								echo '<td><input type="submit" name="modifier_quantite" value="Modifier la quantité"></td>';
								echo '<td><input type="submit" name="supprimer_produit[' . $produit_id . ']" value="Supprimer"></td>';

								echo '</tr>';
							}				
							echo '</table>';
							echo '</form>';
						
							// Traiter les modifications de quantité ou de suppression de produits
							if (isset($_POST['modifier_quantite'])) {
								// Traitement de la modification de quantité
								foreach ($_POST['quantite'] as $produit_id => $nouvelle_quantite) {
									$prix_produit = $_SESSION['panier'][$produit_id]['prix_produit'];
									$_SESSION['panier'][$produit_id]['quantite'] = $nouvelle_quantite;
									$_SESSION['panier'][$produit_id]['prix_total'] = $_SESSION['panier'][$produit_id]['quantite'] * $prix_produit;
								}
								header('Location: panier.php'); // Recharger la page pour afficher les nouvelles informations du panier
							} elseif (!empty($_POST['supprimer_produit'])) {
								// Traitement de la suppression de produits
								foreach ($_POST['supprimer_produit'] as $produit_id => $valeur) {
									unset($_SESSION['panier'][$produit_id]); // Supprimer le produit du panier
								}
								header('Location: panier.php'); // Recharger la page pour afficher les nouvelles informations du panier
							}				
						}	
						
						if (isset($_POST['action']) && $_POST['action'] == 'vider_panier') {
							unset($_SESSION['panier']);
						}
					?>	
					<form method="post" action="panier.php">
						<input type="hidden" name="action" value="vider_panier">
						<button type="submit">Tout supprimer</button>
					</form>
				</div>
			</div>
			<div class="total">
				<h1>Total</h1>
				<div>
					<h5>Sous-total</h5>
					<p>
						<?php echo $total_panier; ?>
					</p>
					<h5>Livraison</h5>
					<p>
						<?php 
							$livraison = 14.99;
							echo $livraison; 
						?>
					</p>
				</div>
				<hr>
				<div>
					<h5>Total final</h5>
					<?php $total_final = $total_panier + $livraison; ?>
					<p>
						<?php echo $total_final; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<div class="livraison">
				<h1>Livraison estimée</h1>
				<div>
					<h5>Livraison estimée le :</h5>
				</div>
			</div>
			<div class="code">
				<h3>Ajouter un code promo</h3>
				<form action="" method="post">
					<input type="text" name="nom" placeholder="Entrez un code"><br>
					<button type="submit">Envoyer</button>
				</form>
			</div>
		</div>
	<hr> <!-- Repère visuel temporaire -->
	<?php include '../../templates/footer.php'; ?>
</body>
</html>