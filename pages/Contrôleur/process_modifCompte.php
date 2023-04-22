<?php
    // Pour la connexion à la base de données
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();
    
    if(isset($_POST["modifier_compte"])) {
        // Récupérer l'email de l'utilisateur à partir du formulaire
        $email = $_POST["email"];
        
        // Récupérer les informations du compte à partir de la base de données
        $sql = "SELECT * FROM compte WHERE email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        // Récupérer les nouvelles données à partir du formulaire
        $new_email = isset($_POST['new_email']) ? $_POST['new_email'] : $row['email'];
        $new_mdp = isset($_POST['new_mdp']) ? $_POST['new_mdp'] : $row['motDePasse'];
        $new_abonnement = isset($_POST['new_abonnement']) ? $_POST['new_abonnement'] : $row['abonnement'];
        $new_dateAbonnement = isset($_POST['new_dateAbonnement']) ? $_POST['new_dateAbonnement'] : $row['dateAbonnement'];
        $new_client = isset($_POST['new_client']) ? $_POST['new_client'] : $row['signatureContratClient'];
        $new_vendeur = isset($_POST['new_vendeur']) ? $_POST['new_vendeur'] : $row['signatureContratVendeur'];
        $new_livreur = isset($_POST['new_livreur']) ? $_POST['new_livreur'] : $row['signatureContratLivreur'];
        
        // Mettre à jour les données du compte dans la base de données
        $sql = "UPDATE compte SET email = '$new_email', motDePasse = '$new_mdp', abonnement = '$new_abonnement', dateAbonnement = '$new_dateAbonnement', signatureContratClient = '$new_client', signatureContratVendeur = '$new_vendeur', signatureContratLivreur = '$new_livreur' WHERE email = '$email'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['succes'] = "Le compte a été modifié avec succès.";
            header("Location: ../Vue/Admin.php");
            exit();
        }
    }
?>
