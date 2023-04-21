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
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<?php include '../../templates/header.php'; ?>
	<?php
		if(isset($_SESSION["message"]))echo "<center><b>".$_SESSION["message"]."</b></center>"; unset($_SESSION["message"]);
	?>
		<div class="wrapper">
			<div class="panier">
				<h1>Panier</h1>
				<div>
					<?php
						if (isset($_POST['ajouter_au_panier'])) {
							// Récupérer les informations du produit envoyées par le formulaire
							$produit_nom = $_POST['produit_nom'];
							$produit_id = $_POST['produit_id'];
							if(isset($_POST['quantite'])){
								$quantite = $_POST['quantite'];
							}
							$prix_produit = $_POST['prix_produit'];
							$prix_total = floatval($prix_produit) * floatval($quantite);
							
							$sqlPrix_produit = mysqli_real_escape_string($conn, $prix_produit);
							$sqlQuantite = mysqli_real_escape_string($conn, $quantite);
							$sqlId_produit = mysqli_real_escape_string($conn, $produit_id);
							$email = $_SESSION["UTILISATEUR"]["email"];
							$email = mysqli_real_escape_string($conn, $email);
							$sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);

							$resultCheck = mysqli_num_rows($result);
							//Si un panier existe deja, on met à jour les valeurs
							if ($resultCheck > 0) {
								$sql = "UPDATE panier SET HT = HT + '$prix_total' WHERE emailCompte='$email'";
								$result = mysqli_query($conn, $sql);
								$sql = "UPDATE panier SET TTC = HT * 1.2 WHERE emailCompte='$email'";
								$result = mysqli_query($conn, $sql);
							} else {
								$sql = "INSERT INTO `panier` (`emailCompte`, `HT`, `TVA`, `TTC`) VALUES ('$email', '$prix_total', 20.00, '$prix_total'*1.2);";
								$result = mysqli_query($conn, $sql);
							}


// FAIT							// Vérifier si le panier existe déjà dans la session
							if (!isset($_SESSION['panier'])) {
								$_SESSION['panier'] = array(); // Si non, créer un tableau vide pour le panier
							}

							$sql = "SELECT * FROM quantiteCommande WHERE id = '$sqlId_produit' AND emailClient = '$email'";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							//Si le produit est deja présent dans le panier
							if ($resultCheck > 0) {
								$sql = "UPDATE quantiteCommande SET quantite = quantite + $quantite WHERE id = '$sqlId_produit' AND emailClient = '$email'";
								$result = mysqli_query($conn, $sql);
								$sql = "UPDATE quantiteCommande SET prix = $sqlPrix_produit * quantite";
								$result = mysqli_query($conn, $sql);					
							} else {
								$sql = "INSERT INTO `quantiteCommande` (`id`, `emailClient`, `quantite`, `prix`) VALUES ('$sqlId_produit', '$email', '$sqlQuantite', '$sqlPrix_produit'*$sqlQuantite);";
								$result = mysqli_query($conn, $sql);
							}

// FAIT								// Vérifier si le produit est déjà dans le panier
							if (isset($_SESSION['panier'][$produit_nom])) {
								// Si oui, mettre à jour la quantité et le prix total du produit dans le panier
								$_SESSION['panier'][intval($produit_nom)]['quantite'] += intval($quantite);
								$_SESSION['panier'][$produit_nom]['prix_total'] += $prix_total;
							} else {
								// Si non, ajouter le produit au panier avec sa quantité et son prix total
								$_SESSION['panier'][$produit_nom] = array(
									'quantite' => $quantite,
									'prix_produit' => $prix_produit,
									'prix_total' => $prix_total
								);
							}
						}
						// Afficher le contenu du panier
						if (isset($_SESSION['panier'])) {
							echo '<table>';
							echo '<tr><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Prix total</th></tr>';
							$total_panier = 0;
							foreach ($_SESSION['panier'] as $produit_nom => $produit) {
								echo '<tr>';
								echo '<td>' . $produit_nom . '</td>';
								echo '<td>' . $produit['quantite'] . '</td>';
								echo '<td>' . $produit['prix_produit'] . '</td>';
								echo '<td>' . floatval($produit['prix_produit']) * floatval($produit['quantite']) . '</td>';
								echo '</tr>';
								$total_panier += floatval($produit['prix_produit']) * floatval($produit['quantite']);
							}				 
							echo '</table>';
						} else {
							echo 'Votre panier LeNil est vide.';
						}
						
						
						// Donner à l'utilisateur la possibilité de modifier la quantité ou de supprimer des produits du panier
						if (isset($_SESSION['panier'])) {
							echo '<form method="post" action="panier.php">';
							echo '<table>';
							echo '<tr><th>Produit</th><th>Quantité</th><th></th></tr>';
							foreach ($_SESSION['panier'] as $produit_nom => $produit) {
								echo '<tr>';
								echo '<td>' . $produit_nom . '</td>';
								echo '<td><input type="number" name="quantite[' . $produit_nom . ']" value="' . $produit['quantite'] . '"></td>';
								echo '<td><input type="submit" name="modifier_quantite" value="Modifier la quantité"></td>';
								echo '<td><input type="submit" name="supprimer_produit[' . $produit_nom . ']" value="Supprimer"></td>';

								echo '</tr>';
							}				
							echo '</table>';
							echo '</form>';
						
							// Traiter les modifications de quantité ou de suppression de produits
							if (isset($_POST['modifier_quantite'])) {
								// Traitement de la modification de quantité
								foreach ($_POST['quantite'] as $produit_nom => $nouvelle_quantite) {
									$prix_produit = $_SESSION['panier'][$produit_nom]['prix_produit'];
									$_SESSION['panier'][$produit_nom]['quantite'] = $nouvelle_quantite;
									$_SESSION['panier'][$produit_nom]['prix_total'] = $_SESSION['panier'][$produit_nom]['quantite'] * $prix_produit;
								}
								header('Location: panier.php'); // Recharger la page pour afficher les nouvelles informations du panier
							} elseif (!empty($_POST['supprimer_produit'])) {
								// Traitement de la suppression de produits
								foreach ($_POST['supprimer_produit'] as $produit_nom => $valeur) {
									unset($_SESSION['panier'][$produit_nom]); // Supprimer le produit du panier
								}
								header('Location: panier.php'); // Recharger la page pour afficher les nouvelles informations du panier
							}				
						}	
					?>	
					<form method="post" action="panier.php">
						<input type="hidden" name="action" value="vider_panier">
						<button type="submit">Tout supprimer</button>
					</form>
					<?php
						if (isset($_POST['action']) && $_POST['action'] == 'vider_panier') {
							unset($_SESSION['panier']);
							unset($_SESSION['prixPanier']);
						}
					?>
				</div>
			</div>
			<div class="total">
				<h1>Total</h1>
				<div>
					<h5>Sous-total</h5>
					<p>
						<?php if(isset($total_panier)) echo $total_panier; ?>
					</p>
					<h5>Livraison</h5>
					<p>
						<?php 
							$livraison = 14.99;
							if(isset($livraison)) echo $livraison; 
						?>
					</p>
				</div>
				<hr>
				<div>
					<h5>Total final</h5>
					<?php
						if(isset($total_panier) && isset($livraison)) {
							$total_final = $total_panier + $livraison;
						}
					?>
					<p>
						<?php 
							if(isset($total_final)){
								if(isset($_SESSION['prixPanier'])){
									$total_final = $_SESSION['prixPanier'];
									unset($_SESSION['prixPanier']);
								} 
								else $_SESSION['prixPanier'] = $total_final;
								echo $total_final;
							}
						?>
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
			<center class="code">
				<h3>Ajouter un code promo</h3>
				<form action="../Contrôleur/process_codePromo.php" method="post">
					<input type="text" name="code" placeholder="Entrez un code">
					<button type="submit">Envoyer</button>
				</form>
			</center>
		</div>
	<hr> <!-- Repère visuel temporaire -->
	<?php include '../../templates/footer.php'; ?>
</body>
</html>