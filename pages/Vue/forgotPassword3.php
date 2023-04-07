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
	<title>Changer votre mot de passe</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
	<div style="width: 500px; margin: auto;">
		<h1>Mot de passe oublié ?</h1>
		<form action="../Contrôleur/process_forgotPassword2.php" method="post">
			<fieldset>
                <table>
                    <tr>
                        <td><label for="password">Entrez votre nouveau mot de passe :</label></td>
                        <td><input type="password" name="password" id="password" pattern="[A-Za-z0-9-]{1,60}" required></td>
                    </tr>
                    <tr>
                    <td><label for="password2">Confirmer le mot de passe :</label></td>
                        <td><input type="password" name="password2" id="password2" pattern="[A-Za-z0-9-]{1,60}" required></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Envoyer">
                        </td>
                    </tr>
                </table>
                <?php
                    if(isset($_SESSION["erreur"])){
                    echo $_SESSION["erreur"];
                    unset($_SESSION["erreur"]);
                    }
                ?>
            </fieldset>
        </form>
    </div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>