<?
include("Compte.php"); 

class Vendeur {
    private string $nom;
    private string $prenom;
    private Compte $compte;
    private Produit $produitsListe;
    
  
    function __construct(string $nom,string $prenom='',Compte $compte,Produit $produitsListe) { 
      $this->nom = $nom;
      $this-> prenom = $prenom;
      $this -> compte = $compte;
      $this -> produitsListe = $produitsListe;
    
  
    }
  
    function getNom() {
      return $this->nom;
    }
    function getPrenom() {
      return $this->prenom;
    }
    function getCompte() {
      return $this->compte;
    }
    function getProduits() {
        return $this->produitsListe;
    }
    
  }
  
  ?>
