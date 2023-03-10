<?php
	session_start();
?>
<!DOCTYPE html>
<html> 
<head>
	<meta cjharset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accueil</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
		<hr> <!-- Repère visuel temporaire -->
		<div>
			<h1>Ma page</h1>
			<p>du texte...</p>
			<?php
				if(isset($_SESSION["UTILISATEUR"])){
					echo "Vous êtes connecté en tant que ".$_SESSION["UTILISATEUR"];
				}
			?>
		</div>
		<hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>