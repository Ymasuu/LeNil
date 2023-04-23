<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');
    $date = mysqli_real_escape_string($conn, $date);
    
    $email = $_SESSION["UTILISATEUR"]["email"];
    $email = mysqli_real_escape_string($conn, $email);
    
    // on recupere les valeurs panier
    $sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(isset($_SESSION["UTILISATEUR"]["prixCode"])){
        $prix = $_SESSION["UTILISATEUR"]["prixCode"];
        unset($_SESSION["UTILISATEUR"]["prixCode"]);
    } else $prix = $row['TTC'];
    
    $sql = "SELECT * FROM commande";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    // si la table est vide 
    if($resultCheck <= 0){
        $nouvelle_id = 0;
    }else {
        // on récupère l'id du dernier élément de la table
         $sql_ancien_id = "SELECT MAX(id) AS ancien_id FROM commande";
         $result_ancien_id = $conn->query($sql_ancien_id);
         $row_ancien_id = $result_ancien_id->fetch_assoc();
         $ancien_id = $row_ancien_id['ancien_id'];
         // on l'incrémente de 1
         $nouvelle_id = $ancien_id + 1;
    }

    // On ajoute la commande avec ses données
    $sql = "INSERT INTO commande (id, emailCompte, totalPayer, modePayment, datePayment, Livre) 
            VALUES ('$nouvelle_id', '$email', '$prix', 'CB', '$date', '0')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Erreur lors de l'exécution de la requête SQL : " . mysqli_error($conn);
    }
    
    $_SESSION['message'] = "Votre commande est validé, merci.";
    $sql = "DELETE FROM quantiteCommande WHERE emailClient = '$email'";
    $result = mysqli_query($conn, $sql);							
    $sql = "DELETE FROM panier WHERE emailCompte = '$email'";
    $result = mysqli_query($conn, $sql);

    header('Location:../Vue/panier.php');

?>