<?php
    session_start();
    if(isset($_POST['mensuel'])){
        $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Mensuel";
    }
    if(isset($_POST['annuel'])){
       $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Annuel";
    }


    /*$csvFile = file_get_contents("../../database/client.csv");
    $csvArray = explode("\n", $csvFile);
    foreach($csvArray as $key => $line) {
        $utilisateur = explode(",", $line);
        if ($utilisateur[2] == $_SESSION['UTILISATEUR']['email'] && $utilisateur[9] == $_SESSION['UTILISATEUR']['mdp']) {
            // Mettre à jour les données dans le tableau $ligne
            $utilisateur[10] = $_SESSION['UTILISATEUR']['Abonnement'];
        }
        $csvArray[$key] = implode(",", $utilisateur);

        $csvFile = implode("\n", $csvArray);
        file_put_contents("../../database/client.csv", $csvFile);
        break;
    }*/

    $fichier = fopen("../../database/client.csv", 'r+');
    // Boucle pour parcourir les lignes du fichier CSV
    while (($utilisateur = fgetcsv($fichier)) !== false) {
        
        // Vérification de l'identifiant de la ligne courante
        if ($utilisateur[2] == $_SESSION['UTILISATEUR']['email'] && $utilisateur[9] == $_SESSION['UTILISATEUR']['mdp']) {
            
            // Modification des données de la ligne courante
            $utilisateur[10] = $_SESSION['UTILISATEUR']['Abonnement'];
            
            // Réécriture de la ligne courante dans le fichier CSV
            fseek($fichier, -1, SEEK_CUR);
            fputcsv($fichier, $utilisateur);
            break;
        }
    }
    // Fermeture du fichier CSV
    fclose($fichier);

    header('Location: ../Vue/profil.php');
    exit();
?>