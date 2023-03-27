<?
class Adresse {
    private string $numeroRue;
    private string $nomRue;
    private int $codePostal;
    private string $ville;
    private string $pays;
    private string $complementAdresse;
    private Compte $compte;
    private  $listeCommande; //1..*
    private $listeQuantiteCommande;//1..* objets de type QuantiteCommande
    
  
    function __construct(string $numeroRue, string $nomRue, int $codePostal,string $ville,string $pays, string $complementAdresse,Compte $compte, Commande $commande) { 
      $this -> numeroRue = $numeroRue;
      $this -> nomRue = $nomRue;
      $this -> codePostal = $codePostal;
      $this -> ville = $ville;
      $this -> pays = $pays;
      $this -> complementAdresse = $complementAdresse;
      $this -> compte = $compte;
      $this -> listeCommande = $commande;
      //On en deduit la listeQuantiteCommande à partir de la listeCommande
      $this->listeQuantiteCommande = null;//Il faut implementer encore
    }
  
    function getNumeroRue() {
      return $this->numeroRue;
    }
    function getNomRue() {
      return $this->nomRue;
    }
    function getCodePostal() {
      return $this->codePostal;
    }
    function getVille() {
        return $this->ville;
    }
    function getPays() {
        return $this->pays;
    }
    function getComplementAdresse(){
        return $this->complementAdresse;
    }
    function getCompte(){
        return $this->compte;
    }
    function getListeCommande(){
        return $this->listeCommande;
    }
  }  
?>