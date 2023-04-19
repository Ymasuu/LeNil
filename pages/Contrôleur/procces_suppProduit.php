<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    // On récupère les informations du produit

    if (isset($_POST['produit_id'])) {
        // Requête pour récupérer les informations du produit cliqué
        $produit_id = $_POST['produit_id'];
        $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur WHERE id = '$produit_id'");
    }
    $produit_id = $_SESSION["produit_id"];




    // supprimer les lignes de la table InfoCompte qui font référence à l'utilisateur à supprimer
    $sql = "DELETE FROM produitsvendeur WHERE produit_id = '$email'";
    $result = mysqli_query($conn, $sql);

    // supprimer l'utilisateur de la table Compte
    $sql = "DELETE FROM Compte WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Fermer la connexion
    mysqli_close($conn);

    $_SESSION["message"] = "Compte supprimé";
    header('Location:../Vue/login.php');
    exit();
?>