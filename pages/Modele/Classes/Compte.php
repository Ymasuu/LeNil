<?

require_once 'Contrat.php';
require_once 'Panier.php';


class Compte {
    private static string $email;
    private string $motDePasse;
    private bool $abonnement;
    private bool $signatureContratClient;
    private bool $signatureContratVendeur;
    private $listeMoyensPayments; //1..* 
    private Contrat $contrat; //1..1 une compte a un seul contrat
    private Panier $panier;
    
  
    function __construct(string $email) {
      
      // récupération des données de la base de données
      require_once '..\..\..\database\config\database.php';
      require_once '..\..\..\database\config\connection.php';
      $sql = "SELECT * FROM Compte WHERE email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $this->abonnement = $row["abonnement"];
          $this->signatureContratClient = $row["signatureContratClient"];
          $this->signatureContratVendeur = $row["signatureContratVendeur"];

          // initialisation de $contrat
          $numero;//pour le numero du contrat
          if ($this->signatureContratClient == 1) {
            $numero = 1;
          }
          else if($this->signatureContratVendeur == 1) {
            $numero = 2;
          }
          else {
            $numero = 3;
          }
$sql = "SELECT * FROM contrat WHERE numero = $numero";

// Exécutez la requête
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
    // Récupérer les données du contrat
    $contrat = $result->fetch_assoc();
    $this->contrat = new Contrat($numero,$this);
    // Afficher les données du contrat
    //echo "Numéro du contrat: " . $contrat['numero'] . "<br>";
    //echo "Texte du contrat: " . $contrat['texte'];
    //echo "Aucun contrat trouvé avec ce numéro.";
          // initialisation de $listeMoyensPayments
          $sql2 = "SELECT * FROM MoyenPayment WHERE email = ?";
          $stmt2 = $conn->prepare($sql2);
          $stmt2->bind_param("s", $email);
          $stmt2->execute();
          $result2 = $stmt2->get_result();
          if ($result2->num_rows > 0) {
              while ($row2 = $result2->fetch_assoc()) {
                  $this->listeMoyensPayments[] = $row2["type"];
              }
          }
      }


      $this->email = $email;
      $this->motDePasse = $motDePasse;
      $this ->abonnement = $abonnement;
      $this ->signatureContratClient = $signatureContratClient;
      $this ->signatureContratVendeur = $signatureContratVendeur;
      
      //Pour associer le panier au compte
      $this->recupererPanierParEmailCompte($email);

  }
  
    function getEmail() {
      return $this->email;
    }
    function getMotDePasse() {
      return $this->motDePasse;
    }
    function getAbonnement() {
      return $this->abonnement;
    }
    function getSignatureContratClient() {
        return $this->signatureContratClient;
    }
    function getSignatureContratVendeur() {
        return $this->signatureContratVendeur;
    }

    function getContrat() {
      return $this->contrat;
  }
  
  function getPanier() {
    return $this->panier;
}

function recupererPanierParEmailCompte(string $emailCompte) {
  // récupération des données de la base de données
  require_once '..\..\..\database\config\database.php';
  require_once '..\..\..\database\config\connection.php';
  
  $sql = "SELECT * FROM panier WHERE emailCompte = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $emailCompte);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
        
    // créer un nouvel objet Panier avec les données récupérées
    $this->panier = new Panier($this);
    
  } else {
    //echo "Erreur dans la creation du panier pour ce Compte";
  }
}
    }

  ?>