<?php 

$mail = $_POST['mail'];
$password = $_POST['password'];

$utilisateurs = explode("\n", file_get_contents("../../database/client.txt")); // récupération des données utilisateur