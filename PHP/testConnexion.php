<?php
    //fichier utilisé pour authentifier un utilisateur

    session_start();
	$utilisateurs = explode("\n", file_get_contents("../database/client.txt")); // récupération des données utilisateur
    $mail = $_POST['mail']; //récupération des données transmises
    $password = $_POST['password'];
	$valide = 0; //par défaut, on considère que les informations entrées sont invalides
	
    foreach($utilisateurs as $end) //on parcourt dans la liste des utilisateurs 
    {
		$detailUtilisateur = explode("|", $end);
        if($detailUtilisateur[1] == $mail && $detailUtilisateur[2] == $password)
        {
			$valide = 1;
			$_SESSION["UTILISATEUR"] = $detailUtilisateur[0]; //changement de la variable environnement
        }
    }

	if ($valide == 0)//si aucun login ne correspond, on renvoie un message d'erreur
    { 
		//$connecte = "Login ou mot de passe incorrect";
        $_SESSION["message"] = $connecte;
        header("Location:../pages/Vue/login.php");
	}
    else //si l'opération à réussi, on affiche un message de succès
    {
        //$connecte = "Connexion réussie !";
        $_SESSION["message"] = $connecte;
        header("Location: ../pages/Vue/index.php");
    }
?>
