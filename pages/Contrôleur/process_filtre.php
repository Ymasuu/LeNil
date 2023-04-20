<?php
    // On récupere les valeurs cochez si elles existent
    if(isset($_POST['categories'])) {
        $categories = $_POST['categories'];
    }

    // on crée le requete SQL
    $sql = "SELECT * FROM produitsvendeur WHERE 1=1";

    if(isset($categories)){
        $sql .= " AND (";
        $i = 0;
        foreach($categories as $categorie) {
            if($i > 0) {
                $sql .= " OR ";
            }
            $sql .= "categorie='$categorie'";
            $i++;
        }
        $sql .= ")";
    }

    // on exécute la requête SQL
    $result = mysqli_query($conn, $sql);

    $_SESSION['objet'] = $result; 


?>