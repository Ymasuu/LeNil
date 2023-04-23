<?php
    // Pour la connexion à la base de données
    require_once '../../database/config/connection.php';
    require_once '../../database/config/database.php';
    session_start();
    
    if(isset($_POST["modifier_compte"])) {
        // Récupérer l'email de l'utilisateur à partir du formulaire
        $email = $_POST["email"];
        
        // Récupérer les informations du compte à partir de la base de données
        $sql = "SELECT * FROM compte WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LE NIL</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div style="width: 500px; margin: auto;">
            <h1>Modification Compte</h1>
            <form action="../Contrôleur/process_modifCompte.php" method="post">
                <fieldset>
                    <legend>Informations du compte</legend>
                    <p>Ne remplissez que les champs que vous désirez changer.</p>
                    <table>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" name="new_email" id="email" placeholder="<?php echo $row['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="mdp">Mot de passe</label></td>
                            <td><input type="password" name="new_mdp" id="mdp" placeholder="<?php echo $row['motDePasse']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="abonnement">Abonnement</label></td>
                            <td><input type="text" name="new_abonnement" id="abonnement" placeholder="<?php echo $row['abonnement']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="dateAbonnement">Date Abonnement</label></td>
                            <td><input type="text" name="new_dateAbonnement" id="dateAbonnement" placeholder="<?php echo $row['dateAbonnement']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="client">Client</label></td>
                            <td><input type="radio" name="type_compte" id="client" value="client"></td>
                        </tr>
                        <tr>
                            <td><label for="vendeur">Vendeur</label></td>
                            <td><input type="radio" name="type_compte" id="vendeur" value="vendeur"></td>
                        </tr>
                        <tr>
                            <td><label for="livreur">Livreur</label></td>
                            <td><input type="radio" name="type_compte" id="livreur" value="livreur"></td>
                        </tr>
                        <tr>
                            <td><label for="admin">Administrateur</label></td>
                            <td><input type="radio" name="type_compte" id="admin" value="admin"></td>
                        </tr>
                    </table>      
                </fieldset>
            </form>
            <form method="post" action="../Contrôleur/process_modifCompte.php">
                <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                <input type="submit" name="modifier_compte" value="Modifier">
            </form>
            <?php
                }
            ?>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>
