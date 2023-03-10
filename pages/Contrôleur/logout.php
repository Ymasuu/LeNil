<?php
session_start(); //démarrez la session
session_destroy(); //supprimez les données de session
header("Location: ../Vue/index.php"); //redirigez vers la page de connexion
exit();
?>