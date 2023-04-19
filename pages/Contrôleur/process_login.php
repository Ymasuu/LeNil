<?php
require_once '..\..\database\config\connection.php';
require_once '..\..\database\config\database.php';
session_start();

// Si l'utilisateur à déjà essayé de se connecter 3 fois, mais qu'il a attendu 5 minutes, on réinitialise le compteur
if (isset($_SESSION["errorLogin"]) && $_SESSION["errorLogin"] >= 3) {
    if (time() - $_SESSION["errorLoginTime"] > 300) {
        $_SESSION["errorLogin"] = 0;
    } else {
        $_SESSION["message"] = "Vous avez essayé de vous connecter 3 fois, vous devez attendre 5 minutes avant de pouvoir réessayer";
        header("Location:../Vue/login.php");
        exit();
    }
}

$mail = $_POST['mail'];
$password = $_POST['password'];

//ACCES DE LUTILISATEUR DANS LA BDD
// Escape special characters to prevent SQL injection attacks
$mail = mysqli_real_escape_string($conn, $mail);
$password = mysqli_real_escape_string($conn, $password);

// Execute the SQL query with escaped values
$query = "SELECT * FROM Compte WHERE email='$mail' AND motDePasse='$password';";
$result = mysqli_query($conn, $query);

$resultCheck = mysqli_num_rows($result);
//Si la requete est bonne...
if ($resultCheck>0) {
    $row = mysqli_fetch_assoc($result);

    //ON VERIFIE SI CEST UNE COMPTE CLIENT, VENDEUR OU LIVREUR

    if ($row['signatureContratClient'] == 1) {
    unset($_SESSION["errorLogin"]); // on supprime la variable de session
    //CLIENT
    //On fait d'autres requetes pour obtenir les informations nécessaires de ce compte
        $sousquery = "SELECT * FROM InfoCompte WHERE emailCompte = '$mail';";
        $sousresult = mysqli_query($conn, $sousquery);
        $sousresultCheck = mysqli_num_rows($sousresult);
        if ($sousresultCheck>0) {
            $informations = mysqli_fetch_assoc($sousresult);
        }

        $_SESSION["UTILISATEUR"]["nom"] = $informations['nom'];
        $_SESSION["UTILISATEUR"]["prenom"] = $informations['prenom'];
        $_SESSION["UTILISATEUR"]["email"] = $row['email'];
        $_SESSION["UTILISATEUR"]["dateNaissance"] = $informations['dateNaissance'];
        $_SESSION["UTILISATEUR"]["tel"] = $informations['telephone'];
        $_SESSION["UTILISATEUR"]["adresse"] = $informations['adresse'];
        $_SESSION["UTILISATEUR"]["ville"] = $informations['ville'];
        $_SESSION["UTILISATEUR"]["codePostal"] = $informations['codePostal'];
        $_SESSION["UTILISATEUR"]["pays"] = $informations['pays'];
        $_SESSION["UTILISATEUR"]["mdp"] = $row['motDePasse'];
        if ($row['abonnement'] == 0) {
            $_SESSION["UTILISATEUR"]["Abonnement"] = "None";
        }
        if ($row['abonnement'] == 1) {
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Mensuel";
        }
        if ($row['abonnement'] == 2) {
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Annuel";
        }
        if ($row['dateAbonnement'] != NULL){
            $_SESSION["UTILISATEUR"]["DateAbonnement"] = $row['dateAbonnement'];
        } else $_SESSION["UTILISATEUR"]["DateAbonnement"] = "None";
        $_SESSION["UTILISATEUR"]["TypeCompte"] = "client";
        header("Location:../Vue/index.php");
        exit();
    }

    //VENDEUR 
    else if ($row['signatureContratVendeur'] == 1) {

    //On fait d'autres requetes pour obtenir les informations nécessaires de ce compte
        $sousquery = "SELECT * FROM InfoCompte WHERE emailCompte = '$mail';";
        $sousresult = mysqli_query($conn, $sousquery);
        $sousresultCheck = mysqli_num_rows($sousresult);
        if ($sousresultCheck>0) {
            $informations = mysqli_fetch_assoc($sousresult);
        }

        unset($_SESSION["errorLogin"]); // on supprime la variable de session
        $_SESSION["UTILISATEUR"]["nom"] = $informations['nom'];
        $_SESSION["UTILISATEUR"]["prenom"] = "";
        $_SESSION["UTILISATEUR"]["email"] = $row['email'];
        $_SESSION["UTILISATEUR"]["tel"] = $informations['telephone'];
        $_SESSION["UTILISATEUR"]["adresse"] = $informations['adresse'];
        $_SESSION["UTILISATEUR"]["ville"] = $informations['ville'];
        $_SESSION["UTILISATEUR"]["codePostal"] = $informations['codePostal'];
        $_SESSION["UTILISATEUR"]["pays"] = $informations['pays'];
        $_SESSION["UTILISATEUR"]["mdp"] = $row['motDePasse'];
        if ($row['abonnement'] == 0) {
            $_SESSION["UTILISATEUR"]["Abonnement"] = "None";
        }
        if ($row['abonnement'] == 1) {
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Mensuel";
        }
        if ($row['abonnement'] == 2) {
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Annuel";
        }
        //$_SESSION["UTILISATEUR"]["Abonnement"] = $row['abonnement'];
        if ($row['dateAbonnement'] != NULL){
            $_SESSION["UTILISATEUR"]["DateAbonnement"] = $row['dateAbonnement'];
        }
        $_SESSION["UTILISATEUR"]["TypeCompte"] = "vendeur";
        header("Location:../Vue/index.php");
        exit();
        }
        
        //LIVREUR ------> A GERER ENCORE
        else if ($row['signatureContratLivreur'] == 1) {
            unset($_SESSION["errorLogin"]); // on supprime la variable de session
        $_SESSION["UTILISATEUR"]["nom"] = $detailUtilisateur[0];
        $_SESSION["UTILISATEUR"]["email"] = $detailUtilisateur[1];
        $_SESSION["UTILISATEUR"]["tel"] = $detailUtilisateur[2];
        $_SESSION["UTILISATEUR"]["adresse"] = $detailUtilisateur[3];
        $_SESSION["UTILISATEUR"]["ville"] = $detailUtilisateur[4];
        $_SESSION["UTILISATEUR"]["codePostal"] = $detailUtilisateur[5];
        $_SESSION["UTILISATEUR"]["pays"] = $detailUtilisateur[6];
        $_SESSION["UTILISATEUR"]["mdp"] = $detailUtilisateur[7];
        $_SESSION["UTILISATEUR"]["TypeCompte"] = "vendeur";
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
    $_SESSION["message"] = "Login ou mot de passe incorrect";
    header("Location:../Vue/login.php");
    exit();
?>