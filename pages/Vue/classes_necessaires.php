            
<?php
                class Compte {
                    private  string $email;
                    private string $motDePasse;
                    private bool $abonnement;
                    private bool $signatureContratClient;
                    private bool $signatureContratVendeur;
                    private $listeMoyensPayments; //1..* 
                    private Contrat $contrat; //1..1 une compte a un seul contrat
                    private Panier $panier;
                    
                  
                    function __construct(string $email) {
                        $this->email = $email;
                        // récupération des données de la base de données
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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
                            $numero = 0;//pour le numero du contrat
                            if ($this->signatureContratClient == 1) {
                                $numero = 1;
                            } else if($this->signatureContratVendeur == 1) {
                                $numero = 2;
                            } else {
                                $numero = 3;
                            }
                    
                            $sql = "SELECT * FROM contrat WHERE numero = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $numero);
                            $stmt->execute();
                            $result = $stmt->get_result();
                     // Récupérer les données du contrat
                     $contrat = $result->fetch_assoc();
                     $this->contrat = new Contrat($numero, $this);
                            // Vérifier s'il y a des résultats
                            /*if ($result->num_rows > 0) {
                               
                                // Afficher les données du contrat
                                //echo "Numéro du contrat: " . $contrat['numero'] . "<br>";
                                //echo "Texte du contrat: " . $contrat['texte'];
                                //echo "Aucun contrat trouvé avec ce numéro.";
                                // initialisation de $listeMoyensPayments
                                $sql2 = "SELECT * FROM MoyenPayment WHERE email = ?";
                                $stmt2 = $conn->prepare($sql2);
                                $stmt2->bind_param("s", $this->email);
                                $stmt2->execute();
                                $result2 = $stmt2->get_result();
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $this->listeMoyensPayments[] = $row2["type"];
                                    }
                                }
                            } */
                    
                            //Pour associer le panier au compte
                            $this->recupererPanierParEmailCompte($email);
                        }
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
                  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                  
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

                ///////////////----------------------------///////////////////////////




                ////////////////-CONTRAT-//////////////////////////////////////////////
                class Contrat {
                    private Compte $compte;
                    private int $numero;
                    private $texte; // de quel type va etre le texte?
                    
                    function __construct(int $numero,Compte $compte) { 
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                          //On recupere les données dans la bdd
                        // Requête pour chercher un contrat avec un id donné
                    $id = $numero; 
                    $result = $conn->query("SELECT * FROM Contrat WHERE numero = $id");
                    
                    // Vérification de la requête
                    if (!$result) {
                        echo "Error: " . $conn->error;
                        exit();
                    }
                    
                    // Traitement des résultats
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $numero = $row["numero"];
                        $texte = $row["texte"];
                        // Création d'un objet Contrat
                        //$contrat = new Contrat($id, $numero, $texte);
                    } else {
                        echo "Aucun contrat trouvé avec l'id $id." .$conn->error;
                    }
                    
                    // Fermeture de la connexion
                    $conn->close();
                          
                    
                    
                        $this ->numero = $numero;
                        $this ->compte = $compte;
                        $this->texte = $texte;
                        
                      }
                    
                      function getCompte() {
                        return $this->compte;
                    }
                    
                    function getNumero() {
                        return $this->numero;
                    }
                    
                    function getTextte() {
                        return $this->texte;
                    }
                    }

                ////////////////////////////////////////////////////////////////////////////

                //////////COMPTE LIVREUR////////////////////////////////////
                /*require_once '..\..\Modele\Classes\Compte.php';
                require_once '..\..\Modele\Classes\Client.php';
                require_once '..\..\Modele\Classes\Commande.php';
                require_once '..\..\Modele\Classes\Colis.php'; */
class CompteLivreur {
    private $emailCompte;
    private $tableauAssociatifColisClient = Array(); //0..* objets de type Colis à livrer
    private $listeDatesCommandes = Array(); //Juste une liste de meme taille que le tableau precedent pour afficher
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

$query = "SELECT colis.id as idColis, commande.*, colis.*
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
        if ($row['datePayment'] == NULL) {
            $row['datePayment'] = 0;
        }
        array_push($this->listeDatesCommandes,$row['datePayment']);

    }
}
    }
    
    // Méthode pour récupérer les colis à livrer pour le livreur en question
    public function getTableauAssociatifColisClient() {
    
        return $this->tableauAssociatifColisClient;
    }

    public function getEmail() {
        return $this->emailCompte;
    }

    public function getCEP() {
        return $this->cepLivreur;
    }
}

class Client {
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private int $numeroTel;
    private bool $connexion;
    private Compte $compte; //Le client a une seule compte
    private  $listeCommandes; //1..* Le client peut avoir plusieurs commandes
    private $listeRecherches; //0..* le Client peut avoir plusiers mots clées de recherche
    private $adresse;
    
    
    function __construct($email, Compte $compte) { 
      
      //On simule l'ajout d'une commande avant l'implementation dans
      //le site

      //date('Y-m-d H:i:s');
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

      //requête SQL avec la variable email
$sql = "SELECT i.emailCompte, i.prenom, i.nom, i.dateNaissance, i.telephone, i.adresse, i.ville, i.codePostal, i.pays, c.abonnement, c.dateAbonnement, c.signatureContratClient, c.signatureContratVendeur, c.signatureContratLivreur 
FROM InfoCompte i 
JOIN Compte c ON i.emailCompte = c.email 
WHERE i.emailCompte = '$email'";


$result = $conn->query($sql);

// on verifie si la requête a réussi
if (!$result) {
  die("La requête a échoué : " . $conn->error);
}

// on parcours les résultats et créer un objet Client avec les données récupérées
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $nom = $row["nom"];
  $prenom = $row["prenom"];
  $dateNaissance = new DateTime($row["dateNaissance"]);
  $numeroTel = $row["telephone"];
  $connexion = true;
  $compte = new Compte($row["emailCompte"]);
  $this->adresse = $row['adresse'];
  $this->recuperationRecherchesClient($conn,$row["emailCompte"]);
  //$client = new Client($nom, $prenom, $dateNaissance, $numeroTel, $connexion, $compte, $commande, $recherche);
} else {
  echo "Aucun client trouvé pour l'adresse e-mail '$email'." . $conn->error;
}

// Fermer la connexion
$conn->close();

      $this -> nom = $nom;
      $this -> prenom = $prenom;
      $this->dateNaissance = $dateNaissance->format('Y-m-d');
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
    function getAdresse() {
        return $this->adresse;
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
        require_once '..\..\database\config\database.php';
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
        $query = "SELECT * FROM commande WHERE emailCompte = ?";
        $stmt = $conn->prepare($query);
        $emailCompte = $client->getEmail();
        $stmt->bind_param("s", $emailCompte);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            // utilisation des données de la commande
            $this->id = $row["id"];
            $this->totalPayer = $row["totalPayer"];
            $this->modePayment = $row["modePayment"];
            $this->datePayment = $row["datePayment"];
        }
    
        $stmt->close();
        $conn->close();
    
        $this->client = $client;
        $this->totalPayer = 0;
        $this->modePayment = "";
        $this->datePayment = date('Y-m-d H:i:s');
        //On recupere la commande associé à ce client pour avoir la quantité exacte
        $tab = $client->getlisteCommande();
         //C'est la commande pour initialiser QuantiteCommande
         //On decomente cette partie une fois que le site prend en compte la commande d'un Client
        /*foreach($tab as $commande) {
            if ($commande->getClient()->getEmail() == $client->getEmail()) {
                $this->quantiteCommande = new QuantiteCommande($client->getAdresse(),$commande);
                break;
            } 
        } */
        
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
    
    require_once '..\..\database\config\database.php';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);

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

class Colis {
    private $id;
    private int $longueur;
    private int $largeur;
    private int $hauteur;
    private int $poids;
    private Commande $commande; //Le colis fait partie d'une commande

    function __construct(Commande $commande) { 
        $this->commande = $commande;
        require_once '..\..\database\config\database.php';
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Requête SQL pour récupérer toutes les informations de la table Colis
$query = "SELECT * FROM colis WHERE idCommande = {$commande->getId()}";
$result = $conn->query($query);

// Vérification des erreurs d'exécution de la requête SQL
if (!$result) {
    echo "Erreur d'exécution de la requête : (" . $conn->errno . ") " . $conn->error;
}
$row = $result->fetch_assoc();
// Récupération des données de la table Colis
    $this->id = $row['id'];
    $this->longueur = $row['longueur'];
    //$this->largeur = $row['largeur']; //probleme avec largeur il dit que l'attribut n'est pas inclus dans le resultat de la requete
    $this->hauteur = $row['hauteur'];
    $this->poids = $row['poids'];
    $this->commande= $commande;
    

// Fermeture de la connexion à la base de données
$conn->close();        
      }

      function getLongueur() {
        return $this->longueur;
    }
    function getLargeur() {
        return $this->largeur;
    }

    function getHauteur() {
        return $this->hauteur;
    }

    function getPoids() {
        return $this->poids;
    }

    function getId() {
        return $this->id;
    }
    function getCommande() {
        return $this->commande;
    }
}
?>