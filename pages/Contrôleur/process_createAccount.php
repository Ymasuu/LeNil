<?php
//Pour se connecter à la bdd
//L'appel à ces fichiers permet de se connecter
require_once '..\..\database\config\connection.php';
require_once '..\..\database\config\database.php';
session_start();
if(isset($_SESSION['email'])){
    header('Location: ../vue/index.php');
    exit();
}

$user["nom"] = $_POST["nom"];
$user["prenom"] = $_POST["prenom"];
$user["email"] = $_POST["email"];
$date = $_POST["dateNaissance"];
$user["dateNaissance"] =  date("d-m-Y", strtotime($date));
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



//On verifie si l'adresse mail n'est pas utilisée

//$utilisateurs = explode("\n", file_get_contents("../../database/client.csv")); // récupération des données utilisateur

$valide = 0; //par défaut, on considère que les informations entrées sont invalides

/*foreach($utilisateurs as $end) //on parcourt dans la liste des utilisateurs 
{
    $detailUtilisateur = explode(",", $end);
    if($detailUtilisateur[2] == $user["email"])
    {
        $valide = 1;
        $_SESSION["error"] = "L'adresse mail est déjà utilisée";
        header("Location:../Vue/createAccount.php");
        exit();
    }
} */

// adresse e-mail à vérifier
$email = $user["email"];

// requête pour vérifier si l'e-mail existe dans la table Compte
$sql = "SELECT email FROM Compte WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// vérification du résultat
if (mysqli_num_rows($result) > 0) {
    // l'e-mail existe déjà dans la table
    $valide = 1;
        $_SESSION["error"] = "L'adresse mail est déjà utilisée";
        header("Location:../Vue/createAccount.php");
        exit();
} else {
    // l'e-mail n'existe pas dans la table
    //echo "L'adresse e-mail n'existe pas dans la table Compte.";
}

//si l'adresse mail n'est pas déjà utilisée, on ajoute le nouvel utilisateur

//---INSERTION DANS LA BDD POUR LES TABLES COMPTE & INFOCOMPTE----
mysqli_begin_transaction($conn);
// Requête d'insertion dans la table Compte
$sql1 = "INSERT INTO Compte (email, motDePasse, abonnement, dateAbonnement, signatureContratClient, signatureContratVendeur, signatureContratLivreur, admin)
VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
$stmt1 = mysqli_prepare($conn, $sql1);
mysqli_stmt_bind_param($stmt1, "ssisiii", $email, $motDePasse, $abonnement, $dateAbonnement, $signatureContratClient, $signatureContratVendeur, $signatureContratLivreur);

// Requête d'insertion dans la table InfoCompte
$sql2 = "INSERT INTO InfoCompte (emailCompte, prenom, nom, dateNaissance, telephone, adresse, ville, codePostal, pays)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt2 = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt2, "ssssisssi", $emailCompte, $prenom, $nom, $dateNaissance, $telephone, $adresse, $ville, $codePostal, $pays);

// Définition des variables pour l'insertion COMPTE
$email = $email;
$motDePasse = $user['mdp'];
$abonnement = 0; // 0 = pas d'abonnement, 1 = abonnement mensuel, 2 = abonnement annuel, etc.

// Vérification de l'abonnement et définition de la date d'abonnement si applicable
if($user["Abonnement"] == "Non abonné") {
$dateAbonnement = NULL; // Pas d'abonnement
} else {
$dateAbonnement = DateTime::createFromFormat('d-m-Y', $user['Abonnement']); // Conversion de la chaîne en objet DateTime
$dateAbonnement = $dateAbonnement->format('Y-m-d'); // On passe à ce format pour la bdd
}
$signatureContratClient = 1; // 0 = non signé, 1 = signé
$signatureContratVendeur = 0; // 0 = non signé, 1 = signé
$signatureContratLivreur = 0; // 0 = non signé, 1 = signé

// Définition des variables avec les données à insérer INFOCOMPTE
$emailCompte = $email;
$prenom = $user['prenom'];
$nom = $user['nom'];
$dateNaissance = DateTime::createFromFormat('d-m-Y', $user['dateNaissance']); // Conversion de la chaîne en objet DateTime
$dateNaissance = $dateNaissance->format('Y-m-d'); // On passe à ce format pour la bdd
$telephone = $user['tel'];
$adresse = $user['adresse'];
$ville = $user['ville'];
$codePostal = $user['codePostal'];
$pays = $user['pays'];

// Exécution des requêtes
if(mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2)) {
// Succès
mysqli_commit($conn);
//echo "Compte créé avec succès!";
} else {
// Erreur
mysqli_rollback($conn);
echo "Erreur lors de la création du compte: " . mysqli_error($conn);
}

// Fermeture des connexions
mysqli_stmt_close($stmt1);
mysqli_stmt_close($stmt2);
mysqli_close($conn);


//$utilisateurs[] = implode(",", $user);
//file_put_contents("../../database/client.csv", implode("\n", $utilisateurs));

//on connecte l'utilisateur, un tableau contenant les informations de l'utilisateur est créé
$_SESSION["UTILISATEUR"] = $user;
header("Location: ../Vue/index.php");
exit();
?>