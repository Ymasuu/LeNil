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

    // Récupération des données POST + METTRE DES CONDITIONS SI C'EST VIDE
    $nom = $_POST['nom'];
    $QuantiteVendeur = $_POST['QuantiteVendeur'];
    $prix =$_POST['prix'];
    $minidescription = $_POST['minidescription'];
    $description = $_POST['description'];
    $descri = "description";

    $connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_begin_transaction($connexion);

    //Mettre a jour la table produitsvendeur
    $sql = "UPDATE produitsvendeur SET nom = '$nom', QuantiteVendeur = '$QuantiteVendeur', prix = '$prix', minidescription = '$minidescription', $descri = '$description' WHERE id = '$produit_id';";
    $result = mysqli_query($conn, $sql);
    if (!mysqli_query($connexion, $sql)) {
        mysqli_rollback($connexion);
        die("Erreur lors de la mise à jour des informations du produit : " . mysqli_error($connexion));
    }

    mysqli_commit($connexion);

    // Fermer la connexion à la base de données
    mysqli_close($connexion);

    $_SESSION["succes"] = "Données du produit mis à jour";
    header('Location:../Vue/Vendeur.php');
    exit();
?>