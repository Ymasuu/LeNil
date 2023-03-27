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
	<title>Mot de passe oublié ?</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div style="width: 500px; margin: auto;">
		<h1>Mot de passe oublié ?</h1>
		<form action="../Contrôleur/process_forgotPassword.php" method="post">
			<fieldset>
                <table>
                    <tr>
                        <td colspan="2">
                            <label for="mail">Entrez votre adresse e-mail :</label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="mail" id="mail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></td>
                        <td><input type="submit" value="Envoyer"></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                if(isset($_SESSION["erreur"])){
                                echo $_SESSION["erreur"];
                                unset($_SESSION["erreur"]);
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
</body>
</html>