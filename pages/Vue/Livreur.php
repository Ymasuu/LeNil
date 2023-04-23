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
    <link rel="stylesheet" href="../../css/livreur.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php';
			if(isset($_SESSION["message"]))echo "<center><b>".$_SESSION["message"]."</b></center>"; unset($_SESSION["message"]);
            unset($_SESSION['message']);
		?>
        <hr> <!-- Repère visuel temporaire -->
        <div class="commandes">
            <form action="pageLivreur.php" method="post">
                    <div class="article">
                        <button type="submit">
                            <div>
                                <h5>Commande #12345</h5>
                                <p>Date de commande : 20 avril 2023 à 10h30</p>
                                <p>Adresse de livraison : 123 rue des Fleurs, 75001 Paris</p>
                            </div>
                        </button>
                        <input type="hidden" name="produit_id" value="<?php echo $row['id']; ?>">
                    </div>
                </form>
                <form action="pageLivreur.php" method="post">
                    <div class="article">
                        <button type="submit">
                            <div>
                                <h5>Commande #12345</h5>
                                <p>Date de commande : 20 avril 2023 à 10h30</p>
                                <p>Adresse de livraison : 123 rue des Fleurs, 75001 Paris</p>
                            </div>
                        </button>
                        <input type="hidden" name="produit_id" value="<?php echo $row['id']; ?>">
                    </div>
                </form>
                <form action="pageLivreur.php" method="post">
                    <div class="article">
                        <button type="submit">
                            <div>
                                <h5>Commande #12345</h5>
                                <p>Date de commande : 20 avril 2023 à 10h30</p>
                                <p>Adresse de livraison : 123 rue des Fleurs, 75001 Paris</p>
                            </div>
                        </button>
                        <input type="hidden" name="produit_id" value="<?php echo $row['id']; ?>">
                    </div>
                </form>
            </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>

