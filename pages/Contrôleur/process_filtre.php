<?php

    // on crée le requete SQL
    $sql = "SELECT * FROM produitsvendeur WHERE 1=1";

    // On récupere les catégories si elles existent
    if(isset($_POST['categories'])) {
        $categories = $_POST['categories'];
    }

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





    // On récupere la fourchette de prix si elle existe
    if(isset($_POST['prix'])) {
        $prix = $_POST['prix'];
    }

    if(isset($prix)){
        $sql .= " AND (";
        if($prix == "1") $sql .= "prix BETWEEN 0 AND 49 )";
        else if ($prix == "2") $sql.= "prix BETWEEN 50 AND 151 )";
        else $sql .= "prix > 150 )";
    }

    // On récupere les catégories si elles existent
    if(isset($_POST['vendeur'])) {
        $vendeur = $_POST['vendeur'];
    }

    if(isset($vendeur)){
        $sql .= " AND (";
        $i = 0;
        foreach($vendeur as $v) {
            if($i > 0) {
                $sql .= " OR ";
            }
            $sql .= "emailVendeur='$v'";
            $i++;
        }
        $sql .= ")";
    }



    $sql .= ";";
    // on exécute la requête SQL
    $resultat = mysqli_query($conn, $sql);
    if (!$resultat) {
        die("Erreur SQL : " . mysqli_error($conn));
    }

    $_SESSION['objet'] = $resultat; 

?>