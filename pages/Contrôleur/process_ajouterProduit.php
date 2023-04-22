<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();


    if(isset($_SESSION["UTILISATEUR"]["email"])) {
        $emailVendeur = $_SESSION["UTILISATEUR"]["email"];
    } else {
        // l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        header("Location: login.php");
        exit();
    }

    // récupérer les autres données du formulaire
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $minidescription = $_POST['minidescription'];
    $description = $_POST['description'];
    //$descri = "description";
    //$image = $_FILES['image'];

   
    // Get the ID of the last inserted product
    $sql_ancien_id = "SELECT MAX(id) AS ancien_id FROM produitsvendeur WHERE emailVendeur = '$emailVendeur'";
    $result_ancien_id = $conn->query($sql_ancien_id);
    $row_ancien_id = $result_ancien_id->fetch_assoc();
    $ancien_id = $row_ancien_id['ancien_id'];

    // Increment the last ID by 1
    $nouvelle_id = $ancien_id + 1;

    // Add the new product with the incremented ID
    $sql = "INSERT INTO produitsvendeur (id, emailVendeur, QuantiteVendeur, prix, nom, description, minidescription) 
            VALUES ('$nouvelle_id', '$emailVendeur', '$quantite', '$prix', '$nom', '$description', '$minidescription')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Erreur lors de l'exécution de la requête SQL : " . mysqli_error($conn);
    }

    // Fermer la connexion
    $conn->close();

    $_SESSION["message"] = "Produit ajouté";
    header('Location:../Vue/Vendeur.php');
    exit();

    


    /*// Vérifiez si l'utilisateur est connecté
    if(isset($_SESSION['email'])){

        // Vérifiez si l'utilisateur est un vendeur
        if($_SESSION['type_compte'] == 'vendeur'){

            // Récupérez l'email du vendeur à partir de la session
            $email_vendeur = $_SESSION['email'];

            //GESTION DE L'IMAGE
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Chemin d'accès où enregistrer l'image sur le système de fichiers
                $upload_path = '../../img';
            
                // Nom de fichier unique pour éviter les conflits
                $filename = uniqid() . '-' . $_FILES['image']['name'];
            
                // Chemin d'accès complet vers le fichier uploadé
                $file_path = $upload_path . '/' . $filename;
            
                // Enregistrement de l'image sur le système de fichiers
                move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
            
                // Message de succès
                echo "L'image a été téléchargée avec succès !";
            }
  
            // Exécution de la requête
            if(mysqli_query($conn, $sql)){
                // Message de succès
                $_SESSION["message"] = "Produit ajouté avec succès !";
            } else{
                // Message d'erreur
                $_SESSION["message"] = "Erreur lors de l'ajout du produit : " . mysqli_error($conn);
            }

        }
    }*/
?>
