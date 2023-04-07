<?php
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

$csvFile = file_get_contents("../../database/client.csv");
$csvArray = explode("\n", $csvFile);

$valide = 0;

foreach($csvArray as $key => $line){
    $userData = explode(",", $line);
    if($userData[2] == $_SESSION["mail"])
    {
        $valide = 1;
        $userData[9] = $password;
        $csvArray[$key] = implode(",", $userData);
        $csvFile = implode("\n", $csvArray);
        file_put_contents("../../database/client.csv", $csvFile);
        break;
    }
}

if($valide == 0){
    $_SESSION["erreur"] = "une erreur est survenue, nous sommes désolés";
    header("Location: ../Vue/forgotPassword3.php");
    exit();
}

$_SESSION["message"] = "Mot de passe modifié avec succès";
header("Location: ../Vue/login.php");
exit();
?>