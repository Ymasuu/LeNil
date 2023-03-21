<?
class MoyenPayment {
private $CodePromo;
private $listeComptes; // 1..* liste de type Compte ayant les comptes associées au moyen de payment

//à defaut, les moyens de payment sont nulls
function __construct($CodePromo = null) { 
    $this -> $this->CodePromo;
    
  }

function getCodePromo() {
    return $this->CodePromo;
}
}
?>