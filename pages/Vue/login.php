<?php
    session_start();
    if(isset($_SESSION['mail'])){
        header('Location: ./index.php');
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
	<div style="width: 500px; margin: auto;">
		<h1>Se connecter</h1>
		<form action="../Contrôleur/process_login.php" method="post">
			<fieldset>
                <legend>Identifiants</legend>
                <table>
                    <tr>
                        <td><label for="mail">Mail</label></td>
                        <td><input type="text" name="mail" id="mail"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Mot de passe</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Se connecter"></td>
                        <td>
                            <?php
                                if(isset($_SESSION["error"])){
                                    echo $_SESSION["error"];
                                    unset($_SESSION["error"]);
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <div style="text-align:right"><a href="forgotPassword.php">Mot de passe oublié ?</a></div>
    </div>
</body>