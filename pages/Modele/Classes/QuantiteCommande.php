<?

class QuantiteCommande {
    private Adresse $adresse;// 1..1 adresse
    private Commande $commande;//1..1 Commande
    private $nomCommande;
    private $emailClient;
    private $prix;
    private $quantite;
    private int $id;


    function __construct(Adresse $adresse,Commande $commande) {

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$query = "SELECT * FROM quantitecommande";

$result = $conn->query($query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Utilisation des données récupérées pour chaque ligne
    $this->id = $row["id"];
    $this->nomCommande = $row["nom"];
    $this->emailClient = $row["emailClient"];
    $this->quantite = $row["quantite"];
    $this->prix = $row["prix"];
  }
}

$conn->close();
        $this->adresse = $adresse;
        $this->commande = $commande;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCommande() {
        return $this->commande;
    }

}

?>