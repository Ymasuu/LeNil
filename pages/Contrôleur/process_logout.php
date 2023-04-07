<?php
session_start(); //démarrez la session
if (isset($_SESSION["UTILISATEUR"])) { //si l'utilisateur est connecté, on le déconnecte
    session_destroy(); //supprimez les données de session
}
header("Location: ../Vue/index.php"); //redirigez vers la page de connexion
exit();
?>