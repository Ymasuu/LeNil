<?php
    // Pour la connection de la bdd
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LE NIL</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>

<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div>
            <div class = "box">
                <?php
                    // Récupération de l'ID du vendeur connecté à partir de la session
                    $emailCompte = $_SESSION['emailCompte'];

                    // Récupération des produits du vendeur connecté
                    $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur WHERE idVendeur = $emailCompte");

                    // Affichage des produits
                    while ($produit = mysqli_fetch_assoc($resultat)) {
                ?>
                <button class="article">
                    <img src="../../img/<?php echo $produit['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                    <div>
                        <h5><?php echo $produit['nom']; ?></h5>
                        <p><?php echo $produit['minidescription']; ?></p>
                        <p>Prix : <?php echo $produit['prix']; ?> €</p>
                    </div>
                </button>
                <?php
                    }
                ?>
			</div>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>