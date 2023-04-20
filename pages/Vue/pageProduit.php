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
    <link rel="stylesheet" href="../../css/style.css">
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
                <hr>
                <p>Categorie : <?php echo $produit['categorie']; ?></p>
            </div>
            <div class="info">
                <div class="prix"><?php echo $produit['prix']; ?> €</div>
                <div class="stock"><?php if($produit['QuantiteVendeur'] > 0) { echo 'En stock'; } else { echo 'Rupture de stock'; } ?></div>
                
                <form method="post" action="panier.php">
                    <div class="quantite">
                        <label for="qty">Quantité :</label>
                        <input type="number" name="quantite" id="qty" min="1" max="100" value="1">
                    </div>
                    <input type="hidden" name="produit_id" value="<?php echo $produit['nom']; ?>">
                    <input type="hidden" name="prix_produit" value="<?php echo $produit['prix']; ?>">
                    <input type="submit" name="ajouter_au_panier" value="Ajouter au panier">
                </form>
            </div>

            <?php
            if(isset($_POST['quantite'])) {
                $quantite = $_POST['quantite'];
            }
            ?>

            <?php
                } else {
                    // Si aucun produit n'a été cliqué, afficher un message d'erreur
                    echo "<p>Aucun produit sélectionné.</p>";
                }
            ?>
        </div>
        <hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>