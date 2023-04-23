<?
require_once 'Client.php';
class Commande {
    private int $totalPayer;
    private String $modePayment; //indique si le payment va etre fait en CB ou Paypal
            //exemple $modePayment = 'CB'
    private $datePayment;
    private QuantiteCommande $quantiteCommande; //1..1 chaque Commande a une QuantiteCommande
    private Client $client;
    private $listeColis;
    private $id;

    function __construct(Client $client) { 
        require_once '..\..\database\config\connection.php';
        require_once '..\..\database\config\database.php';
        $query = "SELECT * FROM commande WHERE emailCompte = '{$client->getEmail()}'";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $emailCompte);
$stmt->execute();
$result = $stmt->get_result();


  // utilisation des données de la commande
  $this->id = $row["id"];
  $this->totalPayer = $row["totalPayer"];
  $this->modePayment = $row["modePayment"];
  $this->datePayment = $row["datePayment"];

$stmt->close();
$conn->close();
        $this ->totalPayer = $totalPayer;
        $this ->modePayment = $modePayment;
        $this->datePayment = date('Y-m-d H:i:s');
        $this->quantiteCommande = $quantiteCommande;
        $this->client = $client;
        $this->listeColis = $this->getColisByCommandeId($this->id);
        
      }

function getTotalPayer() {
    return $this->totalPayer;
}

function getModePayment() {
    return $this->modePayment;
}

function getDatePayment() {
    return $this->datePayment;
}


function getQuantiteCommande() {
    return $this->quantiteCommande;
}

function getClient() {
    return $this->client;
}

function getId() {
    return $this->id;
}

function getColisByCommandeId($idCommande) {
    // Connexion à la base de données
    require_once '..\..\database\config\connection.php';
    require_once '..\..\database\config\database.php';
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les informations de la table Colis en fonction de l'ID de commande donné
    $sql = "SELECT * FROM Colis WHERE idCommande = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCommande);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérification du résultat
    if ($result->num_rows > 0) {
        // Récupération des données dans un tableau associatif
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Fermeture de la connexion et retour des données
        $stmt->close();
        return $data;
    } else {
        // Fermeture de la connexion et retour d'un tableau vide
        $stmt->close();
        //echo "Probleme avec la requete";
    }
}



}
?>