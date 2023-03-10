<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LE NIL </title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
    <h3> Produit du magasin <?php echo $_SESSION["vendeur"] ?></h3>
</head>

<body>
    <div>
        <?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
        <div>
            <h5>Produit 1 : </h5>
            <p>image // prix : 0 // stock : 0 </p> <button>modifier informations</button>
            <h5>Produit 2 : </h5>
            <p>image // prix : 0 // stock : 0 </p> <button>modifier informations</button>
            <h5>Produit 3 : </h5>
            <p>image // prix : 0 // stock : 0 </p> <button>modifier informations</button>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>