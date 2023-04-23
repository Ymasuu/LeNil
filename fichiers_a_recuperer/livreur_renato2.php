<?php
    // Pour la connection de la bdd
    session_start();
    require_once 'classes_necessaires.php';
    // Instanciation de la classe CompteLivreur pour récupérer le tableau associatif
    
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
                // Boucle pour afficher toutes les commandes


                /////-------ON METS LA CLASSE COMPTELIVREUR CAR IL NE RECONNAIT PAS LE FICHIER DANS MODELE/CLASSES
                //JE NE SAIS PAS POURQUOI ----------////////////////////////////////////

                ///////////COMPTE ////////////////////////////////////////////////////////


                /////////////--------------///////////////////////////////////////////////////



                $livreur = new CompteLivreur($_SESSION["UTILISATEUR"]["email"],$_SESSION["UTILISATEUR"]["codePostal"]);
    $tableauAssociatifColisClient = $livreur->getTableauAssociatifColisClient();
                foreach($tableauAssociatifColisClient as $idColis => $association) {
                    $colis = $association['colis'];
                    $compte = $association['compte'];
                    $commande = $colis->getCommande();
                    $client = $commande->getClient();



                    $conn = new mysqli(DB_HOST, DB_USER,DB_PASS,DB_NAME);

                    if ($conn->connect_error) {
                        die("Erreur de connexion : " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT colis.id, infocompte.adresse, infocompte.codePostal, commande.datePayment 
                    FROM colis 
                    JOIN commande ON colis.idCommande = commande.id 
                    JOIN infocompte ON commande.emailCompte = infocompte.emailCompte";
                    
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($_SESSION["UTILISATEUR"]["codePostal"] == $row["codePostal"]) {
                            // Traitement des données récupérées
                            $adresseClient = $row["adresse"];
                            $idColis = $row["id"];
                            $dateCommande = $row["datePayment"];
                            $codePostalClient = $row["codePostal"];
                            }
                        }
                    } else {
                       // echo "Aucun résultat trouvé.";
                    }
                    
                    $mysqli->close();
            ?>
                <form action="pageLivreur.php" method="post">
                    <div class="article">
                        <button type="submit">
                            <div>
                                <h5>Commande #<?php echo $idColis; ?></h5>
                                <p>Date de commande : <?php echo $dateCommande; ?></p>
                                <p>Adresse de livraison : <?php echo $adresseClient; ?></p>
                            </div>
                        </button>
                        <input type="hidden" name="colis_id" value="<?php echo $idColis; ?>">
                    </div>
                </form>

                <!--
<form action="pageLivreur.php" method="post">
                    <div class="article">
                        <button type="submit">
                            <div>
                                <h5>Commande #<?php echo $commande->getIdCommande(); ?></h5>
                                <p>Date de commande : <?php echo $commande->getDateCommande(); ?></p>
                                <p>Adresse de livraison : <?php echo $client->getAdresse(); ?></p>
                            </div>
                        </button>
                        <input type="hidden" name="colis_id" value="<?php echo $idColis; ?>">
                    </div>
                </form>
                -->

            
            <?php } ?>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>