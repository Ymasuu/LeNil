<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    // vérifie si le formulaire a été soumis
    if (isset($_POST['commander'])) {
        
        // récupère le total de la commande depuis la session
        $total = $_SESSION['total_final'];

        // génère un numéro de commande aléatoire
        $numero_commande = rand(100000, 999999);

        // stocke les données de la commande dans la session
        $_SESSION['numero_commande'] = $numero_commande;
        $_SESSION['total_commande'] = $total;

        // Rediriger l'utilisateur vers le panier
        header('Location:../Vue/panier.php');
        exit;
    }
?>