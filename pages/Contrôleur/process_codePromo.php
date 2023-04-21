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
        // si le montant du panier n'est pas suffisant pour utiliser le code
        else if ($_SESSION['prixPanier'] < $row['APartirDeCombien']){
            $_SESSION['message'] = "Désolé ce code est valide à partir de " . $row['APartirDeCombien'] . " € minimum.";
            header("Location:../Vue/panier.php");
            exit();
        }
        else {
            $_SESSION['prixPanier'] = $_SESSION['prixPanier'] - $row['Valeur_Code'];
            $_SESSION['message'] = "Le code est validé.";
        }
    }
    else $_SESSION['message'] = "Désolé le code n'existe pas essayez un autre.";

    header("Location:../Vue/panier.php");

?>