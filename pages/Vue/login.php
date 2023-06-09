<?php
    session_start();
    if(isset($_SESSION["UTILISATEUR"])){
        header("Location: profil.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Se connecter</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php';?>
        <hr>
        <div style="width: 500px; margin: auto;">
            <h1>Se connecter</h1>
            <form action="../Contrôleur/process_login.php" method="post">
                <fieldset>
                    <legend>Identifiants</legend>
                    <table>
                        <tr>
                            <td><label for="mail">Mail</label></td>
                            <td><input type="text" name="mail" id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Mot de passe</label></td>
                            <td><input type="password" name="password" id="password" pattern="[A-Za-z0-9-]{1,60}" required></td>
                        </tr>
                        <tr>
                            <td><input class="bouton-golden" type="submit" value="Se connecter"></td>
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
                    <div style="text-align: right;"><a class="bouton-golden" href="forgotPassword.php">Mot de passe oublié ?</a></div>
                </fieldset>
            </form>
            <!-- Faire en sorte que les boutons soit sur la même ligne -->
            <div>
                <a class="bouton-golden" href="index.php">Retour à l'accueil</a>
                <span style="padding-left: 35px;">Pas de compte ?</span>
                <a class="bouton-golden" href="createAccount.php">S'inscrire</a>
            </div>
        </div>
        <hr>
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>