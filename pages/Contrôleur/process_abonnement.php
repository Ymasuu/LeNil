<?php
    session_start();

    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-y');

    if(isset($_POST['desabonner'])){
        $_SESSION["UTILISATEUR"]["Abonnement"] = "None";
        $_SESSION["UTILISATEUR"]["DateAbonnement"] = "None";
        $_SESSION["merci"] = "Nous vous confirmons la résilation de votre abonnement. Vous pouvez vous réabonner quand vous voulez !";
    }
    else {
        if(isset($_POST['mensuel'])){
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Mensuel";
            $_SESSION["UTILISATEUR"]["DateAbonnement"] = $date;
        }
        if(isset($_POST['annuel'])){
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Annuel";
            $_SESSION["UTILISATEUR"]["DateAbonnement"] = $date;
        }
        $_SESSION["merci"] = "merci pour votre abonnement !";
    }

    // On met à jour les informations de l'utilisateur dans la base de données
    $csvFile = file_get_contents("../../database/client.csv");
    $csvArray = explode("\n", $csvFile);
    foreach($csvArray as $key => $line) {
        $userData = explode(",", $line);
        if($userData[2] == $_SESSION["UTILISATEUR"]["email"]) {
            // On met à jour l'informations de l'utilisateur en question
            $userData[10] = $_SESSION["UTILISATEUR"]["Abonnement"];
            $userData[11] = $_SESSION["UTILISATEUR"]["DateAbonnement"];
            $csvArray[$key] = implode(",", $userData);

            $csvFile = implode("\n", $csvArray);
            file_put_contents("../../database/client.csv", $csvFile);
            break;
        }
    }

    header('Location:../Vue/index.php');
    exit();
?>