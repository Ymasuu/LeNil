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
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <h1>Ajouter un produit</h1>
        <form action="Vendeur.php" method="post">
            <fieldset>
                <legend>Informations Produit</legend>
                <table>
                    <tr>
                        <td><label for="nom">Nom</label></td>
                        <td><input type="text" name="nom" id="nom" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
                    </tr>
                    <tr>
                        <td><label for="quantite">Quantité</label></td>
                        <td><input type="text" name="quantite" id="quantite" pattern="[0-9]{5}" required></td>
                    </tr>
                    <tr>
                        <td><label for="prix">Prix</label></td>
                        <td><input type="text" name="prix" id="prix" pattern="[0-9]{5}" required></td>
                    </tr>
                    <tr>
                        <td><label for="minidescription">Mini Description</label></td>
                        <td><input type="text" name="minidescription" id="minidescription" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
                    </tr>
                    <tr>
                        <td><label for="description">Description</label></td>
                        <td><input type="text" name="description" id="description" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
                    </tr>
                    <tr>
                        <td><input class="bouton-golden" type="submit" value="Ajouter mon produit"></td>
                        <td>
                            <?php
                                if(isset($_SESSION["message"])){
                                    echo $_SESSION["message"];
                                    unset($_SESSION["message"]);
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>
