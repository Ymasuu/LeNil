<?php
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION["UTILISATEUR"])){
    header('Location:../Vue/login.php');
    exit();
}

// On met à jour les informations de l'utilisateur dans la base de données
$csvFile = file_get_contents("../../database/client.csv");
$csvArray = explode("\n", $csvFile);
foreach($csvArray as $key => $line) {
    $userData = explode(",", $line);
    if($userData[2] == $_SESSION["UTILISATEUR"]["email"]) {
        // On supprime l'utilisateur en question
        unset($csvArray[$key]);
        $csvFile = implode("\n", $csvArray);
        file_put_contents("../../database/client.csv", $csvFile);
        break;
    }
}

// On supprime la session de l'utilisateur
unset($_SESSION["UTILISATEUR"]);

$_SESSION["message"] = "Compte supprimé";
header('Location:../Vue/login.php');
exit();
?>