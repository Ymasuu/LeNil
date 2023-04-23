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
        <h1>Ajouter un Compte</h1>
            <form action="../Contrôleur/process_ajoutCompte.php" method="post">
                <fieldset>
                    <legend>Informations du compte</legend>
                    <table>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" name="new_email" id="email"></td>
                        </tr>
                        <tr>
                            <td><label for="mdp">Mot de passe</label></td>
                            <td><input type="password" name="new_mdp" id="mdp"></td>
                        </tr>
                        <tr>
                            <td><label for="client">Client</label></td>
                            <td><input type="radio" name="type_compte" id="client" value="client"></td>
                        </tr>
                        <tr>
                            <td><label for="vendeur">Vendeur</label></td>
                            <td><input type="radio" name="type_compte" id="vendeur" value="vendeur"></td>
                        </tr>
                        <tr>
                            <td><label for="livreur">Livreur</label></td>
                            <td><input type="radio" name="type_compte" id="livreur" value="livreur"></td>
                        </tr>
                        <tr>
                            <td><label for="admin">Administrateur</label></td>
                            <td><input type="radio" name="type_compte" id="admin" value="admin"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Ajouter le compte" class="bouton-golden"></td>
                        </tr>
                    </table>
                </fieldset>
            </form>  
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>

