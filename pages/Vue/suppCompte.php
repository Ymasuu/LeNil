<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    if(isset($_POST['supprimer_compte'])) {
        $email = $_POST['email'];

    // Supprimer les informations du compte dans la table "infocompte"
    $sql1 = "DELETE FROM infocompte WHERE emailCompte = '$email'";
    $conn->query($sql1);

    // Supprimer le compte dans la table "compte"
    $sql2 = "DELETE FROM compte WHERE email = '$email'";
    $conn->query($sql2);

    // Rediriger vers la page Admin.php avec un message de confirmation
    $_SESSION['success_message'] = "Le compte a été supprimé avec succès.";
    header("Location: Admin.php");
    exit();
    }
?>
