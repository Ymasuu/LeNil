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
						$email = $_SESSION["UTILISATEUR"]["email"];
						$email = mysqli_real_escape_string($conn, $email);
						if (isset($_POST['ajouter_au_panier'])) {
							// Récupérer les informations du produit envoyées par le formulaire
							$produit_nom = $_POST['produit_nom'];
							$produit_id = $_POST['produit_id'];
							if(isset($_POST['quantite'])){
								$quantite = $_POST['quantite'];
							}
							$prix_produit = $_POST['prix_produit'];
							$prix_total = floatval($prix_produit) * floatval($quantite);
							
							$sqlNom = mysqli_real_escape_string($conn, $produit_nom);
							$sqlPrix_produit = mysqli_real_escape_string($conn, $prix_produit);
							$sqlQuantite = mysqli_real_escape_string($conn, $quantite);
							$sqlId_produit = mysqli_real_escape_string($conn, $produit_id);
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
								// on regarde si des commandes existent dans la table
								$sql = "SELECT * FROM quantiteCommande";
								$result = mysqli_query($conn, $sql);
								$resultCheck = mysqli_num_rows($result);
								if($resultCheck <= 0){
									$nouvelle_id = 0;
								}else {
									// on récupère l'id du dernier élément de la table
									$sql_ancien_id = "SELECT MAX(id) AS ancien_id FROM quantiteCommande";
									$result_ancien_id = $conn->query($sql_ancien_id);
									$row_ancien_id = $result_ancien_id->fetch_assoc();
									$ancien_id = $row_ancien_id['ancien_id'];
									// on l'incrémente de 1
									$nouvelle_id = $ancien_id + 1;
								}
								$sql = "INSERT INTO `quantiteCommande` (`id`, `idCommande`, `nom`, `emailClient`, `quantite`, `prix`) VALUES ('$sqlId_produit', '$nouvelle_id', '$sqlNom', '$email', '$sqlQuantite', '$sqlPrix_produit');";
								$result = mysqli_query($conn, $sql);
							}
						}
						
							$sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);

							$resultCheck = mysqli_num_rows($result);
							//Si un panier existe deja on affiche son contenu 
							if ($resultCheck > 0) {
								echo '<table>';
								echo '<tr><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Prix total</th></tr>';
								$sql = "SELECT * FROM quantiteCommande WHERE emailClient = '$email'";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) { // on affiche chaque produit ligne par ligne
									$nom = $row['nom'];
									$quantite = $row['quantite'];
									$prix = $row['prix'];
									echo '<tr>';
									echo '<td>' . $nom . '</td>';
									echo '<td>' . $quantite . '</td>';
									echo '<td>' . $prix . '</td>';
									echo '<td>' . $prix * $quantite . '€' . '</td>';
									echo '</tr>';
								}
								echo '</table>';
							}else echo 'Votre panier LeNil est vide.';						
						
							
							$sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							// Possibilité de modifier le panier s'il existe
							if ($resultCheck > 0) {
								echo '<form method="post" action="panier.php">';
								echo '<table>';
								echo '<tr><th>Produit</th><th>Quantité</th><th></th></tr>';
								$sql = "SELECT * FROM quantiteCommande WHERE emailClient = '$email'";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) { // on affiche chaque produit ligne par ligne
									$nom = $row['nom'];
									$quantite = $row['quantite'];
									$prix = $row['prix'];
									$prod = $row['id'];
									echo '<tr>';
									echo '<td>' . $nom . '</td>';
									echo '<td><input type="number" name="quantite[' . $prod . ']" value="' . $quantite . '"></td>';
									echo '<input type="hidden" name="nom[' . $prod . ']" value="' . $nom . '"></td>';
									echo '<td><input type="submit" name="modifier_quantite[' . $prod . ']" value="Modifier la quantité"></td>';
									echo '<td><input type="submit" class=bouton-golden name="supprimer_produit[' . $prod . ']" value="Supprimer"></td>';
									echo '</tr>';
								}				
								echo '</table>';
								echo '</form>';

								// Traitement des modifications de quantité ou de suppression de produits
								if (isset($_POST['modifier_quantite'])) { // Traitement de la modification de quantité
									foreach($_POST['modifier_quantite'] as $prod => $v) {
										$nom = $_POST['nom'][$prod];
										$nouvelle_quantite = $_POST['quantite'][$prod];
										$nom = mysqli_real_escape_string($conn, $nom);
										$nouvelle_quantite = mysqli_real_escape_string($conn, $nouvelle_quantite);
										// on supprime la ligne si la nouvelle quantite est egale a 0 ou moins
										if ($nouvelle_quantite <= 0){
											$sql = "DELETE FROM quantiteCommande WHERE nom = '$nom'";
											$result = mysqli_query($conn, $sql);
											// on vide le panier si c'était le dernier produit du client
											$sql = "SELECT * FROM quantiteCommande WHERE emailClient = '$email'";
											$result = mysqli_query($conn, $sql);
											$resultCheck = mysqli_num_rows($result);
											if ($resultCheck <= 0) { 
												$sql = "DELETE FROM quantiteCommande WHERE emailClient = '$email'";
												$result = mysqli_query($conn, $sql);							
												$sql = "DELETE FROM panier WHERE emailCompte = '$email'";
												$result = mysqli_query($conn, $sql);
											}
										}
										$sql = "UPDATE quantiteCommande SET quantite = '$nouvelle_quantite' WHERE nom = '$nom'";
										$result = mysqli_query($conn, $sql);
									}
									header('Location: panier.php');
									
								} else if (!empty($_POST['supprimer_produit'])) {
									foreach($_POST['supprimer_produit'] as $prod => $v) {
										$nom = $_POST['nom'][$prod];
										$nom = mysqli_real_escape_string($conn, $nom);
										// on supprime la ligne
										$sql = "DELETE FROM quantiteCommande WHERE nom = '$nom'";
										$result = mysqli_query($conn, $sql);
										// on vide le panier si c'était le dernier produit du client
										$sql = "SELECT * FROM quantiteCommande WHERE emailClient = '$email'";
										$result = mysqli_query($conn, $sql);
										$resultCheck = mysqli_num_rows($result);
										if ($resultCheck <= 0) {
											$sql = "DELETE FROM panier WHERE emailCompte = '$email'";
											$result = mysqli_query($conn, $sql);
										}
									}
									header('Location: panier.php');		
								}
															
								
								// on recalcule la valeur du panier en fonction des changements effectués
								$sql = "SELECT * FROM quantiteCommande WHERE emailClient = '$email'";
								$result = mysqli_query($conn, $sql);
								$resultCheck = mysqli_num_rows($result);
								if ($resultCheck > 0) {
									$prix = 0;
									while ($row = mysqli_fetch_assoc($result)) {
										$prix += $row['quantite'] * $row['prix'];
									}
									$sql = "UPDATE panier SET HT = '$prix' WHERE emailCompte='$email'";
									$result = mysqli_query($conn, $sql);
									$sql = "UPDATE panier SET TTC = HT * 1.2 WHERE emailCompte='$email'";
									$result = mysqli_query($conn, $sql);
								}
							}
	
					?>	
					<form method="post" action="panier.php">
						<input type="hidden" name="action" value="vider_panier">
						<button type="submit" class="bouton-golden">Tout supprimer</button>
					</form>
					<?php
						if (isset($_POST['action']) && $_POST['action'] == 'vider_panier') {
							$sql = "DELETE FROM quantiteCommande WHERE emailClient = '$email'";
							$result = mysqli_query($conn, $sql);							
							$sql = "DELETE FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);
							header('Location: panier.php'); 
						}
					?>
				</div>
			</div>
			<div class="total">
				<h1>Total</h1>
				<div>
					<h5>Prix Hors Taxe : 
						<?php
							$sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							// Possibilité de modifier le panier s'il existe
							if ($resultCheck > 0) {
								$row = mysqli_fetch_assoc($result);
								$prixHT = $row['HT'];
							}
							if(isset($prixHT)){
								echo $prixHT . " €";
							}
						?>
					</h5>
					<h5>Prix TTC (20% de TVA) :  
						<?php
							$sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							// Possibilité de modifier le panier s'il existe
							if ($resultCheck > 0) {
								$row = mysqli_fetch_assoc($result);
								$prix = $row['TTC'];
							}
							if(isset($prix)){
								echo $prix . " €";
							}
						?>
					</h5>
					<h5>Livraison
						<?php
							if (isset($prix)) {
								if($_SESSION["UTILISATEUR"]["Abonnement"] == "None"){
									$livraison = $prix * 0.05;
									$livraison = round($livraison, 2);
									echo $livraison;
								}else{
									$livraison = 0;
									echo $livraison . " €";
								} 

							}
						?>
					</h5>
				</div>
				<hr>
				<div>
					<h5>Total final</h5>
					<?php
						if(isset($prix) && isset($livraison)) {
							$total_final = $prix + $livraison;
							$sql = "UPDATE panier SET TTC = '$total_final' WHERE emailCompte='$email'";
							$result = mysqli_query($conn, $sql);
						}
						if(isset($_SESSION["UTILISATEUR"]["prixCode"])){
							$total_final = $_SESSION["UTILISATEUR"]["prixCode"];
							$sql = "UPDATE panier SET TTC = '$total_final' WHERE emailCompte='$email'";
							$result = mysqli_query($conn, $sql);
						}
					?>
					<h5>
						<?php 
							if(isset($total_final)){
								echo $total_final . " €";
							}
						?>
					</h5>
				</div>
				<form action="../Contrôleur/process_commander.php" method="post">
					<input type="submit" class="bouton-golden" name="commander" value="Commander">
				</form>
			</div>
		</div>
		<div class="wrapper">
			<div class="livraison">
				<h1>Livraison estimée</h1>
				<div>
					<h5>Livraison estimée le :
						<?php
							$sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
							$result = mysqli_query($conn, $sql);

							$resultCheck = mysqli_num_rows($result);
							//Si le panier existe 
							if ($resultCheck > 0) {								
								date_default_timezone_set('Europe/Paris');
								$date = date('Y-m-d');
								if($_SESSION["UTILISATEUR"]["Abonnement"] == "None"){
									$date = date('Y-m-d', strtotime($date . ' +3 days'));
								} else $date = date('Y-m-d', strtotime($date . ' +1 days'));
								echo $date;
							}
						?>
					</h5>
				</div>
			</div>
			<center class="code">
				<h3>Ajouter un code promo</h3>
				<form action="../Contrôleur/process_codePromo.php" method="post">
					<input type="text" name="code" placeholder="Entrez un code">
					<button type="submit" class="bouton-golden">Envoyer</button>
				</form>
			</center>
		</div>
	<hr> <!-- Repère visuel temporaire -->
	<?php include '../../templates/footer.php'; ?>
</body>
</html>