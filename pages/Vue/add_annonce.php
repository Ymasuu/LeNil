<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajouter une annonce</title>
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
    </head>
    <body>
        <header>
            <h1>Ajouter une annonce</h1>
        </header>
        <main>
            <form method="post">
                <div>
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre" name="titre" required>
                </div>
                <div>
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>
                <div>
                    <label for="prix">Prix :</label>
                    <input type="number" id="prix" name="prix" required>
                </div>
                <div>
                    <button type="submit" name="submit">Ajouter</button>
                </div>
            </form>
        </main>
        <footer>
            <a href="#" class="bouton-golden">Supprimer mon compte</a>
            <hr>
            
        </footer>
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
