<?php
class Colis {
    private $id;
    private int $longueur;
    private int $largeur;
    private int $hauteur;
    private int $poids;
    private Commande $commande; //Le colis fait partie d'une commande

    function __construct(Commande $commande) { 

        require_once '..\..\database\config\connection.php';
        require_once '..\..\database\config\database.php';
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
    $this->largeur = $row['largeur'];
    $this->hauteur = $row['hauteur'];
    $this->poids = $row['poids'];
    $this->commande= $commande;
    

// Fermeture de la connexion à la base de données
$conn->close();        
      }

      function getLongueur() {
        return $this->longueur;
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
}