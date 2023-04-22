<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();
?>

<?php
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');
    // on cherche dans la base de donnée si le code existe
    if(isset($_POST['code'])){
        $code = $_POST['code'];
        $code = mysqli_real_escape_string($conn, $code);
        $sql = "SELECT * FROM code_promo WHERE Code = '$code'";
    }

    $resultat = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($resultat);
    // si le code existe 
    if($resultCheck > 0){
        $row = mysqli_fetch_assoc($resultat);
        // si le code est périmé  
        if($date > $row['dateDePeremption']){
            $_SESSION['message'] = "Désolé le code est périmé.";
            header("Location:../Vue/panier.php");
            exit();
        }
        $email = $_SESSION["UTILISATEUR"]["email"];
        // si le montant du panier n'est pas suffisant pour utiliser le code
        $sql = "SELECT * FROM panier WHERE emailCompte = '$email'";
        $result = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_assoc($result);
        if ($row2['TTC'] < $row['APartirDeCombien']){
            $_SESSION['message'] = "Désolé ce code est valide à partir de " . $row['APartirDeCombien'] . " € minimum.";
            header("Location:../Vue/panier.php");
            exit();
        }
        else {
            $nv_montant = $row2['TTC'] - $row['Valeur_Code'];
            $sql = "UPDATE panier SET TTC = '$nv_montant' WHERE emailCompte = '$email'";
            $_SESSION['message'] = "Le code est validé.";
        }
    }
    else $_SESSION['message'] = "Désolé le code n'existe pas essayez un autre.";

    header("Location:../Vue/panier.php");

?>