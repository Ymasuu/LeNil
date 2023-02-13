<?php
    session_start();
    //fichier utilisé pour l'inscription d'un utilisateur

    //calcul du prochain identifiant
	$utilisateurs = explode("\n", file_get_contents("../database/client.txt")); //récupération des détails du dernier utilisateur pour obtennir son id
	$dernier = explode("|", end($utilisateurs));
	$nouvelID = strval(intval($dernier[0]) + 1);

    //création de la chaine avec les informations entrée dans le formulaire
    $nouvelUtilisateur = $nouvelID."|".$_POST["email"]."|".$_POST["mdp"]. "|".$_POST["nom"]."|".$_POST["prenom"]."|".$_POST["dateNaissance"]."|".$_POST["tel"]."|".$_POST["adresse"]."|".$_POST["ville"]."|".$_POST["codePostal"]."|".$_POST["pays"]."|";

    array_push($utilisateurs, $nouvelUtilisateur); //ajout de l'utilisateur dans la liste
	$stringutilisateur = implode("\n", $utilisateurs); //conversion en chaine de caractère pour l'enregistrer

	$fichier = fopen("../database/client.txt", "w");
	fwrite($fichier, $stringutilisateur);
	fclose($fichier);

    $_SESSION["UTILISATEUR"] = $nouvelID; //attribution de l'id à la variable de session

    // $_SESSION["message"] = "Inscription réussie !";
    header("Location: ../pages/Vue/index.php");
    
?>  
