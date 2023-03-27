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
	<title>Vous avez reçu un mail</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div style="width: 500px; margin: auto;">
        <h1>Votre Boite Mail</h1>
			<fieldset>
                <table>
                    <tr>
                        <td>
                            <p>from : websiteprojet2023@gmail.com</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>to : <?php echo $_SESSION["mail"]; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Object : Rénitialisation de votre mot de passe</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                            Cher(e) utilisateur(trice),<br> 
                            Nous avons bien reçu votre demande de réinitialisation de mot de passe sur 
                            notre marketplace LeNil. Pour accéder à nouveau à votre compte, nous vous 
                            invitons à créer un nouveau mot de passe en cliquant sur le lien ci-dessous :<br><br>
                            <a href="forgotPassword3.php">Modifier votre mot de passe</a><br><br>
                            Si vous n'êtes pas à l'origine de cette demande, nous vous invitons à contacter 
                            notre équipe de support immédiatement à l'adresse suivante : support@lenil.com.<br><br>
                            Cordialement,<br>
                            L'équipe LeNil</p>
                        </td>
                </table>
            </fieldset>