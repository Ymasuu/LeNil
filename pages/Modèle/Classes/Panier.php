<?
class Panier {
private $HT;
private $TTC;
private $TVA;
private Compte $compte;

function __construct(Compte $compte ,$HT,$TVA) { 
    $this ->HT = $HT;
    $this ->TVA = $TVA;
    $this->TTC = $HT + $TVA;
    $this->compte = $compte;
    
  }


  //Revoir comment afficher le panier...
  function afficherPanier() {
    return null;
}

  function getTVA() {
    return $this->TVA;
}

function getHT() {
    return $this->HT;
}

function getTTC() {
    return $this->TTC;
}

function getCompte() {
    return $this->compte;
}

}

?>