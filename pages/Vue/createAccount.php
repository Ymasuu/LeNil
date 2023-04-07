<?php
    session_start();
    if(isset($_SESSION["UTILISATEUR"])){
        header("Location: profil.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Créer un compte</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div style="width: 500px; margin: auto;">
		<h1>Créer un compte</h1>
		<form action="../Contrôleur/process_createAccount.php" method="post">
			<fieldset>
				<legend>Informations personnelles</legend>
				<table>
					<tr>
						<td><label for="nom">Nom*</label></td>
						<td><input type="text" name="nom" id="nom" pattern="[A-Za-z-]{1,26}" required></td>
					</tr>
					<tr>
						<td><label for="prenom">Prénom*</label></td>
						<td><input type="text" name="prenom" id="prenom" pattern="[A-Za-z-]{1,26}" required></td>
					</tr>
					<tr>
						<td><label for="email">Email*</label></td>
						<td><input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
					</tr>
					<tr>
						<td><label for="dateNaissance">Date de naissance*</label></td>
						<td><input type="date" name="dateNaissance" id="dateNaissance" min="1900-01-01" max="2010-12-31" required></td>
					</tr>
					<tr>
						<td><label for="tel">Téléphone*</label></td>
						<td><input type="tel" name="tel" id="tel" pattern="[0-9]{10}" required></td>
					</tr>
					<tr>
						<td><label for="adresse">Adresse*</label></td>
						<td><input type="text" name="adresse" id="adresse" pattern="[A-Za-z0-9-' ]{1,60}" required></td>
					</tr>
					<tr>
						<td><label for="ville">Ville*</label></td>
						<td><input type="text" name="ville" id="ville" pattern="[A-Za-z-]{1,26}" required></td>
					</tr>
					<tr>
						<td><label for="codePostal">Code postal*</label></td>
						<td><input type="text" name="codePostal" id="codePostal" pattern="[0-9]{5}" required></td>
					</tr>
					<tr>
						<td><label for="pays">Pays*</label></td>
						<td><input type="text" name="pays" id="pays" pattern="[A-Za-z-]{1,26}" required></td>
					</tr>
					<tr>
						<td><label for="mdp">Mot de passe*</label></td>
						<td><input type="password" name="mdp" id="mdp" pattern="[A-Za-z0-9-]{1,60}" required></td>
					</tr>
					<tr>
						<td><label for="mdp2">Confirmer le mot de passe*</label></td>
						<td><input type="password" name="mdp2" id="mdp2" pattern="[A-Za-z0-9-]{1,60}" required></td>
					</tr>
					<tr>
						<td><input type="submit" value="Créer le compte"></td>
						<td>
							<?php
								if(isset($_SESSION["error"])){
									echo $_SESSION["error"];
									unset($_SESSION["error"]);
								}
							?>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
		<br>
		<a href="index.php">Retour à l'accueil</a>
			<span style="padding-left: 80px;">Vous posséder déjà un compte ?</span>
			<button style="display: inline-block;" name="Se connecter" value="Se connecter" onclick="window.location.href='login.php'"><a href="login.php">Se connecter</a></button>
	</div>
</body>
</html>
