<?php
session_start();
// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION["UTILISATEUR"])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilisateur</title>
    <link rel="stylesheet" href="../../css/profil.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <?php include '../../templates/header.php'; ?>
    <div>
        <div style="width: 500px; margin: auto;">
            <h1>Profil Utilisateur</h1>
            <fieldset>
                <legend>Informations</legend>
                <table>
                    <tr>
                        <td colspan="2">
                        <?php if(isset($_SESSION["succes"])){echo $_SESSION["succes"]; unset($_SESSION["succes"]);} ?>
                        </td>
                    </tr>
                    <tr>
                        <td>nom :
                            <?php echo $_SESSION["UTILISATEUR"]["nom"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>prenom :
                            <?php echo $_SESSION["UTILISATEUR"]["prenom"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>mail :
                            <?php echo $_SESSION["UTILISATEUR"]["email"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>date de naissance :
                            <?php echo $_SESSION["UTILISATEUR"]["dateNaissance"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>numéro de téléphone :
                            <?php echo $_SESSION["UTILISATEUR"]["tel"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>adresse :
                            <?php echo $_SESSION["UTILISATEUR"]["adresse"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ville :
                            <?php echo $_SESSION["UTILISATEUR"]["ville"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>code postal :
                            <?php echo $_SESSION["UTILISATEUR"]["codePostal"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>pays :
                            <?php echo $_SESSION["UTILISATEUR"]["pays"]; ?>
                        </td>
                    </tr>
                    <?php if($_SESSION["UTILISATEUR"]["Abonnement"] != 'None'){
                            echo '<tr><td>Statut : '.$_SESSION["UTILISATEUR"]["Abonnement"].'</td></tr>';
                        }
                    ?>
                    <?php if($_SESSION["UTILISATEUR"]["DateAbonnement"] != 'None'){
                            echo '<tr><td>Date d\'abonnement : '.$_SESSION["UTILISATEUR"]["DateAbonnement"].'</td></tr>';
                        }
                    ?>
                </table>
            <div style="text-align:right"><a class="bouton-golden" href="editProfil.php">Modifier les informations</a></div>
            <div style="text-align:right"><button class="bouton-golden" onclick="afficherPopup()">Supprimer mon compte</button></div>
            </fieldset>
            <div><a class="bouton-golden" href="../Contrôleur/process_logout.php">Se déconnecter</a></div>
            <div><a class="bouton-golden" href="index.php">Retour à l'accueil</a></div>
        </div>
        <div id="popup" class="modal">
            <div class="modal-contenu">
                <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                <button class="bouton-golden" onclick="confirmerSuppression()">Oui</button>
                <button class="bouton-golden" onclick="annulerSuppression()">Non</button>
            </div>
        </div>
    </div>
    <?php include '../../templates/footer.php'; ?>
    <script>
        function afficherPopup(){
            document.getElementById("popup").style.display = "block";
        }
        function annulerSuppression(){
            document.getElementById("popup").style.display = "none";
        }
        function confirmerSuppression(){
            window.location.href = "../Contrôleur/process_deleteProfil.php";
        }
    </script>
</body>
</html>
