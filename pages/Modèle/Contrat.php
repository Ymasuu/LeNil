<?

class Contrat {
private Compte $compte;
private int $numero;
private $texte; // de quel type va etre le texte?

function __construct(int $numero,Compte $compte) { 
    require_once '..\..\..\database\config\database.php';
      require_once '..\..\..\database\config\connection.php';
      //On recupere les données dans la bdd
    // Requête pour chercher un contrat avec un id donné
$id = $numero; 
$result = $mysqli->query("SELECT * FROM Contrat WHERE id = $id");

// Vérification de la requête
if (!$result) {
    echo "Error: " . $mysqli->error;
    exit();
}

// Traitement des résultats
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $numero = $row["numero"];
    $texte = $row["texte"];
    // Création d'un objet Contrat
    $contrat = new Contrat($id, $numero, $texte);
} else {
    echo "Aucun contrat trouvé avec l'id $id." .$mysqli->error;
}

// Fermeture de la connexion
$mysqli->close();
      


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

?>