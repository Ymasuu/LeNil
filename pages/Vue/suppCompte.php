<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    if(isset($_POST['supprimer_compte'])) {
        $email = $_POST['email'];

        // Supprimer les informations du compte dans la table "panier"
        $sql1 = "DELETE FROM panier WHERE emailCompte = '$email'";
        $conn->query($sql1);

        // Supprimer les informations du compte dans la table "infocompte"
        $sql2 = "DELETE FROM infocompte WHERE emailCompte = '$email'";
        $conn->query($sql2);

        // Supprimer les informations du compte dans la table "quantitecommande"
        $sql2 = "DELETE FROM quantitecommande WHERE emailClient = '$email'";
        $conn->query($sql2);

        // Supprimer les informations du compte dans la table "recherche"
        $sql2 = "DELETE FROM recherche WHERE emailCompte = '$email'";
        $conn->query($sql2);

        // Supprimer les informations du compte dans la table "commande"
        $sql2 = "DELETE FROM commande WHERE emailCompte = '$email'";
        $conn->query($sql2);

        // Supprimer les informations du compte dans la table "produitsvendeur"
        $sql2 = "DELETE FROM produitsvendeur WHERE emailVendeur = '$email'";
        $conn->query($sql2);

        // Supprimer le compte dans la table "compte"
        $sql3 = "DELETE FROM compte WHERE email = '$email'";
        $conn->query($sql3);

        // Rediriger vers la page Admin.php avec un message de confirmation
        $_SESSION['success_message'] = "Le compte a été supprimé avec succès.";
        header("Location: Admin.php");
        exit();
    }
?>
