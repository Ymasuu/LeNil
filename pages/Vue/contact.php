<?php
	session_start();
?>
<!DOCTYPE html>
<html> 
<head>
	<meta cjharset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact</title>
    <style>
        .contact{
            text-align: center;
            border-style: ridge;
            
        }
    </style>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div class="contact">
            <h2>Demande de contact</h2>
            <form id="form" action="mail.php" method="post">
            <label for='dateC'> Date du contact : </label>
                <input type="date" id="dateC" name="dateC" value="2022-01-01" required><br><br>
                <label for='nom'> Nom : </label>
                <input type="text" placeholder="Entrez votre nom" name="nom" id="nom" required><br><br>
                <label for='prenom'> Prénom : </label>
                <input type="text" placeholder="Entrez votre prénom" name="prenom" required><br><br>
                <label for='email'> Email : </label>
                <input type="email" placeholder="monmail@site.org" name="email" required><br><br>
                <label for='Date'> Date de naissance : </label>
                <input type="date" name="date" id="date" value="2000-01-01" required><br><br>
                <label for='fonction'> Fonction : </label>
                <select name="fonction" id="fonction" required>
                    <option value="">---------</option>
                    <option value="Employé">Employé</option>
                    <option value="Client">Client</option>
                    <option value="Vendeur">Vendeur</option>
                    <option value="Livreur">Livreur</option>
                    <option value="Autre">Autre</option>
                </select><br><br>
                <label for='sujet'> Sujet : </label>
                <input type="text" placeholder="Entrez le sujet de votre mail" name="sujet" required><br><br>
                <label for='Contenu'> Contenu : </label>
                <textarea placeholder="Tapez ici la demande de votre mail" name="contenu"></textarea><br><br>
                <input class="color" class="bouton" type="submit" value="Envoyer" name="submit">
                <input class="color" style="margin-bottom: 5px;" class="bouton" type="Reset" value="Reset">

            </form>
        </div>
        
        <hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>