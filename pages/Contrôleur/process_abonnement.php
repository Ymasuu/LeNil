<?php
    session_start();
    if(isset($_POST['mensuel'])){
        $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Mensuel";
    }
    if(isset($_POST['annuel'])){
       $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Annuel";
    }

    $fichier = fopen('../../database/client.csv', 'r+');
    // Parcours du fichier CSV et mise à jour des enregistrements correspondants
    while (($utilisateur = fgetcsv($fichier)) !== FALSE) {
        if ($utilisateur[2] == $_SESSION['UTILISATEUR']['email'] && $utilisateur[9] == $_SESSION['UTILISATEUR']['mdp']) {
            // Mettre à jour les données dans le tableau $ligne
            $utilisateur[10] = $_SESSION['UTILISATEUR']['Abonnement'];
            // Réécrire la ligne mise à jour dans le fichier CSV
            fseek($fichier, -strlen(implode(',', $ligne)), SEEK_CUR);
            fputcsv($fichier, $utilisateur);
            break;
        }
    }
    // Fermeture du fichier CSV
    fclose($fichier);


    header('Location: ../Vue/profil.php');
    exit();
?>