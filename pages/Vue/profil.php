<?php
session_start();
// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION['UTILISATEUR'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilisateur</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</html>
<body>
    <div>
        <div style="width: 500px; margin: auto;">
            <h1>Profil Utilisateur</h1>
            <fieldset>
                <legend>Informations</legend>
                <table>
                    <tr>
                        <td>nom :
                            <?php echo $_SESSION['UTILISATEUR']['nom']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>prenom :
                            <?php echo $_SESSION['UTILISATEUR']['prenom']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>mail :
                            <?php echo $_SESSION['UTILISATEUR']['email']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>date de naissance :
                            <?php echo $_SESSION['UTILISATEUR']['dateNaissance']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>numéro de téléphone :
                            <?php echo $_SESSION['UTILISATEUR']['tel']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>adresse :
                            <?php echo $_SESSION['UTILISATEUR']['adresse']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ville :
                            <?php echo $_SESSION['UTILISATEUR']['ville']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>code postal :
                            <?php echo $_SESSION['UTILISATEUR']['codePostal']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>pays :
                            <?php echo $_SESSION['UTILISATEUR']['pays']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>mdp :
                            <?php echo $_SESSION['UTILISATEUR']['mdp']; ?>
                        </td>
                    </tr>
                </table>
            <div style="text-align:right"><a href="editProfil.php">Modifier les informations</a></div>
            </fieldset>
            <div><a href="../Contrôleur/process_logout.php">Se déconnecter</a></div>
            <div><a href="index.php">Retour à l'accueil</a></div>
        </div>
    </div>