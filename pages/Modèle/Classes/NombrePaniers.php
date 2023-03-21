<? 
class NombrePaniers {
//c'est la classe association entre Paniet et ProcuitVendeurs
private int $quantitePanier;
private ProduitsVendeur $produitVendeur; //1..1
private Panier $panier; //1..1

function __construct(int $quantitePanier,ProduitsVendeur $pv, Panier $p) { 
    $this ->quantitePanier = $quantitePanier;
    $this->produitVendeur = $pv;
    $this->panier = $p;

    
  }

  function getQuantitePanier() {
    return $this->quantitePanier;
}

function getProduitVendeur() {
    return $this->produitVendeur;
}

function getPanier() {
    return $this->panier;
}
}
?>