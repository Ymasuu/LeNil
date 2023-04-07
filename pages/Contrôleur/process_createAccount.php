<?php
session_start();
if(isset($_SESSION['email'])){
    header('Location: ../vue/index.php');
    exit();
}

$user["nom"] = $_POST["nom"];
$user["prenom"] = $_POST["prenom"];
$user["email"] = $_POST["email"];
$user["dateNaissance"] = $_POST["dateNaissance"];
$user["dateNaissance"] = date('d-m-y');
$user["tel"] = $_POST["tel"];
$user["adresse"] = $_POST["adresse"];
$user["ville"] = $_POST["ville"];
$user["codePostal"] = $_POST["codePostal"];
$user["pays"] = $_POST["pays"];
$user["mdp"] = $_POST["mdp"];
$mdp = $_POST["mdp2"];
$user["Abonnement"] = "Non abonné";
$user["DateAbonnement"] = "None";

if ($mdp != $user["mdp"]){ //si les mots de passe ne correspondent pas, on renvoie un message d'erreur
    $_SESSION["error"] = "Les mots de passe ne correspondent pas";
    header("Location:../Vue/createAccount.php");
    exit();
}

$utilisateurs = explode("\n", file_get_contents("../../database/client.csv")); // récupération des données utilisateur

$valide = 0; //par défaut, on considère que les informations entrées sont invalides

foreach($utilisateurs as $end) //on parcourt dans la liste des utilisateurs 
{
    $detailUtilisateur = explode(",", $end);
    if($detailUtilisateur[1] == $email)
    {
        $valide = 1;
        $_SESSION["error"] = "L'adresse mail est déjà utilisée";
        header("Location:../Vue/createAccount.php");
        exit();
    }
}

//si l'adresse mail n'est pas déjà utilisée, on ajoute le nouvel utilisateur
$utilisateurs[] = implode(",", $user);
file_put_contents("../../database/client.csv", implode("\n", $utilisateurs));

//on connecte l'utilisateur, un tableau contenant les informations de l'utilisateur est créé
$_SESSION["UTILISATEUR"] = $user;
header("Location: ../Vue/index.php");
exit();
?>