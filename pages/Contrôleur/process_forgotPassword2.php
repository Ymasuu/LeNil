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

$utilisateurs = explode("\n", file_get_contents("../../database/client.csv"));

$valide = 0;

foreach($utilisateurs as $end){
    $detailUtilisateur = explode(",", $end);
    if($detailUtilisateur[2] == $_SESSION["email"])
    {
        $valide = 1;
        $detailUtilisateur[9] = $password;
        break;
    }
}

if($valide == 0){
    $_SESSION["erreur"] = "une erreur est survenue, nous sommes désolés";
    header("Location: ../Vue/forgotPassword3.php");
    exit();
}

$utilisateurs[] = implode(",", $detailUtilisateur);
file_put_contents("../../database/client.csv", implode("\n", $utilisateurs));

$_SESSION["message"] = "Mot de passe modifié avec succès";
header("Location: ../Vue/login.php");
exit();
?>