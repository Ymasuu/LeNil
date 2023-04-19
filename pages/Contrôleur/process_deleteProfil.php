<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    // Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
    if(!isset($_SESSION["UTILISATEUR"])){
        header('Location:../Vue/login.php');
        exit();
    }
    // récupérer l'email de l'utilisateur à supprimer
    $email = $_SESSION["UTILISATEUR"]["email"];

    // supprimer les lignes de la table InfoCompte qui font référence à l'utilisateur à supprimer
    $sql = "DELETE FROM InfoCompte WHERE emailCompte = '$email'";
    $result = mysqli_query($conn, $sql);

    // supprimer l'utilisateur de la table Compte
    $sql = "DELETE FROM Compte WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Fermer la connexion
    mysqli_close($conn);

    /*// On met à jour les informations de l'utilisateur dans la base de données
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
    } */

    // On supprime la session de l'utilisateur
    unset($_SESSION["UTILISATEUR"]);

    $_SESSION["message"] = "Compte supprimé";
    header('Location:../Vue/login.php');
    exit();
?>