<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajouter une annonce</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <h1>Ajouter une annonce</h1>
        </header>
        <main>
            <form method="post" enctype="multipart/form-data">
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
                    <label for="image">Image :</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <div>
                    <button class="bouton-golden" type="submit" name="submit">Ajouter</button>
                </div>
            </form>
        </main>
    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_FILES['image'];

    // Vérifier si l'utilisateur a choisi un fichier
    if ($image['name'] !== '') {
        // Vérifier si le fichier est une image
        if (getimagesize($image['tmp_name'])) {
            // Générer un nom de fichier unique
            $filename = uniqid('', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
            // Enregistrer l'image sur le serveur
            move_uploaded_file($image['tmp_name'], 'uploads/' . $filename);
            // Enregistrer les données de l'annonce dans la base de données
            // ...
            // Rediriger vers la page d'accueil
            header('Location: index.php');
            exit;
        } else {
            echo 'Le fichier choisi n\'est pas une image.';
        }
    } else {
        // Enregistrer les données de l'annonce dans la base de données
        // ... A faire
        // Rediriger vers la page d'accueil
        header('Location: index.php');
        exit;
    }
}
?>
