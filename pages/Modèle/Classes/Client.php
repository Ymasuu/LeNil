<?
require_once 'Compte.php';
require_once 'Recherche.php';
require_once 'Commande.php';
class Client {
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private int $numeroTel;
    private bool $connexion;
    private Compte $compte; //Le client a une seule compte
    private  $listeCommandes; //1..* Le client peut avoir plusieurs commandes
    private $listeRecherches; //0..* le Client peut avoir plusiers mots clées de recherche
    
    
    function __construct(string $nom, string $prenom, $dateNaissance,int $numeroTel,bool $connexion, Compte $compte) { 
      
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
  $this->recuperationRecherchesClient($conn,$row["emailCompte"]);
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
    function getlisteCommande(){
        return $this->listeCommandes;
    }
    function getRecherche(){
        return $this->listeRecherches;
    }

    function getEmail() {
      return $this->compte->getEmail();
    }


    function recuperationRecherchesClient($conn,$emailCompte) {
      // Préparation de la requête
      $sql = "SELECT motCle FROM recherche WHERE emailCompte = ?";
      
      // Préparation de la commande préparée
      $stmt = $conn->prepare($sql);
      
      // Association des paramètres
      $stmt->bind_param("s", $emailCompte);
      
      // Exécution de la requête
      $stmt->execute();
      
      // Récupération des résultats
      $result = $stmt->get_result();
      
      // Affichage des résultats
      while ($row = $result->fetch_assoc()) {
          echo $row["motCle"] . "<br>";
      }
      
      // Fermeture de la commande préparée et de la connexion à la base de données
      $stmt->close();
          }

          function ajoutCommandeDansListeCommandesClient(Commande $commande) {
            //On cherche dans la classe Commande le client

            //On recupere cela dans le site. Le client
            //fait la commande puis on l'insere dans la bdd.

            //On ajoute dans cette classe Client la commande
            //qui vient d'etre ajouté

            array_push($listeCommandes, $commande);
          }
    
  }  
?>