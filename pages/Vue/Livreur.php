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
            <?php 
                $sql = "SELECT * FROM commande";
                $resultat = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($resultat);
                // s'il existe des commandes 
                if($resultCheck > 0){
                    while ($row = mysqli_fetch_assoc($resultat)) { 
                        // on recupere l'adresse du client
                        $mail = $row['emailCompte'];
                        $sql2 = "SELECT adresse FROM infoCompte WHERE emailCompte = '$mail'";
                        $result = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result);
                        if($row['Livre'] == 0){
                        ?>
                            <form action="../Contrôleur/process_notifierClient.php" method="post">
                                <div class="article">
                                    <button type="submit" name="commandeID" value="<?php echo $row['id']; ?>" >
                                        <div>
                                            <h5>Commande #<?php echo $row['id']; ?></h5>
                                            <p>Date de commande : <?php echo $row['datePayment']; ?></p>
                                            <p>Prix : <?php echo $row['totalPayer']; ?> €</p>
                                            <p>Adresse : <?php echo $row2['adresse'] ?></p>
                                        </div>
                                    </button>
                                </div>
                            </form>
            <?php       }
                    }
                } 
            ?>  
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html> 