<?
class ProduitsVendeur {
    private int $quantite;
    private int $prix;

    function __construct(int $quantite ,int $prix) { 
        $this ->quantite = $quantite;
        $this ->prix = $prix;
        
      }

      function getPrix() {
        return $this->prix;
    }

    function getQuantite() {
        return $this->quantite;
    }
}

?>