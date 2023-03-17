<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LE NIL </title>
    <style>
        .user{
            margin-left: 70%;
        }
    </style>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
    <h3> Catalogue </h3>
    <h3 class="user"> Bienvenue <?php echo $_SESSION["user"] ?> 
        <p>Panier : 0</p>
    </h3>
</head>
<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div>
            <h5>Casquette : </h5>
            <div style="display: flex; align-items: center;">
            <img src="../../img/casquette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
            <p>Description : Casquette très utile ... notamment contre le vent<br>Prix : 10.50€</p>    
            </div>
            <button>Ajouter au panier</button>

            <h5>Lunette de soleil : </h5>
            <div style="display: flex; align-items: center;">
            <img src="../../img/lunette_soleil.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
            <p>Description : Très bonne lunette de soleil qui permettent une protection très efficace contre le soleil<br>Prix : 8.99€</p>  
            </div>
            <button>Ajouter au panier</button>

            <h5>Claquette : </h5>
            <div style="display: flex; align-items: center;">
            <img src="../../img/claquette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
            <p>Description : Claquette stylée qui sont très confortables ! <br>Prix : 13.50€</p>
            </div>
            <button>Ajouter au panier</button>

            <h5>Chaussette : </h5>
            <div style="display: flex; align-items: center;">
            <img src="../../img/chaussette.jpg" style="width: 100px; height: 100px; margin-right: 10px;">
            <p>Description : Chaussette chaude à l'effigie de  l'ancien président américain Donald Trump<br>Prix : 9.50€</p>
            </div>
            <button>Ajouter au panier</button>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>