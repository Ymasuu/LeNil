<?php
require_once '..\..\database\config\connection.php';
require_once '..\..\database\config\database.php';
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION["UTILISATEUR"])){
    header('Location:../Vue/login.php');
    exit();
}

if ($_POST['mdp'] != $_SESSION["UTILISATEUR"]["mdp"]) {
    $_SESSION["erreur"] = "Mot de passe incorrect";
    header('Location:../Vue/editProfil.php');
    exit();
}

// On récupère les informations de l'utilisateur
if ($_POST['nom'] != "") $_SESSION["UTILISATEUR"]["nom"] = $_POST['nom'];
if ($_POST['prenom'] != "") $_SESSION["UTILISATEUR"]["prenom"] = $_POST['prenom'];
$OLDMAIL = $_SESSION["UTILISATEUR"]["email"];
if(isset($_POST['mail'])){
    $_SESSION["UTILISATEUR"]["email"] = $_POST['mail'];
}

if ($_POST['dateNaissance'] != "") $_SESSION["UTILISATEUR"]["dateNaissance"] = $_POST['dateNaissance'];
if ($_POST['tel'] != "") $_SESSION["UTILISATEUR"]["tel"] = $_POST['tel'];
if ($_POST['adresse'] != "") $_SESSION["UTILISATEUR"]["adresse"] = $_POST['adresse'];
if ($_POST['ville'] != "") $_SESSION["UTILISATEUR"]["ville"] = $_POST['ville'];
if ($_POST['codePostal'] != "") $_SESSION["UTILISATEUR"]["codePostal"] = $_POST['codePostal'];
if ($_POST['pays'] != "") $_SESSION["UTILISATEUR"]["pays"] = $_POST['pays'];

// Récupération des données POST
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email =$_SESSION["UTILISATEUR"]["email"];
$dateNaissance = date('Y-m-d', strtotime($_POST['dateNaissance']));
$tel = $_POST['tel'];
//Correction pour tel
if (isset($_POST['tel']) && is_numeric($_POST['tel'])) {
    $tel = (int)$_POST['tel'];
} else {
    $tel = 0;
}
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$codePostal = $_POST['codePostal'];
$pays = $_POST['pays'];

$connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_begin_transaction($connexion);

// Préparation de la requête SQL
if (isset($email)) {
    $sql1 = "UPDATE Compte SET email = '$email' WHERE email = '{$_SESSION["UTILISATEUR"]["email"]}'";
    if (!mysqli_query($connexion, $sql1)) {
        mysqli_rollback($connexion);
        die("Erreur lors de la mise à jour du compte : " . mysqli_error($connexion));
    }
    $_SESSION["UTILISATEUR"]["email"] = $email;
}

// Mettre à jour la table InfoCompte
$sql2 = "UPDATE InfoCompte SET nom = '$nom', prenom = '$prenom', dateNaissance = '$dateNaissance', telephone = '$tel', adresse = '$adresse', ville = '$ville', codePostal = '$codePostal', pays = '$pays' WHERE emailCompte = '{$_SESSION["UTILISATEUR"]["email"]}'";
if (!mysqli_query($connexion, $sql2)) {
    mysqli_rollback($connexion);
    die("Erreur lors de la mise à jour des informations du compte : " . mysqli_error($connexion));
}

mysqli_commit($connexion);

// Fermer la connexion à la base de données
mysqli_close($connexion);

// On met à jour les informations de l'utilisateur dans la base de données
/*$csvFile = file_get_contents("../../database/client.csv");
$csvArray = explode("\n", $csvFile);
foreach($csvArray as $key => $line) {
    $userData = explode(",", $line);
    if($userData[2] == $OLDMAIL) {
        // On met à jour les informations de l'utilisateur en question
        $userData[0] = $_SESSION["UTILISATEUR"]["nom"];
        $userData[1] = $_SESSION["UTILISATEUR"]["prenom"];
        $userData[2] = $_SESSION["UTILISATEUR"]["email"];
        $userData[3] = $_SESSION["UTILISATEUR"]["dateNaissance"];
        $userData[4] = $_SESSION["UTILISATEUR"]["tel"];
        $userData[5] = $_SESSION["UTILISATEUR"]["adresse"];
        $userData[6] = $_SESSION["UTILISATEUR"]["ville"];
        $userData[7] = $_SESSION["UTILISATEUR"]["codePostal"];
        $userData[8] = $_SESSION["UTILISATEUR"]["pays"];
        $csvArray[$key] = implode(",", $userData);

        $csvFile = implode("\n", $csvArray);
        file_put_contents("../../database/client.csv", $csvFile);
        break;
    }
} */



$_SESSION["succes"] = "Données du profil mis à jour";
header('Location:../Vue/profil.php');
exit();
?>