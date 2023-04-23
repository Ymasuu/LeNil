<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    $email = $_POST['new_email'];
    $mdp = $_POST['new_mdp'];
    $abonnement = 0;

    // Utiliser les valeurs POST pour initialiser les variables $signatureContrat*
    $client = $_POST['type_compte'] == 'client' ? 1 : 0;
    $vendeur = $_POST['type_compte'] == 'vendeur' ? 1 : 0;
    $livreur = $_POST['type_compte'] == 'livreur' ? 1 : 0;
    $admin = $_POST['type_compte'] == 'admin' ? 1 : 0;

    // Ajouter le nouveau compte avec l'ID incrémenté
    $sql = "INSERT INTO compte (email, motDePasse, abonnement, signatureContratClient, signatureContratVendeur, signatureContratLivreur, admin) 
            VALUES ('$email', '$mdp', '$abonnement', '$client', '$vendeur', '$livreur', '$admin')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Erreur lors de l'exécution de la requête SQL : " . mysqli_error($conn);
    }

    // Fermer la connexion
    $conn->close();

    $_SESSION["message"] = "Compte ajouté";
    header('Location:../Vue/Admin.php');
    exit();
?>
