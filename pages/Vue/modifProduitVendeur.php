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
        <div style="width: 500px; margin: auto;">
            <?php
                if (isset($_POST['produit_id'])) {
                    $_SESSION["produit_id"] = $_POST['produit_id'];
                    // Requête pour récupérer les informations du produit cliqué
                    $produit_id = $_POST['produit_id'];
                    $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur WHERE id = '$produit_id'");

                    // Afficher les informations du produit
                    $produit = mysqli_fetch_assoc($resultat);
            ?>
            <h1>Modification Produit</h1>
            <form action="../Contrôleur/process_modifProduit.php" method="post">
                <fieldset>
                    <legend>Informations du produit</legend>
                    <p>Ne remplissez que les champs que vous désirez changer.</p>
                    <table>
                        <tr>
                            <td><label for="nom">Nom</label></td>
                            <td><input type="text" name="nom" id="nom" placeholder="<?php echo $produit['nom']; ?>"></td>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="QuantiteVendeur">Quantité</label></td>
                            <td><input type="text" name="QuantiteVendeur" id="QuantiteVendeur" placeholder="<?php echo $produit['QuantiteVendeur']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="prix">Prix</label></td>
                            <td><input type="text" name="prix" id="prix" placeholder="<?php echo $produit['prix']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="minidescription">Mini Description</label></td>
                            <td><input type="text" name="minidescription" id="minidescription" placeholder="<?php echo $produit['minidescription']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="description">Description</label></td>
                            <td><input type="text" name="description" id="description" placeholder="<?php echo $produit['description']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="categorie">Categorie</label></td>
                            <td><input type="text" name="categorie" id="categorie" placeholder="<?php echo $produit['categorie']; ?>"></td>
                        </tr>
                        <td colspan="2"><p>Confirmer la modification avec votre mot de passe :</p></td>
                        </tr>
                        <tr>
                            <td><label for="mdp">mot de passe</label></td>
                            <td><input type="password" name="mdp" id="mdp" placeholder="mot de passe"></td>
                        </tr>
                        <tr>
                            <td><?php if(isset($_SESSION['erreur'])){echo $_SESSION['erreur'];unset($_SESSION['erreur']);} ?></td>
                        </tr> 
                    </table>
                    <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                    <input type="submit" name="modifier_un_produit" value="Modifier">
                </fieldset>
            </form>
            <?php
                }
            ?>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>
