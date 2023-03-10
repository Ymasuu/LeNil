<?php
session_start();
if(isset($_SESSION['email'])){
    header('Location: ../vue/index.php');
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$dateNaissance = $_POST['dateNaissance'];
$tel = $_POST['tel'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$codePostal = $_POST['codePostal'];
$pays = $_POST['pays'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];

if ($mdp != $mdp2) {
    $_SESSION["error"] = "Les mots de passe ne correspondent pas";
    header("Location:../Vue/createAccount.php");
    exit();
}

$utilisateurs = explode("\n", file_get_contents("../../database/client.csv")); // récupération des données utilisateur

$valide = 0; //par défaut, on considère que les informations entrées sont invalides

foreach($utilisateurs as $end) //on parcourt dans la liste des utilisateurs 
{
    $detailUtilisateur = explode("|", $end);
    if($detailUtilisateur[1] == $email)
    {
        $valide = 1;
        $_SESSION["error"] = "L'adresse mail est déjà utilisée";
        header("Location:../Vue/createAccount.php");
        exit();
    }
}

//si l'adresse mail n'est pas déjà utilisée, on ajoute le nouvel utilisateur
$utilisateurs[] = $nom.",".$prenom.",".$email.",".$dateNaissance.",".$tel.",".$adresse.",".$ville.",".$codePostal.",".$pays.",".$mdp;
file_put_contents("../../database/client.csv", implode("\n", $utilisateurs));

//on connecte l'utilisateur
$_SESSION["UTILISATEUR"] = $prenom." ".$nom; //changement de la variable environnement
header("Location: ../Vue/index.php");
?>