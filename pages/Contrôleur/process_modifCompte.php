<?php
    // Pour la connexion à la base de données
    require_once '../../database/config/connection.php';
    require_once '../../database/config/database.php';
    session_start();

    if(isset($_POST["modifier_compte"])) {
        // Récupérer l'email de l'utilisateur à partir du formulaire
        $email = $_POST["email"];
        $email = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT * FROM compte WHERE email = '$email';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            // Récupérer les nouvelles données depuis le formulaire
            $new_email = isset($_POST["new_email"]) ? $_POST["new_email"] : "";
            $new_mdp = isset($_POST["new_mdp"]) ? $_POST["new_mdp"] : "";
            $new_abonnement = isset($_POST["new_abonnement"]) ? $_POST["new_abonnement"] : "";
            $new_dateAbonnement = isset($_POST["new_dateAbonnement"]) ? $_POST["new_dateAbonnement"] : "";

            $client = isset($_POST['type_compte']) && $_POST['type_compte'] == 'client' ? 1 : 0;
            $vendeur = isset($_POST['type_compte']) && $_POST['type_compte'] == 'vendeur' ? 1 : 0;
            $livreur = isset($_POST['type_compte']) && $_POST['type_compte'] == 'livreur' ? 1 : 0;
            $admin = isset($_POST['type_compte']) && $_POST['type_compte'] == 'admin' ? 1 : 0;
            
            // Mettre à jour les informations du compte dans la base de données
            $sql = "UPDATE compte SET ";
            if (!empty($new_email)) {
                $sql .= "email = '$new_email', ";
            }
            if (!empty($new_mdp)) {
                $sql .= "motDePasse = '$new_mdp', ";
            }
            if (!empty($new_abonnement)) {
                $sql .= "abonnement = '$new_abonnement', ";
            }
            if (!empty($new_dateAbonnement)) {
                $sql .= "dateAbonnement = '$new_dateAbonnement', ";
            }
            $sql .= "signatureContratClient = $client, signatureContratVendeur = $vendeur, signatureContratLivreur = $livreur, admin = $admin WHERE email = '$email';";

            $connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_begin_transaction($connexion);

            // Mettre a jour la table produitsvendeur
            $result = mysqli_query($connexion, $sql);
            if (!$result) {
                mysqli_rollback($connexion);
                die("Erreur lors de la mise à jour des informations du compte : " . mysqli_error($connexion));
            }

            mysqli_commit($connexion);

            // Fermer la connexion à la base de données
            mysqli_close($connexion);

            // Rediriger 
            $_SESSION["succes"] = "Données du compte mises à jour";
            header("Location: ../Vue/Admin.php");
            exit();
        } else {
            echo "Le compte n'a pas été trouvé";
        }
    }
?>
