<?
class Adresse {
    private string $numeroRue;
    private string $nomRue;
    private int $codePostal;
    private string $ville;
    private string $pays;
    private string $complementAdresse;
    
  
    function __construct(string $numeroRue, string $nomRue, int $codePostal,string $ville,string $pays, string $complementAdresse) { 
      $this -> numeroRue = $numeroRue;
      $this -> nomRue = $nomRue;
      $this -> codePostal = $codePostal;
      $this -> ville = $ville;
      $this -> pays = $pays;
      $this -> complementAdresse = $complementAdresse;
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
  }  
?>