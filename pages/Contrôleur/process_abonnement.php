<?php
    session_start();
    if(isset($_POST['mensuel'])){
        $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Mensuel";
    }
    if(isset($_POST['annuel'])){
       $_SESSION['UTILISATEUR']['Abonnement'] = "Abonnement Annuel";
    }

    $utilisateurs = explode("\n", file_get_contents("../../database/client.csv")); // récupération des données utilisateur
    foreach($utilisateurs as $end){ //on parcourt dans la liste des utilisateurs 
        $detailUtilisateur = explode(",", $end);
        if($detailUtilisateur[2] == $_SESSION['UTILISATEUR']['email']){
            $detailUtilisateur[10] = $_SESSION['UTILISATEUR']['Abonnement'];
        }
    }   
    header('Location: ../Vue/profil.php');
    exit();
?>