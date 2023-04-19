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
    <link rel="stylesheet" href="../../css/vendeur.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div class = "global">
            <div class="box">
                <?php
                    // Vérifier si la variable de session 'email' existe
                    if (isset($_SESSION["UTILISATEUR"]["email"])) {
                        // Requête pour récupérer les informations de chaque produit du vendeur connecté
                        $email = $_SESSION["UTILISATEUR"]["email"];
                        $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur WHERE emailVendeur = '$email'");
                        //Parcours des résultats avec une boucle while
                        while ($produit = mysqli_fetch_assoc($resultat)) {
                ?>
                  <form action="pageProduitVendeur.php" method="post">
						<div class="article">
							<button type="submit" style="background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;">
								<img src="../../img/<?php echo $produit['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
								<div>
									<h5><?php echo $produit['nom']; ?></h5>
									<p><?php echo $produit['minidescription']; ?></p>
									<p>Prix : <?php echo $produit['prix']; ?> €</p>
								</div>
							</button>
							<input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
						</div>
					</form>
                <?php
                        }
                        // Fermeture de la connexion à la base de données
                        mysqli_close($conn);
                    } else {
                        echo "Vous n'êtes pas connecté.";
                    }
                ?>
            </div>
            <form method="post" action="ajoutProduitVendeur.php">
                <input type="submit" name="ajouter_un_produit" value="Ajouter un produit">
            </form>
            <hr> <!-- Repère visuel temporaire -->
            <?php include '../../templates/footer.php'; ?>
        </div>
    </div>
</body>
</html>

