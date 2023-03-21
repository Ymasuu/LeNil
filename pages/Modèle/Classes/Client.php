<?
class Client {
    private string $nom;
    private string $prenom;
    private $dateNaissance = date('Y-m-d H:i:s');
    private int $numeroTel;
    private bool $connexion;
    private Compte $compte;
    private Commande $commande;
    private Recherche $recherche;
    
  
    function __construct(string $nom, string $prenom, $dateNaissance,int $numeroTel,bool $connexion, Compte $compte, Commande $commande, Recherche $recherche) { 
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