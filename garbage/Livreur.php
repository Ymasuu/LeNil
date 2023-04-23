<?php
    // Pour la connection de la bdd
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    session_start();
    // Instanciation de la classe CompteLivreur pour récupérer le tableau associatif
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LE NIL</title>
    <link rel="stylesheet" href="../../css/livreur.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="image/png" href="../../img/logo2.png">
</head>
<body>
    <div>
        <?php include '../../templates/header.php';
			if(isset($_SESSION["message"]))echo "<center><b>".$_SESSION["message"]."</b></center>"; unset($_SESSION["message"]);
            unset($_SESSION['message']);
		?>
        <hr> <!-- Repère visuel temporaire -->
        <div class="commandes">
            <?php
                // Boucle pour afficher toutes les commandes


                /////-------ON METS LA CLASSE COMPTELIVREUR CAR IL NE RECONNAIT PAS LE FICHIER DANS MODELE/CLASSES
                //JE NE SAIS PAS POURQUOI ----------////////////////////////////////////
                /*require_once '..\..\Modele\Classes\Compte.php';
                require_once '..\..\Modele\Classes\Client.php';
                require_once '..\..\Modele\Classes\Commande.php';
                require_once '..\..\Modele\Classes\Colis.php'; */
class CompteLivreur {
    
    private $emailCompte;
    private $tableauAssociatifColisClient = Array(); //0..* objets de type Colis à livrer
    private $listeDatesCommandes; //Juste une liste de meme taille que le tableau precedent pour afficher
                                    //les dates des commandes
    private int $cepLivreur;
    
    // Constructeur de la classe
    public function __construct($email,$cepLivreur) {
        $this->emailCompte = $email;
        $this->cepLivreur = $cepLivreur; //Le cep designe sur quelles adresses
                    //Ce livreur livrera les colis
        
        //On fait une requete dans la bdd pour trouver tous les colis liés à ce livreur
        require_once '..\..\database\config\connection.php';
        require_once '..\..\database\config\database.php';
/*$query = "SELECT *
          FROM colis
          INNER JOIN commande ON colis.idCommande = commande.id"; */

$query = "SELECT colis.idColis as id, commande.*, colis.*
          FROM colis
          INNER JOIN commande ON colis.idCommande = commande.id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // traitement des données récupérées
        //On recupere tous les colis des client qu'on le meme CEP que ce livreur
        //On prepare un objet type Colis pour ajouter à ce livreur en fonction
        //de l'adresse du client
        $compteClient = new Compte($row['emailCompte']);
        $client = new Client($row['emailCompte'], $compteClient);
        $commande = new Commande($client);        
        $colis = new Colis($commande);
        // Ajout des objets $colis et $compte dans le tableau associatif
        //la cle de chaque association c'est l'id du Colis en question
        $tableauAssociatifColisClient[$row['idColis']] = array('colis' => $colis, 'client' => $client);
        array_push($this->listeDatesCommandes,$row['datePayment']);

    }
}
    }
    
    // Méthode pour récupérer les colis à livrer pour le livreur en question
    public function getTableauAssociatifColisClient() {
    
        return $this->tableauAssociatifColisClient;
    }
}


                /////////////--------------///////////////////////////////////////////////////
                $livreur = new CompteLivreur($_SESSION["UTILISATEUR"]["email"],$_SESSION["UTILISATEUR"]["codePostal"]);
    $tableauAssociatifColisClient = $livreur->getTableauAssociatifColisClient();
                foreach($tableauAssociatifColisClient as $idColis => $association) {
                    $colis = $association['colis'];
                    $compte = $association['compte'];
                    $commande = $colis->getCommande();
                    $client = $commande->getClient();
            ?>
                <form action="pageLivreur.php" method="post">
                    <div class="article">
                        <button type="submit">
                            <div>
                                <h5>Commande #<?php echo $commande->getIdCommande(); ?></h5>
                                <p>Date de commande : <?php echo $commande->getDateCommande(); ?></p>
                                <p>Adresse de livraison : <?php echo $client->getAdresse(); ?></p>
                            </div>
                        </button>
                        <input type="hidden" name="colis_id" value="<?php echo $idColis; ?>">
                    </div>
                </form>
            <?php } ?>
        </div>
        <hr> <!-- Repère visuel temporaire -->
        <?php include '../../templates/footer.php'; ?>
    </div>
</body>
</html>
