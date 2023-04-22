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

   
    $sql = "INSERT INTO produitsvendeur (emailVendeur, QuantiteVendeur, prix, nom, description, minidescription) VALUES ('$emailVendeur', '$quantite', '$prix', '$nom', '$description', '$minidescription')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Erreur lors de l'exécution de la requête SQL : " . mysqli_error($conn);
    }


    // Fermer la connexion
    $conn->close();

    $_SESSION["message"] = "Produit ajouté";
    header('Location:../Vue/Vendeur.php');
    exit();
    


    /*
    // Vérifiez si l'utilisateur est connecté
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
            
            //GESTION DES AUTRES INFOS
            $nom = $_POST['nom'];
            $QuantiteVendeur = $_POST['quantite'];
            $prix = $_POST['prix'];
            $minidescription = $_POST['minidescription'];
            $description = $_POST['description'];

            mysqli_begin_transaction($conn);

            // Requête d'insertion dans la table produitsvendeur
            $sql1 = "INSERT INTO produitsvendeur (id, nom, QuantiteVendeur, prix, minidescription, description, emailVendeur) 
            VALUES (NULL, ?, ?, ?, ?, ?, ?)";

            $stmt1 = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($stmt1, "ssssss", $nom, $QuantiteVendeur, $prix, $minidescription, $description, $email_vendeur);

            $max_id_query = "SELECT MAX(id) FROM produitsvendeur";
            $result = mysqli_query($conn, $max_id_query);
            $row = mysqli_fetch_assoc($result);
            $next_id = $row['MAX(id)'] + 1;
            
            // Utilisez la variable $next_id dans la requête d'insertion
            $sql = "INSERT INTO produitsvendeur (id, nom, QuantiteVendeur, prix, minidescription, description, emailVendeur) 
            VALUES ('$next_id', '$nom', '$QuantiteVendeur', '$prix', '$minidescription', '$description', '$email_vendeur')";

            // Exécution de la requête
            if(mysqli_query($conn, $sql)){
                // Message de succès
                $_SESSION["message"] = "Produit ajouté avec succès !";
            } else{
                // Message d'erreur
                $_SESSION["message"] = "Erreur lors de l'ajout du produit : " . mysqli_error($conn);
            }
            mysqli_close($conn);

            header("Location : ../Vue/Vendeur.php");

        }
    }
    */
?>
