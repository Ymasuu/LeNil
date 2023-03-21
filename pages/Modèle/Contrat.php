<?
class Contrat {
private Compte $compte;
private int $numero;
private $texte; // de quel type va etre le texte?

function __construct(int $numero,Compte $compte,$texte) { 
    $this ->numero = $numero;
    $this ->compte = $compte;
    $this->texte = $texte;
    
  }

  function getCompte() {
    return $this->compte;
}

function getNumero() {
    return $this->numero;
}

function getTextte() {
    return $this->texte;
}
}

?>