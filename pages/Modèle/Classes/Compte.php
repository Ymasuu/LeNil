<?
class Compte {
    private static string $email;
    private string $motDePasse;
    private bool $abonnement;
    private bool $signatureContratClient;
    private bool $signatureContratVendeur;
    private $listeMoyensPayments;
    
  
    function __construct(string $email, string $motDePasse,bool $abonnement,$signatureContratClient,$signatureContratVendeur) { 
      $this->email = $email;
      $this->motDePasse = $motDePasse;
      $this ->abonnement = $abonnement;
      $this ->signatureContratClient = $signatureContratClient;
      $this ->signatureContratVendeur = $signatureContratVendeur;
    
  
    }
  
    function getEmail() {
      return $this->email;
    }
    function getMotDePasse() {
      return $this->motDePasse;
    }
    function getAbonnement() {
      return $this->abonnement;
    }
    function getSignatureContratClient() {
        return $this->signatureContratClient;
    }
    function getSignatureContratVendeur() {
        return $this->signatureContratVendeur;
    }
    
  }
  
  ?>