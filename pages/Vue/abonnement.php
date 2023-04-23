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
    <link rel="stylesheet" href="../../css/abonnement.css">
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
                <ul class="test">
                    <li>Livraison plus rapide</li>
                    <li>Frais de Livraison gratuit</li>
                    <li>10€/mois</li>
                </ul>
                <input class="bouton-golden" type="submit"  id="mensuel" name="mensuel" value="s'abonner">
            </div>
            <div class="flex">
                <h4>ABONNEMENT ANNUEL</h4>
                <ul class="test">
                    <li>Livraison plus rapide</li>
                    <li>Frais de Livraison gratuit</li>
                    <li>100€/an</li>
                </ul>
                <input class="bouton-golden" type="submit" id="annuel" name="annuel" value="s'abonner">
            </div>     
        </form>
        <hr> <!-- Repère visuel temporaire -->
	</div>
    <?php include '../../templates/footer.php'; ?>
</body>
</html>
