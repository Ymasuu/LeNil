<?php
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();

    // Récupérer les informations des utilisateurs à partir de la base de données
    $sql = "SELECT * FROM compte";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html> 
<head>
	<meta cjharset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
        <h1>Liste des utilisateurs</h1>
        <table>
            <tr>
                <th>Email</th>
                <th>Mot de passe</th>
                <th>Abonnement</th>
                <th>Date d'abonnement</th>
                <th>Signature contrat client</th>
                <th>Signature contrat vendeur</th>
                <th>Signature contrat livreur</th>
                <th>Administrateur</th>
            </tr>
            <?php
                // Afficher les informations des utilisateurs dans un tableau
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["email"]."</td><td>".$row["motDePasse"]."</td><td>".$row["abonnement"]."</td><td>".$row["dateAbonnement"]."</td><td>".$row["signatureContratClient"]."</td><td>".$row["signatureContratVendeur"]."</td><td>".$row["signatureContratLivreur"]."</td><td>".$row["admin"]."</td><td>";
                        
                        echo "<form method='post' action='suppCompte.php'>";
                        echo "<input type='hidden' name='email' value='".$row["email"]."'>";
                        echo "<input type='submit' name='supprimer_compte' value='Supprimer ce compte' class='bouton-golden'>";
                        echo "</form>";
                    }                    
                }
                
            ?>
            </table>
            <form method="post" action="ajoutCompte.php">
                <input type="submit" name="ajouter_un_compte" value="Ajouter un compte" class="bouton-golden">
            </form>
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>
