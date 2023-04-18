<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ajouter une annonce</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="icon" type="image/png" href="./logo2.png">
</head>
<body>
	<div style="width: 520px; margin: auto;">
		<h1>Ajouter une annonce</h1>
		<form action="add_annonce.php" method="POST">
			<label for="titre">Titre de l'annonce :</label>
			<input type="text" id="titre" name="titre" required><br><br>
			<label for="description">Description :</label>
			<textarea id="description" name="description" required></textarea><br><br>
			<label for="prix">Prix :</label>
			<input type="number" id="prix" name="prix" min="0" required><br><br>
			<label for="photo">Photo :</label>
			<input type="file" id="photo" name="photo"><br><br>
			<input class="bouton-golden" type="submit" value="Ajouter">
		</form>
	</div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Traitement du formulaire
	$titre = $_POST['titre'];
	$description = $_POST['description'];
	$prix = $_POST['prix'];

	// Validation des données
	if(empty($titre) || empty($description) || empty($prix)) {
		echo "Veuillez remplir tous les champs";
	} else {
		// Insertion de l'annonce dans la base de données
		$bdd = new PDO('mysql:host=localhost;dbname=lenil;charset=utf8', 'root', '');
		$req = $bdd->prepare('INSERT INTO ProduitVendeur (nom, description, prix) VALUES (?, ?, ?)');
		$req->execute(array($titre, $description, $prix));
		echo "Annonce ajoutée avec succès !";
	}
}
?>
