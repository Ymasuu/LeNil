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
    $produit_id = mysqli_real_escape_string($conn, $produit_id);
    $sql = "SELECT * FROM produitsvendeur WHERE id = '$produit_id';";
    $result = $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    //Si la requete est bonne...
    if ($resultCheck>0) {
        $row = mysqli_fetch_assoc($result);
        $nom = $row['nom'];
        $QuantiteVendeur = $row['QuantiteVendeur'];
        $prix = $row['prix'];
        $minidescription = $row['minidescription'];
        $categorie = $row['categorie'];
        $description = $row['description'];
    }

    // Récupération des données POST
    if ($_POST['nom'] != "") $nom = $_POST['nom'];
    if ($_POST['QuantiteVendeur'] != "") $QuantiteVendeur = $_POST['QuantiteVendeur'];
    if ($_POST['prix'] != "") $prix =$_POST['prix'];
    if ($_POST['minidescription'] != "") $minidescription = $_POST['minidescription'];
    if ($_POST['description'] != "") $description = $_POST['description'];
    $description = str_replace("'", "''", $description); // pour évitez les probleme avec les apostrophes lorsque l'on utilisera la requete
    if ($_POST['categorie'] != "") $categorie = $_POST['categorie'];   

    $connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_begin_transaction($connexion);

    $descri = "description";

    //Mettre a jour la table produitsvendeur
    $sql = "UPDATE produitsvendeur SET nom = '$nom', QuantiteVendeur = '$QuantiteVendeur', prix = '$prix', minidescription = '$minidescription', $descri = '$description', categorie = '$categorie' WHERE id = '$produit_id';";
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