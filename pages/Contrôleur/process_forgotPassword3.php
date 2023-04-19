<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    if(isset($_SESSION["UTILISATEUR"])){
        header("Location: ../vue/profil.php");
        exit();
    }

    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if($password != $password2){
        $_SESSION["erreur"] = "Les mots de passe ne correspondent pas";
        header("Location: ../Vue/forgotPassword3.php");
        exit();
    }

    $mail = $_SESSION["mail"];
    // ACCES DE L'UTILISATEUR DANS LA BDD
    $mail = mysqli_real_escape_string($conn, $mail);

    $query = "UPDATE Compte SET motDePasse = '$password' WHERE email='$mail';";
    $result = mysqli_query($conn, $query);


    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM Compte WHERE email='$mail'AND motDePasse='$password';";
    $result = mysqli_query($conn, $query);

    $resultCheck = mysqli_num_rows($result);
    //Si la requete est bonne...
    if ($resultCheck <= 0) {
        $_SESSION["erreur"] = "une erreur est survenue, nous sommes désolés";
        header("Location: ../Vue/forgotPassword3.php");
        exit();
    }


    $_SESSION["message"] = "Mot de passe modifié avec succès";
    header("Location: ../Vue/login.php");
    exit();
?>