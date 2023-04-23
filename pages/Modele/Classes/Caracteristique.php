<?
class Carateristique {
    private int $valeur;
    private String $libelle;
    private Produit $produit; //1..1 la caracteristique appartien à un seul Produit

    function __construct(int $valeur, String $libelle,Produit $produit) { 
        $this ->valeur = $valeur;
        $this->libelle = $libelle;
        $this->produit = $produit;
        
      }

      function getValeur() {
        return $this->valeur;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getProduit() {
        return $this->produit;
    }



}