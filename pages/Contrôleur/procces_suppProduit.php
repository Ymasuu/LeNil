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
    // a cause des clés étrangeres :
    mysqli_query($conn, "DELETE FROM contenupanier WHERE idProduitsVendeur = '$produit_id'");

    // supprimer le produit
    $sql = "DELETE FROM produitsvendeur WHERE id = '$produit_id'";
    $result = mysqli_query($conn, $sql);

    // Fermer la connexion
    mysqli_close($conn);

    $_SESSION["message"] = "Produit supprimé";
    header('Location:../Vue/Vendeur.php');
    exit();
?>