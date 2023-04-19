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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casquette</title>
    <link rel="stylesheet" href="../../css/pageProduit.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div class="page">
            <?php
                if (isset($_POST['produit_id'])) {
                    // Requête pour récupérer les informations du produit cliqué
                    $produit_id = $_POST['produit_id'];
                    $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur WHERE id = '$produit_id'");

                    // Afficher les informations du produit
                    $produit = mysqli_fetch_assoc($resultat);
            ?>
            <div class="image">
                <img src="../../img/<?php echo $produit['NomImage']; ?>" >
            </div>
            <div class="detail">
                <h1><?php echo $produit['nom']; ?></h1>
                 <hr>
                <h2><?php echo $produit['description']; ?></h2>
                <hr>
                <p>Prix : <?php echo $produit['prix']; ?> €</p>
                <p>Catégorie : <?php echo $produit['categorie']; ?></p>

            </div>
            <div class="info">
                <div class="prix"><?php echo $produit['prix']; ?> €</div>
                <div class="stock"><?php if($produit['QuantiteVendeur'] > 0) { echo 'En stock'; } else { echo 'Rupture de stock'; } ?></div>
                <?php
                if(isset($_POST['ajouter_au_panier'])){
                    $produit_id = $produit['nom'];
                    $prix_produit = $produit['prix'];
                    $quantite = $_POST['quantite'];
                    // Ajouter ici la logique pour ajouter l'article au panier
                }
                ?>
            </div>
            <?php
                } else {
                    // Si aucun produit n'a été cliqué, afficher un message d'erreur
                    echo "<p>Aucun produit sélectionné.</p>";
                }
            ?>
        </div>
            <form method="post" action="modifProduitVendeur.php">
                <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                <input type="submit" name="modifier_un_produit" value="Modifier ce produit">
            </form>
            <form method="post" action="../Contrôleur/procces_suppProduit.php">
                <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                <input type="submit" name="supprimer_un_produit" value="Supprimer ce produit">
            </form>
        <hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>