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
			<?php include 'catalogue.php'?>
		</div>
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>