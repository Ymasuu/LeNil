<?php
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION['UTILISATEUR'])){
    header('Location:../Vue/login.php');
    exit();
}

if ($_POST['mdp'] != $_SESSION['UTILISATEUR']['mdp']) {
    $_SESSION['erreur'] = "Mot de passe incorrect";
    header('Location:../Vue/editProfil.php');
    exit();
}

// On récupère les informations de l'utilisateur
if ($_POST['nom'] != "") $_SESSION['UTILISATEUR']['nom'] = $_POST['nom'];
if ($_POST['prenom'] != "") $_SESSION['UTILISATEUR']['prenom'] = $_POST['prenom'];
if ($_POST['email'] != "") {
    $OLDMAIL = $_SESSION['UTILISATEUR']['email'];
    $_SESSION['UTILISATEUR']['email'] = $_POST['email'];
}
if ($_POST['dateNaissance'] != "") $_SESSION['UTILISATEUR']['dateNaissance'] = $_POST['dateNaissance'];
if ($_POST['tel'] != "") $_SESSION['UTILISATEUR']['tel'] = $_POST['tel'];
if ($_POST['adresse'] != "") $_SESSION['UTILISATEUR']['adresse'] = $_POST['adresse'];
if ($_POST['ville'] != "") $_SESSION['UTILISATEUR']['ville'] = $_POST['ville'];
if ($_POST['codePostal'] != "") $_SESSION['UTILISATEUR']['codePostal'] = $_POST['codePostal'];
if ($_POST['pays'] != "") $_SESSION['UTILISATEUR']['pays'] = $_POST['pays'];

// On met à jour les informations de l'utilisateur dans la base de données
$utilisateurs = explode("\n", file_get_contents("../../database/client.csv"));
foreach($utilisateurs as $end) {
    $detailUtilisateur = explode(",", $end);
    if($detailUtilisateur[1] == $OLDMAIL) {
        $utilisateurs[] = implode(",", $_SESSION['UTILISATEUR']);
        file_put_contents("../../database/client.csv", implode("\n", $utilisateurs));
        break;
    }
}

$_SESSION['succes'] = "Données du profil mis à jour";
header('Location:../vue/profil.php');
exit();
?>