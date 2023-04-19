<?php
require_once '..\..\database\config\connection.php';
require_once '..\..\database\config\database.php';
session_start();
    
if(isset($_SESSION["UTILISATEUR"])){
    header("Location: profil.php");
    exit();
}
$email = $_POST['mail'];

$valide = 0; //par défaut, on considère que les informations entrées sont invalides

// ACCES DE L'UTILISATEUR DANS LA BDD
$email = mysqli_real_escape_string($conn, $email);


// Execute the SQL query with escaped values
$query = "SELECT * FROM Compte WHERE email='$email';";
$result = mysqli_query($conn, $query);

$resultCheck = mysqli_num_rows($result);

//Si la requete est bonne...
if ($resultCheck>0) {
    $valide = 1;
}






/*$utilisateurs = explode("\n", file_get_contents("../../database/client.csv")); // récupération des données utilisateur

$valide = 0; //par défaut, on considère que les informations entrées sont invalides

foreach($utilisateurs as $end) //on parcourt dans la liste des utilisateurs 
{
    $detailUtilisateur = explode(",", $end);
    if($detailUtilisateur[2] == $email)
    {
        $valide = 1;
        break;
    }
}
*/
if($valide == 0){
    $_SESSION["erreur"] = "L'adresse mail n'est pas valide";
    header("Location:../Vue/forgotPassword.php");
    exit();
}
/* 
// Génération du lien unique pour la modification du mot de passe
$lien = "http://localhost:3000/pages/Vue/modifier_mot_de_passe.php?email=".urlencode($email)."&token=".uniqid();

// Envoi du mail
$sujet = "Modification de votre mot de passe sur le site Le Nil";
$message = "Bonjour,\n\nVous avez demandé à modifier votre mot de passe sur
le site Le Nil.\n\nPour ce faire, veuillez cliquer sur le lien suivant : 
".$lien."\n\nLe lien est valable 2h.\n\n
Si vous n'avez pas demandé à modifier votre mot de passe,
veuillez ignorer ce message.\n\nCordialement,\n\nL'équipe Le Nil";
$header = "From: LeNil@gmail.com\r\nReply-To: LeNil@gmail.com\r\nX-Mailer: PHP/".phpversion();
mail($email, $sujet, $message, $header);
*/

// On ne peut pas envoyer de mail sur le serveur de l'école, donc on ne peut pas tester 
// cette partie du code. Nous allons donc la simuler.

$_SESSION["mail"] = $email;
header("Location:../Vue/forgotPassword2.php");
exit();
?>