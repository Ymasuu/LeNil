<?

class Client {
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private int $numeroTel;
    private bool $connexion;
    private Compte $compte;
    private Commande $commande;
    private Recherche $recherche;
    
  
    function __construct(string $nom, string $prenom, $dateNaissance,int $numeroTel,bool $connexion, Compte $compte, Commande $commande, Recherche $recherche) { 
      
      require_once '..\..\..\database\config\database.php';
      require_once '..\..\..\database\config\connection.php';
      //date('Y-m-d H:i:s');
      
      // Préparer la requête SQL avec la variable email
$sql = "SELECT i.emailCompte, i.prenom, i.nom, i.dateNaissance, i.telephone, i.adresse, i.ville, i.codePostal, i.pays, c.abonnement, c.dateAbonnement, c.signatureContratClient, c.signatureContratVendeur, c.signatureContratLivreur 
FROM InfoCompte i 
JOIN Compte c ON i.emailCompte = c.email 
WHERE i.emailCompte = '$email'";

// Exécuter la requête SQL
$result = $conn->query($sql);

// Vérifier si la requête a réussi
if (!$result) {
  die("La requête a échoué : " . $conn->error);
}

// Parcourir les résultats et créer un objet Client avec les données récupérées
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $nom = $row["nom"];
  $prenom = $row["prenom"];
  $dateNaissance = new DateTime($row["dateNaissance"]);
  $numeroTel = $row["telephone"];
  $connexion = true;
  $compte = new Compte($row["emailCompte"], $row["motDePasse"], $row["abonnement"], new DateTime($row["dateAbonnement"]), $row["signatureContratClient"], $row["signatureContratVendeur"], $row["signatureContratLivreur"]);
  $commande = new Commande();
  $recherche = new Recherche();
  //$client = new Client($nom, $prenom, $dateNaissance, $numeroTel, $connexion, $compte, $commande, $recherche);
} else {
  echo "Aucun client trouvé pour l'adresse e-mail '$email'." . $conn->error;
}

// Fermer la connexion
$conn->close();

      $this -> nom = $nom;
      $this -> prenom = $prenom;
      $this -> dateNaissance = $dateNaissance;
      $this -> numeroTel = $numeroTel;
      $this -> connexion = $connexion;
      $this -> compte = $compte;
      $this -> commande = $commande;
      $this -> recherche = $recherche;

    }
  
    function getNom() {
      return $this->nom;
    }
    function getPrenom() {
      return $this->prenom;
    }
    function getDate() {
      return $this->dateNaissance;
    }
    function getNumeroTel() {
        return $this->numeroTel;
    }
    function getConnexion() {
        return $this->connexion;
    }
    function getCompte() {
        return $this->compte;
    }
    function getCommande(){
        return $this->commande;
    }
    function getRecherche(){
        return $this->recherche;
    }
  }  
?>