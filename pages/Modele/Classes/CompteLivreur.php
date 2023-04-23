<?
require_once 'Compte.php';
require_once 'Client.php';
require_once 'Commande.php';
require_once 'Colis.php';
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
?>