<?php
session_start();
// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if(!isset($_SESSION["UTILISATEUR"])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta cjharset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>abonnement</title>
    <style>
        .conteneur {
            display: flex;
        }
        .flex {
            flex-grow: 1;
            border-style: ridge;
            margin: 10px;
        }
        h4{
            text-align : center;
        }
        .desabonner{
            margin-left: 10px;
        }

    </style>
    
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
		<hr> <!-- Repère visuel temporaire -->
        <form action="../Contrôleur/process_abonnement.php" class="conteneur" method="POST">
            <div class="flex">
                <h4>ABONNEMENT MENSUEL</h4>
                <ul>
                    <li>Des réductions sur certains articles</li>
                    <li>Livraison plus rapide</li>
                    <li>Frais de Livraison gratuits</li>
                    <li>10€/mois</li>
                </ul>
                <input type="submit"  id="mensuel" name="mensuel" value="s'abonner">
            </div>
            <div class="flex">
                <h4>ABONNEMENT ANNUEL</h4>
                <ul>
                    <li>Des réductions sur certains articles</li>
                    <li>Livraison plus rapide</li>
                    <li>Frais de Livraison gratuits</li>
                    <li>100€/an</li>
                </ul>
                <input type="submit" id="annuel" name="annuel" value="s'abonner">
            </div>     
        </form>
        <form action="../Contrôleur/process_abonnement.php" class="desabonner" method="POST">
            <input type="submit" id="desabonner" name="desabonner" value="se désabonner">
        </form>
        <hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>
