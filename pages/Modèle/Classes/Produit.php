<?
class Produit {
    private ProduitsVendeur $ProduitsVendeur; //1..1

    private String $description;
    private Carateristique $caracteristique;

    function __construct(String $description ,ProduitsVendeur $pv,Carateristique $caracteristique) { 
        $this ->ProduitsVendeur = $pv;
        $this ->description = $description;
        $this ->caracteristique = $caracteristique;
        
        
      }

      function getDescription() {
        return $this->description;
    }

    function getProduitVendeur() {
        return $this->ProduitsVendeur;
    }

    function getCaracteristique() {
        return $this->caracteristique;
    }
}
?>