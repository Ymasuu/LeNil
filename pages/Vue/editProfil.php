<?php
session_start();
// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION["UTILISATEUR"])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Informations</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</html>
<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <div style="width: 500px; margin: auto;">
            <h1>Profil Utilisateur</h1>
            <form action="../Contrôleur/process_editProfil.php" method="post">
                <fieldset>
                    <legend>Informations</legend>
                    <p>Ne remplissez que les champs que vous désirez changer.</p>
                    <table>
                        <tr>
                            <td><label for="nom">Nom</label></td>
                            <td><input type="text" name="nom" id="nom" placeholder="<?php echo $_SESSION["UTILISATEUR"]["nom"]; ?>"></td>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="prenom">Prénom</label></td>
                            <td><input type="text" name="prenom" id="prenom" placeholder="<?php echo $_SESSION["UTILISATEUR"]["prenom"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="mail">Mail</label></td>
                            <td><input type="email" name="mail" id="mail" placeholder="<?php echo $_SESSION["UTILISATEUR"]["email"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="dateNaissance">Date de naissance</label></td>
                            <td><input type="date" name="dateNaissance" id="dateNaissance"></td>
                        </tr>
                        <tr>
                            <td><label for="tel">Numéro de téléphone</label></td>
                            <td><input type="tel" name="tel" id="tel" placeholder="<?php echo $_SESSION["UTILISATEUR"]["tel"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="adresse">Adresse</label></td>
                            <td><input type="text" name="adresse" id="adresse" placeholder="<?php echo $_SESSION["UTILISATEUR"]["adresse"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="ville">Ville</label></td>
                            <td><input type="text" name="ville" id="ville" placeholder="<?php echo $_SESSION["UTILISATEUR"]["ville"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="codePostal">Code postal</label></td>
                            <td><input type="text" name="codePostal" id="codePostal" placeholder="<?php echo $_SESSION["UTILISATEUR"]["codePostal"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="pays">Pays</label></td>
                            <td><input type="text" name="pays" id="pays" placeholder="<?php echo $_SESSION["UTILISATEUR"]["pays"]; ?>"></td>
                        </tr>
                        <tr>
                        <td colspan="2"><p>Confirmer la modification avec votre mot de passe :</p></td>
                        </tr>
                        <tr>
                            <td><label for="mdp">mot de passe</label></td>
                            <td><input type="password" name="mdp" id="mdp" placeholder="mot de passe"></td>
                        </tr>
                        <tr>
                            <td><input class="bouton-golden" type="submit" value="Modifier"></td>
                            <td><?php if(isset($_SESSION['erreur'])){echo $_SESSION['erreur'];unset($_SESSION['erreur']);} ?></td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <!-- un bouton permettant de revenir à la page précédente-->
        <div style="width: 500px; margin: auto; padding-left:100px;">
            <a class="bouton-golden" href="profil.php">Retour</a>
        </div>
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>