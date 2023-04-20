<?php
session_start(); //démarrez la session
if (isset($_SESSION["UTILISATEUR"])) { //si l'utilisateur est connecté, on le déconnecte
    //On supprime les informations qu'il a recherchée pendant sa connection?
    //On peut plutot recuperer toutes les recherches et
    //afficher les top recherches des utilisateurs...

    session_destroy(); //supprimez les données de session
}
header("Location: ../Vue/index.php"); //redirigez vers la page de connexion
exit();
?>