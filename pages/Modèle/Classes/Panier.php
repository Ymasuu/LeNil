<?
class Panier {
private $HT;
private $TTC;
private $TVA;
private $emailCompte;
private Compte $compte;
private $listeNombreQuantite;
private $listeProduits;

function __construct(Compte $compte) { 


require_once '..\..\database\config\connection.php';
require_once '..\..\database\config\database.php';

// Requête pour récupérer tous les attributs de la table "panier"
$sql = "SELECT * FROM panier WHERE emailCompte = '{$compte->getEmail()}'";

// Exécution de la requête
$result = $conn->query($sql);

// Vérification si la requête a réussi
if ($result) {
  // Boucle pour parcourir les résultats
  while ($row = $result -> fetch_assoc()) {
    // Récupération des valeurs de chaque colonne
    $emailCompte = $row["emailCompte"];
    $HT = $row["HT"];
    $TVA = $row["TVA"];
    $TTC = $row["TTC"];
    
  }
  
  // Libération des résultats de la requête
  $result -> free_result();
} else {
  // Affichage d'un message d'erreur si la requête a échoué
  echo "Erreur lors de la récupération des données : " . $mysqli -> error;
}

// Fermeture de la connexion
$conn -> close();

    $this ->HT = $HT;
    $this ->TVA = $TVA;
    $this->TTC = $HT + $TVA;
    $this->compte = $compte;
    $this->listeNombreQuantite = $listeNombreQuantite;
    
  }


  //Revoir comment afficher le panier...
  function afficherPanier() {
    return null;
}

  function getTVA() {
    return $this->TVA;
}

function getHT() {
    return $this->HT;
}

function getTTC() {
    return $this->TTC;
}

function getCompte() {
    return $this->compte;
}

function getEmailCompteClient() {
    return $this->emailCompte;
}

function getListeNombreQuantite() {
    return $this->listeNombreQuantite;
}

}

?>