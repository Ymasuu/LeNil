<?php
    session_start();
    if(isset($_POST['mensuel'])){
        $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Mensuel";
    }
    if(isset($_POST['annuel'])){
       $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Annuel";
    }


    /*$fichier = file_get_contents("../../database/client.csv");
    $utilisateur = explode("\n", $fichier);
    foreach($utilisateur as $end) {
        if ($utilisateur[2] == $_SESSION["UTILISATEUR"]["email"]) {
            // Mettre à jour les données dans le tableau $ligne
            $utilisateur[10] = "test";
            header('Location:../Vue/profil.php');
            exit();
        }
        $fichier = implode("\n", $csvArray);
        file_put_contents("../../database/client.csv", $fichier);
        break;
    }*/

    $csv = file_get_contents("../../database/client.csv");
    // diviser la chaîne en lignes
    $lignes = explode("\n", $csv);

    // parcourir chaque ligne
    foreach ($lignes as $index => $ligne) {
        // diviser la ligne en colonnes
        $colonnes = str_getcsv($ligne, ',');

        // si la colonne 3 contient votre adresse e-mail, mettre à jour la colonne 9 avec la nouvelle donnée
        if ($colonnes[2] == $_SESSION['UTILISATEUR']['email']) {
            $colonnes[10] = $_SESSION['UTILISATEUR']['Abonnement'];
            // fusionner les colonnes en une nouvelle ligne
            $nouvelle_ligne = implode(',', $colonnes);
            // remplacer la ligne d'origine par la nouvelle ligne
            $lignes[$index] = $nouvelle_ligne;
            // fusionner les lignes en une chaîne de caractères
            $nouveau_csv = implode("\n", $lignes);
            // fusionner les lignes en une chaîne de caractères
            $nouveau_csv = implode("\n", $lignes);
            // écrire le nouveau contenu dans le fichier
            file_put_contents('chemin/vers/votre/fichier.csv', $nouveau_csv);
            break;
        }        
    }



    header('Location:../Vue/index.php');
    exit();
?>