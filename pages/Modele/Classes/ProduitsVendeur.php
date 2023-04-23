<?
class ProduitsVendeur {
    private int $quantite;
    private int $prix;
    private $listeProduits; //1..* C'est une liste ayant tous les types de Produit
            //qu'il y a dans le site que le vendeur dispose pour vendre
            private $listeNombreQuantite; //0..*

    function __construct(int $quantite ,int $prix,$listeProduits,$listeNombreQuantite) { 
        $this ->quantite = $quantite;
        $this ->prix = $prix;
        $this->listeProduits = $listeProduits;
        $this->listeNombreQuantite = $listeNombreQuantite;
        
      }

      function getPrix() {
        return $this->prix;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getListeProduits() {
        return $this->listeProduits;
    }

    function getListeNombreQuantite() {
        return $this->listeNombreQuantite;
    }

    
}

?>