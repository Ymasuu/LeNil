<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');

    if(!isset($_POST['mensuel']) and !isset($_POST['annuel']) ){
        $_SESSION["UTILISATEUR"]["Abonnement"] = "None";
        $abo = 0;
        $_SESSION["UTILISATEUR"]["DateAbonnement"] = "None";
        $_SESSION["merci"] = "Nous vous confirmons la résilation de votre abonnement. Vous pouvez vous réabonner quand vous voulez !";
    }
    else {
        if(isset($_POST['mensuel'])){
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Mensuel";
            $abo = 1;
            $_SESSION["UTILISATEUR"]["DateAbonnement"] = $date;
        }
        if(isset($_POST['annuel'])){
            $_SESSION["UTILISATEUR"]["Abonnement"] = "Abonnement Annuel";
            $abo = 2;
            $_SESSION["UTILISATEUR"]["DateAbonnement"] = $date;
        }
        $_SESSION["merci"] = "merci pour votre abonnement !";
    }

    
    $mail = $_SESSION["UTILISATEUR"]["email"];
    $password = $_SESSION["UTILISATEUR"]["mdp"];

    //ACCES DE LUTILISATEUR DANS LA BDD
    // Escape special characters to prevent SQL injection attacks
    $mail = mysqli_real_escape_string($conn, $mail);
    $password = mysqli_real_escape_string($conn, $password);

    // Execute the SQL query with escaped values
    $query = "UPDATE Compte SET abonnement = '$abo' WHERE email='$mail' AND motDePasse='$password';";
    $result = mysqli_query($conn, $query);
    if($abo != 0)$query = "UPDATE Compte SET dateAbonnement = '$date' WHERE email='$mail' AND motDePasse='$password';";
    else $query = "UPDATE Compte SET dateAbonnement = NULL WHERE email='$mail' AND motDePasse='$password';";
    $result = mysqli_query($conn, $query);

    header('Location:../Vue/index.php');
    exit();
?>