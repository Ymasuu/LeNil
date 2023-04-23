<?php
    // Pour la connection de la bdd
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();
?> 
<?php
    if($_POST['commandeID']){
        $id = $_POST['commandeID'];
        $sql = "UPDATE commande SET Livre = 1 WHERE id = '$id'";
        $resultat = mysqli_query($conn, $sql);
        $_SESSION['message'] = "Merci d'avoir accepté la commande #". $id . " un email va etre envoyé au client.";
    }

    header("Location:../Vue/Livreur.php");
?>