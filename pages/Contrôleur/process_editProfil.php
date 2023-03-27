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
$OLDMAIL = $_SESSION['UTILISATEUR']['email'];
if ($_POST['email'] != "") $_SESSION['UTILISATEUR']['email'] = $_POST['email'];
if ($_POST['dateNaissance'] != "") $_SESSION['UTILISATEUR']['dateNaissance'] = $_POST['dateNaissance'];
if ($_POST['tel'] != "") $_SESSION['UTILISATEUR']['tel'] = $_POST['tel'];
if ($_POST['adresse'] != "") $_SESSION['UTILISATEUR']['adresse'] = $_POST['adresse'];
if ($_POST['ville'] != "") $_SESSION['UTILISATEUR']['ville'] = $_POST['ville'];
if ($_POST['codePostal'] != "") $_SESSION['UTILISATEUR']['codePostal'] = $_POST['codePostal'];
if ($_POST['pays'] != "") $_SESSION['UTILISATEUR']['pays'] = $_POST['pays'];

// On met à jour les informations de l'utilisateur dans la base de données
$csvFile = file_get_contents("../../database/client.csv");
$csvArray = explode("\n", $csvFile);
foreach($csvArray as $key => $line) {
    $userData = explode(",", $line);
    if($userData[2] == $OLDMAIL) {
        // On met à jour les informations de l'utilisateur en question
        $userData[0] = $_SESSION['UTILISATEUR']['nom'];
        $userData[1] = $_SESSION['UTILISATEUR']['prenom'];
        $userData[2] = $_SESSION['UTILISATEUR']['email'];
        $userData[3] = $_SESSION['UTILISATEUR']['dateNaissance'];
        $userData[4] = $_SESSION['UTILISATEUR']['tel'];
        $userData[5] = $_SESSION['UTILISATEUR']['adresse'];
        $userData[6] = $_SESSION['UTILISATEUR']['ville'];
        $userData[7] = $_SESSION['UTILISATEUR']['codePostal'];
        $userData[8] = $_SESSION['UTILISATEUR']['pays'];
        $csvArray[$key] = implode(",", $userData);

        $csvFile = implode("\n", $csvArray);
        file_put_contents("../../database/client.csv", $csvFile);
        break;
    }
}

$_SESSION['succes'] = "Données du profil mis à jour";
header('Location:../Vue/profil.php');
exit();
?>