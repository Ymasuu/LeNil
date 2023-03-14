<?php 
session_start();

// Si l'utilisateur à déjà essayé de se connecter 3 fois, mais qu'il a attendu 5 minutes, on réinitialise le compteur
if (isset($_SESSION["errorLogin"]) && $_SESSION["errorLogin"] >= 3) {
    if (time() - $_SESSION["errorLoginTime"] > 300) {
        $_SESSION["errorLogin"] = 0;
    } else {
        $_SESSION["error"] = "Vous avez essayé de vous connecter 3 fois, vous devez attendre 5 minutes avant de pouvoir réessayer";
        header("Location:../Vue/login.php");
        exit();
    }
}

$mail = $_POST['mail'];
$password = $_POST['password'];

$utilisateurs = explode("\n", file_get_contents("../../database/client.csv")); // récupération des données utilisateur

foreach($utilisateurs as $end) //on parcourt dans la liste des utilisateurs 
{
    $detailUtilisateur = explode(",", $end);
    if($detailUtilisateur[2] == $mail && $detailUtilisateur[9] == $password)
    {
        unset($_SESSION["errorLogin"]); // on supprime la variable de session
        $_SESSION["UTILISATEUR"]["nom"] = $detailUtilisateur[0];
        $_SESSION["UTILISATEUR"]["prenom"] = $detailUtilisateur[1];
        $_SESSION["UTILISATEUR"]["email"] = $detailUtilisateur[2];
        $_SESSION["UTILISATEUR"]["dateNaissance"] = $detailUtilisateur[3];
        $_SESSION["UTILISATEUR"]["tel"] = $detailUtilisateur[4];
        $_SESSION["UTILISATEUR"]["adresse"] = $detailUtilisateur[5];
        $_SESSION["UTILISATEUR"]["ville"] = $detailUtilisateur[6];
        $_SESSION["UTILISATEUR"]["codePostal"] = $detailUtilisateur[7];
        $_SESSION["UTILISATEUR"]["pays"] = $detailUtilisateur[8];
        $_SESSION["UTILISATEUR"]["mdp"] = $detailUtilisateur[9];
        header("Location:../Vue/index.php");
        exit();
    }
}
    // Pour chaque erreur de login, on imcrémente une variable de 1
    if (!isset($_SESSION["errorLogin"])) {
        $_SESSION["errorLogin"] = 1;
    } else {
        $_SESSION["errorLogin"]++;
    }
    // à partir de 3 erreurs, on enregistre la date de la dernière erreur
    if ($_SESSION["errorLogin"] >= 3) {
        $_SESSION["lastErrorLogin"] = time();
    }
    $_SESSION["error"] = "Login ou mot de passe incorrect";
    header("Location:../Vue/login.php");
    exit();
?>